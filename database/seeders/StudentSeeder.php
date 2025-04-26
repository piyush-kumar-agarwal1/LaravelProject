<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'name_en' => 'John Doe',
                'contact_en' => '1234567890',
                'email' => 'john@example.com',
                'password' => Hash::make('123'),
                'role_id' => 4 // Student role
            ],
            [
                'name_en' => 'Jane Smith',
                'contact_en' => '2345678901',
                'email' => 'jane@example.com',
                'password' => Hash::make('123'),
                'role_id' => 4
            ],
            [
                'name_en' => 'Alex Johnson',
                'contact_en' => '3456789012',
                'email' => 'alex@example.com',
                'password' => Hash::make('123'),
                'role_id' => 4
            ],
            [
                'name_en' => 'Sarah Williams',
                'contact_en' => '4567890123',
                'email' => 'sarah@example.com',
                'password' => Hash::make('123'),
                'role_id' => 4
            ],
            [
                'name_en' => 'Michael Brown',
                'contact_en' => '5678901234',
                'email' => 'michael@example.com',
                'password' => Hash::make('123'),
                'role_id' => 4
            ]
        ];

        foreach ($students as $student) {
            // Create student
            $studentId = DB::table('students')->insertGetId([
                'name_en' => $student['name_en'],
                'contact_en' => $student['contact_en'],
                'email' => $student['email'],
                'password' => $student['password'],
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create user account for student
            DB::table('users')->insert([
                'name_en' => $student['name_en'],
                'contact_en' => $student['contact_en'],
                'email' => $student['email'],
                'password' => $student['password'],
                'role_id' => $student['role_id'],
                'instructor_id' => 1, // Link to existing instructor
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}