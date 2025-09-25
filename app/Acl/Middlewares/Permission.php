<?php

namespace App\Acl\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission = ''): Response
    {
        $user = Auth::user();

        if (!$user || !$user->hasPermission(permission: $permission)) {
            return redirect()->route(route: 'home');
        }

        return $next($request);
    }
}
