<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        $loggedInOperator = auth()->user();

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()
                    ->maxLength(255),
                Forms\Components\Hidden::make('tenant_id')
                    ->default($loggedInOperator->tenant_id),
                Forms\Components\TextInput::make('email')
                    ->rules(['required', 'email', 'unique:users,email'])
            ])->columns(columns: 1);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutMe();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('username'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('deactivate')
                    ->label('Deactivate')
                    ->icon('heroicon-s-pencil')
                    ->mountUsing(function (Forms\ComponentContainer $form, User $record) {
                        return $form->fill([]);
                    })
                    ->action(function (User $record, array $data): void {
                        $loggedInOperator = auth()->user();

                        // Protection against self-deactivation
                        if ($record->id == $loggedInOperator->id) {
                            Notification::make()
                                ->title('You cannot deactivate yourself')
                                ->danger()
                                ->send();

                            return;
                        }

                        // Protection against incorrect password
                        if (!Hash::check($data['password'], $loggedInOperator->password)) {
                            Notification::make()
                                ->title('Password does not match')
                                ->danger()
                                ->send();

                            return;
                        }

                        // Protection against minimum number of operator(s)
                        // The minimum number of operator should be configurable
                        if (User::all()->count() <= 2) {
                            Notification::make()
                                ->title('Minimum number of operator is violated')
                                ->danger()
                                ->send();

                            return;
                        }

                        Notification::make()
                            ->title('This operator has been deactivated successfully')
                            ->success()
                            ->send();

                        $record->delete();
                    })
                    ->form([
                        TextInput::make('password')
                            ->label('Password')
                            ->required(),
                    ])
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'edit-profile' => Pages\EditProfile::route('/{record}/edit-profile'),
        ];
    }

    public static function resolveMyRecordRouteBinding($key): ?Model
    {
        return app(static::getModel())
            ->resolveRouteBindingQuery(static::getModel()::query(), $key, static::getRecordRouteKeyName())
            ->first();
    }
}
