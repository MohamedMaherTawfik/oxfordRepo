<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStaffPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $permission
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }

        $user = auth()->user();

        // Admin has all permissions
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Check if staff has the required permission
        if ($user->role === 'staff' && $user->hasPermission($permission)) {
            return $next($request);
        }

        abort(403, 'You do not have permission to access this resource.');
    }
}
