<?php

namespace App\Http\Livewire;

use App\Models\Respondent;
use App\Models\Tenant;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Livewire\Component;

class PublicReportFilter extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?string $startPeriod;

    public ?string $endPeriod;

    public ?Tenant $tenant;

    public ?int $startYear;

    public ?int $startMonth;

    public ?int $endYear;

    public ?int $endMonth;

    public function mount(): void
    {
        $startPeriod = Carbon::createFromFormat('Y-m', $this->startPeriod);

        $endPeriod = Carbon::createFromFormat('Y-m', $this->endPeriod);

        $this->form->fill([
            'startYear' => $startPeriod->format('Y'),
            'startMonth' => $startPeriod->format('m'),
            'endYear' => $endPeriod->format('Y'),
            'endMonth' => $endPeriod->format('m'),
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Fieldset::make('Periode Statistik')
                ->schema([
                    Forms\Components\Select::make('startYear')
                        ->label('Dari Tahun')
                        ->inlineLabel()
                        ->options($this->yearOptions())
                        ->disablePlaceholderSelection()
                        ->required(),
                    Forms\Components\Select::make('startMonth')
                        ->label('Bulan')
                        ->inlineLabel()
                        ->options($this->monthOptions())
                        ->disablePlaceholderSelection()
                        ->required(),
                    Forms\Components\Select::make('endYear')
                        ->label('Sampai Tahun')
                        ->inlineLabel()
                        ->options($this->yearOptions())
                        ->disablePlaceholderSelection()
                        ->required(),
                    Forms\Components\Select::make('endMonth')
                        ->label('Bulan')
                        ->inlineLabel()
                        ->options($this->monthOptions())
                        ->disablePlaceholderSelection()
                        ->required(),
                ])
                ->columns(4),
        ];
    }

    public function render()
    {
        return view('livewire.public-report-filter');
    }

    protected function getEnd(bool $max = true, bool $year = true): string
    {
        $query = Respondent::where('tenant_id', 1);

        // get the created_date
        $date = $max ? $query->max('created_at') : null;

        // to a Carbon object
        $date = $date ? new Carbon($date) : Carbon::now();

        return $year ? $date->format('Y') : $date->format('m');
    }

    protected function yearOptions(): array
    {
        $options = [];

        $maxYear =  $this->getEnd(true, true);

        $minYear =  $this->getEnd(false, true);

        for (; $maxYear >= $minYear; --$maxYear) {
            $options[$maxYear] = $maxYear;
        }

        return $options;
    }

    protected function monthOptions(): array
    {
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
    }

    public function submit()
    {
        $startPeriod = Carbon::createFromFormat(
            'Y-m',
            $this->startYear . '-' . $this->startMonth
        );

        $endPeriod = Carbon::createFromFormat(
            'Y-m',
            $this->endYear . '-' . $this->endMonth
        );

        if ($startPeriod->gt($endPeriod)) {
            $temp = $endPeriod;
            $endPeriod = $startPeriod;
            $startPeriod = $temp;
        }

        $this->startPeriod = $startPeriod->format('Y-m');

        $this->endPeriod = $endPeriod->format('Y-m');

        $this->redirectRoute('public-report', [
            'tenant' => $this->tenant->token,
            'startPeriod' => $this->startPeriod,
            'endPeriod' => $this->endPeriod,
        ]);
    }
}
