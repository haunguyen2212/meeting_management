<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call([
            DepartmentSeeder::class,
            PositionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            MemberSeeder::class,
            SupporterSeeder::class,
            RoomSeeder::class,
            TypeSupportSeeder::class,
            MeetingManagementSeeder::class,
        ]);
    }
}
