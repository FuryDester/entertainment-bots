<?php

namespace Database\Seeders\GroupBoss;

use App\Models\GroupBoss\GroupBoss;
use App\Models\GroupBoss\GroupBossWeapon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

final class GroupBossWeaponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groupBosses = GroupBoss::get();

        GroupBossWeapon::factory()
            ->count(mt_rand($groupBosses->count(), $groupBosses->count() * 5))
            ->state(new Sequence(
                static fn () => ['group_boss_id' => $groupBosses->random()],
            ))
            ->make()
            ->unique(fn ($weapon) => $weapon->group_boss_id.$weapon->name)
            ->each(fn ($weapon) => $weapon->save());
    }
}
