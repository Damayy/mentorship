<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
{
    if (Auth::check() && Auth::user()->role === $role) {
        return $next($request);
    }

    // Redirect based on the user's role if they try to access a forbidden route
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif (Auth::check() && Auth::user()->role === 'warga') {
        return redirect('/warga/profile');
    }

    return redirect('beranda'); // Redirect to homepage or another page for guests
}
}

    // public function handle(Request $request, Closure $next, $role): Response
    // {
    //     if (auth()->user()->role == $role ) {
    //         return $next($request);
    //     }
    //     return redirect('beranda');
    // } 
