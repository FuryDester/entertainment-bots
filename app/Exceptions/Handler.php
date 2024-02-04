<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * {@inheritDoc}
     */
    public function render($request, Throwable $e): HttpResponse|JsonResponse|RedirectResponse|Response
    {
        // Ответ в специальном формате, в случае ответа JSON
        if ($request->expectsJson()) {
            $data = [
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => [
                    'code' => $e->getCode(),
                ],
            ];

            if (!app()->isProduction()) {
                $data['data'] = [
                    ...$data['data'],
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTrace(),
                ];
            }

            return response()->json($data, $this->getExceptionHTTPStatus($e));
        }

        return parent::render($request, $e);
    }

    /**
     * Получение корректного HTTP-статуса для исключения
     */
    private function getExceptionHTTPStatus(Throwable $e): int
    {
        return match (true) {
            property_exists($e, 'status') => $e->status, // Если у исключений определен статус ошибки,
            method_exists($e, 'getStatusCode') => $e->getStatusCode(), // Если у исключения определен метод получения кода ошибки
            default => Response::HTTP_INTERNAL_SERVER_ERROR
        };
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // ...
    }
}
