<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$slides = [
    ['imagen' => 'hero4.jpg', 'titulo' => 'Comunidad educativa', 'subtitulo' => 'La Presentación Neiva'],
    ['imagen' => 'hero5.jpg', 'titulo' => 'Actividades institucionales', 'subtitulo' => 'La Presentación Neiva'],
    ['imagen' => 'hero6.jpg', 'titulo' => 'Espacios de aprendizaje', 'subtitulo' => 'La Presentación Neiva'],
    ['imagen' => 'hero7.jpg', 'titulo' => 'Formación integral', 'subtitulo' => 'La Presentación Neiva'],
    ['imagen' => 'hero8.jpg', 'titulo' => 'Excelencia académica', 'subtitulo' => 'La Presentación Neiva']
];

foreach ($slides as $k => $s) {
    if (!\App\Models\HeroSlide::where('imagen', $s['imagen'])->exists()) {
        \App\Models\HeroSlide::create([
            'imagen' => $s['imagen'],
            'titulo' => $s['titulo'],
            'subtitulo' => $s['subtitulo'],
            'orden' => $k + 3,
            'activo' => true
        ]);
        echo "Inserted " . $s['imagen'] . "\n";
    }
}
