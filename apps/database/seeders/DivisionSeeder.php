<?php

namespace Database\Seeders;

use App\Models\Division;

class DivisionSeeder extends AbstractSeeder
{
    protected $modelClass = Division::class;

    protected function data(): array
    {
        return [
            [
                'tenant_id' => 1,
                'name' => 'Seksi Perekonomian Kesra dan Pelayanan Umum',
            ],
            [
                'tenant_id' => 1,
                'name' => 'Seksi Pembangunan dan Pemberdayaan Masyarakat dan Desa',
            ],
        ];
    }
}
