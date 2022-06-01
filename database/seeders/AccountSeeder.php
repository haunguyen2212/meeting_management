<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AccountSeeder extends Seeder
{

    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('accounts')->insert([
            [
                'id' => 1,
                'username' => 'nguyentrunghau',
                'password' => Hash::make('12345'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 2,
                'username' => 'huynhkhacsu',
                'password' => Hash::make('12345'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 3,
                'username' => 'tnhuudinh',
                'password' => Hash::make('12345'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 4,
                'username' => 'lanhdao1',
                'password' => Hash::make('12345'),
                'role_id' => 2,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 5,
                'username' => 'quanly1',
                'password' => Hash::make('12345'),
                'role_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 6,
                'username' => 'hotro1',
                'password' => Hash::make('12345'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 7,
                'username' => 'hotro2',
                'password' => Hash::make('12345'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 8,
                'username' => 'hotro3',
                'password' => Hash::make('12345'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 9,
                'username' => 'hotro4',
                'password' => Hash::make('12345'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 10,
                'username' => 'hotro5',
                'password' => Hash::make('12345'),
                'role_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
