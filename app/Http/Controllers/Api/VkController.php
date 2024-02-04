<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;

class VkController extends BaseApiController
{
    public function callback(): Response
    {
        return response('ok', Response::HTTP_OK);
    }
}
