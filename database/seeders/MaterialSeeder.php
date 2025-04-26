<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        // Get all lesson IDs with their course_id
        $lessons = DB::table('lessons')->select('id', 'course_id', 'title')->get();

        // Create materials for each lesson
        foreach ($lessons as $lesson) {
            // Create 1-3 materials per lesson
            $materialCount = rand(1, 3);

            for ($i = 1; $i <= $materialCount; $i++) {
                // Only use types that match the enum in the database
                $type = rand(0, 1) ? 'video' : 'document';
                $title = $this->getMaterialTitle($type, $i, $lesson->title);

                DB::table('materials')->insert([
                    'lesson_id' => $lesson->id,
                    'title' => $title,
                    'type' => $type,
                    'content' => null,
                    'content_url' => $this->getContentUrl($type),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function getMaterialTitle($type, $index, $lessonTitle)
    {
        $prefix = '';

        switch ($type) {
            case 'document':
                $prefix = 'Reading Material:';
                break;
            case 'video':
                $prefix = 'Video Tutorial:';
                break;
            default:
                $prefix = 'Resource:';
        }

        return $prefix . ' ' . $lessonTitle . ' (Resource ' . $index . ')';
    }

    private function getContentUrl($type)
    {
        switch ($type) {
            case 'document':
                return 'sample/materials/document.pdf';
            case 'video':
                return 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
            default:
                return 'sample/materials/document.pdf';
        }
    }
}