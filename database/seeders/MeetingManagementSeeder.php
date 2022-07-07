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
                'qty' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'date' => $date,
                'type_sp_id' => 2,
                'qty' => 5,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'date' => $date,
                'type_sp_id' => 3,
                'qty' => 10,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
