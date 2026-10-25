<?php

namespace App\Filament\Resources;

use App\Events\MessageSent;
use App\Filament\Resources\ChatConversationResource\Pages;
use App\Filament\Resources\ChatConversationResource\RelationManagers;
use App\Models\ChatConversation;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ChatConversationResource extends Resource
{
    protected static ?string $model = ChatConversation::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Chat Inbox';

    protected static ?string $modelLabel = 'Conversation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'open' => 'Open',
                        'closed' => 'Closed',
                    ])
                    ->required()
                    ->default('open'),
                Forms\Components\Select::make('assigned_user_id')
                    ->label('Assign to Operator')
                    ->options(User::role(['admin', 'operator'])->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assignedUser.name')
                    ->label('Assigned To')
                    ->sortable()
                    ->default('Unassigned'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'open',
                        'gray' => 'closed',
                    ]),
                Tables\Columns\TextColumn::make('last_message_at')
                    ->label('Last Activity')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->default('Never'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Started')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('last_message_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'open' => 'Open',
                        'closed' => 'Closed',
                    ]),
                Tables\Filters\SelectFilter::make('assigned_user_id')
                    ->label('Assigned To')
                    ->relationship('assignedUser', 'name'),
            ])
            ->actions([
                Tables\Actions\Action::make('reply')
                    ->label('Balas')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('primary')
                    ->form([
                        Forms\Components\Textarea::make('message')
                            ->label('Pesan Balasan ke Pelanggan')
                            ->required()
                            ->maxLength(2000)
                            ->rows(3),
                    ])
                    ->action(function (ChatConversation $record, array $data): void {
                        $msg = $record->messages()->create([
                            'user_id' => auth()->id(),
                            'sender_type' => 'admin',
                            'message' => $data['message'],
                        ]);
                        $record->update(['last_message_at' => now(), 'status' => 'open']);
                        try {
                            event(new MessageSent($msg));
                        } catch (\Throwable $e) {
                        }

                        Notification::make()
                            ->title('Pesan balasan berhasil dikirim ke pelanggan')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MessagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChatConversations::route('/'),
            'view' => Pages\ViewChatConversation::route('/{record}'),
            'edit' => Pages\EditChatConversation::route('/{record}/edit'),
        ];
    }
}
