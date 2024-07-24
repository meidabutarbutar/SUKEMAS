<?php

namespace App\Filament\Widgets;

use App\Models\Answer;
use App\Models\Respondent;
use Illuminate\Support\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverviewWidget extends BaseWidget
{
    protected function getCards(): array
    {
        $loggedInOperator = auth()->user();

        $answer = Answer::all()->avg('value');

        return [
            Card::make(
                'Jumlah Responden Bulan Ini',
                Respondent::whereMonth('submitted_at', '>', Carbon::now()->subDays(30))
                    ->count()
            ),
            Card::make('Jumlah Total Responden', Respondent::all()->count()),
            Card::make('Rata-Rata IKM', number_format((float)$answer, 2, '.', '')),
        ];
    }
}
