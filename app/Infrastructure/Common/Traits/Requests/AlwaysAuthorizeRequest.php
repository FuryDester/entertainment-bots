<?php

namespace App\Infrastructure\Common\Traits\Requests;

trait AlwaysAuthorizeRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
