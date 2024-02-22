<?php

namespace Database\Seeders\Quiz;

use App\Models\Quiz\Quiz;
use App\Models\Quiz\QuizAction;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! is_dir(storage_path('app/public/images/quiz'))) {
            mkdir(storage_path('app/public/images/quiz'), recursive: true);
        }

        $actions = QuizAction::get();

        Quiz::factory()
            ->count(mt_rand(5, 10))
            ->state(new Sequence(
                static fn () => [
                    'action_id' => $actions->random(),
                ]
            ))
            ->create();
    }
}
