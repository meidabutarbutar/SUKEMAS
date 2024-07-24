<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Regency;
use Livewire\Component;
use App\Models\District;
use App\Models\Province;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use AbanoubNassem\FilamentGRecaptchaField\Forms\Components\GRecaptcha;

class Register extends Component implements HasForms
{
    use InteractsWithForms;

    # tenant section
    public $tenant_name = '';
    public $tenant_address = '';
    public $tenant_logo = '';
    public $tenant_province_id = '';
    public $tenant_regency_id = '';
    public $tenant_district_id = '';

    # operator section
    public $operator_name = '';
    public $operator_email = '';
    public $operator_email_confirmation = '';
    public $operator_password = '';
    public $operator_password_confirmation = '';

    public function getFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('Instansi')
                    ->schema([
                        Fieldset::make('Data Instansi')
                        ->schema([
                            Grid::make(2)
                            ->schema([
                                Grid::make(1)
                                ->schema([
                                    TextInput::make('tenant_name')
                                    ->label('Nama Instansi')
                                    ->required()
                                    ->maxLength(255),
                                    TextInput::make('tenant_address')
                                    ->label('Alamat Instansi')
                                    ->required()
                                    ->maxLength(255),
                                    TextInput::make('tenant_logo')
                                    ->label('Logo')
                                    ->required(),
                                ])->columnSpan('half'),
                                Grid::make(1)
                                ->schema([
                                    Select::make('tenant_province_id')
                                    ->label('Provinsi')
                                    ->required()
                                    ->options(Province::all()->pluck('name', 'id')->toArray())
                                    ->searchable()
                                    ->reactive()
                                    ->afterStateUpdated(fn (callable $set) => $set('tenant_regency_id', null)),
                                    Select::make('tenant_regency_id')
                                    ->label('Kota/Kabupaten')
                                    ->required()
                                    ->searchable()
                                    ->options(function (callable $get) {
                                        $province = Province::find($get('tenant_province_id'));
                                        if (! $province) {
                                            return Regency::all()->pluck('name', 'id');
                                        }
                                        return $province->regencies->pluck('name', 'id');
                                    })
                                    ->reactive()
                                    ->afterStateUpdated(fn (callable $set) => $set('tenant_district_id', null)),
                                    Select::make('tenant_district_id')
                                    ->label('Kecamatan')
                                    ->required()
                                    ->options(function (callable $get) {
                                        $regency = Regency::find($get('tenant_regency_id'));
                                        if (! $regency) {
                                            return District::all()->pluck('name', 'id');
                                        }
                                        return $regency->districts->pluck('name', 'id');
                                    })
                                    ->searchable()
                                ])->columnSpan('half')
                            ])
                        ]),
                    ]),
                Wizard\Step::make('Operator')
                    ->schema([
                        Fieldset::make('Data Operator')
                        ->schema([
                            Grid::make(2)
                            ->schema([
                                Grid::make(1)
                                ->schema([
                                    TextInput::make('operator_name')
                                        ->label('Nama')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('operator_email')
                                        ->label('Email')
                                        ->email()
                                        ->required()
                                        ->maxLength(50)
                                        ->unique(User::class)
                                        ->same('operator_email_confirmation'),
                                    TextInput::make('operator_email_confirmation')
                                        ->label('Konfirmasi Email')
                                        ->email()
                                        ->required()
                                        ->maxLength(50)
                                        ->same('operator_email'),
                                ])
                                ->columnSpan('half'),
                                Grid::make(1)
                                ->schema([
                                    TextInput::make('operator_password')
                                        ->label('Password')
                                        ->password()
                                        ->required()
                                        ->maxLength(50)
                                        ->minLength(8)
                                        ->same('operator_password_confirmation')
                                        ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                                    TextInput::make('operator_password_confirmation')
                                        ->label('Konfirmasi Password')
                                        ->password()
                                        ->required()
                                        ->maxLength(50)
                                        ->minLength(8)
                                        ->dehydrated(false),
                                    GRecaptcha::make('captcha')
                                ])
                                ->columnSpan('half'),
                            ])
                        ])
                    ]),
            ])
            ->submitAction(view('forms.submit-button'))
        ];
    }

    public function submit()
    {
        // TODO: validate request

        $token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        while (Tenant::where('token', $token)->exists()) {
            $token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        }

        Tenant::create([
            'name' => $this->tenant_name,
            'address' => $this->tenant_address,
            'province_id' => $this->tenant_province_id,
            'regency_id' => $this->tenant_regency_id,
            'district_id' => $this->tenant_district_id,
            'slug' => SlugService::createSlug(Tenant::class, 'slug', $this->tenant_name),
            'token' => $token,
            'logo_path' => $this->tenant_logo,
            'latitude' => '1.11111',
            'longitude' => '2.22222',
            'description' => 'dummy-desc'
        ]);

        User::create([
            'name' => $this->operator_name,
            'tenant_id' => Tenant::firstWhere('name', $this->tenant_name)->id,
            // TODO: add field username in form
            'email' => $this->operator_email,
            // TODO: generate email verifying stamp
            'password' => Hash::make($this->operator_password)
        ]);

        // TODO: add flash for reporting successful registration

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.register');
    }
}
