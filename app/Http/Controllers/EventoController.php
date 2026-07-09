<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Services\AdmissionService;
use Inertia\Inertia;

class EventoController extends Controller
{
    public function index()
    {
        return Inertia::render('EventosCalendario', [
            'eventos' => Evento::where('es_activo', true)
                ->orderBy('fecha', 'asc')
                ->get(),
            'ajustes' => AdmissionService::ajustesConAdmisionesDinamicas(),
        ]);
    }
}