<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends AbstractSeeder
{
    protected $modelClass = User::class;

    protected function data(): array
    {
        return [
            [
                'tenant_id' => 1,
                'name' => 'Mastuari',
                'username' => 'mastuari',
                'email' => 'mastuariotf@gmail.com',
                'email_verified_at' => Carbon::createFromFormat('d/m/Y H:i:s', '03/03/2023 00:00:00'),
                'password' => Hash::make('msukemas1234'),
            ],
            [
                'tenant_id' => 2,
                'name' => 'Rufina',
                'username' => 'rufina',
                'email' => 'aprilinarufinaf@gmail.com',
                'email_verified_at' => Carbon::createFromFormat('d/m/Y H:i:s', '03/03/2023 00:00:00'),
                'password' => Hash::make('rsukemas1234'),
            ],
            [
                'tenant_id' => 2,
                'name' => 'Meida',
                'username' => 'meida',
                'email' => 'meidaangelichabutarbutar@gmail.com',
                'email_verified_at' => Carbon::createFromFormat('d/m/Y H:i:s', '03/03/2023 00:00:00'),
                'password' => Hash::make('sukemas1234'),
            ],
            [
                'tenant_id' => 1,
                'name' => 'Theresia',
                'username' => 'theresia',
                'email' => 'theresiahaan0712@gmail.com',
                'email_verified_at' => Carbon::createFromFormat('d/m/Y H:i:s', '03/03/2023 00:00:00'),
                'password' => Hash::make('sukemas1234'),
            ],
            [
                'tenant_id' => 1,
                'name' => 'Sihar',
                'username' => 'sihar',
                'email' => 'siharsiahaan@gmail.com',
                'email_verified_at' => Carbon::createFromFormat('d/m/Y H:i:s', '03/03/2023 00:00:00'),
                'password' => Hash::make('sukemas1234'),
            ],
            [
                'tenant_id' => 2,
                'name' => 'Marcel',
                'username' => 'marcel',
                'email' => 'marceljoshua69@gmail.com',
                'email_verified_at' => Carbon::createFromFormat('d/m/Y H:i:s', '03/03/2023 00:00:00'),
                'password' => Hash::make('sukemas1234'),
            ],
        ];
    }
}
