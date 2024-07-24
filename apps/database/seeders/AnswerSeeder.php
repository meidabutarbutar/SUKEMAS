<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Respondent;

class AnswerSeeder extends AbstractSeeder
{
    protected $modelClass = Answer::class;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $respondents = Respondent::all();

        $questions = Question::where(['question_set_id' => 1])
            ->get();

        foreach ($respondents as $respondent) {
            foreach ($questions as $question) {
                $answer_option_id = rand(1, 4);

                $record = new $this->modelClass([
                    'respondent_id' => $respondent->id,
                    'question_id' => $question->id,
                    'answer_option_id' => $answer_option_id,
                    'value' => $answer_option_id,
                ]);

                $record->save();
            }
        }
    }

    protected function data(): array
    {
        return [];
    }
}
