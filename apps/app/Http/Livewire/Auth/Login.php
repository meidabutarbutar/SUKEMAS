<?php

namespace App\Http\Livewire\Auth;

use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;

/**
 * @property ComponentContainer $form
 */
class Login extends \Filament\Http\Livewire\Auth\Login
{
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->label(__('filament::login.fields.email.label'))
                ->email()
                ->default(app()->hasDebugModeEnabled() ? 'mastuariotf@gmail.com' : '')
                ->required()
                ->autocomplete(),
            TextInput::make('password')
                ->label(__('filament::login.fields.password.label'))
                ->password()
                ->default(app()->hasDebugModeEnabled() ? 'msukemas1234' : '')
                ->required(),
            Checkbox::make('remember')
                ->label(__('filament::login.fields.remember.label'))
                ->default(true),
        ];
    }

    public function render(): View
    {
        return view('filament::login')
            ->layout('filament::components.layouts.card');
    }
}
