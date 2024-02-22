<?php

namespace Database\Seeders\GroupBoss;

use App\Models\Common\User;
use App\Models\GroupBoss\GroupBoss;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

final class GroupBossSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! is_dir(storage_path('app/public/images/boss'))) {
            mkdir(storage_path('app/public/images/boss'), recursive: true);
        }

        $users = User::get();
        GroupBoss::factory()
            ->count(mt_rand(5, 10))
            ->state(new Sequence(
                static fn () => ['user_id' => $users->random()],
            ))
            ->create();
    }
}
