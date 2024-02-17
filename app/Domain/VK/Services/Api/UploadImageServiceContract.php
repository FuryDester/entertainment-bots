<?php

namespace App\Domain\VK\Services\Api;

interface UploadImageServiceContract
{
    /**
     * Загружает изображение на сервер ВК
     *
     * @param  string  $path  Путь к изображению
     */
    public function uploadImage(string $path): string;
}
