<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Instructor',
                'password' => bcrypt('password'),
                'email' => 'instructor@gmail.com',
                'role' => 'instructor',
            ],
            [
                'name' => 'Student',
                'password' => bcrypt('password'),
                'email' => 'student@gmail.com',
                'role' => 'student',
            ]
        ];

        User::insert($users);    
    }
}
