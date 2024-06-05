<?php

namespace Database\Seeders\Notes;

use App\Models\Common\User;
use App\Models\Notes\Notes;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::get();

        Notes::factory()
            ->count(mt_rand(2, 10))
            ->state(new Sequence(
                static function () use ($users) {
                    return [
                        'user_id' => $users->random()->id,
                        'peer_id' => $users->random()->vk_peer_id,
                    ];
                }
            ))
            ->create();
    }
}
