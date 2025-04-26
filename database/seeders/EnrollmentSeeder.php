<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        // Get all student IDs
        $students = DB::table('students')->pluck('id')->toArray();

        // Get all course IDs
        $courses = DB::table('courses')->pluck('id')->toArray();

        // Create enrollments (each student enrolls in 1-3 random courses)
        foreach ($students as $studentId) {
            // Shuffle courses to randomize selection
            shuffle($courses);

            // Determine how many courses this student will take (1-3)
            $courseCount = rand(1, min(3, count($courses)));

            for ($i = 0; $i < $courseCount; $i++) {
                $courseId = $courses[$i];

                DB::table('enrollments')->insert([
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                    'enrollment_date' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}