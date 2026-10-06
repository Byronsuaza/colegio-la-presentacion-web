<?php

namespace App\Support;

class PaginaLayoutBuilder
{
    /**
     * Construye el HTML enriquecido para las páginas con diseño especial.
     */
    public static function buildHtml(string $slug, array $datos): ?string
    {
        return match ($slug) {
            'mision' => self::buildMision($datos),
            'rectora' => self::buildRectora($datos),
            'principios' => self::buildPrincipios($datos),
            'simbolos' => self::buildSimbolos($datos),
            default => null,
        };
    }

    /**
     * Resuelve la ruta pública o de storage para una imagen.
     */
    private static function resolveImgUrl(?string $img, string $default = ''): string
    {
        if (empty($img)) {
            return $default;
        }

        $trimmed = trim(str_replace('\\', '/', $img));

        if (str_starts_with($trimmed, 'http://') || str_starts_with($trimmed, 'https://')) {
            return $trimmed;
        }

        if (str_starts_with($trimmed, '/storage/')) {
            return $trimmed;
        }

        if (str_starts_with($trimmed, 'storage/')) {
            return '/' . $trimmed;
        }

        if (str_starts_with($trimmed, '/')) {
            return $trimmed;
        }

        // Si es un archivo de storage (ej. paginas/xyz.jpg)
        return '/storage/' . $trimmed;
    }

    /**
     * Genera el HTML para la página de Misión.
     */
    public static function buildMision(array $data): string
    {
        $intro1 = htmlspecialchars($data['intro_principal'] ?? '', ENT_QUOTES, 'UTF-8');
        $intro2 = htmlspecialchars($data['intro_secundaria'] ?? '', ENT_QUOTES, 'UTF-8');
        $tarjetas = $data['tarjetas'] ?? [];

        $html = '<div class="mision-container">' . PHP_EOL;
        if ($intro1) {
            $html .= '    <p class="mision-lead">' . $intro1 . '</p>' . PHP_EOL;
        }
        if ($intro2) {
            $html .= '    <p class="mision-lead-sub">' . $intro2 . '</p>' . PHP_EOL;
        }

        if (!empty($tarjetas)) {
            $html .= '    <div class="mision-grid">' . PHP_EOL;
            foreach ($tarjetas as $card) {
                $titulo = htmlspecialchars($card['titulo'] ?? '', ENT_QUOTES, 'UTF-8');
                $desc = htmlspecialchars($card['descripcion'] ?? '', ENT_QUOTES, 'UTF-8');
                $imgSrc = self::resolveImgUrl($card['imagen'] ?? null, '/mision_confesional.jpg');

                $html .= '        <div class="mision-card">' . PHP_EOL;
                $html .= '            <div class="mision-card__img-wrapper">' . PHP_EOL;
                $html .= '                <img src="' . htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8') . '" alt="' . $titulo . '" class="mision-card__img" />' . PHP_EOL;
                $html .= '            </div>' . PHP_EOL;
                $html .= '            <div class="mision-card__body">' . PHP_EOL;
                $html .= '                <h3>' . $titulo . '</h3>' . PHP_EOL;
                $html .= '                <p>' . $desc . '</p>' . PHP_EOL;
                $html .= '            </div>' . PHP_EOL;
                $html .= '        </div>' . PHP_EOL;
            }
            $html .= '    </div>' . PHP_EOL;
        }
        $html .= '</div>';

        return $html;
    }

    /**
     * Genera el HTML para la página de la Rectora.
     */
    public static function buildRectora(array $data): string
    {
        $nombre = htmlspecialchars($data['nombre'] ?? 'Hna. Yolanda Gómez Aristizabal', ENT_QUOTES, 'UTF-8');
        $cargo = htmlspecialchars($data['cargo'] ?? 'Rectora de la Institución', ENT_QUOTES, 'UTF-8');
        $frase = htmlspecialchars($data['frase'] ?? '', ENT_QUOTES, 'UTF-8');
        $mensaje = $data['mensaje'] ?? '';
        $fotoSrc = self::resolveImgUrl($data['foto'] ?? null, '/rectora.jpg');

        // Formatear mensaje a párrafos si viene en texto plano
        if (!str_contains($mensaje, '<p>')) {
            $paragraphs = array_filter(array_map('trim', explode("\n", $mensaje)));
            $mensajeHtml = '';
            foreach ($paragraphs as $p) {
                $mensajeHtml .= '    <p>' . htmlspecialchars($p, ENT_QUOTES, 'UTF-8') . '</p>' . PHP_EOL;
            }
        } else {
            $mensajeHtml = $mensaje;
        }

        $html = '<div class="rectora-profile">' . PHP_EOL;
        $html .= '    <div class="rectora-card">' . PHP_EOL;
        $html .= '        <div class="rectora-image-wrapper">' . PHP_EOL;
        $html .= '            <img src="' . htmlspecialchars($fotoSrc, ENT_QUOTES, 'UTF-8') . '" alt="' . $nombre . '" class="rectora-photo" />' . PHP_EOL;
        $html .= '        </div>' . PHP_EOL;
        $html .= '        <div class="rectora-info">' . PHP_EOL;
        $html .= '            <h3>' . $nombre . '</h3>' . PHP_EOL;
        $html .= '            <span class="rectora-title">' . $cargo . '</span>' . PHP_EOL;
        $html .= '        </div>' . PHP_EOL;
        $html .= '    </div>' . PHP_EOL;

        $html .= '    <div class="rectora-message">' . PHP_EOL;
        if ($frase) {
            $cleanFrase = trim($frase, "\"'\t\n\r\0\x0B");
            $html .= '        <blockquote class="rectora-quote">' . PHP_EOL;
            $html .= '            "' . $cleanFrase . '"' . PHP_EOL;
            $html .= '        </blockquote>' . PHP_EOL;
        }
        $html .= '    ' . trim($mensajeHtml) . PHP_EOL;
        $html .= '    </div>' . PHP_EOL;
        $html .= '</div>';

        return $html;
    }

