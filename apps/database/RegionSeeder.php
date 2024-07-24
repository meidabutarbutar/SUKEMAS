<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataPath = database_path('data');

        $provinceDirectories = File::directories($dataPath);

        foreach ($provinceDirectories as $provinceDirectory) {
            $provinceName = basename($provinceDirectory);
            $province = Province::create(['name' => $provinceName]);

            $regencyDirectories = File::directories($provinceDirectory);

            foreach ($regencyDirectories as $regencyDirectory) {
                $regencyName = basename($regencyDirectory);
                $regency = Regency::create([
                    'province_id' => $province->id,
                    'name' => $regencyName
                ]);

                $districtDirectories = File::directories($regencyDirectory);

                foreach ($districtDirectories as $districtDirectory) {
                    $districtName = basename($districtDirectory);
                    $district = District::create([
                        'regency_id' => $regency->id,
                        'name' => $districtName
                    ]);

                    $villagesFilePath = $districtDirectory . '/villages.txt';
                    $villageNames = file($villagesFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                    foreach ($villageNames as $villageName) {
                        Village::create([
                            'district_id' => $district->id,
                            'name' => $villageName
                        ]);
                    }
                }
            }
        }
    }
}
