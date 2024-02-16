<?php

namespace Database\Seeders\Quiz;

use App\Models\Common\User;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\QuizUserStatus;
use Illuminate\Database\Seeder;

class QuizUserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::get();
        $quizzes = Quiz::get();

        QuizUserStatus::factory()
            ->count(mt_rand(1, 5))
            ->state(function () use ($users, $quizzes) {
                return [
                    'user_id' => $users->random(),
                    'quiz_id' => $quizzes->random(),
                ];
            })
            ->create();
    }
}
