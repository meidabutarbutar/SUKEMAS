<?php

namespace Database\Seeders;

use App\Models\OccupationOption;

class OccupationOptionSeeder extends AbstractSeeder
{
    protected $modelClass = OccupationOption::class;

    protected function data(): array
    {
        return [
            [
                'name' => 'TNI/POLRI',
            ],
            [
                'name' => 'ASN',
            ],
            [
                'name' => 'Wiraswasta',
            ],
            [
                'name' => 'Karyawan swasta',
            ],
            [
                'name' => 'IRT',
            ],
        ];
    }
}
