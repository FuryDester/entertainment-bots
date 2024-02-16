<?php

namespace App\Infrastructure\Common\Traits;

trait SecondsToHms
{
    private function secondsToHms(int $seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        $parts = [];
        if ($hours > 0) {
            $parts[] = "$hours час.";
        }
        if ($minutes > 0) {
            $parts[] = "$minutes мин.";
        }
        if ($seconds > 0) {
            $parts[] = "$seconds сек.";
        }

        return implode(', ', $parts);
    }
}