    /**
     * Genera el HTML para la página de Principios.
     */
    public static function buildPrincipios(array $data): string
    {
        $intro = htmlspecialchars($data['intro'] ?? '', ENT_QUOTES, 'UTF-8');
        $tarjetas = $data['tarjetas'] ?? [];

        $html = '<div class="principios-container">' . PHP_EOL;
        if ($intro) {
            $html .= '    <p class="principios-intro">' . $intro . '</p>' . PHP_EOL;
        }

        if (!empty($tarjetas)) {
            $html .= '    <div class="principios-grid">' . PHP_EOL;
            foreach ($tarjetas as $card) {
                $titulo = htmlspecialchars($card['titulo'] ?? '', ENT_QUOTES, 'UTF-8');
                $badge = htmlspecialchars($card['badge'] ?? $titulo, ENT_QUOTES, 'UTF-8');
                $desc = htmlspecialchars($card['descripcion'] ?? '', ENT_QUOTES, 'UTF-8');
                $imgSrc = self::resolveImgUrl($card['imagen'] ?? null, '/mision_formacionIntegral.jpg');

                $html .= '        <div class="principio-card">' . PHP_EOL;
                $html .= '            <div class="principio-card__header">' . PHP_EOL;
                $html .= '                <img src="' . htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8') . '" alt="' . $titulo . '" class="principio-card__img" />' . PHP_EOL;
                $html .= '                <span class="principio-card__badge">' . $badge . '</span>' . PHP_EOL;
                $html .= '            </div>' . PHP_EOL;
                $html .= '            <div class="principio-card__body">' . PHP_EOL;
                $html .= '                <h3>' . $titulo . '</h3>' . PHP_EOL;
                $html .= '                <p>' . $desc . '</p>' . PHP_EOL;
                $html .= '            </div>' . PHP_EOL;
                $html .= '        </div>' . PHP_EOL;
            }
            $html .= '    </div>' . PHP_EOL;
        }
        $html .= '</div>';

        return $html;
    }

    /**
     * Genera el HTML para la página de Símbolos (Himno, Mascota, etc.).
     */
    public static function buildSimbolos(array $data): string
    {
        $imgSrc = self::resolveImgUrl($data['imagen'] ?? null, '/himno.jpg');
        $titulo = htmlspecialchars($data['titulo'] ?? 'Himno del Colegio', ENT_QUOTES, 'UTF-8');
        $meta = htmlspecialchars($data['meta'] ?? 'Letra: Hermana Margarita de la Encarnación / Música: Antonio Fortich', ENT_QUOTES, 'UTF-8');
        $coro = $data['coro'] ?? '';
        $estrofas = $data['estrofas'] ?? [];

        $html = '<div class="simbolos-container">' . PHP_EOL;
        $html .= '    <section class="simbolo-section himno-section">' . PHP_EOL;
        $html .= '        <div class="simbolo-grid">' . PHP_EOL;
        $html .= '            <div class="simbolo-img-container">' . PHP_EOL;
        $html .= '                <img src="' . htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8') . '" alt="' . $titulo . '" class="simbolo-img" />' . PHP_EOL;
        $html .= '            </div>' . PHP_EOL;
        $html .= '            <div class="simbolo-text-container">' . PHP_EOL;
        $html .= '                <h3>' . $titulo . '</h3>' . PHP_EOL;
        $html .= '                <span class="simbolo-meta">' . $meta . '</span>' . PHP_EOL;

        $html .= '                <div class="himno-box">' . PHP_EOL;
        $html .= '                    <div class="himno-lyrics">' . PHP_EOL;

        if ($coro) {
            $coroLines = nl2br(htmlspecialchars(trim($coro), ENT_QUOTES, 'UTF-8'));
            $html .= '                        <p class="himno-coro"><strong>Coro</strong><br>' . $coroLines . '</p>' . PHP_EOL;
        }

        if (is_array($estrofas)) {
            foreach ($estrofas as $idx => $estrofa) {
                $num = htmlspecialchars($estrofa['numero'] ?? ('Estrofa ' . ($idx + 1)), ENT_QUOTES, 'UTF-8');
                $texto = nl2br(htmlspecialchars(trim($estrofa['texto'] ?? ''), ENT_QUOTES, 'UTF-8'));
                $html .= '                        <p><strong>' . $num . '</strong><br>' . $texto . '</p>' . PHP_EOL;
            }
        }

        $html .= '                    </div>' . PHP_EOL;
        $html .= '                </div>' . PHP_EOL;
        $html .= '            </div>' . PHP_EOL;
        $html .= '        </div>' . PHP_EOL;
        $html .= '    </section>' . PHP_EOL;
        $html .= '</div>';

        return $html;
    }
}
