<?php
$url = 'http://127.0.0.1:8000';
$html = @file_get_contents($url);
if ($html === false) {
    echo "ERROR_FETCHING_HOME\n";
    exit(1);
}
$lines = preg_split('/\r?\n/', $html);
foreach ($lines as $line) {
    if (stripos($line, 'href=') !== false || stripos($line, 'src=') !== false || stripos($line, 'vite') !== false || stripos($line, 'build') !== false) {
        if (stripos($line, 'http') !== false || stripos($line, 'build') !== false || stripos($line, 'vite') !== false) {
            echo trim($line) . "\n";
        }
    }
}
echo "===NOTICIAS LINES===\n";
foreach ($lines as $line) {
    if (stripos($line, 'noticias__card') !== false || stripos($line, 'noticias__card-img') !== false) {
        echo trim($line) . "\n";
    }
}
