<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::guard('web')->check()) {
            // Jika belum login, redirect ke halaman login dengan pesan
            return redirect()->route('auth.login')
                ->with('error', 'Anda harus login terlebih dahulu untuk mengakses halaman admin.');
        }

        // Jika sudah login, lanjutkan request
        return $next($request);
    }
}