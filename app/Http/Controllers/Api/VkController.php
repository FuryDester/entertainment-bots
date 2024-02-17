<?php

namespace App\Http\Controllers\Api;

use App\Domain\VK\Factories\Models\VkEventDTOFactoryContract;
use App\Domain\VK\Services\Actions\ActionServiceContract;
use App\Domain\VK\Services\Models\VkEventServiceContract;
use App\Http\Requests\Api\VK\CallbackRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VkController extends BaseApiController
{
    /**
     * Роут для обработки callback-запросов от VK.
     * Всегда возвращает 200 OK, за исключением ошибок, для возможности повторной отправки запроса.
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

        /** @var VkEventDTOFactoryContract $vkEventFactory */
        $vkEventFactory = app(VkEventDTOFactoryContract::class);
        $vkEvent = $vkEventFactory::createFromCallback($dto);

        /** @var ActionServiceContract $actionService */
        $actionService = app(ActionServiceContract::class);
        $action = $actionService->getActionByDto($vkEvent);
        if (! $action) {
            return $response;
        }

        Log::info("Processing event: {$vkEvent->getEventId()} with type: {$vkEvent->getType()}");
        $result = $action::perform($dto);
        $vkEvent->setIsProcessed($result);
        $service->save($vkEvent);

        $eventProcessingStatus = $result ? 'processed' : 'processing failed';
        $functionName = $result ? 'info' : 'warning';
        Log::$functionName("Event $eventProcessingStatus: {$vkEvent->getEventId()} with type: {$vkEvent->getType()}");

        return $response;
    }
}
