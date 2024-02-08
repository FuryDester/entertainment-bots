<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VK\VkEvent>
 */
class VkEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // TODO: Can fail with unique constraint violation, fix it
            'event_id' => Str::random(40),
            'type' => 'message_new',
            'version' => '5.199',
            'group_id' => $this->faker->randomNumber(),
            'object' => json_encode([
                'message' => [
                    'date' => time(),
                    'from_id' => $this->faker->randomNumber(),
                    'id' => $this->faker->randomNumber(),
                    'out' => $this->faker->boolean(),
                    'peer_id' => $this->faker->randomNumber(),
                    'text' => $this->faker->text(),
                    'conversation_message_id' => $this->faker->randomNumber(),
                    'fwd_messages' => [],
                    'important' => $this->faker->boolean(),
                    'random_id' => $this->faker->randomNumber(),
                    'attachments' => [],
                    'is_hidden' => $this->faker->boolean(),
                ],
                'client_info' => [
                    'button_actions' => [
                        'text' => $this->faker->randomNumber(),
                        'type' => 'text',
                    ],
                    'keyboard' => $this->faker->boolean(),
                    'inline_keyboard' => $this->faker->boolean(),
                    'carousel' => $this->faker->boolean(),
                    'lang_id' => $this->faker->randomNumber(),
                ],
            ]),
            'is_processed' => $this->faker->boolean(),
            'attempts' => mt_rand(1, config('integrations.vk.retry')),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
