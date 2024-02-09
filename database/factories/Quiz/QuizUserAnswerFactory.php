<?php

namespace Database\Factories\Quiz;

use Database\Factories\Common\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz\QuizUserAnswer>
 */
class QuizUserAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isText = $this->faker->boolean(20);

        return [
            'question_id' => QuizQuestionFactory::class,
            'answer_id' => $isText ? null : QuizAnswerFactory::class,
            'answer' => $isText ? $this->faker->sentence() : null,
            'user_id' => UserFactory::class,
            'answered_at' => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
        ];
    }
}
