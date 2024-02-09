<?php

namespace Database\Seeders\VK;

use App\Models\VK\VkEvent;
use Illuminate\Database\Seeder;

class VkEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VkEvent::factory(mt_rand(50, 150))->create();
    }
}
