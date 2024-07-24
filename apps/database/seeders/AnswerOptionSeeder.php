<?php

namespace Database\Seeders;

use App\Models\AnswerOption;

class AnswerOptionSeeder extends AbstractSeeder
{
    protected $modelClass = AnswerOption::class;

    protected function data(): array
    {
        return [
            [
                'answer_type_id' => 1,
                'value' => '1',
            ],
            [

                'answer_type_id' => 2,
                'value' => '2',
            ],
            [
                'answer_type_id' => 3,
                'value' => '3',
            ],
            [
                'answer_type_id' => 4,
                'value' => '4',
            ],
        ];
    }
}
