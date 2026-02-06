<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     * Verify user has admin role before allowing access.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Authentication required',
                ], 401);
            }
            return redirect()->route('login');
        }

        // Check if user has admin role (assuming role column exists)
        if (!in_array($user->role ?? null, ['admin', 'super_admin'], true)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized. Admin access required.',
                ], 403);
            }
            abort(403, 'Unauthorized. Admin access required.');
        }

        return $next($request);
    }
}
