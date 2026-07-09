<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Services\AdmissionService;
use Inertia\Inertia;

class NoticiaController extends Controller
{
    public function index()
    {
        return Inertia::render('NoticiasTodas', [
            'noticias' => Noticia::latest()->get(),
            'ajustes' => AdmissionService::ajustesConAdmisionesDinamicas(),
        ]);
    }
}