<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileCompletionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        // Cek apakah profile sudah lengkap
        if (!$user->gender || !$user->birth_date || !$user->height) {
            // Jika sedang di halaman profile setup, biarkan lewat
            if ($request->routeIs('profile.setup') || $request->routeIs('profile.setup.store')) {
                return $next($request);
            }
            
            return redirect()->route('profile.setup');
        }

        return $next($request);
    }
}