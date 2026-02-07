<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiSecretAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validToken = config('integrations.vk.secret');
        if ($validToken && $request->get('secret') !== config('integrations.vk.secret') && $request->get('type') !== 'confirmation') {
            return response('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
