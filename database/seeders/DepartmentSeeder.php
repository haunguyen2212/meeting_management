<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DepartmentSeeder extends Seeder
{

    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('departments')->insert([
            [
                'id' => 1,
                'name' => 'Phòng Bưu chính, Viễn thông - Công nghệ thông tin',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 2,
                'name' => 'Phòng Thông tin - Báo Chí - Xuất bản',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 3,
                'name' => 'Thanh tra Sở',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 4,
                'name' => 'Văn phòng',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 5,
                'name' => 'Ban giám đốc',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 6,
                'name' => 'Bộ phận quản lý',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 7,
                'name' => 'Bộ phận hỗ trợ',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
