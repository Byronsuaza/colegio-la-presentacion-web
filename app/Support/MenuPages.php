<?php

namespace App\Support;

use App\Models\PaginaContenido;

class MenuPages
{
    /**
     * Estructura base del menú con agrupación de columnas para la navbar.
     * Sirve como plantilla; las páginas reales se toman de la BD.
     */
    public static function template(): array
    {
        return [
            [
                'label' => 'Nuestra Institución',
                'base' => 'nuestra-institucion',
                'columns' => [
                    [
                        'title' => 'Identidad',
                        'slugs' => ['marie-poussepin', 'mision', 'vision', 'principios', 'simbolos'],
                    ],
                    [
                        'title' => 'Gobierno y memoria',
                        'slugs' => ['organizacion', 'en-manos-de-ellas', 'recorrido-historico', 'rectora'],
                    ],
                    [
                        'title' => 'Recursos',
                        'slugs' => ['pei-general', 'pei-local', 'galeria', 'resolucion-de-costos'],
                    ],
                ],
            ],
            [
                'label' => 'Gestión Académica',
                'base' => 'gestion-academica',
                'columns' => [
                    [
                        'title' => 'Planeación',
                        'slugs' => ['calendario-academico', 'horarios-generales', 'horarios-especificos', 'plan-de-estudios'],
                    ],
                    [
                        'title' => 'Seguimiento',
                        'slugs' => ['comites-academicos-por-areas', 'pruebas-diagnosticas', 'siee'],
                    ],
                ],
            ],
            [
                'label' => 'Calidad y Pastoral',
                'base' => 'calidad-y-pastoral',
                'columns' => [
                    [
                        'title' => 'Calidad',
                        'slugs' => ['objetivos-de-calidad', 'politica-de-calidad', 'evaluacion-actividades-docentes', 'politica-de-privacidad'],
                    ],
                    [
                        'title' => 'Pastoral',
                        'slugs' => ['plan-global-de-pastoral', 'proyecto-pastoral', 'infografias-de-pastoral'],
                    ],
                ],
            ],
            [
                'label' => 'Gestión Comunitaria',
                'navLabel' => 'Comunitaria',
                'base' => 'gestion-comunitaria',
                'columns' => [
                    [
                        'title' => 'Convivencia',
                        'slugs' => ['proyeccion-social', 'titulares', 'manual-de-convivencia', 'flujogramas'],
                    ],
                    [
                        'title' => 'Rutas de atención',
                        'slugs' => ['ruta-de-atencion-integral', 'violencia-escolar', 'conducta-suicida', 'spa'],
                    ],
                    [
                        'title' => 'Proyectos',
                        'slugs' => ['proyectos-comunitarios'],
                    ],
                ],
            ],
            [
                'label' => 'Servicios y Comunidad',
                'navLabel' => 'Servicios',
                'base' => 'servicios',
                'columns' => [
                    [
                        'title' => 'Plataformas',
                        'slugs' => ['syscolegios'],
                    ],
                    [
                        'title' => 'Comunidad educativa',
                        'slugs' => ['estudiantes', 'encuestas', 'evaluaciones', 'rincones-didacticos', 'padres-de-familia', 'egresados-exalumnos'],
                    ],
                ],
            ],
            [
                'label' => 'Comunicaciones & Contacto',
                'navLabel' => 'Contacto',
                'base' => 'comunicaciones-contacto',
                'columns' => [
                    [
                        'title' => 'Comunicaciones',
                        'slugs' => ['circulares', 'directorio-de-correos', 'pqrs', 'contactenos'],
                    ],
                ],
            ],
            [
                'label' => 'Admisiones',
                'base' => 'admisiones',
                'columns' => [
                    [
                        'title' => 'Admisiones',
                        'slugs' => ['inscripcion-en-linea', 'separacion-de-cupo'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Genera la estructura del menú de navegación combinando la plantilla
     * estática con las páginas reales de la BD.
     *
     * - Páginas que están en la plantilla pero NO en la BD → se eliminan del menú
     * - Páginas que están en la BD pero NO en la plantilla → se agregan en "Más" al final
     */
    public static function forNavbar(): array
    {
        $dbPages = PaginaContenido::publicadas()
            ->get(['base', 'slug', 'titulo', 'url_externa', 'subseccion'])
            ->groupBy('base');

        $nav = [];

        foreach (self::template() as $section) {
            $base = $section['base'];
            $sectionDbPages = $dbPages->get($base, collect());

            // Indexar páginas de BD por slug para búsqueda rápida
            $dbBySlug = $sectionDbPages->keyBy('slug');

            // Slugs ya ubicados en columnas
            $placedSlugs = [];

            // Mapear columnas iniciales para permitir agregar links dinámicamente
            $columnsMap = [];
            foreach ($section['columns'] as $column) {
                $links = [];
                foreach ($column['slugs'] as $slug) {
                    $dbPage = $dbBySlug->get($slug);
                    if ($dbPage) {
                        $links[] = [
                            'label' => $dbPage->titulo,
                            'slug' => $dbPage->slug,
                            'url_externa' => $dbPage->url_externa,
                        ];
                        $placedSlugs[] = $slug;
                    }
                }
                $columnsMap[$column['title']] = [
                    'title' => $column['title'],
                    'links' => $links,
                ];
            }

            // Agregar páginas de BD que no están en ninguna columna de la plantilla
            $extraPages = $sectionDbPages->filter(
                fn ($p) => ! in_array($p->slug, $placedSlugs)
            );

            foreach ($extraPages as $page) {
                $subseccion = $page->subseccion;

                if (! empty($subseccion)) {
                    if (isset($columnsMap[$subseccion])) {
                        $columnsMap[$subseccion]['links'][] = [
                            'label' => $page->titulo,
                            'slug' => $page->slug,
                            'url_externa' => $page->url_externa,
                        ];
                    } else {
                        $columnsMap[$subseccion] = [
                            'title' => $subseccion,
                            'links' => [
                                [
                                    'label' => $page->titulo,
                                    'slug' => $page->slug,
                                    'url_externa' => $page->url_externa,
                                ]
                            ],
                        ];
                    }
                } else {
                    if (! isset($columnsMap['Más'])) {
                        $columnsMap['Más'] = [
                            'title' => 'Más',
                            'links' => [],
                        ];
                    }
                    $columnsMap['Más']['links'][] = [
                        'label' => $page->titulo,
                        'slug' => $page->slug,
                        'url_externa' => $page->url_externa,
                    ];
                }
            }

            // Filtrar columnas vacías
            $columns = [];
            foreach ($columnsMap as $column) {
                if (! empty($column['links'])) {
                    $columns[] = $column;
                }
            }

            // Solo agregar la sección si tiene al menos una columna con links
            if (! empty($columns)) {
                $nav[] = [
                    'label' => $section['navLabel'] ?? $section['label'],
                    'base' => '/'.$base,
                    'columns' => $columns,
                ];
            }
        }

        // Secciones que existen en BD pero no en la plantilla
        $templateBases = collect(self::template())->pluck('base')->all();
        $extraBases = $dbPages->keys()->diff($templateBases);

        foreach ($extraBases as $base) {
            $pages = $dbPages->get($base);
            $sectionLabel = $pages->first()->seccion ?? ucfirst(str_replace('-', ' ', $base));

            $nav[] = [
                'label' => $sectionLabel,
                'base' => '/'.$base,
                'columns' => [
                    [
                        'title' => $sectionLabel,
                        'links' => $pages->map(fn ($p) => [
                            'label' => $p->titulo,
                            'slug' => $p->slug,
                            'url_externa' => $p->url_externa,
                        ])->values()->all(),
                    ],
                ],
            ];
        }

        return $nav;
    }

    /**
     * Retorna la lista plana de páginas de una sección (para compatibilidad con rutas).
     */
    public static function sections(): array
    {
        $dbPages = PaginaContenido::publicadas()
            ->get(['base', 'slug', 'titulo'])
            ->groupBy('base');

        $sections = [];

        foreach (self::template() as $section) {
            $base = $section['base'];
            $sectionDbPages = $dbPages->get($base, collect());

            $pages = $sectionDbPages->map(fn ($p) => [
                'slug' => $p->slug,
                'title' => $p->titulo,
            ])->values()->all();

            $sections[] = [
                'label' => $section['label'],
                'base' => $base,
                'pages' => $pages,
            ];
        }

        // Secciones extra de BD
        $templateBases = collect(self::template())->pluck('base')->all();
        foreach ($dbPages as $base => $pages) {
            if (in_array($base, $templateBases)) {
                continue;
            }

            $sections[] = [
                'label' => $pages->first()->seccion ?? ucfirst(str_replace('-', ' ', $base)),
                'base' => $base,
                'pages' => $pages->map(fn ($p) => [
                    'slug' => $p->slug,
                    'title' => $p->titulo,
                ])->values()->all(),
            ];
        }

        return $sections;
    }

    /**
     * Busca una página por sección y slug.
     * Primero busca en la BD (fuente de verdad), luego en la plantilla como fallback.
     */
    public static function find(string $section, string $slug): ?array
    {
        // Buscar en BD
        $dbPage = PaginaContenido::publicadas()
            ->where('base', $section)
            ->where('slug', $slug)
            ->first();

        if ($dbPage) {
            $sectionPages = PaginaContenido::publicadas()
                ->where('base', $section)
                ->get(['slug', 'titulo as title'])
                ->map(fn ($p) => ['slug' => $p->slug, 'title' => $p->title])
                ->all();

            // Buscar label de la sección en la plantilla
            $sectionLabel = $dbPage->seccion;
            foreach (self::template() as $tmplSection) {
                if ($tmplSection['base'] === $section) {
                    $sectionLabel = $tmplSection['label'];
                    break;
                }
            }

            return [
                'slug' => $dbPage->slug,
                'title' => $dbPage->titulo,
                'section' => $sectionLabel,
                'base' => $dbPage->base,
                'sectionPages' => $sectionPages,
            ];
        }

        return null;
    }
}
