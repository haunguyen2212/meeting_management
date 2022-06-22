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
                'name' => 'Hội nghị truyền hình',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 2,
                'name' => 'Hỗ trợ cán bộ kỹ thuật',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 3,
                'name' => 'Họp trực tuyến Jitsi Meet',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
