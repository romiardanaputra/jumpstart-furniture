<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SanitizeInput
{
    /**
     * Fields that should be sanitized
     */
    protected array $except = [
        'password',
        'password_confirmation',
        'current_password',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $input = $request->all();
        
        array_walk_recursive($input, function (&$value, $key) {
            if (!in_array($key, $this->except, true) && is_string($value)) {
                // Strip HTML tags and trim whitespace
                $value = strip_tags(trim($value));
                
                // Remove null bytes
                $value = str_replace("\0", '', $value);
            }
        });
        
        $request->merge($input);
        
        return $next($request);
    }
}
