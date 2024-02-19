<?php

namespace Database\Factories\GroupBoss;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroupBoss\GroupBossWeapon>
 */
final class GroupBossWeaponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group_boss_id' => GroupBossFactory::class,
            'name' => $this->faker->name(),
            'hit_damage_template' => $this->faker->sentence(3),
            'min_damage' => $this->faker->numberBetween(1, 100),
            'max_damage' => $this->faker->numberBetween(1, 100),
            'hit_chance' => $this->faker->numberBetween(1, 100),
        ];
    }
}
