<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('room_registrations')->insert([
            [
                'meet_name' => 'Đại hội Chi bộ 1 nhiệm kỳ 2022-2025',
                'room_id' => 1,
                'register_id' => 3,
                'department_id' => 1,
                'type_sp_id' => 2,
                'supporter_id' => 1,
                'test_time' => Carbon::now(),
                'start_time' => Carbon::now()->addHours(1),
                'end_time' => Carbon::now()->addHours(3),
                'approval_time' => Carbon::now()->addMinutes(20),
                'status' => '1',
                'feedback' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'meet_name' => 'Hội nghị đẩy mạnh Chương trình hỗ trợ doanh nghiệp nhỏ và vừa chuyển đổi số 2022',
                'room_id' => 2,
                'register_id' => 5,
                'department_id' => 2,
                'type_sp_id' => 1,
                'supporter_id' => NULL,
                'test_time' => Carbon::now()->addDays(2),
                'start_time' => Carbon::now()->addDays(2)->addHours(1),
                'end_time' => Carbon::now()->addDays(2)->addHours(4),
                'approval_time' => Carbon::now()->addMinutes(330),
                'status' => '1',
                'feedback' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'meet_name' => 'Hội nghị tập huấn về chuyển đổi số năm 2022',
                'room_id' => 3,
                'register_id' => 4,
                'department_id' => 3,
                'type_sp_id' => 1,
                'supporter_id' => NULL,
                'test_time' => Carbon::now()->addHour(3),
                'start_time' => Carbon::now()->addHours(4),
                'end_time' => Carbon::now()->addHours(6),
                'approval_time' => NULL,
                'status' => '0',
                'feedback' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'meet_name' => 'Hội nghị trực tuyến “Bảo đảm an toàn thông tin cho các nền tảng chuyển đổi số”',
                'room_id' => NULL,
                'register_id' => 2,
                'department_id' => 4,
                'type_sp_id' => 3,
                'supporter_id' => NULL,
                'test_time' => Carbon::now()->addDays(5),
                'start_time' => Carbon::now()->addDays(5)->addHours(1),
                'end_time' => Carbon::now()->addDays(5)->addHours(4),
                'approval_time' => Carbon::now()->addDays(5),
                'status' => '1',
                'feedback' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'meet_name' => 'Hội nghị tổng kết phong trào thi đua Khối 8 năm 2021',
                'room_id' => 4,
                'register_id' => 5,
                'department_id' => 2,
                'type_sp_id' => 2,
                'supporter_id' => 4,
                'test_time' => Carbon::now()->subWeeks(1),
                'start_time' => Carbon::now()->subWeeks(1)->addHours(1),
                'end_time' => Carbon::now()->subWeeks(1)->addHours(4),
                'approval_time' => Carbon::now()->subWeeks(1),
                'status' => '1',
                'feedback' => NULL,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
