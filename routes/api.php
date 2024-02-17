<?php

use App\Http\Controllers\Api\VkController;
use App\Http\Middleware\ApiSecretAuthMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::get('/healthcheck', static function (Request $request) {
        return response()->json([
            'healthcheck' => true,
            'ip' => $request->ip(),
            'host' => $request->host(),
            'scheme' => $request->getScheme(),
            'body' => $request->getContent(),
        ]);
    })->name('healthcheck');

    Route::prefix('/vk')->middleware(ApiSecretAuthMiddleware::class)->group(function () {
        Route::post('/callback', [VkController::class, 'callback'])->name('vk.callback');
    });
});
