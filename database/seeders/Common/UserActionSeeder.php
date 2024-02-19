<?php

namespace Database\Seeders\Common;

use App\Models\Common\User;
use App\Models\Common\UserAction;
use App\Models\Quiz\QuizAction;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

final class UserActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::get();
        $quizActions = QuizAction::get();

        UserAction::factory()
            ->count(mt_rand(100, 200))
            ->state(new Sequence(
                static fn () => [
                    'user_id' => $users->random(),
                    'quiz_action_id' => $quizActions->random(),
                ],
            ))
            ->create();
    }
}
