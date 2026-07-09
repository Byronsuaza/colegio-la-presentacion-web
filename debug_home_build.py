from pathlib import Path
import json
import subprocess
import urllib.request

base = Path('public/build/assets')
markers = ['noticias__card-img', 'noticias__card-media', 'noticias__bento', 'noticias__card-title', 'storageUrl', 'noticias.slice']
for path in sorted(base.glob('*')):
    if path.suffix in ['.css', '.js']:
        text = path.read_text(encoding='utf-8', errors='ignore')
        hits = [m for m in markers if m in text]
        if hits:
            print('FILE', path.name, hits)
            for line in text.splitlines():
                if any(m in line for m in hits):
                    print('  LINE', line.strip()[:240])
                    break

manifest_path = Path('public/build/manifest.json')
print('MANIFEST_EXISTS', manifest_path.exists())
if manifest_path.exists():
    manifest = json.loads(manifest_path.read_text(encoding='utf-8', errors='ignore'))
    print('HOME_ENTRY', 'resources/js/Pages/Home.jsx' in manifest)
    if 'resources/js/Pages/Home.jsx' in manifest:
        print('HOME_ENTRY_DATA', manifest['resources/js/Pages/Home.jsx'])

try:
    html = urllib.request.urlopen('http://127.0.0.1:8000', timeout=10).read().decode('utf-8', 'ignore')
    print('HTML_ASSET_LINES')
    for line in html.splitlines():
        if 'href=' in line or 'src=' in line or 'vite' in line.lower() or 'build' in line.lower():
            if 'http' in line or 'build' in line or 'vite' in line:
                print(line.strip())
    print('HTML_NOTICIAS_LINES')
    for line in html.splitlines():
        if 'noticias__card' in line or 'noticias__card-img' in line:
            print(line.strip())
except Exception as e:
    print('HTML_ERROR', e)

try:
    proc = subprocess.run([
        'php', '-r',
        "require 'vendor/autoload.php'; $app=require 'bootstrap/app.php'; $kernel=$app->make(Illuminate\\Contracts\\Console\\Kernel::class); $kernel->bootstrap(); use App\\Models\\Noticia; $items=Noticia::latest()->take(3)->get(['id','titulo','imagen']); foreach ($items as $n) { echo $n->id.'|'.str_replace('\\n',' ',trim($n->titulo)).'|'.trim((string)$n->imagen).'\\n'; }"
    ], capture_output=True, text=True)
    print('LATEST_NEWS')
    print(proc.stdout)
    if proc.stderr:
        print('PHP_STDERR', proc.stderr)
except Exception as e:
    print('PHP_CALL_ERROR', e)
