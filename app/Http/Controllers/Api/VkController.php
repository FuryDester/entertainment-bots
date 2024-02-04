<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VkController extends BaseApiController
{
    public function callback(Request $request): JsonResponse
    {
        $data = $request->all();
        $secret = config('integrations.vk.secret');
        $confirmation = config('integrations.vk.confirmation');

        if ($data['type'] === 'confirmation' && $data['secret'] === $secret) {
            return response()->json($confirmation);
        }

        return response()->json('ok');
    }
}
