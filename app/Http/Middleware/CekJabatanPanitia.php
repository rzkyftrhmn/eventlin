<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CekJabatanPanitia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = auth()->guard('panitia')->user();
        Log::info('Jabatan user: ' . $user->jabatan_panitia);
        Log::info('Roles yang diizinkan: ' . implode(', ', $roles));
        // Kalau tidak login
        if (!$user) {
            return redirect()->route('panitia.loginForm');
        }
        // Kalau jabatannya tidak sesuai
        if (!in_array($user->jabatan_panitia, $roles)) {
            abort(403, 'Akses ditolak: Jabatan tidak diizinkan.');
        }
        return $next($request);
    }
}
