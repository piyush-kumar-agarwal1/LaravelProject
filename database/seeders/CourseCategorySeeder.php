<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Web Development', 'category_status' => 1],
            ['category_name' => 'Mobile Development', 'category_status' => 1],
            ['category_name' => 'Data Science', 'category_status' => 1],
            ['category_name' => 'Digital Marketing', 'category_status' => 1],
            ['category_name' => 'Graphic Design', 'category_status' => 1],
        ];

        foreach ($categories as $category) {
            DB::table('course_categories')->insert([
                'category_name' => $category['category_name'],
                'category_status' => $category['category_status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}