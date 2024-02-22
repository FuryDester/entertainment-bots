<?php

namespace Database\Factories\GroupBoss;

use Database\Factories\Common\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroupBoss\GroupBossUserAction>
 */
final class GroupBossUserActionFactory extends Factory
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
            'group_boss_id' => GroupBossFactory::class,
            'group_boss_weapon_id' => GroupBossWeaponFactory::class,
            'damage' => $this->faker->numberBetween(1, 100),
            'is_miss' => $this->faker->boolean(),
        ];
    }
}
