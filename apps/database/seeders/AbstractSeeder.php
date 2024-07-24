<?php

namespace Database\Seeders;

abstract class AbstractSeeder extends \Illuminate\Database\Seeder
{
    // Base Seeder
    protected $modelClass = null;

    protected function data() : array
    {
        return [];
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = $this->data();

        foreach ($data as $datum) {
            $record = new $this->modelClass($datum);

            $record->save();
        }
    }
}
