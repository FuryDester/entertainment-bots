<?php

namespace Database\Seeders\Quiz;

use App\Models\Quiz\QuizAction;
use Illuminate\Database\Seeder;

class QuizActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuizAction::factory()->count(100)->make()->unique()->each(
            static fn (QuizAction $quizAction) => $quizAction->save()
        );
    }
}
