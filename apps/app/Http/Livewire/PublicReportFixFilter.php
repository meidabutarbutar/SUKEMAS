<?php

namespace App\Http\Livewire;

use App\Models\Tenant;
use Filament\Forms;
use Illuminate\Support\Carbon;
use Livewire\Component;

class PublicReportFixFilter extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?Tenant $tenant;

    public ?Carbon $startPeriod;

    public ?Carbon $endPeriod;

    public array $filterOptions = [];

    public ?int $selectedOption = 0;

    public function mount(): void
    {
        parent::mount();

        $this->buildOptions([1, 2, 3, 4, 6, 12]);

        $this->form->fill([]);
    }

    protected function buildOptions(array $ranges): void
    {
        foreach ($ranges as $key => $range) {
            $this->filterOptions[$range] = "{$range} bulan";
        }
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('selectedOption')
                ->label('Periode Laporan')
                ->options($this->filterOptions)
                ->required()
                ->reactive(),
        ];
    }

    public function render()
    {
        return view('livewire.public-report-fix-filter');
    }

    public function updatedSelectedOption($value)
    {
        /**
         * The period fixed based on the start period.
         */
        $startPeriod = $this->endPeriod->clone();

        $startPeriod->subMonths($this->selectedOption);

        $this->redirectRoute('public-report', [
            'tenant' => $this->tenant->token,
            'startPeriod' => $startPeriod->format('Y-m'),
            'endPeriod' => $this->endPeriod->format('Y-m'),
        ]);
    }

    public function submit()
    {
        // nothing
    }
}
