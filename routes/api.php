<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VkController;

Route::name('api.')->group(function () {
    Route::prefix('/vk')->group(function () {
        Route::post('/callback', [VkController::class, 'callback'])->name('vk.callback');
    });
});
