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
            'recorrido-historico' => self::buildRecorridoHistorico($datos),
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
     * Genera el HTML para la página de Símbolos (Himno, Escudo, Bandera, Lema).
     */
    public static function buildSimbolos(array $data): string
    {
        // 1. HIMNO
        $himnoImg = self::resolveImgUrl($data['himno_imagen'] ?? $data['imagen'] ?? null, '/himno.jpg');
        $himnoTitulo = htmlspecialchars($data['himno_titulo'] ?? $data['titulo'] ?? 'Himno del Colegio', ENT_QUOTES, 'UTF-8');
        $himnoMeta = htmlspecialchars($data['himno_meta'] ?? $data['meta'] ?? 'Letra: Hermana Margarita de la Encarnación / Música: Antonio Fortich', ENT_QUOTES, 'UTF-8');
        $coro = $data['himno_coro'] ?? $data['coro'] ?? '';
        $estrofas = $data['himno_estrofas'] ?? $data['estrofas'] ?? [];

        $html = '<div class="simbolos-container">' . PHP_EOL;
        $html .= '    <section class="simbolo-section himno-section">' . PHP_EOL;
        $html .= '        <div class="simbolo-grid">' . PHP_EOL;
        $html .= '            <div class="simbolo-img-container">' . PHP_EOL;
        $html .= '                <img src="' . htmlspecialchars($himnoImg, ENT_QUOTES, 'UTF-8') . '" alt="' . $himnoTitulo . '" class="simbolo-img" />' . PHP_EOL;
        $html .= '            </div>' . PHP_EOL;
        $html .= '            <div class="simbolo-text-container">' . PHP_EOL;
        $html .= '                <h3>' . $himnoTitulo . '</h3>' . PHP_EOL;
        $html .= '                <span class="simbolo-meta">' . $himnoMeta . '</span>' . PHP_EOL;

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

        // 2. ESCUDO
        $escudoImg = self::resolveImgUrl($data['escudo_imagen'] ?? null, '/escudo.jpg');
        $escudoTitulo = htmlspecialchars($data['escudo_titulo'] ?? 'El Escudo', ENT_QUOTES, 'UTF-8');
        $escudoDesc = $data['escudo_descripcion'] ?? "El escudo del colegio de la Presentación consta de un sello con fondo azul. Esculpida en él una pequeña abeja dorada, enmarcada en una decena del santo rosario.\n\nEl fondo azul simboliza para los estudiantes de la Presentación la armonía de la sencillez de su vida. La pequeña abeja dorada es el símbolo del trabajo constante y discreto, constructor y de hondo sentido social. El trabajo tiene un valor trascendente cuando se proyecta a la sociedad y al entorno inmediato, haciéndose todo por amor e identificación evangélica con el servicio.\n\nEl rosario que enmarca el sello representa la piedad constante que debe inspirar la vida de un estudiante Presentación, demostrando que su fe tiene profundas e ineludibles implicaciones sociales.";

        $html .= '    <hr class="simbolo-divider" />' . PHP_EOL;
        $html .= '    <section class="simbolo-section escudo-section">' . PHP_EOL;
        $html .= '        <div class="simbolo-grid">' . PHP_EOL;
        $html .= '            <div class="simbolo-img-container">' . PHP_EOL;
        $html .= '                <img src="' . htmlspecialchars($escudoImg, ENT_QUOTES, 'UTF-8') . '" alt="' . $escudoTitulo . '" class="simbolo-img" />' . PHP_EOL;
        $html .= '            </div>' . PHP_EOL;
        $html .= '            <div class="simbolo-text-container">' . PHP_EOL;
        $html .= '                <h3>' . $escudoTitulo . '</h3>' . PHP_EOL;
        if (!str_contains($escudoDesc, '<p>')) {
            $escudoParagraphs = array_filter(array_map('trim', explode("\n", $escudoDesc)));
            foreach ($escudoParagraphs as $ep) {
                $html .= '                <p>' . htmlspecialchars($ep, ENT_QUOTES, 'UTF-8') . '</p>' . PHP_EOL;
            }
        } else {
            $html .= '                ' . trim($escudoDesc) . PHP_EOL;
        }
        $html .= '            </div>' . PHP_EOL;
        $html .= '        </div>' . PHP_EOL;
        $html .= '    </section>' . PHP_EOL;

        // 3. BANDERA
        $banderaImg = self::resolveImgUrl($data['bandera_imagen'] ?? null, '/bandera.jpg');
        $banderaTitulo = htmlspecialchars($data['bandera_titulo'] ?? 'La Bandera', ENT_QUOTES, 'UTF-8');
        $banderaDesc = $data['bandera_descripcion'] ?? "La Bandera del colegio de la Presentación está conformada por una franja blanca y una franja azul rey, colocadas en forma horizontal, simbolizando la pureza de vida, la sencillez y la armonía.\n\nEl color blanco encarna la pureza e integridad moral que debe adornar a todo estudiante Presentación, y el color azul simboliza la sencillez virtuosa que les caracteriza. Vivenciar estas virtudes permite alcanzar el equilibrio e integrar razones morales que persigan permanentemente lo bueno, bello, verdadero y digno en la existencia humana.";

        $html .= '    <hr class="simbolo-divider" />' . PHP_EOL;
        $html .= '    <section class="simbolo-section bandera-section">' . PHP_EOL;
        $html .= '        <div class="simbolo-grid">' . PHP_EOL;
        $html .= '            <div class="simbolo-img-container">' . PHP_EOL;
        $html .= '                <img src="' . htmlspecialchars($banderaImg, ENT_QUOTES, 'UTF-8') . '" alt="' . $banderaTitulo . '" class="simbolo-img" />' . PHP_EOL;
        $html .= '            </div>' . PHP_EOL;
        $html .= '            <div class="simbolo-text-container">' . PHP_EOL;
        $html .= '                <h3>' . $banderaTitulo . '</h3>' . PHP_EOL;
        if (!str_contains($banderaDesc, '<p>')) {
            $banderaParagraphs = array_filter(array_map('trim', explode("\n", $banderaDesc)));
            foreach ($banderaParagraphs as $bp) {
                $html .= '                <p>' . htmlspecialchars($bp, ENT_QUOTES, 'UTF-8') . '</p>' . PHP_EOL;
            }
        } else {
            $html .= '                ' . trim($banderaDesc) . PHP_EOL;
        }
        $html .= '            </div>' . PHP_EOL;
        $html .= '        </div>' . PHP_EOL;
        $html .= '    </section>' . PHP_EOL;

        // 4. LEMA
        $lemaTitulo = htmlspecialchars($data['lema_titulo'] ?? 'Nuestro Lema: Piedad, Sencillez y Trabajo', ENT_QUOTES, 'UTF-8');
        $lemaPiedad = htmlspecialchars($data['lema_piedad'] ?? 'La virtud que permite descubrir la presencia viva de Dios. Inspira la relación espiritual personal y fomenta el compromiso social a través de la solidaridad, la justicia activa y la búsqueda incesante de la paz colectiva.', ENT_QUOTES, 'UTF-8');
        $lemaSencillez = htmlspecialchars($data['lema_sencillez'] ?? 'La virtud de la transparencia, rectitud, honestidad y coherencia. Permite reconocer los propios dones y ponerlos desinteresadamente al servicio del prójimo con respeto y profundos buenos modales.', ENT_QUOTES, 'UTF-8');
        $lemaTrabajo = htmlspecialchars($data['lema_trabajo'] ?? 'La virtud redentora y transformadora que potencia los talentos en favor del bien común. Representa el sentido de responsabilidad, la creatividad permanente y el deseo noble de edificar una sociedad mejor.', ENT_QUOTES, 'UTF-8');

        $html .= '    <hr class="simbolo-divider" />' . PHP_EOL;
        $html .= '    <section class="simbolo-section lema-section">' . PHP_EOL;
        $html .= '        <h3>' . $lemaTitulo . '</h3>' . PHP_EOL;
        $html .= '        <div class="lema-grid">' . PHP_EOL;

        $html .= '            <div class="lema-card">' . PHP_EOL;
        $html .= '                <div class="lema-card__header lema-card__header--piedad">PIEDAD</div>' . PHP_EOL;
        $html .= '                <div class="lema-card__body">' . PHP_EOL;
        $html .= '                    <p>' . $lemaPiedad . '</p>' . PHP_EOL;
        $html .= '                </div>' . PHP_EOL;
        $html .= '            </div>' . PHP_EOL;

        $html .= '            <div class="lema-card">' . PHP_EOL;
        $html .= '                <div class="lema-card__header lema-card__header--sencillez">SENCILLEZ</div>' . PHP_EOL;
        $html .= '                <div class="lema-card__body">' . PHP_EOL;
        $html .= '                    <p>' . $lemaSencillez . '</p>' . PHP_EOL;
        $html .= '                </div>' . PHP_EOL;
        $html .= '            </div>' . PHP_EOL;

        $html .= '            <div class="lema-card">' . PHP_EOL;
        $html .= '                <div class="lema-card__header lema-card__header--trabajo">TRABAJO</div>' . PHP_EOL;
        $html .= '                <div class="lema-card__body">' . PHP_EOL;
        $html .= '                    <p>' . $lemaTrabajo . '</p>' . PHP_EOL;
        $html .= '                </div>' . PHP_EOL;
        $html .= '            </div>' . PHP_EOL;

        $html .= '        </div>' . PHP_EOL;
        $html .= '    </section>' . PHP_EOL;
        $html .= '</div>';

        return $html;
    }

    /**
     * Genera el HTML para la línea de tiempo de Recorrido Histórico.
     */
    public static function buildRecorridoHistorico(array $data): string
    {
        $intro = htmlspecialchars($data['intro'] ?? 'Explora el fascinante recorrido de nuestra historia a través de los tomos documentales oficiales cuidadosamente recopilados e indexados por la institución. Haz clic en los botones para abrir los documentos en PDF almacenados en Google Drive:', ENT_QUOTES, 'UTF-8');
        $tomos = $data['tomos'] ?? [];

        $html = '<div class="recorrido-container">' . PHP_EOL;
        if ($intro) {
            $html .= '    <p class="timeline-intro">' . $intro . '</p>' . PHP_EOL;
        }

        if (!empty($tomos)) {
            $html .= '    <div class="timeline">' . PHP_EOL;
            foreach ($tomos as $tomo) {
                $badge = htmlspecialchars($tomo['badge'] ?? $tomo['anio'] ?? '', ENT_QUOTES, 'UTF-8');
                $titulo = htmlspecialchars($tomo['titulo'] ?? '', ENT_QUOTES, 'UTF-8');
                $era = htmlspecialchars($tomo['era'] ?? $tomo['periodo'] ?? '', ENT_QUOTES, 'UTF-8');
                $desc = htmlspecialchars($tomo['descripcion'] ?? '', ENT_QUOTES, 'UTF-8');

                $url = !empty($tomo['url_documento'])
                    ? $tomo['url_documento']
                    : (!empty($tomo['archivo_pdf']) ? self::resolveImgUrl($tomo['archivo_pdf']) : '');

                $defaultBtnText = 'Abrir Tomo Histórico' . ($era ? ' ' . $era : ($badge ? ' ' . $badge : ''));
                $btnTexto = htmlspecialchars(!empty($tomo['texto_boton']) ? $tomo['texto_boton'] : $defaultBtnText, ENT_QUOTES, 'UTF-8');

                $html .= '        <div class="timeline-item">' . PHP_EOL;
                $html .= '            <div class="timeline-badge">' . $badge . '</div>' . PHP_EOL;
                $html .= '            <div class="timeline-panel">' . PHP_EOL;
                $html .= '                <div class="timeline-heading">' . PHP_EOL;
                $html .= '                    <h4>' . $titulo . '</h4>' . PHP_EOL;
                if ($era) {
                    $html .= '                    <span class="timeline-era">' . $era . '</span>' . PHP_EOL;
                }
                $html .= '                </div>' . PHP_EOL;
                $html .= '                <div class="timeline-body">' . PHP_EOL;
                if ($desc) {
                    $html .= '                    <p>' . $desc . '</p>' . PHP_EOL;
                }
                if ($url) {
                    $html .= '                    <a href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" target="_blank" rel="noopener noreferrer" class="timeline-btn">' . PHP_EOL;
                    $html .= '                        <span class="timeline-btn-icon">📄</span> ' . $btnTexto . PHP_EOL;
                    $html .= '                    </a>' . PHP_EOL;
                }
                $html .= '                </div>' . PHP_EOL;
                $html .= '            </div>' . PHP_EOL;
                $html .= '        </div>' . PHP_EOL;
            }
            $html .= '    </div>' . PHP_EOL;
        }

        $html .= '</div>';

        return $html;
    }
}
