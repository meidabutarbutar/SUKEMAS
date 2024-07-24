<?php

namespace Database\Seeders;

use App\Models\QuestionSet;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionSetSeeder extends AbstractSeeder
{
    // disable events and observers
    use WithoutModelEvents;

    protected $modelClass = QuestionSet::class;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        parent::run();

        $this->attachTenantDefaultQuestionSet();
    }

    protected function attachTenantDefaultQuestionSet()
    {
        Tenant::withoutEvents(function () {
            // attach to all tenants
            Tenant::all()
                ->each
                ->update(['question_set_id' => 1]);
        });
    }

    protected function data(): array
    {
        return [
            [
                'tenant_id' => 1,
                'name' => 'Default',
                'reference' => 'PermenPAN-RB RI No. 14 Tahun 2017',
            ],
            [
                'tenant_id' => 2,
                'name' => 'Default tenant 2',
                'reference' => 'PermenPAN-RB RI No. 14 Tahun 2017',
            ],
        ];
    }
}
