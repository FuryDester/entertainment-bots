<?php

namespace App\Domain\Common\Services\Templator;

interface BaseTemplatorServiceContract
{
    /**
     * Получение данных из шаблона путем подстановки значений из массива.
     * ${key} в шаблоне заменяется на значение из массива $data['key'].
     *
     * @param  string  $template  Шаблон.
     * @param  array<string, mixed>  $data  Массив данных для подстановки.
     * @param  bool  $replaceWithoutKeys  Заменять ли в шаблоне ключи, которых нет в массиве $data.
     * @return string Результат подстановки.
     */
    public function render(string $template, array $data, bool $replaceWithoutKeys = true): string;
}
