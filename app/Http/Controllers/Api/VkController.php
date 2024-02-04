<?php

namespace App\Http\Controllers\Api;

use App\Domain\VK\Services\Actions\Actionable;
use App\Http\Requests\Api\VK\CallbackRequest;
use App\Infrastructure\VK\Enums\ActionEnum;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VkController extends BaseApiController
{
    /**
     * Роут для обработки callback-запросов от VK.
     * Всегда возвращает 200 OK, за исключением случаев, когда произошла ошибка, для возможности повторной отправки запроса.
     *
     * @throws \Exception
     */
    public function callback(CallbackRequest $request): Response
    {
        $response = response('ok', Response::HTTP_OK);

        $dto = $request->formDto();

        $type = $dto->getType();
        $actionValue = ActionEnum::tryFrom($type);
        if ($actionValue === null) {
            return $response;
        }

        $actions = array_filter(
            ClassFinder::getClassesInNamespace('App\Domain\VK\Services\Actions'),
            fn($class) => is_subclass_of($class, Actionable::class),
        );
        foreach ($actions as $action) {
            $class = app($action);
            if (!($class instanceof Actionable)) {
                Log::error('Action is not instance of Actionable! Action: ' . $action);
                continue;
            }

            if ($class::getActionName() === $actionValue) {
                $class::perform($dto);
                break;
            }
        }

        return $response;
    }
}
