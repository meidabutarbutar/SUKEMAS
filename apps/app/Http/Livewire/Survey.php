<?php

namespace App\Http\Livewire;

use App\Models\AgeOption;
use App\Models\Answer;
use App\Models\Division;
use App\Models\OccupationOption;
use App\Models\Question;
use App\Models\QuestionSet;
use App\Models\Respondent;
use App\Models\Service;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Survey extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?Tenant $tenant;

    public ?Division $division;

    public ?Service $service;

    public ?Respondent $respondent = null;

    public ?QuestionSet $questionSet = null;

    public $data;

    public function mount(): void
    {
        parent::mount();

        $this->form->fill([]);
    }

    protected function getQuestionaireFormSchema(): array
    {
        $formSchema = [];

        $questions = $this->tenant->questionSet->questions;

        $counter = 1;

        $questions->each(function (Question $item, int $index) use (&$formSchema, &$counter) {
            $formSchema[] = \App\Forms\Components\CustomRadio::make('answers.' . $item->id)
                ->label("{$counter}. {$item->question}")
                ->options([
                    1 => "Sangat tidak setuju",
                    2 => "Tidak setuju",
                    3 => "Setuju",
                    4 => "Sangat setuju",
                ])
                ->default(rand(1, 4));

            ++$counter;
        });

        $formSchema[] = Forms\Components\TextInput::make('respondent.comment')
            ->label('Ada komentar/saran/kritik?');

        return [
            Wizard\Step::make('Pertanyaan')
                ->schema($formSchema)
        ];
    }

    protected function getFormSchema(): array
    {
        $respondentFormSchema = [
            Wizard\Step::make('Responden')
                ->schema([
                    Forms\Components\Radio::make('respondent.age_option_id')
                        ->label('Usia')
                        ->options(AgeOption::all()->pluck('value', 'id'))
                        ->required(),
                    Forms\Components\Radio::make('respondent.occupation_option_id')
                        ->label('Pekerjaan')
                        ->options(OccupationOption::all()->pluck('name', 'id'))
                        ->required(),
                    Forms\Components\Radio::make('respondent.gender')
                        ->label('Jenis Kelamin')
                        ->options([
                            'male' => 'Pria',
                            'female' => 'Wanita',
                        ])->required(),
                    Forms\Components\Select::make('respondent.village_id')
                        ->label('Domisili')
                        ->options(
                            $this->tenant->district->villages->pluck('name', 'id')
                        )->searchable(),
                ])->columns(2),
        ];

        return [
            Wizard::make(array_merge(
                $respondentFormSchema,
                $this->getQuestionaireFormSchema()
            ))->submitAction(view('components.forms.submit-button'))
        ];
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    public function submit(): void
    {
        $answers = [];

        foreach ($this->data['answers'] as $key => $value) {
            $answers[] = new Answer([
                'question_id' => $key,
                'value' => $value,
            ]);
        }

        $respondent = new Respondent([
            'tenant_id' => $this->tenant->id,
            'service_id' => $this->service->id,
            'division_id' => $this->division->id,
        ]);

        $respondent->fill($this->data['respondent']);

        DB::beginTransaction();

        $saved = false;
        try {
            $saved = $respondent->save();

            $respondent->answers()->saveMany($answers);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            logger()->error('survey', [
                'method' => __METHOD__,
                'exception' => $exception->getMessage(),
            ]);
        }

        $this->redirectRoute('survey-end', [
            'tenant' => $this->tenant->token,
        ]);
    }

    public function render()
    {
        return view('livewire.survey');
    }
}
