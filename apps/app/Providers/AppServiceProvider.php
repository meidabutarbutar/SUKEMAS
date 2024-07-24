<?php

namespace App\Providers;

use App\Filament\Resources\TenantResource;
use App\Filament\Resources\UserResource;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Filament::serving(
            function () {

                $userMenus = [];
                if (auth()->hasUser()) {
                    $loggedInOperator = auth()->user();

                    $userMenus[] = UserMenuItem::make()
                        ->label('Update Profile')
                        ->url(UserResource::getUrl('edit-profile', ['record' => $loggedInOperator->id]));

                    $userMenus[] = UserMenuItem::make()
                        ->label('Update Tenant')
                        ->url(TenantResource::getUrl('edit', ['record' => $loggedInOperator->tenant->id]));
                }

                Filament::registerUserMenuItems(
                    $userMenus
                );

            }
        );
    }

}