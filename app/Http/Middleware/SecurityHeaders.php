<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Apply a set of security headers to every response.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '0');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        $response->headers->set('Content-Security-Policy', implode('; ', [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://cdn.tiny.cloud https://www.google.com https://www.gstatic.com https://pagead2.googlesyndication.com",
            "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com https://cdn.tiny.cloud",
            "font-src 'self' data: https://fonts.gstatic.com https://cdn.jsdelivr.net https://cdn.tiny.cloud",
            "img-src 'self' data: blob: https://*.googleusercontent.com https://i.ytimg.com https://maps.google.com https://www.google.com https://www.gstatic.com",
            "connect-src 'self' https://www.youtube.com https://i.ytimg.com",
            "frame-src 'self' https://www.youtube.com https://www.google.com https://maps.google.com",
            "object-src 'none'",
            "base-uri 'self'",
            "frame-ancestors 'self'",
        ]));

        return $response;
    }
}
