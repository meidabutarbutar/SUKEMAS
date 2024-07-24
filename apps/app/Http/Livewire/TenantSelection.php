<?php

namespace App\Http\Livewire;

use App\Models\Tenant;
use Filament\Forms;
use Livewire\Component;

class TenantSelection extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?string $token = null;

    public function mount(): void
    {
        parent::mount();

        $this->form->fill([]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('token')
                ->label('')
                ->numeric()
                ->minLength(6)
                ->maxLength(6)
                ->default(728261)
                ->extraInputAttributes(['class' => 'text-center font-semibold'])
                ->required()
        ];
    }

    public function submit()
    {
        logger()->info('open-report', [
            'method' => __METHOD__,
        ]);

        if (!$this->token || !$this->tenantExists($this->token)) {
            return;
        }

        session(['tenant.token' => $this->token]);

        $this->redirectRoute('survey', [
            'tenant' => $this->token,
        ]);
    }

    public function openReport()
    {
        logger()->info('open-report', [
            'method' => __METHOD__,
        ]);

        if (!$this->token || !$this->tenantExists($this->token)) {
            return;
        }

        session(['tenant.token' => $this->token]);

        $this->redirectRoute('public-report', [
            'tenant' => $this->token,
        ]);
    }

    protected function tenantExists(string $token): bool
    {
        return Tenant::where('token', $this->token)
            ->exists();
    }

    public function render()
    {
        return view('livewire.tenant-selection');
    }
}
