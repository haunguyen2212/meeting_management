<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MeetingManagementSeeder extends Seeder
{
    
    
    public function run()
    {
        $dateTime = Carbon::now()->add(-1, 'day')->format('Y-m-d H:i:s');
        $date = Carbon::now()->add(-1, 'day')->format('Y-m-d');

        DB::table('meeting_managements')->insert([
            [
                'date' => $date,
                'type_sp_id' => 1,
                'max_qty' => 4,
                'remaining_qty' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'date' => $date,
                'type_sp_id' => 2,
                'max_qty' => 5,
                'remaining_qty' => 5,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'date' => $date,
                'type_sp_id' => 3,
                'max_qty' => 10,
                'remaining_qty' => 10,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
