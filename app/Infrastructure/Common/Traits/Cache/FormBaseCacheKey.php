<?php

namespace App\Infrastructure\Common\Traits\Cache;

use Illuminate\Support\Arr;

trait FormBaseCacheKey
{
    /**
     * Функция для генерации базового ключа кэша по имени и параметрам функции
     *
     * @param mixed ...$args Аргументы вызывающей функции, которые могут влиять на кэш
     * @return string
     */
    protected function formBaseCacheKey(mixed ...$args): string
    {
        list(, $caller) = debug_backtrace();

        $baseName = sprintf('%s::%s', $caller['class'], $caller['function']);

        foreach ($args as $arg) {
            // Можно ли преобразовать в строку без танцев с бубном
            if (
                !is_array($arg)
                && (
                    (!is_object($arg) && settype($arg, 'string') !== false)
                    || (is_object($arg) && method_exists($arg, '__toString'))
                )
            ) {
                $baseName .= "_$arg";

                continue;
            }

            if (is_array($arg) && Arr::isList($arg)) {
                sort($arg);
            }

            $baseName .= '_' . serialize($arg);
        }

        return $baseName;
    }
}
