<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\Action;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EditProfile extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        $loggedInOperator = auth()->user();
        return [
            Action::make(name: 'Change Password')
                ->form([
                    Hidden::make('tenant_id')
                        ->default($loggedInOperator->tenant_id),
                    TextInput::make('Old password')
                        ->password()
                        ->label(label: 'Old Password')
                        ->rule(Password::default()),
                    TextInput::make('New Password')
                        ->password()
                        ->label(label: 'New Password')
                        ->rule(Password::default()),
                    TextInput::make('Confirm password')
                        ->password()
                        ->label(label: 'Confirm Password')
                        ->same(statePath: 'New Password')
                        ->rule(Password::default())
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'password' => Hash::make($data['New Password'])
                    ]);
                    $this->notify(status: 'success', message: 'Password updated successfully');
                })
        ];
    }

    protected function getFormSchema(): array
    {
        $loggedInOperator = auth()->user();
        return [
            Forms\Components\TextInput::make('name')->required()
                ->maxLength(255),
            Forms\Components\Hidden::make('tenant_id')
                ->default($loggedInOperator->tenant_id),
            Forms\Components\TextInput::make('email')
                ->rules(['required', 'email'])
        ];
    }

    protected function resolveRecord($key): Model
    {
        $loggedInOperator = auth()->user();

        $key = $loggedInOperator->id;

        $record = static::getResource()::resolveMyRecordRouteBinding($key);

        if ($record === null) {
            throw (new ModelNotFoundException())->setModel($this->getModel(), [$key]);
        }

        return $record;
    }
}
