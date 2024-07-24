<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class TenantSeeder extends AbstractSeeder
{
    protected $modelClass = Tenant::class;

    protected function data(): array
    {
        return [
            [
                'name' => 'Kantor Camat Sigumpar',
                'address' => 'Jl. Lintas Sumatera, Sigumpar Dangsina, Kec. Sigumpar, Toba, Sumatera Utara 22384',
                'province_id' => 12,
                'regency_id' => 163,
                'district_id' => 2051,
                'slug' => 'camat-sigumpar',
                'token' => '728261',
                'logo_path' => './img/logo/camat-sigumpar.png',
                'latitude' => 2.39056292923147,
                'longitude' => 99.15533665849597,
                'description' => 'Kantor Camat Sigumpar merupakan kantor camat yang berada di Kecamatan Sigumpar',
                'submitted_at' => Carbon::createFromFormat('d/m/Y H:i:s', '03/03/2023 00:00:00'),

            ],
            [
                'name' => 'UPT Puskesmas Soposurung',
                'address' => 'Hinalang Bagasan, Kec. Balige, Toba, Sumatera Utara 22312',
                'province_id' => 12,
                'regency_id' => 164,
                'district_id' => 2083,
                'slug' => 'puskesmas-soposurung',
                'token' => '527725',
                'logo_path' => './img/logo/puskesmas-soposurung.png',
                'latitude' => 2.3270077124665085,
                'longitude' => 99.04932559279551,
                'description' => 'Kantor Camat Sigumpar merupakan kantor camat yang berada di Kecamatan Sigumpar',
                'submitted_at' => Carbon::createFromFormat('d/m/Y H:i:s', '03/03/2023 00:00:00'),

            ]
        ];
    }
}