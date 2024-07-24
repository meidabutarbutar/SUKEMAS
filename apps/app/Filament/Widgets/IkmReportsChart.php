<?php

namespace App\Filament\Widgets;

use App\Models\Answer;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class IkmReportsChart extends LineChartWidget
{
    protected static ?string $heading = 'Chart';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        // First day of the year
        $firstDay = Carbon::now()->startOfYear();

        // Last day of the month
        $lastDay = Carbon::now()->endOfMonth();

        $div1 = Trend::query(Answer::query()->forDivision(1))
            ->dateColumn('created_at')
            ->between(
                start: $firstDay,
                end: $lastDay
            )
            ->perMonth()
            ->average($div1 = 'value');

        $div2 = Trend::query(Answer::query()->forDivision(2))

            ->dateColumn('created_at')
            ->between(
                start: $firstDay,
                end: $lastDay
            )
            ->perMonth()
            ->average($div2 = 'value');

        logger()->info('Chart', [
            'method' => __METHOD__,
            'firstDay' => $firstDay->format('Y/m/d'),
            'lastDay' => $lastDay->format('Y/m/d'),
        ]);

        return [
            'datasets' => [
                [
                    'label' => 'Rata-Rata Nilai IKM Divisi 1 ',
                    'data' => $div1->map(fn (TrendValue $div1) => $div1->aggregate),
                    'backgroundColor' => 'rgba(255, 99, 132, 1)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Rata-Rata Nilai IKM Divisi 2',
                    'data' =>  $div2->map(fn (TrendValue $div2) => $div2->aggregate),
                    'backgroundColor' => 'rgba(54, 162, 235, 1)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1
                ]
            ],
            'options' =>
            [
                'scales' => [
                    'yAxes' => [[
                        'ticks' => ['beginAtZero' => true]
                    ]]
                ]
            ],
            'labels' => $div1->map(fn (TrendValue $div1) => $div1->date),
            'label' => $div2->map(fn (TrendValue $div2) => $div2->date),
        ];
    }
}
