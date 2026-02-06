<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Stripe\Exception\ApiErrorException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
        'card_number',
        'cvv',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            // Log all exceptions with context
            Log::error('Application Exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
        });

        // Handle exceptions for JSON/AJAX requests
        $this->renderable(function (Throwable $e, Request $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->handleJsonException($e);
            }
        });
    }

    /**
     * Handle exceptions for JSON/AJAX requests with standardized response
     */
    protected function handleJsonException(Throwable $e): JsonResponse
    {
        // Validation errors
        if ($e instanceof ValidationException) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }

        // Stripe API errors
        if ($e instanceof ApiErrorException) {
            return response()->json([
                'success' => false,
                'message' => 'Payment processing failed',
                'error' => config('app.debug') ? $e->getMessage() : 'Please try again later',
            ], 402);
        }

        // HTTP exceptions
        if ($e instanceof HttpException) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'An error occurred',
            ], $e->getStatusCode());
        }

        // Default error response
        return response()->json([
            'success' => false,
            'message' => config('app.debug') ? $e->getMessage() : 'An unexpected error occurred',
            'code' => 500,
        ], 500);
    }
}

