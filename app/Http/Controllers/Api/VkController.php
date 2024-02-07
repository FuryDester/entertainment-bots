<?php

namespace App\Http\Controllers\Api;

use App\Domain\VK\Factories\Models\VkEventDTOFactoryContract;
use App\Domain\VK\Services\Actionable;
use App\Domain\VK\Services\Models\VkEventServiceContract;
use App\Http\Requests\Api\VK\CallbackRequest;
use App\Infrastructure\VK\Enums\ActionEnum;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class VkController extends BaseApiController
{
    /**
     * Роут для обработки callback-запросов от VK.
     * Всегда возвращает 200 OK, за исключением случаев, когда произошла ошибка, для возможности повторной отправки запроса.
     *
     * @throws Exception
     */
    public function callback(CallbackRequest $request, VkEventServiceContract $service): Response
    {
        $response = response('ok', Response::HTTP_OK);

        $dto = $request->formDto();

        // Проверка наличия события в базе данных, чтобы избежать повторной обработки.
        $eventDto = $service->getEventByEventId($dto->getEventId());
        if ($eventDto) {
            return $response;
        }

        $type = $dto->getType();
        $actionValue = ActionEnum::tryFrom($type);
        if ($actionValue === null) {
            return $response;
        }

        $actions = array_filter(
            ClassFinder::getClassesInNamespace('App\Application\VK\Services\Actions'),
            fn($class) => is_subclass_of($class, Actionable::class),
        );
        foreach ($actions as $action) {
            $class = app($action);
            if (!($class instanceof Actionable)) {
                Log::error('Action is not instance of Actionable! Action: ' . $action);
                continue;
            }

            if ($class::getActionName() !== $actionValue) {
                continue;
            }

            $result = $class::perform($dto);

            /** @var VkEventDTOFactoryContract $vkEventFactory */
            $vkEventFactory = app(VkEventDTOFactoryContract::class);
            $eventDto = $vkEventFactory->createFromCallback($dto)->setIsProcessed($result);
            $service->save($eventDto);

            break;
        }

        return $response;
    }
}
