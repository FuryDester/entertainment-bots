<?php

namespace Database\Factories\GroupBoss;

use Database\Factories\Common\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroupBoss\GroupBoss>
 */
final class GroupBossFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $maxHealth = $this->faker->numberBetween(10000, 1000000);

        return [
            'user_id' => UserFactory::class,
            'name' => $this->faker->name(),
            'post_id' => $this->faker->numberBetween(1, 10000000),
            'post_content' => $this->faker->text(),
            'image' => mt_rand(0, 1) ? $this->faker->image(storage_path('app/public/images/boss')) : null,
            'max_health' => $maxHealth,
            'current_health' => $this->faker->numberBetween(1, $maxHealth),
            'base_hit_chance' => $this->faker->numberBetween(1, 100),
            'hit_cooldown' => $this->faker->numberBetween(1, 100),
            'miss_cooldown' => $this->faker->numberBetween(1, 100),
            'killed_by' => null,
            'killed_at' => null,
        ];
    }
}
