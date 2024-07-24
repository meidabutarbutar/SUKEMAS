<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProvinceSeeder::class,
            RegencySeeder::class,
            DistrictSeeder::class,
            VillageSeeder::class,

            AgeOptionSeeder::class,
            AnswerTypeSeeder::class,
            AnswerOptionSeeder::class,
            OccupationOptionSeeder::class,

            TenantSeeder::class,
            DivisionSeeder::class,
            ServiceSeeder::class,

            QuestionSetSeeder::class,
            QuestionSeeder::class,
            RespondentSeeder::class,
            AnswerSeeder::class,

            UserSeeder::class,
        ]);
    }
}
