<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$withImage = App\Models\Noticia::whereNotNull('imagen')->where('imagen', '<>', '');
echo 'COUNT_WITH_IMAGE=' . $withImage->count() . PHP_EOL;
$items = $withImage->latest()->take(5)->get(['id', 'titulo', 'imagen', 'created_at']);
foreach ($items as $item) {
    echo $item->id . '|' . $item->titulo . '|' . $item->imagen . '|' . $item->created_at . PHP_EOL;
}
