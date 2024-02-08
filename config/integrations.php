<?php

return [
    'vk' => [
        'secret' => env('VK_SECRET'),
        'confirmation' => env('VK_CONFIRMATION'),

        'access_token' => env('VK_TOKEN'),

        'retry' => env('VK_RETRY_COUNT', 3),
    ],
];
