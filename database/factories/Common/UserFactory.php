<?php

namespace Database\Factories\Common;

use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Common\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vk_user_id' => mt_rand(1000000, 30000000),
            'vk_peer_id' => mt_rand(2000000000, 3000000000),
            'is_admin' => $this->faker->boolean(),
            'state' => $this->faker->randomElement(Arr::pluck(ActionStageEnum::cases(), 'value')),
            'data' => null,
            'last_activity_at' => $this->faker->dateTimeBetween('-1 month'),
        ];
    }
}
