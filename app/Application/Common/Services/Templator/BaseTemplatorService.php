<?php

namespace App\Application\Common\Services\Templator;

use App\Domain\Common\Services\Templator\BaseTemplatorServiceContract;

final readonly class BaseTemplatorService implements BaseTemplatorServiceContract
{
    /**
     * {@inheritDoc}
     */
    public function render(string $template, array $data, bool $replaceWithoutKeys = true): string
    {
        // Нахождение всех подстрок вида ${key}.
        preg_match_all('/\${\s*\w+\s*}/', $template, $matches);

        // Замена всех подстрок вида ${key} на значения из массива $data.
        foreach ($matches[0] as $match) {
            $key = substr($match, 2, -1);
            if (! array_key_exists($key, $data) && ! $replaceWithoutKeys) {
                continue;
            }

            $value = $data[$key] ?? '';
            $template = str_replace($match, $value, $template);
        }

        return $template;
    }
}
