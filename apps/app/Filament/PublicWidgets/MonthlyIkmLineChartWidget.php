<?php

namespace App\Filament\PublicWidgets;

use App\Models\Answer;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class MonthlyIkmLineChartWidget extends AbstractFilterableLineChartWidget
{
    protected static ?string $heading = 'Grafik IKM';

    protected static ?int $sort = 1;

    protected static ?array $options = [
        'scales' => [
            'y' => [
                'beginAtZero' => true,
                'min' => 0.0,
                'max' => 4.0,
                'ticks' => [
                    'stepSize' => 0.5,
                ],
            ],
        ],
    ];

    protected function getData(): array
    {
        $startPeriod = $this->startPeriod
            ->clone()
            ->startOfMonth()
            ->startOfDay();

        $endPeriod = $this->endPeriod
            ->clone()
            ->endOfMonth()
            ->endOfDay();

        $divisions = $this->tenant->divisions()
            ->orderBy('name')
            ->get();

        $datasets = [];

        $labels = collect([]);

        $divisions->each(function ($division, $key) use (&$datasets, &$labels, $startPeriod, $endPeriod) {
            $trendValues = Trend::query(Answer::forDivision($division->id))
                ->between(
                    start: $startPeriod,
                    end: $endPeriod
                )
                ->perMonth()
                ->average('value');

            $labels = ($labels->count()) ?
                $labels :
                $trendValues->map(fn (TrendValue $trendValue) => $trendValue->date);

            $datasets[] = [
                'label' => $division->short_name,
                'data' => $trendValues->map(fn (TrendValue $trendValue) => $trendValue->aggregate),
                'backgroundColor' => 'rgba(255, 99, 132, 1)',
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'borderWidth' => 1
            ];
        });

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }
}
