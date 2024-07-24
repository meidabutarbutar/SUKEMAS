<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\StatsOverviewWidget;
use App\Filament\Widgets\ReportsChart;
use App\Filament\Widgets\IkmReportsChart;

class Reports extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.reports';

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverviewWidget::class,
            ReportsChart::class,
            IkmReportsChart::class,
        ];
    }
}
