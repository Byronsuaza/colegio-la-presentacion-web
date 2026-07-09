<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\Noticia;
use App\Models\Evento;
use Illuminate\Support\Facades\Cache;
use App\Services\AdmissionService;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Home', [
            'heroSlides' => HeroSlide::activo()->get(),
            'noticias' => Noticia::whereNotNull('imagen')
                ->where('imagen', '<>', '')
                ->latest()
                ->take(3)
                ->get(),
            'ajustes' => AdmissionService::ajustesConAdmisionesDinamicas(),
            'eventos' => Evento::where('es_activo', true)
                ->where('fecha', '>=', now()->toDateString())
                ->orderBy('fecha', 'asc')
                ->take(4)
                ->get(),
        ]);
    }
}