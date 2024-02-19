<?php

namespace Database\Factories\Common;

use Database\Factories\Quiz\QuizActionFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Common\UserAction>
 */
final class UserActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => UserFactory::class,
            'quiz_action_id' => QuizActionFactory::class,
            'ends_at' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
