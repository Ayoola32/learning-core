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
                'first_name' => 'First',
                'last_name' => 'Instructor',
                'password' => bcrypt('password'),
                'email' => 'instructor@gmail.com',
                'role' => 'instructor',
            ],
            [
                'first_name' => 'First',
                'last_name' => 'Student',
                'password' => bcrypt('password'),
                'email' => 'student@gmail.com',
                'role' => 'student',
            ]
        ];

        User::insert($users);    
    }
}
