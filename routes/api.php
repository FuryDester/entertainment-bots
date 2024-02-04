<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiSecretAuthMiddleware;
use App\Http\Controllers\Api\VkController;

Route::name('api.')->group(function () {
    Route::prefix('/vk')->middleware(ApiSecretAuthMiddleware::class)->group(function () {
        Route::post('/callback', [VkController::class, 'callback'])->name('vk.callback');
    });
});
