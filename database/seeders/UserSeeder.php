<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    

    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Nguyễn Trung Hậu',
                'department_id' => 1,
                'position_id' => 1,
                'account_id' => 1,
                'date_of_birth' => '2000-12-22',
                'sex' => 0,
                'address' => 'Vĩnh Long',
                'phone' => '123456789',
                'email' => 'hau@gmail.com',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 2,
                'name' => 'Huỳnh Khắc Sử',
                'department_id' => 1,
                'position_id' => 2,
                'account_id' => 2,
                'date_of_birth' => '2000-12-10',
                'sex' => 0,
                'address' => 'Trà Vinh',
                'phone' => '123456788',
                'email' => 'su@gmail.com',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 3,
                'name' => 'Trần Nguyễn Hữu Dinh',
                'department_id' => 2,
                'position_id' => 1,
                'account_id' => 3,
                'date_of_birth' => '2000-01-10',
                'sex' => 0,
                'address' => 'Cần Thơ',
                'phone' => '123456787',
                'email' => 'dinh@gmail.com',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 4,
                'name' => 'Lê Hoàng Việt',
                'department_id' => 5,
                'position_id' => 1,
                'account_id' => 4,
                'date_of_birth' => '1999-04-12',
                'sex' => 0,
                'address' => 'Cần Thơ',
                'phone' => '123456786',
                'email' => 'viet@gmail.com',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 5,
                'name' => 'Nguyễn Khánh Linh',
                'department_id' => 6,
                'position_id' => 1,
                'account_id' => 5,
                'date_of_birth' => '2000-06-11',
                'sex' => 0,
                'address' => 'Trà Vinh',
                'phone' => '123456785',
                'email' => 'klinh@gmail.com',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 6,
                'name' => 'Phạm Hoàng Khiêm',
                'department_id' => 7,
                'position_id' => 3,
                'account_id' => 6,
                'date_of_birth' => '2000-04-21',
                'sex' => 0,
                'address' => 'Vĩnh Long',
                'phone' => '123456784',
                'email' => 'khiem@gmail.com',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 7,
                'name' => 'Phạm Gia Hưng',
                'department_id' => 7,
                'position_id' => 3,
                'account_id' => 7,
                'date_of_birth' => '1995-11-09',
                'sex' => 0,
                'address' => 'Trà Vinh',
                'phone' => '123456783',
                'email' => 'hung@gmail.com',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 8,
                'name' => 'Hồ Võ Hải Đăng',
                'department_id' => 7,
                'position_id' => 3,
                'account_id' => 8,
                'date_of_birth' => '1990-02-22',
                'sex' => 0,
                'address' => 'Vĩnh Long',
                'phone' => '123456782',
                'email' => 'dang@gmail.com',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 9,
                'name' => 'Nguyễn Trung Hiếu',
                'department_id' => 7,
                'position_id' => 3,
                'account_id' => 9,
                'date_of_birth' => '1989-02-02',
                'sex' => 0,
                'address' => 'Cần Thơ',
                'phone' => '123456781',
                'email' => 'hieu@gmail.com',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'id' => 10,
                'name' => 'Lê Thị Hồng Vân',
                'department_id' => 7,
                'position_id' => 3,
                'account_id' => 10,
                'date_of_birth' => '1993-02-02',
                'sex' => 1,
                'address' => 'Trà Vinh',
                'phone' => '123456780',
                'email' => 'van@gmail.com',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);

    }
}
