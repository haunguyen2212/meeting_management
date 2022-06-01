<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SupporterSeeder extends Seeder
{
    
    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');
        $date = Carbon::now()->format('Y-m-d');

        DB::table('supporters')->insert([
            [
                'id' => 1,
                'user_id' => 6,
                'date' => $date,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 2,
                'user_id' => 7,
                'date' => $date,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 3,
                'user_id' => 8,
                'date' => $date,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 4,
                'user_id' => 9,
                'date' => $date,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 5,
                'user_id' => 10,
                'date' => $date,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
