<?php

namespace App\Infrastructure\Common\Traits;

trait WordDeclension
{
    private function declension(int $number, array $titles): string
    {
        $cases = [2, 0, 1, 1, 1, 2];

        return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
    }
}
