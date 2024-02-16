<?php

namespace Database\Factories\Quiz;

use Database\Factories\Common\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz\QuizUserStatus>
 */
class QuizUserStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $done = $this->faker->boolean();
        return [
            'quiz_id' => QuizFactory::class,
            'user_id' => UserFactory::class,
            'is_done' => $done,
            'done_at' => $done ? $this->faker->dateTimeBetween('-1 month') : null,
        ];
    }
}
