<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogSensitiveActions
{
    /**
     * Sensitive action patterns to log
     */
    protected array $sensitivePatterns = [
        'payment',
        'checkout',
        'admin',
        'delete',
        'destroy',
        'user',
    ];

    /**
     * Handle an incoming request.
     * Log all sensitive actions for audit trail.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only log write operations
        if (!in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            return $response;
        }

        // Check if route matches sensitive patterns
        $routeName = $request->route()?->getName() ?? '';
        $routeUri = $request->route()?->uri() ?? '';
        
        $isSensitive = false;
        foreach ($this->sensitivePatterns as $pattern) {
            if (str_contains($routeName, $pattern) || str_contains($routeUri, $pattern)) {
                $isSensitive = true;
                break;
            }
        }

        if ($isSensitive) {
            Log::channel('security')->info('Sensitive action performed', [
                'user_id' => $request->user()?->id,
                'user_email' => $request->user()?->email,
                'action' => $request->method() . ' ' . $request->path(),
                'route' => $routeName,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status_code' => $response->getStatusCode(),
                'timestamp' => now()->toIso8601String(),
            ]);
        }

        return $response;
    }
}
