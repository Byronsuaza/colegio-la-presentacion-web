<?php
$css = file_get_contents(__DIR__ . '/public/build/assets/Home-BM4UNcZP.css');
$keys = ['noticias__card-title','noticias__card-desc','noticias__card-inner','noticias__fecha','noticias__cat','noticias__read-link'];
foreach ($keys as $key) {
    echo "=== $key ===\n";
    $pos = strpos($css, $key);
    if ($pos === false) {
        echo "NOT FOUND\n";
        continue;
    }
    $start = max(0, $pos - 80);
    $context = substr($css, $start, 280);
    echo $context . "\n";
}
