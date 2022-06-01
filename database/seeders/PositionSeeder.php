<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PositionSeeder extends Seeder
{

    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('positions')->insert([
            [
                'id' => 1,
                'name' => 'Trưởng phòng',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 2,
                'name' => 'Phó trưởng phòng',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 3,
                'name' => 'Nhân viên',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
