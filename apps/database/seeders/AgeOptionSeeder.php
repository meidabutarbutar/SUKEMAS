<?php

namespace Database\Seeders;

use App\Models\AgeOption;

class AgeOptionSeeder extends AbstractSeeder
{
    protected $modelClass = AgeOption::class;

    protected function data() : array
    {
        return [
            [
                'value' => '< 21 thn',
            ],
            [
                'value' => '21 - 46 thn',
            ],
            [
                'value' => '> 46 thn',
            ],
        ];
    }
}
