<?php

namespace Database\Seeders;

use App\Models\AnswerType;

class AnswerTypeSeeder extends AbstractSeeder
{
    protected $modelClass = AnswerType::class;

    protected function data(): array
    {
        return [
            [
                'name' => 'Tidak Sesuai, Kurang Sesuai, Sesuai, Sangat Sesuai',
            ],
            [
                'name' => 'Tidak Mudah, Kurang Mudah, Mudah, Sangat Mudah',
            ],
            [
                'name' => 'Tidak Cepat, Kurang Cepat, Cepat, Sangat Cepat',
            ],
            [
                'name' => 'Sangat Mahal, Cukup Mahal, Murah, Gratis',
            ],
            [
                'name' => 'Tidak Kompeten, Kurang Kompeten, Kompeten, Sangat Kompeten',
            ],
            [
                'name' => 'Tidak Sopan dan Ramah, Kurang Sopan dan Ramah, Sopan dan Ramah, Sangat Sopan dan Ramah',
            ],
            [
                'name' => 'Buruk, Cukup, Baik, Sangat Baik',
            ],
            [
                'name' => 'Tidak Ada, Ada tetapi Tidak Berfungsi, Berfungsi Kurang Maksimal, Dikelola dengan Baik',
            ],
        ];
    }
}
