<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$rows = App\Models\Noticia::latest()->take(5)->get(['id','titulo','imagen']);
foreach ($rows as $row) {
    echo "{$row->id} | {$row->titulo} | {$row->imagen}\n";
}
