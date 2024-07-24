<?php

namespace App\Filament\Pages;

use App\Filament\PublicWidgets\MonthlyIkmLineChartWidget;
use App\Filament\PublicWidgets\MonthlyRespondentsChartWidget;
use App\Filament\PublicWidgets\StatsWidget;
use Filament\Pages\Page;

abstract class AbstractPublicReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.abstract-public-report';

    /**
     * This attribute will be passed into widgets via the view file.
     */
    public array $widgetData = [];

    protected static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            MonthlyRespondentsChartWidget::class,
            MonthlyIkmLineChartWidget::class,
        ];
    }
}
