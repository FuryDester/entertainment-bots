<?php

namespace Database\Seeders\Quiz;

use App\Models\Common\User;
use App\Models\Quiz\QuizAnswer;
use App\Models\Quiz\QuizQuestion;
use App\Models\Quiz\QuizUserAnswer;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class QuizUserAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->get();
        $quizQuestions = QuizQuestion::query()->get();
        $quizAnswers = QuizAnswer::query()->get();

        QuizUserAnswer::factory()
            ->count(mt_rand(50, 100))
            ->state(new Sequence(
                static fn () => [
                    'user_id' => $users->random(),
                    'question_id' => $quizQuestions->random(),
                    'answer_id' => $quizAnswers->random(),
                ]
            ))
            ->create();
    }
}
