<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        // Get all course IDs
        $courses = DB::table('courses')->pluck('id')->toArray();

        foreach ($courses as $courseId) {
            // Create 5-7 lessons per course
            $lessonCount = rand(5, 7);

            for ($i = 1; $i <= $lessonCount; $i++) {
                DB::table('lessons')->insert([
                    'title' => "Lesson $i: " . $this->getLessonTitle($i),
                    'description' => "This lesson covers important concepts related to topic $i.",
                    'course_id' => $courseId,
                    'notes' => "Additional notes for lesson $i",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function getLessonTitle($number)
    {
        $titles = [
            'Introduction to the Subject',
            'Core Concepts and Fundamentals',
            'Advanced Techniques',
            'Practical Applications',
            'Case Studies',
            'Project Implementation',
            'Best Practices and Tips',
            'Troubleshooting Common Issues',
            'Review and Assessment'
        ];

        return $titles[$number % count($titles)];
    }
}