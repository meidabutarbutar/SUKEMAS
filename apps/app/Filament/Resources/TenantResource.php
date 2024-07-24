<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Tenant;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')->default('name')
                            ->label('Nama Instansi')
                            ->required()
                            ->reactive()
                            ->maxLength(255)
                            ->afterStateUpdated(function (Closure $set, $state) {
                                $set('slug', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('slug')->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->maxLength(255)
                            ->label('Deskripsi Instansi'),
                        Forms\Components\FileUpload::make('logo_path')
                            ->label('Logo')
                            ->image()
                            ->minSize(500)
                            ->maxSize(1000),
                        Forms\Components\TextInput::make('address')->required()
                            ->maxLength(255)
                            ->label('Alamat Instansi'),
                        Forms\Components\Select::make('province_id')
                            ->label('Provinsi')
                            ->options(Province::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('token')
                            ->required()
                            ->hidden(),
                        Forms\Components\Select::make('regency_id')
                            ->label('Kabupaten')
                            ->options(Regency::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('district_id')
                            ->label('Kecamatan')
                            ->options(District::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }

    public static function resolveMyRecordRouteBinding($key): ?Model
    {
        return app(static::getModel())
            ->resolveRouteBindingQuery(static::getModel()::query(), $key, static::getRecordRouteKeyName())
            ->first();
    }
}
