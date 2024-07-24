<?php

namespace App\Filament\Widgets;

use App\Models\Respondent;
use Filament\Widgets\BarChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class ReportsChart extends BarChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        // First day of the year
        $firstDay = Carbon::now()->startOfYear();

        // Last day of the month
        $lastDay = Carbon::now()->endOfMonth();

        $respondent = Trend::model(Respondent::class)
            ->dateColumn('submitted_at')
            ->between(
                start: $firstDay,
                end: $lastDay
            )
            ->perMonth()
            ->count();

        logger()->info('Chart', [
            'method' => __METHOD__,
            'firstDay' => $firstDay->format('Y/m/d'),
            'lastDay' => $lastDay->format('Y/m/d'),
            'responden' => $respondent,
        ]);

        return [
            'datasets' => [
                [
                    'barPercentage' => '0.5',
                    'barThickness' => '100',
                    'maxBarThickness' => '35',
                    'minBarLength' => '10',
                    'label' => 'Jumlah Responden',
                    'data' => $respondent->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => [
                        '#f59e0b',
                    ],
                ],
            ],
            'labels' => $respondent->map(fn (TrendValue $value) => $value->date),
        ];
    }
}
