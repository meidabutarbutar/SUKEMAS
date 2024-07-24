<?php

namespace App\Filament\PublicWidgets;

use App\Models\Answer;
use App\Models\Respondent;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsWidget extends AbstractFilterableStatsWidget
{
    protected function getCards(): array
    {
        $startPeriod = $this->startPeriod->clone()
            ->firstOfMonth();

        $endPeriod = $this->endPeriod->clone()
            ->lastOfMonth()
            ->endOfDay();

        $numOfRespondent = Respondent::query()
            ->forTenantBetween(
                $this->tenant,
                $startPeriod,
                $endPeriod
            )->count();

        $ikm = Answer::query()
            ->forTenantBetween(
                $this->tenant,
                $startPeriod,
                $endPeriod
            )->avg('value');

        $prevEndPeriod = $startPeriod->clone()
            ->subMonth()
            ->endOfMonth()
            ->endOfDay();

        $prevStartPeriod = $prevEndPeriod->clone()
            ->startOfMonth()
            ->startOfDay();

        $prevIkm = Answer::query()
            ->forTenantBetween(
                $this->tenant,
                $prevStartPeriod,
                $prevEndPeriod,
            )->avg('value');

        $diff = round($ikm - $prevIkm, 2);

        $ikmDescription = 'Tidak Ada Peningkatan';

        $ikmIcon = '';

        $ikmColor = 'primary';

        if ($diff > 0) {
            $ikmDescription = "Peningkatan {$diff}";

            $ikmIcon = 'heroicon-s-trending-up';

            $ikmColor = 'success';
        } else if ($diff < 0) {
            $ikmDescription = "Penurunan {$diff}";

            $ikmIcon = 'heroicon-s-trending-down';

            $ikmColor = 'danger';
        }

        return [
            Card::make(
                'Jumlah Responden',
                $numOfRespondent
            )
                ->icon('heroicon-o-user')
                ->description('Periode: ' . $startPeriod->format('d-M') . ' s.d. ' . $endPeriod->format('d-M')),

            Card::make(
                'Rata-Rata IKM',
                round($ikm, 2) . ' / ' . ($diff > 0 ? '+' : '') . round($diff, 2)
            )
                ->description($ikmDescription)
                ->descriptionIcon($ikmIcon)
                ->color($ikmColor),
        ];
    }
}
