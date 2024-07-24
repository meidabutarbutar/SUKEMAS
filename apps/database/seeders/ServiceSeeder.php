<?php

namespace Database\Seeders;

use App\Models\Service;

class ServiceSeeder extends AbstractSeeder
{
    protected $modelClass = Service::class;

    protected function data(): array
    {
        return [
            [
                'division_id' => 1,
                'name' => 'Rekomendasi Penerbitan KTP',
            ],
            [
                'division_id' => 1,
                'name' => 'Rekomendasi Penerbitan KK',
            ],
            [
                'division_id' => 1,
                'name' => 'Penerbitan Surat Keterangan Pindah',
            ],
            [
                'division_id' => 1,
                'name' => 'Penerbitan Surat Keterangan Tidak Mampu',
            ],
            [
                'division_id' => 1,
                'name' => 'Penerbitan Surat Keterangan Lainnya',
            ],
            [
                'division_id' => 2,
                'name' => 'Pendampingan/ penyelesaian sengketa di Desa/ Kelurahan',
            ],
            [
                'division_id' => 2,
                'name' => 'Rekomendasi Pemberkasan SKHM',
            ],
            [
                'division_id' => 2,
                'name' => 'Rekomendasi Pemberkasan IMB',
            ],
            [
                'division_id' => 2,
                'name' => 'Penerbitan Surat Ahli Waris',
            ],
            [
                'division_id' => 2,
                'name' => 'Penerbitan Surat Keterangan Meninggal Dunia',
            ],
            [
                'division_id' => 2,
                'name' => 'Rekomendasi Penerbitan Reklame (Spanduk, Baliho, dll)',
            ],
        ];
    }
}
