<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class ApiHandler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException && $request->is('api/*')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Método no permitido para esta ruta'
            ], 405);
        }

        return parent::render($request, $exception);
    }
}
