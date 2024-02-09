<?php

namespace Database\Seeders\Common;

use App\Models\Common\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(mt_rand(50, 150))->create();
    }
}
