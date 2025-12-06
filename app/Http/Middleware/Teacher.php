<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Teacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            
            // Check if user is a teacher
            if ($user->role == 'teacher') {
                // Check if applyTeacher exists
                if (!$user->applyTeacher) {
                    abort(403, 'Teacher application not found. Please contact administrator.');
                }
                
                // Check if status is accepted
                if ($user->applyTeacher->status == 'accepted') {
                    return $next($request);
                } else {
                    abort(403, 'Your teacher application is ' . $user->applyTeacher->status . '. Please wait for approval.');
                }
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
