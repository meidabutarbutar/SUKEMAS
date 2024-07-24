<?php

namespace Database\Seeders;

use App\Models\Question;

class QuestionSeeder extends AbstractSeeder
{
    protected $modelClass = Question::class;

    protected function data(): array
    {
        return [
            [
                'answer_type_id' => '1',
                'question_set_id' => '1',
                'question' => 'Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya.',
                'order' => '1',
            ],
            [
                'answer_type_id' => '2',
                'question_set_id' => '1',
                'question' => 'Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini.',
                'order' => '2',
            ],
            [
                'answer_type_id' => '3',
                'question_set_id' => '1',
                'question' => 'Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan.',
                'order' => '3',
            ],
            [
                'answer_type_id' => '4',
                'question_set_id' => '1',
                'question' => 'Bagaimana pemahaman Saudara tentang kewajaran biaya/tarif dalam pelayanan.',
                'order' => '4',
            ],
            [
                'answer_type_id' => '1',
                'question_set_id' => '1',
                'question' => 'Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan.',
                'order' => '5',
            ],
            [
                'answer_type_id' => '5',
                'question_set_id' => '1',
                'question' => 'Bagaimana pendapat Saudara tentang kompetensi/ kemampuan petugas dalam pelayanan.',
                'order' => '6',
            ],
            [
                'answer_type_id' => '6',
                'question_set_id' => '1',
                'question' => 'Bagamana pendapat saudara perilaku petugas dalam pelayanan terkait kesopanan dan keramahan.',
                'order' => '7',
            ],
            [
                'answer_type_id' => '7',
                'question_set_id' => '1',
                'question' => 'Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana.',
                'order' => '8',
            ],
            [
                'answer_type_id' => '8',
                'question_set_id' => '1',
                'question' => 'Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan.',
                'order' => '9',
            ],
        ];
    }
}
