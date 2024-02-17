<?php

namespace App\Infrastructure\Common\Traits;

trait ArrayKeysToSneakCase
{
    /**
     * Переводит ключи массива в sneak_case
     */
    private function arrayKeysToSneakCase(array $array): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            $result[mb_strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key))] = $value;
        }

        return $result;
    }
}
