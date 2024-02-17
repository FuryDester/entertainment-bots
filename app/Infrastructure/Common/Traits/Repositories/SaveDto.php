<?php

namespace App\Infrastructure\Common\Traits\Repositories;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use App\Infrastructure\Common\Traits\ArrayKeysToSneakCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

trait SaveDto
{
    use ArrayKeysToSneakCase;

    /**
     * Общая логика сохранения DTO в модель.
     */
    private function saveDto(Model $model, AbstractDTO $dto, array $excludeFields = []): bool
    {
        $data = Arr::except($this->arrayKeysToSneakCase($dto->toArray()), [
            'id',
            'created_at',
            'updated_at',
            ...$excludeFields,
        ]);

        $hasUpdatedAt = method_exists($dto, 'setUpdatedAt');
        $now = now();
        if (method_exists($dto, 'getId') && $id = $dto->getId()) {
            $fields = $data;
            if ($hasUpdatedAt) {
                $fields['updated_at'] = $now;
            }

            $result = (bool) $model::query()
                ->firstWhere('id', $id)
                ->update($fields);

            if ($result && $hasUpdatedAt) {
                $dto->setUpdatedAt($now);
            }

            return $result;
        }

        $hasCreatedAt = method_exists($dto, 'setCreatedAt');
        $fields = $data;
        if ($hasUpdatedAt) {
            $fields['updated_at'] = $now;
        }

        if ($hasCreatedAt) {
            $fields['created_at'] = $now;
        }

        $id = $model::query()->insertGetId($fields);
        if (! $id) {
            return false;
        }

        if (method_exists($dto, 'setId')) {
            $dto->setId($id);
        }

        if ($hasCreatedAt) {
            $dto->setCreatedAt($now);
        }

        if ($hasUpdatedAt) {
            $dto->setUpdatedAt($now);
        }

        return true;
    }
}
