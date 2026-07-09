<?php
function printLine($line) {
    echo $line . PHP_EOL;
}

$markers = [
    'noticias__card-img',
    'noticias__card-media',
    'noticias__bento',
    'noticias__card-title',
    'storageUrl',
    'noticias.slice',
];

printLine('===BUILD ASSET CHECK===');
$assetDir = __DIR__ . '/public/build/assets';
foreach (glob($assetDir . '/*.{js,css}', GLOB_BRACE) as $file) {
    $contents = file_get_contents($file);
    $found = [];
    foreach ($markers as $marker) {
        if (strpos($contents, $marker) !== false) {
            $found[] = $marker;
        }
    }
    if ($found) {
        printLine('FILE ' . basename($file) . ' ' . implode(', ', $found));
        $lines = explode("\n", $contents);
        foreach ($lines as $line) {
            foreach ($found as $marker) {
                if (strpos($line, $marker) !== false) {
                    printLine('  ' . trim(substr($line, 0, 240)));
                    break 2;
                }
            }
        }
    }
}

printLine('===MANIFEST ENTRY===');
$manifestPath = __DIR__ . '/public/build/manifest.json';
if (file_exists($manifestPath)) {
    $manifest = json_decode(file_get_contents($manifestPath), true);
    printLine('manifest loaded: ' . (is_array($manifest) ? 'yes' : 'no'));
    if (isset($manifest['resources/js/Pages/Home.jsx'])) {
        printLine('Home entry found');
        printLine(json_encode($manifest['resources/js/Pages/Home.jsx'], JSON_UNESCAPED_SLASHES));
    } else {
        printLine('Home entry missing');
    }
} else {
    printLine('Manifest missing');
}

printLine('===LATEST NEWS DATA===');
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$latest = App\Models\Noticia::latest()->take(3)->get(['id', 'titulo', 'imagen', 'created_at']);
foreach ($latest as $n) {
    printLine($n->id . '|' . str_replace("\n", ' ', trim($n->titulo)) . '|' . trim((string)$n->imagen) . '|' . $n->created_at);
}

printLine('===HOME PAGE HTML===');
$html = @file_get_contents('http://127.0.0.1:8000');
if ($html === false) {
    printLine('ERROR_FETCHING_HOME');
} else {
    $lines = explode("\n", $html);
    foreach ($lines as $line) {
        if (stripos($line, 'href=') !== false || stripos($line, 'src=') !== false || stripos($line, 'vite') !== false || stripos($line, 'build') !== false) {
            if (stripos($line, 'http') !== false || stripos($line, 'build') !== false || stripos($line, 'vite') !== false) {
                printLine(trim($line));
            }
        }
    }
    printLine('===HOME NOTICIAS LINES===');
    foreach ($lines as $line) {
        if (stripos($line, 'noticias__card') !== false || stripos($line, 'noticias__card-img') !== false) {
            printLine(trim($line));
        }
    }
}
