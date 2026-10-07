<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PqrsController;
use App\Http\Controllers\PqrsAttachmentController;
use App\Http\Controllers\PruebasDiagnosticasController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);
Route::get('/noticias', [NoticiaController::class, 'index']);
Route::get('/calendario-eventos', [EventoController::class, 'index']);

Route::get('/nuestra-institucion/seccion-preescolar', [SeccionController::class, 'show'])
    ->defaults('nombre', 'preescolar');
Route::get('/nuestra-institucion/seccion-primaria', [SeccionController::class, 'show'])
    ->defaults('nombre', 'primaria');
Route::get('/nuestra-institucion/seccion-bachillerato', [SeccionController::class, 'show'])
    ->defaults('nombre', 'bachillerato');

Route::get('/{section}/{page}', [PaginaController::class, 'show'])
    ->where([
        'section' => '[a-z0-9-]+',
        'page' => '[a-z0-9-]+',
    ]);

Route::get('/visor-pdf/{path}', [PdfController::class, 'show'])
    ->where('path', '.*');

Route::post('/pqrs', [PqrsController::class, 'store'])
    ->middleware('throttle:5,10');

Route::get('/pqrs/attachment/{submission}', [PqrsAttachmentController::class, 'show'])
    ->middleware('auth')
    ->name('pqrs.attachment');

// Verificación de contraseña para pruebas diagnósticas (nunca expone la contraseña al frontend)
Route::post('/api/pruebas-diagnosticas/verificar', [PruebasDiagnosticasController::class, 'verificar'])
    ->middleware('throttle:5,1')
    ->name('pruebas.verificar');

// Fallback para servir archivos de storage si el enlace simbólico es bloqueado por el servidor web
Route::get('/storage/{path}', function (string $path) {
    $cleanPath = str_replace(['../', '..\\'], '', urldecode($path));
    $filePath = storage_path('app/public/' . $cleanPath);

    if (! file_exists($filePath)) {
        // Intentar alternativas comunes (espacio vs guion bajo)
        $altSpace = str_replace('hero slides', 'hero_slides', $cleanPath);
        $altUnderscore = str_replace('hero_slides', 'hero slides', $cleanPath);

        if (file_exists(storage_path('app/public/' . $altSpace))) {
            $filePath = storage_path('app/public/' . $altSpace);
        } elseif (file_exists(storage_path('app/public/' . $altUnderscore))) {
            $filePath = storage_path('app/public/' . $altUnderscore);
        } elseif (file_exists(public_path($cleanPath))) {
            // Si el archivo está en public/ directamente (ej: hero.jpg, hero2.jpg)
            $filePath = public_path($cleanPath);
        }
    }

    if (! file_exists($filePath) || is_dir($filePath)) {
        abort(404);
    }

    $mimeType = @mime_content_type($filePath) ?: 'application/octet-stream';

    return response()->file($filePath, [
        'Content-Type' => $mimeType,
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->where('path', '.*');