<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|RedirectResponse)  $next
     * @return \Illuminate\Http\Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): \Illuminate\Http\Response|RedirectResponse
    {
        if (Auth::user()->isTeacher() === false) {
            if ($request->ajax()) {
                return response('Teacher account required.', 401);
            }

            return back();
        }

        return $next($request);
    }
}
