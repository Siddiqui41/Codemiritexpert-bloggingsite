<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. If not authenticated, redirect to admin login page
        if (!Auth::check()) {
            return redirect()->guest(route('admin.login'))->with('error', 'Aap ko Admin Panel access karne ke liye login karna zaroori hai.');
        }

        // 2. If authenticated but not an admin, logout and redirect to login
        if (!Auth::user()->isAdmin()) {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Yeh panel sirf administrators ke liye makhsoos hai.'
            ]);
        }

        return $next($request);
    }
}
