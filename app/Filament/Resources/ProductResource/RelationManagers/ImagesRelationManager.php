<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image_path')
                    ->image()
                    ->directory('products')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('alt_text')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_primary')
                    ->label('Primary Image')
                    ->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('image_path')
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->square()
                    ->size(60),
                Tables\Columns\TextColumn::make('alt_text')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_primary')
                    ->label('Primary')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        // If is_primary is set, ensure only one primary per product
                        if (!empty($data['is_primary'])) {
                            $productId = $this->getOwnerRecord()->id;
                            DB::table('product_images')
                                ->where('product_id', $productId)
                                ->update(['is_primary' => false]);
                        }
                        return $data;
                    })
                    ->after(function () {
                        // If no primary exists after creation, set first image as primary
                        $productId = $this->getOwnerRecord()->id;
                        $hasPrimary = DB::table('product_images')
                            ->where('product_id', $productId)
                            ->where('is_primary', true)
                            ->exists();
                        if (!$hasPrimary) {
                            DB::table('product_images')
                                ->where('product_id', $productId)
                                ->orderBy('id', 'asc')
                                ->limit(1)
                                ->update(['is_primary' => true]);
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data, $record): array {
                        // If toggling primary on edit, un‑primary other images
                        if (!empty($data['is_primary'])) {
                            DB::table('product_images')
                                ->where('product_id', $record->product_id)
                                ->where('id', '!=', $record->id)
                                ->update(['is_primary' => false]);
                        }
                        return $data;
                    }),
                Tables\Actions\DeleteAction::make()
                    ->after(function ($record) {
                        // If deleted image was primary, promote another if exists
                        if ($record->is_primary) {
                            DB::table('product_images')
                                ->where('product_id', $record->product_id)
                                ->where('id', '!=', $record->id)
                                ->orderBy('sort_order')
                                ->limit(1)
                                ->update(['is_primary' => true]);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
