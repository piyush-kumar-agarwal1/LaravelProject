<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdditionalInstructorSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = [
            [
                'name_en' => 'Professor Smith',
                'contact_en' => '7654321098',
                'email' => 'prof.smith@example.com',
                'bio' => 'Expert in Web Development with 10 years of teaching experience',
                'designation' => 'Senior Web Developer',
                'title' => 'Web Development Expert'
            ],
            [
                'name_en' => 'Dr. Johnson',
                'contact_en' => '6543210987',
                'email' => 'dr.johnson@example.com',
                'bio' => 'Data Science specialist with PhD in Computer Science',
                'designation' => 'Data Scientist',
                'title' => 'AI & Machine Learning Expert'
            ],
            [
                'name_en' => 'Designer Williams',
                'contact_en' => '5432109876',
                'email' => 'designer.williams@example.com',
                'bio' => 'Creative designer with expertise in UI/UX and graphic design',
                'designation' => 'Senior Designer',
                'title' => 'UI/UX Expert'
            ]
        ];

        foreach ($instructors as $instructor) {
            $instructorId = DB::table('instructors')->insertGetId([
                'name_en' => $instructor['name_en'],
                'contact_en' => $instructor['contact_en'],
                'email' => $instructor['email'],
                'bio' => $instructor['bio'],
                'designation' => $instructor['designation'],
                'title' => $instructor['title'],
                'password' => Hash::make('123'),
                'role_id' => 3, // Instructor role
                'status' => 1,
                'language' => 'en',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create user for instructor
            DB::table('users')->insert([
                'name_en' => $instructor['name_en'],
                'email' => $instructor['email'],
                'contact_en' => $instructor['contact_en'],
                'password' => Hash::make('123'),
                'role_id' => 3, // Instructor role
                'instructor_id' => $instructorId,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}