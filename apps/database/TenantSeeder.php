<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Tenant;

class TenantSeeder extends AbstractSeeder
{
    protected $modelClass = Tenant::class;

    protected function data(): array
    {
        return [
            [
                'name' => 'Kantor Camat Sigumpar',
                'website' => 'https://tobakab.go.id/',
                'address' => 'Jl. Lintas Sumatera, Sigumpar Dangsina',
                'postal_code' => '22384',
                'province_id' => Province::firstWhere('name', 'Sumatera Utara')->id,
                'regency_id' => Regency::firstWhere('name', 'Kabupaten Toba Samosir')->id,
                'district_id' => District::firstWhere('name', 'Kecamatan Sigumpar')->id,
                'slug' => 'camat-sigumpar',
                'token' => '728261',
                'logo_path' => './img/logo/camat-sigumpar.png',
                'latitude' => 2.39056292923147,
                'longitude' => 99.15533665849597,
                'description' => 'Kantor Camat Sigumpar merupakan kantor camat yang berada di Kecamatan Sigumpar',
            ],
            [
                'name' => 'UPT Puskesmas Soposurung',
                'address' => 'Jl. Hinalang Bagasan',
                'postal_code' => '22312',
                'province_id' => Province::firstWhere('name', 'Sumatera Utara')->id,
                'regency_id' => Regency::firstWhere('name', 'Kabupaten Toba Samosir')->id,
                'district_id' => District::firstWhere('name', 'Kecamatan Balige')->id,
                'slug' => 'puskesmas-soposurung',
                'token' => '527725',
                'logo_path' => './img/logo/puskesmas-soposurung.png',
                'latitude' => 2.3270077124665085,
                'longitude' => 99.04932559279551,
                'description' => 'Kantor Camat Sigumpar merupakan kantor camat yang berada di Kecamatan Sigumpar',
            ]
        ];
    }
}
