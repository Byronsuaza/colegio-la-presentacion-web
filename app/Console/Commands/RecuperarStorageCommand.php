<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RecuperarStorageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:recuperar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restaura y fusiona archivos de storage desde carpetas de respaldo de Hostinger y recrea los enlaces en public_html';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $base = base_path();
        $targetStorage = storage_path('app/public');

        if (! File::isDirectory($targetStorage)) {
            File::makeDirectory($targetStorage, 0755, true, true);
        }

        // 1. Buscar todas las carpetas storage.* que crea Hostinger al restaurar
        $backupDirs = glob($base . '/storage.*') ?: [];
        $recoveredCount = 0;

        foreach ($backupDirs as $backupDir) {
            $backupPublic = $backupDir . '/app/public';
            if (File::isDirectory($backupPublic)) {
                $this->info('Escaneando respaldo: ' . basename($backupDir));

                $files = File::allFiles($backupPublic);
                foreach ($files as $file) {
                    $relative = $file->getRelativePathname();
                    $destination = $targetStorage . '/' . $relative;

                    if (! File::exists($destination)) {
                        File::ensureDirectoryExists(dirname($destination));
                        File::copy($file->getRealPath(), $destination);
                        $recoveredCount++;
                    }
                }
            }
        }

        $this->info("Archivos recuperados de respaldos: {$recoveredCount}");

        // 2. Gestionar hero_slides y 'hero slides'
        $heroSlidesPath = $targetStorage . '/hero_slides';
        $heroSlidesSpace = $targetStorage . '/hero slides';
        if (File::isDirectory($heroSlidesPath) && ! File::exists($heroSlidesSpace)) {
            @symlink($heroSlidesPath, $heroSlidesSpace);
        }

        // 3. Detectar public_html (entorno Hostinger)
        $publicHtmlCandidates = [
            dirname($base) . '/public_html',
            $base . '/../public_html',
        ];

        $foundHostinger = false;
        foreach ($publicHtmlCandidates as $publicHtml) {
            if (File::isDirectory($publicHtml)) {
                $foundHostinger = true;
                $publicHtmlStorage = $publicHtml . '/storage';
                $this->info("Detectado entorno Hostinger en: {$publicHtml}");

                // Si es un enlace o carpeta, limpiarla para recrear el enlace limpio
                if (is_link($publicHtmlStorage)) {
                    @unlink($publicHtmlStorage);
                } elseif (is_dir($publicHtmlStorage)) {
                    File::deleteDirectory($publicHtmlStorage);
                }

                @symlink($targetStorage, $publicHtmlStorage);
                $this->info("Enlace simbólico recreado en: {$publicHtmlStorage} -> {$targetStorage}");

                // Sincronizar public/build a public_html/build
                $localBuild = public_path('build');
                $publicHtmlBuild = $publicHtml . '/build';
                if (File::isDirectory($localBuild)) {
                    File::ensureDirectoryExists($publicHtmlBuild);
                    File::copyDirectory($localBuild, $publicHtmlBuild);
                    $this->info('Assets compilados de Vite sincronizados en public_html/build');
                }
                break;
            }
        }

        if (! $foundHostinger) {
            $this->info('No se detectó public_html externo. Recreando enlace local storage:link...');
            $this->call('storage:link');
        }

        // 4. Permisos
        @chmod(storage_path(), 0755);
        @chmod($targetStorage, 0755);

        // 5. Limpiar cachés
        $this->call('optimize:clear');

        $this->info('¡Storage restaurado, enlazado y cachés limpiadas con éxito!');
        return self::SUCCESS;
    }
}
