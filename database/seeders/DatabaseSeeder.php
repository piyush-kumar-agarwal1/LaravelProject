<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CourseCategorySeeder::class,
            StudentSeeder::class,
            AdditionalInstructorSeeder::class,
            CourseSeeder::class,
            LessonSeeder::class,
            EnrollmentSeeder::class,
        ]);
    }
}