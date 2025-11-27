<?php

namespace App\Http\Middleware;

use App\Models\Courses;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class courseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $course = Courses::find(request('id'));
        // dd(Auth::guard('api')->user()->id);
        if ($course->user_id == Auth::guard('api')->user()->id) {
            return $next($request);
        }
        return response()->json(
            [
                'message' => "You don't have permission for this Action"
            ]
        );
    }
}
