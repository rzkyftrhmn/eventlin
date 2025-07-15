<?php
// app/Http/Middleware/AuthAdminOrPanitiaSuper.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdminOrPanitiaSuper
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        if (Auth::guard('panitia')->check()) {
            $jabatan = strtolower(Auth::guard('panitia')->user()->jabatan_panitia ?? '');
            if (in_array($jabatan, ['ketua', 'sekretaris', 'bendahara'])) {
                return $next($request);
            }
            return abort(403, 'Anda tidak memiliki hak akses.');
        }

        // Jika belum login sama sekali
        return redirect()->guest(route('peserta.loginForm'));
}

}
