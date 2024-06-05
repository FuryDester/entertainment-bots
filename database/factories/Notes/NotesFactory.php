<?php

namespace Database\Factories\Notes;
use Database\Factories\Common\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notes\Notes>
 */
class NotesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->text(),
            'user_id' => UserFactory::class,
            'peer_id' => $this->faker->numberBetween(2000000000, 2000099999),
        ];
    }
}
