<?php

namespace Database\Seeders\Quiz;

use App\Models\Quiz\Quiz;
use App\Models\Quiz\QuizQuestion;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class QuizQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quizzes = Quiz::query()->get();

        QuizQuestion::factory()
            ->count(mt_rand(50, 150))
            ->state(new Sequence(
                static fn () => ['quiz_id' => $quizzes->random()],
            ))
            ->create();
    }
}
