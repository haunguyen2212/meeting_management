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

        DB::table('supporters')->insert([
            [
                'id' => 1,
                'user_id' => 7,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 2,
                'user_id' => 8,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 3,
                'user_id' => 9,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 4,
                'user_id' => 10,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
