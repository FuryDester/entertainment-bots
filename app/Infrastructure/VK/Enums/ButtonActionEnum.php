<?php

namespace App\Infrastructure\VK\Enums;

enum ButtonActionEnum: string
{
    case Text = 'text';
    case VkPay = 'vkpay';
    case OpenApp = 'open_app';
    case Location = 'location';
    case OpenLink = 'open_link';
    case Callback = 'callback';
}
