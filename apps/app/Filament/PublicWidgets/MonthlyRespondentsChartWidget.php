<?php

namespace App\Filament\PublicWidgets;

use App\Models\Respondent;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class MonthlyRespondentsChartWidget extends AbstractFilterableBarChartWidget
{
    protected static ?string $heading = 'Jumlah Responden';

    protected function getData(): array
    {
        $respondent = Trend::model(Respondent::class)
            ->dateColumn('submitted_at')
            ->between(
                start: $this->startPeriod,
                end: $this->endPeriod
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Responden',
                    'data' => $respondent->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => [
                        '#f59e0b',
                    ],
                    'borderColor' => [
                        '#f59e0b',
                    ],
                    'borderWidth => 3',
                    'barPercentage' => '0.5',
                    'barThickness' => '100',
                    'maxBarThickness' => '35',
                    'minBarLength' => '10',
                ],
            ],
            'labels' => $respondent->map(fn (TrendValue $value) => $value->date),
        ];
    }
}
