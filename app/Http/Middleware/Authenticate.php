<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    /* protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    } */

    public function handle($request, \Closure $next, ...$guards): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
