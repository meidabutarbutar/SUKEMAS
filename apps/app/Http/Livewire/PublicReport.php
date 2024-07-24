<?php

namespace App\Http\Livewire;

use App\Models\Tenant;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

/**
 * Acting as a proxy class to satisfy Livewire's namespace.
 */
class PublicReport extends \App\Filament\Pages\AbstractPublicReport
{
    public ?Tenant $tenant;

    public ?Carbon $startPeriod;

    public ?Carbon $endPeriod;

    protected static ?string $title = '';

    public function mount()
    {
        parent::mount();

        $this->fill([]);

        $this->widgetData = [
            'tenant' => $this->tenant,
            'startPeriod' => $this->startPeriod,
            'endPeriod' => $this->endPeriod,
        ];
    }

    protected function getHeader(): View
    {
        return view(
            'filament.pages.abstract-public-report-header',
            $this->widgetData
        );
    }
}
