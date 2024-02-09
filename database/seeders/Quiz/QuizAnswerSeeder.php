<?php

namespace Database\Seeders\Quiz;

use App\Models\Quiz\QuizAnswer;
use App\Models\Quiz\QuizQuestion;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class QuizAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quizQuestions = QuizQuestion::query()->get();

        QuizAnswer::factory()
            ->count(mt_rand(150, 300))
            ->state(new Sequence(
                static fn () => [
                    'question_id' => $quizQuestions->random(),
                ]
            ))
            ->create();
    }
}
