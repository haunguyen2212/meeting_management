<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    

    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('users')->insert([
            [
                'id' => 1,
                'username' => 'admincp',
                'password' => Hash::make('12345678'),
                'role_id' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 2,
                'username' => 'CB00001',
                'password' => Hash::make('12345678'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 3,
                'username' => 'CB00002',
                'password' => Hash::make('12345678'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 4,
                'username' => 'CB00003',
                'password' => Hash::make('12345678'),
                'role_id' => 2,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 5,
                'username' => 'CB00004',
                'password' => Hash::make('12345678'),
                'role_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 6,
                'username' => 'CB00005',
                'password' => Hash::make('12345678'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 7,
                'username' => 'CB00006',
                'password' => Hash::make('12345678'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 8,
                'username' => 'CB00007',
                'password' => Hash::make('12345678'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 9,
                'username' => 'CB00008',
                'password' => Hash::make('12345678'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 10,
                'username' => 'CB00009',
                'password' => Hash::make('12345678'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],

        ]);

    }
}
