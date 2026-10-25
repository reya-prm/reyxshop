<?php

namespace App\Filament\Resources\ChatConversationResource\RelationManagers;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MessagesRelationManager extends RelationManager
{
    protected static string $relationship = 'messages';

    protected static ?string $title = 'Messages';

    protected static ?string $recordTitleAttribute = 'message';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('sender_type')
                    ->options([
                        'admin' => 'Admin',
                        'operator' => 'Operator',
                        'system' => 'System',
                        'customer' => 'Customer',
                    ])
                    ->default('admin')
                    ->required(),
                Forms\Components\Textarea::make('message')
                    ->required()
                    ->maxLength(2000)
                    ->rows(3),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sender_type')
                    ->badge()
                    ->colors([
                        'primary' => 'customer',
                        'success' => 'admin',
                        'warning' => 'operator',
                        'gray' => 'system',
                    ]),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengirim')
                    ->default(fn (ChatMessage $record) => $record->sender_type === 'customer' ? ($record->conversation->user->name ?? 'Customer') : 'Admin ReyxShop'),
                Tables\Columns\TextColumn::make('message')
                    ->wrap()
                    ->limit(100),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Sent at')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'asc')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Send Reply')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['user_id'] = auth()->id();
                        $data['sender_type'] = $data['sender_type'] ?? 'admin';

                        return $data;
                    })
                    ->after(function (ChatMessage $record) {
                        $record->conversation->update(['last_message_at' => now()]);
                        try {
                            event(new MessageSent($record));
                        } catch (\Throwable $e) {
                        }
                    })
                    ->successNotificationTitle('Pesan balasan berhasil dikirim.'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
