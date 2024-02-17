<?php

namespace App\Application\VK\Services\Actions;

use App\Domain\VK\Services\Actions\ActionServiceContract;
use App\Domain\VK\Services\Actions\Processors\Actionable;
use App\Infrastructure\VK\DataTransferObjects\Models\VkEventDTO;
use App\Infrastructure\VK\Enums\ActionEnum;
use Exception;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\Facades\Log;

final readonly class ActionService implements ActionServiceContract
{
    /**
     * {@inheritDoc}
     *
     * @throws Exception
     */
    public function getActionByDto(VkEventDTO $dto): ?Actionable
    {
        $type = $dto->getType();
        $actionValue = ActionEnum::tryFrom($type);
        if ($actionValue === null) {
            return null;
        }

        $actions = array_filter(
            ClassFinder::getClassesInNamespace('App\Application\VK\Services\Actions\Processors'),
            static fn ($class) => is_subclass_of($class, Actionable::class),
        );

        foreach ($actions as $action) {
            $class = app($action);
            if (! ($class instanceof Actionable)) {
                Log::error('Action is not instance of Actionable! Action: '.$action);

                continue;
            }

            if ($class::getActionName() === $actionValue) {
                return $class;
            }
        }

        return null;
    }
}
