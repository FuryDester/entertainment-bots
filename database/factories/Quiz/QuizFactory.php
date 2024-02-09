<?php

namespace Database\Factories\Quiz;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(mt_rand(3, 6)),
            'description' => $this->faker->text(),
            'image' => $this->faker->image(storage_path('public'), 600, 300, 'quiz'),
            'starts_at' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'ends_at' => $this->faker->dateTimeBetween('+1 month', '+2 month'),
            'action_id' => $this->faker->boolean() ? QuizActionFactory::class : null,
            'question_cooldown' => mt_rand(0, 3600),
        ];
    }
}
