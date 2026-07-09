<?php

namespace App\Http\Controllers;

use App\Models\PaginaContenido;
use App\Models\GaleriaAlbum;
use App\Models\AreaAcademica;
use App\Support\MenuPages;
use App\Services\AdmissionService;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PaginaController extends Controller
{
    public function show(string $section, string $page)
    {
        $menuPage = MenuPages::find($section, $page);

        if (! $menuPage) {
            abort(404);
        }

        $ajustes = AdmissionService::ajustesConAdmisionesDinamicas();
        $sectionLabel = $menuPage['base'] === 'admisiones'
            ? 'Admisiones ' . $ajustes->admisiones_anio
            : $menuPage['section'];

        $content = PaginaContenido::publicadas()
            ->where('base', $section)
            ->where('slug', $page)
            ->first();
        $title = $content?->titulo ?? $menuPage['title'];
        $subtitle = $content?->subtitulo;

        if ($menuPage['base'] === 'admisiones' && $menuPage['slug'] === 'inscripcion-en-linea') {
            $title = 'Inscripciones Abiertas para el año ' . $ajustes->admisiones_anio;
            $subtitle = 'Disponibilidad de cupos en preescolar, primaria y bachillerato hasta grado noveno.';
        }

        $bodyContent = $content?->contenido;

        if ($menuPage['base'] === 'admisiones' && $menuPage['slug'] === 'inscripcion-en-linea' && $bodyContent) {
            $bodyContent = AdmissionService::reemplazarAnioEnContenido($bodyContent, $ajustes);
        }

        $galleryAlbums = $this->getGalleryAlbums($menuPage);

        $areasAcademicas = $this->getAreasAcademicas($menuPage);

        $sectionPages = PaginaContenido::publicadas()
            ->where('base', $section)
            ->orderByRaw("FIELD(slug, '" . collect($menuPage['sectionPages'])->pluck('slug')->implode("','") . "')")
            ->get(['slug', 'titulo as title', 'url_externa'])
            ->map(function ($item) use ($ajustes, $section) {
                $title = $item->title;

                if ($section === 'admisiones' && $item->slug === 'inscripcion-en-linea') {
                    $title = 'Inscripciones Abiertas para el año ' . $ajustes->admisiones_anio;
                }

                return [
                    'slug' => $item->slug,
                    'title' => $title,
                    'url_externa' => $item->url_externa,
                ];
            })
            ->all();

        return Inertia::render('MenuPage', [
            'ajustes' => $ajustes,
            'page' => [
                ...$menuPage,
                'section' => $sectionLabel,
                'title' => $title,
                'subtitle' => $subtitle,
                'image' => $content?->imagen,
                'externalUrl' => $content?->url_externa,
                'content' => $bodyContent,
                'links' => $content?->enlaces ?? [],
            ],
            'sectionPages' => $sectionPages ?: $menuPage['sectionPages'],
            'galleryAlbums' => $galleryAlbums,
            'areasAcademicas' => $areasAcademicas,
            // Indica si la página de pruebas diagnósticas está protegida con contraseña.
            // La contraseña real NUNCA se pasa al frontend.
            'pruebasProtegida' => ! empty($ajustes->pruebas_diagnosticas_password),
        ]);
    }

    private function getGalleryAlbums(array $menuPage): array
    {
        if ($menuPage['base'] !== 'nuestra-institucion' || $menuPage['slug'] !== 'galeria') {
            return [];
        }

        return GaleriaAlbum::publicados()
            ->orderBy('orden')
            ->latest('fecha')
            ->get()
            ->map(fn ($album) => [
                'id' => $album->id,
                'titulo' => $album->titulo,
                'categoria' => $album->categoria,
                'fecha' => $album->fecha?->format('Y-m-d'),
                'portada' => $album->portada,
                'imagenes' => $album->imagenes ?? [],
                'videos' => $album->videos ?? [],
                'descripcion' => $album->descripcion,
            ])
            ->all();
    }

    private function getAreasAcademicas(array $menuPage): array
    {
        if ($menuPage['base'] !== 'gestion-academica' || $menuPage['slug'] !== 'comites-academicos-por-areas') {
            return [];
        }

        try {
            return AreaAcademica::activas()->ordenadas()->get()
                ->map(function ($area) {
                    $enlaces = collect($area->enlaces ?? [])->map(function ($enlace) {
                        $url = $enlace['url'] ?? null;
                        if (! empty($enlace['archivo'])) {
                            $url = Storage::url(ltrim($enlace['archivo'], '/'));
                        }

                        return [
                            'titulo' => $enlace['titulo'] ?? ($enlace['label'] ?? ''),
                            'url' => $url,
                        ];
                    })->all();

                    $area->enlaces = $enlaces;

                    return $area;
                })
                ->all();
        } catch (\Exception $e) {
            return [];
        }
    }
}