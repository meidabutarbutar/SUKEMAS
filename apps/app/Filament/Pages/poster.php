<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class poster extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.poster';


    protected function setUp(): array
    {
        return [
        posterWidget::class,
        ];
   
    }
}
