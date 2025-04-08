<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'phone' => '992002887717',
                'password' => bcrypt('992002887717'),
                'name' => 'Abdurazzoq',
                'surname' => 'Fozilov',
                'born_in' => '2001-08-24',
                'gender' => 1,
                'role' => User::ROLE_SUPER_ADMIN,
            ],
            [
                'phone' => '992929646001',
                'password' => '992929646001',
                'name' => 'Какой-то',
                'surname' => 'Чел',
                'born_in' => '2001-08-24',
                'gender' => 1,
                'role' => User::ROLE_CLIENT,
            ],
            [
                'phone' => '992007777777',
                'password' => '992002887717',
                'name' => null,
                'surname' => null,
                'born_in' => null,
                'gender' => 1,
                'role' => User::ROLE_COMPANY_ADMIN,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
