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

        // Content Security Policy - allow fonts, cloudflare turnstile, and embeds
        $csp = "default-src 'self'; " .
               "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://challenges.cloudflare.com; " .
               "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; " .
               "font-src 'self' https://fonts.gstatic.com data:; " .
               "img-src 'self' data: https: blob:; " .
               "frame-src 'self' https://challenges.cloudflare.com https://www.google.com https://www.youtube.com https://youtube.com https://*.youtube.com https://www.youtube-nocookie.com https://*.canva.com https://canva.com https://*.canva.cn; " .
               "connect-src 'self' https://challenges.cloudflare.com; " .
               "object-src 'none'; " .
               "base-uri 'self';";
        $response->headers->set('Content-Security-Policy', $csp);

        // HTTP Strict Transport Security
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

        // MIME type sniffing protection
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Clickjacking protection (SAMEORIGIN allows admin panel modals/previews)
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Referrer policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // XSS protection (for older browsers)
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        return $response;
    }
}
