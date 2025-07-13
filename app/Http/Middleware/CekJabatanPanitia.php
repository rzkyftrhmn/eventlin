<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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

        if (!$user || !in_array($user->jabatan_panitia, $roles)) {
            return redirect()->route('panitia.loginForm');
        }

        if (in_array($user->jabatan_panitia, $roles)) {
            return $next($request);
        }

        abort(403, 'Akses ditolak.');
    }
}
