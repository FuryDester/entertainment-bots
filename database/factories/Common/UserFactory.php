<?php

namespace Database\Factories\Common;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        ];
    }
}
