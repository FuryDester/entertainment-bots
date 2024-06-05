<?php

return [
    'vk' => [
        'secret' => env('VK_SECRET'),
        'confirmation' => env('VK_CONFIRMATION'),

        'access_token' => env('VK_TOKEN'),

        'retry' => env('VK_RETRY_COUNT', 3),

        'command_prefix' => env('COMMAND_PREFIX', '!'),

        'peer_id_delta' => 2000000000,

        'max_message_size' => 4096,
    ],
];
