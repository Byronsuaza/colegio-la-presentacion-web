<?php

namespace App\Http\Controllers;

use App\Services\AdmissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PdfController extends Controller
{
    public function show(Request $request, string $path)
    {
        $path = urldecode($path);
        $normalizedPath = str_replace('\\', '/', $path);
        $normalizedPath = ltrim($normalizedPath, '/');
        $title = $request->query('title');

        abort_unless(! str_contains($normalizedPath, '..') && str_ends_with(strtolower($normalizedPath), '.pdf'), 404);
        abort_unless(Storage::disk('public')->exists($normalizedPath), 404);

        return Inertia::render('PdfViewer', [
            'title' => $title ?: basename($normalizedPath),
            'pdfUrl' => Storage::url($normalizedPath),
            'backUrl' => url()->previous() ?: '/',
            'ajustes' => AdmissionService::ajustesConAdmisionesDinamicas(),
        ]);
    }
}