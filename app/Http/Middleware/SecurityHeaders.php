<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Response $response */
        $response = $next($request);

        // Content Security Policy - basic self restrictions
        $csp = "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; object-src 'none'; base-uri 'self';";
        $response->headers->set('Content-Security-Policy', $csp);

        // HTTP Strict Transport Security
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

        // MIME type sniffing protection
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Clickjacking protection
        $response->headers->set('X-Frame-Options', 'DENY');

        // Referrer policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // XSS protection (deprecated but still useful for older browsers)
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        error_log('security middleware called');
        $response->headers->set('X-Debug-Middleware', 'yes');
        return $response;
    }
}
