<?php

namespace App\Http\Controllers;

use App\Models\Seccion;
use App\Services\AdmissionService;
use Inertia\Inertia;

class SeccionController extends Controller
{
    public function show(string $nombre)
    {
        $seccion = Seccion::where('nombre', $nombre)->first();

        $titles = [
            'preescolar' => 'Sección I - Preescolar',
            'primaria' => 'Sección II - Primaria',
            'bachillerato' => 'Sección III - Bachillerato',
        ];

        return Inertia::render('SeccionDetalle', [
            'seccionData' => $seccion,
            'seccion' => $nombre,
            'menuPage' => ['title' => $seccion?->titulo ?? ($titles[$nombre] ?? '')],
            'ajustes' => AdmissionService::ajustesConAdmisionesDinamicas(),
        ]);
    }
}