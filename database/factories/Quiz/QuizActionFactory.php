<?php

namespace Database\Factories\Quiz;

use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz\QuizAction>
 */
class QuizActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alias' => Arr::random(Arr::pluck(ActionAliasTypeEnum::cases(), 'value')),
            'type' => Arr::random(Arr::pluck(ActionTypeEnum::cases(), 'value')),
            'value' => $this->faker->randomNumber(2),
        ];
    }
}
