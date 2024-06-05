<?php

namespace Database\Seeders\GroupBoss;

use App\Models\Common\User;
use App\Models\GroupBoss\GroupBoss;
use App\Models\GroupBoss\GroupBossUserAction;
use App\Models\GroupBoss\GroupBossWeapon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

final class GroupBossUserActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::get();
        $groupBosses = GroupBoss::get();
        $groupBossWeapons = GroupBossWeapon::get();

        GroupBossUserAction::factory()
            ->count(mt_rand($users->count(), $users->count() * 5))
            ->state(new Sequence(
                static function () use ($users, $groupBosses, $groupBossWeapons) {
                    $groupBoss = $groupBosses->random();
                    $groupBossWeapon = $groupBossWeapons->where('group_boss_id', $groupBoss->id)->random();

                    return [
                        'user_id' => $users->random(),
                        'group_boss_id' => $groupBoss,
                        'group_boss_weapon_id' => $groupBossWeapon,
                    ];
                }
            ))
            ->create();
    }
}
