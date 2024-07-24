<?php

namespace App\Filament\PublicWidgets;

use App\Models\Tenant;
use Illuminate\Support\Carbon;
use Filament\Widgets\BarChartWidget;

abstract class AbstractFilterableBarChartWidget extends BarChartWidget
{
    public ?Tenant $tenant;

    public ?Carbon $startPeriod;

    public ?Carbon $endPeriod;

    /**
     * Autorefresh 10 mins (600 secs).
     */
    protected static ?string $pollingInterval = '600s';

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];
}
