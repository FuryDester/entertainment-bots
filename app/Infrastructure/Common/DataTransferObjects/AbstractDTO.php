<?php

namespace App\Infrastructure\Common\DataTransferObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use ReflectionClass;

abstract class AbstractDTO implements Arrayable
{
    /**
     * @param  iterable  $values  массив значений переменных
     */
    final public function __construct(iterable $values = [])
    {
        if (is_array($values) && Arr::isList($values)) {
            return;
        }

        foreach ($values as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @param  iterable  $values  массив значений класса
     * @return self инстанс класса
     */
    public static function getInstance(iterable $values = []): self
    {
        return new (get_called_class())($values);
    }

    /**
     * @param  array  $values  массив значений переменных класса
     * @return self инстанс класса
     */
    final public static function __set_state(array $values): self
    {
        return static::getInstance($values);
    }

    /**
     * Функция получения аттрибутов объекта
     *
     * @param  int  $mode  режим вывода переменных (по умолчанию - защищённые (имеющие сеттеры и геттеры))
     * @return array<int, array{name: string, type: string, default: mixed}> список переменных класса
     */
    final public static function getProperties(int $mode = \ReflectionProperty::IS_PROTECTED): array
    {
        $reflection = new ReflectionClass(get_called_class());
        $properties = $reflection->getProperties($mode);

        return array_map(static fn ($item) => [
            'name' => $item->getName(),
            'type' => $item->getType()?->getName() ?? 'mixed',
            'default' => $item->getDefaultValue(),
        ], $properties);
    }

    /**
     * Функция, выводящая результат, есть ли нулевые ключи (не проставленные) в ДТО
     */
    final public function hasNullKeys(): bool
    {
        $properties = Arr::mapWithKeys(
            static::getProperties(),
            static fn ($item) => [$item['name'] => $this->{$item['name']}]
        );

        $nullValues = Arr::where($properties, static function ($item) {
            return $item === null;
        });

        return count($nullValues) > 0;
    }

    /**
     * @return array воплощение свойств объекта в массиве
     */
    public function toArray(): array
    {
        return Arr::mapWithKeys(static::getProperties(), function ($item) {
            $itemValue = $this->{$item['name']} ?? null;

            if ($itemValue instanceof \UnitEnum) {
                $itemValue = $itemValue->value;
            } elseif ($itemValue instanceof Arrayable) {
                $itemValue = $itemValue->toArray();
            } elseif (is_array($itemValue)) {
                $itemValue = Arr::map($itemValue, static function ($arrayValue) {
                    return $arrayValue instanceof Arrayable ? $arrayValue->toArray() : $arrayValue;
                });
            }

            return [$item['name'] => $itemValue];
        });
    }
}
