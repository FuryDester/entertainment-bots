<?php

namespace Database\Seeders;

use Database\Seeders\Common\UserActionSeeder;
use Database\Seeders\Common\UsersSeeder;
use Database\Seeders\GroupBoss\GroupBossSeeder;
use Database\Seeders\GroupBoss\GroupBossUserActionSeeder;
use Database\Seeders\GroupBoss\GroupBossWeaponSeeder;
use Database\Seeders\Quiz\QuizActionSeeder;
use Database\Seeders\Quiz\QuizAnswerSeeder;
use Database\Seeders\Quiz\QuizQuestionSeeder;
use Database\Seeders\Quiz\QuizSeeder;
use Database\Seeders\Quiz\QuizUserAnswerSeeder;
use Database\Seeders\Quiz\QuizUserStatusSeeder;
use Database\Seeders\VK\VkEventSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            VkEventSeeder::class,
            UsersSeeder::class,
            QuizActionSeeder::class,
            QuizSeeder::class,
            QuizQuestionSeeder::class,
            QuizAnswerSeeder::class,
            QuizUserAnswerSeeder::class,
            QuizUserStatusSeeder::class,
            GroupBossSeeder::class,
            GroupBossWeaponSeeder::class,
            GroupBossUserActionSeeder::class,
            UserActionSeeder::class,
        ]);
    }
}
