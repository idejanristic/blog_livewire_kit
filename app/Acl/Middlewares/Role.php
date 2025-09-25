<?php

namespace App\Acl\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ?string $role = ""): Response
    {
        $user = Auth::user();

        if (!$user || !$user->hasRle($role)) {
            abort(code: 403, message: 'Forbidden');
        }

        return $next($request);
    }
}
