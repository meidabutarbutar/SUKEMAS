<?php

namespace App\View\Components;

use App\Models\Service;
use App\Models\Tenant;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ServiceSelection extends Component
{
    public ?Tenant $tenant;

    public Collection $services;

    /**
     * Create a new component instance.
     */
    public function __construct(?Tenant $tenant)
    {
        $this->tenant = $tenant;

        $this->services = Service::query()
            ->forTenant($tenant)
            ->get();

        logger()->info('service-selection', [
            'method' => __METHOD__,
            'tenant' => $this->tenant->name,
            'services' => $this->services->toArray(),
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.service-selection');
    }
}
