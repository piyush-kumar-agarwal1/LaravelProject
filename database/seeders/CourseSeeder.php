<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // Get all instructor IDs
        $instructors = DB::table('instructors')->pluck('id')->toArray();

        // Get all category IDs
        $categories = DB::table('course_categories')->pluck('id')->toArray();

        $courses = [
            [
                'title_en' => 'Complete Web Development Bootcamp',
                'price' => 4999,
                'description_en' => 'This comprehensive course covers everything you need to become a full-stack web developer.',
                'prerequisites_en' => 'Basic computer knowledge',
                'type' => 'paid',
                'duration' => 40,  // Changed to integer
                'difficulty' => 'beginner',
                'status' => 2 // Active status
            ],
            [
                'title_en' => 'Data Science Fundamentals',
                'price' => 5999,
                'description_en' => 'Learn the foundations of data science with practical projects and real-world datasets.',
                'prerequisites_en' => 'Basic programming knowledge',
                'type' => 'paid',
                'duration' => 35,  // Changed to integer
                'difficulty' => 'intermediate',
                'status' => 2 // Active status
            ],
            [
                'title_en' => 'UI/UX Design Masterclass',
                'price' => 3999,
                'description_en' => 'Master the principles of UI/UX design with this comprehensive course.',
                'prerequisites_en' => 'No prerequisites',
                'type' => 'paid',
                'duration' => 30,  // Changed to integer
                'difficulty' => 'beginner',
                'status' => 2 // Active status
            ]
        ];

        foreach ($courses as $index => $course) {
            // Assign instructor and category (rotating through available ones)
            $instructorId = $instructors[$index % count($instructors)];
            $categoryId = $categories[$index % count($categories)];

            DB::table('courses')->insert([
                'title_en' => $course['title_en'],
                'description_en' => $course['description_en'],
                'prerequisites_en' => $course['prerequisites_en'],
                'price' => $course['price'],
                'old_price' => isset($course['old_price']) ? $course['old_price'] : null,
                'type' => $course['type'],
                'duration' => $course['duration'],
                'difficulty' => $course['difficulty'],
                'status' => $course['status'],
                'instructor_id' => $instructorId,
                'course_category_id' => $categoryId,
                'language' => 'en',
                'image' => 'default-course.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}