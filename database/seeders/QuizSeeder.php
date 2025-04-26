<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // Get all course IDs
        $courses = DB::table('courses')->pluck('id')->toArray();

        $quizTitles = [
            'Module Assessment Quiz',
            'Knowledge Check',
            'Concept Validation Test',
            'Skills Evaluation',
            'Final Assessment'
        ];

        // Create 1-3 quizzes per course
        foreach ($courses as $courseId) {
            $quizCount = rand(1, 3);

            for ($i = 1; $i <= $quizCount; $i++) {
                // Select a random title
                $title = $quizTitles[array_rand($quizTitles)] . " #$i";

                $quizId = DB::table('quizzes')->insertGetId([
                    'title' => $title,
                    'course_id' => $courseId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Create 5-10 questions per quiz
                $this->createQuestionsForQuiz($quizId, rand(5, 10));
            }
        }
    }

    private function createQuestionsForQuiz($quizId, $count)
    {
        $questionTypes = ['multiple_choice', 'true_false', 'short_answer']; // Changed to match your schema

        for ($i = 1; $i <= $count; $i++) {
            $type = $questionTypes[array_rand($questionTypes)];

            $questionId = DB::table('questions')->insertGetId([
                'quiz_id' => $quizId,
                'content' => "Question $i: " . $this->generateQuestionText($type), // Changed to 'content'
                'type' => $type, // Changed to 'type'
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create options for this question
            $this->createOptionsForQuestion($questionId, $type);
        }
    }

    // Rest of your methods remain the same
    private function generateQuestionText($type)
    {
        // Your existing code
    }

    private function createOptionsForQuestion($questionId, $type)
    {
        // Your existing code
    }
}