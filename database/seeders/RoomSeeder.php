<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    
    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');
        DB::table('rooms')->insert([
            [
                'id' => 1,
                'name' => 'Phòng họp 1',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 2,
                'name' => 'Phòng họp 2',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 3,
                'name' => 'Phòng họp 3',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 4,
                'name' => 'Phòng họp 4',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 5,
                'name' => 'Phòng họp 5',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
