<?php

namespace App\Services;

class HtmlSanitizerService
{
    /**
     * Sanitiza HTML permitiendo solo un conjunto limitado de tags.
     */
    public static function sanitize(string $html): string
    {
        if (trim($html) === '') {
            return '';
        }

        $allowedTags = '<p><br><b><i><u><em><strong><span>' .
            '<h1><h2><h3><h4><h5><h6>' .
            '<ul><ol><li>' .
            '<a><img><table><thead><tbody><tr><th><td>' .
            '<blockquote><pre><code><hr><div>' .
            '<iframe><video><source>';

        $clean = strip_tags($html, $allowedTags);

        // Remove event handlers
        $clean = preg_replace('/\s*on\w+\s*=\s*"[^"]*"/i', '', $clean);
        $clean = preg_replace("/\s*on\w+\s*=\s*'[^']*'/i", '', $clean);

        // Neutralize javascript: URLs
        $clean = preg_replace('/(href|src)\s*=\s*(["\'])(\s*javascript:[^\2]*?)\2/i', '$1=$2#${2}', $clean);

        return $clean;
    }
}
