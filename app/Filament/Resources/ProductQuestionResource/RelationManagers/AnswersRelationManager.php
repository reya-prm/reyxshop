<?php

namespace App\Filament\Resources\ProductQuestionResource\RelationManagers;

use App\Models\QuestionAnswer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AnswersRelationManager extends RelationManager
{
    protected static string $relationship = 'answers'; // Eloquent relation name on ProductQuestion

    protected static ?string $title = 'Answers';

    protected static ?string $recordTitleAttribute = 'answer';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('answer')
                    ->required()
                    ->maxLength(2000),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('answer')
                    ->wrap()
                    ->limit(100),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Admin')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['user_id'] = auth()->id();
                        return $data;
                    })
                    ->after(function ($record) {
                        // Update parent question status to answered
                        $record->question->update(['status' => 'answered']);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->after(function ($record) {
                        // If no other answers remain, set status back to pending
                        if ($record->question->answers()->count() === 0) {
                            $record->question->update(['status' => 'pending']);
                        }
                    }),
            ]);
    }
}
