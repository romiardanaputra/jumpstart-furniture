<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class role
{
    public function handle(Request $request, Closure $next, ...$role)
    {
        if (! Auth::check()) {
            abort(403);
        }

        return collect($role)->contains(auth()->user()->role) ? $next($request) : back();
    }
}
