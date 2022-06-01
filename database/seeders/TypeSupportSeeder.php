<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TypeSupportSeeder extends Seeder
{
    
    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('types_support')->insert([
            [
                'id' => 1,
                'name' => 'Hỗ trợ họp qua Hội nghị truyền hình',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 2,
                'name' => 'Hỗ trợ cán bộ kỹ thuật vận hành phòng họp trực tuyến của đơn vị',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 3,
                'name' => 'Hỗ trợ phòng họp trực tuyến qua hệ thống Jitsi Meet',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
