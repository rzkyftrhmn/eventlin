<?php

namespace App\Http\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as MiddlewareAuthenticate;


class Authenticate extends MiddlewareAuthenticate
{
    protected function unauthenticated($request, array $guards)
    {
        foreach ($guards as $guard) {
            switch ($guard) {
                case 'admin':
                    throw new AuthenticationException(redirectTo: route('admin.login'));
                case 'panitia':
                    throw new AuthenticationException(redirectTo: route('panitia.loginForm')); // asumsi kamu punya ini
                case 'peserta':
                    throw new AuthenticationException(redirectTo: route('peserta.loginForm'));
                default:
                    throw new AuthenticationException(redirectTo: route('login'));
            }
        }

        // fallback
        throw new AuthenticationException(redirectTo: route('login'));
    }
}