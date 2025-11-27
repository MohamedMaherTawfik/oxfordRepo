<?php

namespace App\Http\Middleware\api;

use App\Http\Controllers\api\auth\apiResponse;
use App\Models\comments;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ownComment
{
    use apiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $commentId = comments::find($request->route('id'));
        if (Auth::check()) {

            if (Auth::guard('api')->user()->id == $commentId->user_id) {
                return $next($request);
            } else {
                return $this->unauthorized("You don't have permission to access this comment");
            }
        }
        return $this->unauthorized('You are not authenticated');
    }
}