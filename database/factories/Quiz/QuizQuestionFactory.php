<?php

namespace Database\Factories\Quiz;

use App\Infrastructure\Quiz\Enums\QuestionTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz\QuizQuestion>
 */
class QuizQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence(5).'?',
            'type' => Arr::random(Arr::pluck(QuestionTypeEnum::cases(), 'value')),
            'points' => $this->faker->numberBetween(1, 10),
            'quiz_id' => QuizFactory::class,
        ];
    }
}
