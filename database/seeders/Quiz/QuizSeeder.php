<?php

namespace Database\Seeders\Quiz;

use App\Models\Quiz\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quiz::factory()->count(mt_rand(5, 10))->create();
    }
}
