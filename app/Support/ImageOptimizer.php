<?php

namespace App\Support;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Filament\Forms\Components\FileUpload;

class ImageOptimizer
{
    /**
     * Configura un componente FileUpload para que optimice y convierta imágenes a WebP automáticamente.
     */
    public static function configure(FileUpload $fileUpload, string $directory): FileUpload
    {
        return $fileUpload
            ->image()
            ->directory($directory)
            ->saveUploadedFileUsing(function (TemporaryUploadedFile $file) use ($directory) {
                return self::optimizeAndSave($file, $directory);
            });
    }

    /**
     * Procesa una imagen temporal, la convierte a WebP y la guarda en el almacenamiento público.
     */
    public static function optimizeAndSave(TemporaryUploadedFile $file, string $directory): string
    {
        $tempPath = $file->getRealPath();

        // 1. Obtener información de la imagen
        $imageInfo = @getimagesize($tempPath);
        if (!$imageInfo) {
            // Si no se puede leer como imagen, guardar el original como fallback
            return $file->store($directory, 'public');
        }

        $mime = $imageInfo['mime'];
        $width = $imageInfo[0];
        $height = $imageInfo[1];

        // 2. Crear recurso de imagen según el tipo MIME
        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = @imagecreatefromjpeg($tempPath);
                break;
            case 'image/png':
                $image = @imagecreatefrompng($tempPath);
                if ($image) {
                    imagealphablending($image, false);
                    imagesavealpha($image, true);
                }
                break;
            case 'image/gif':
                $image = @imagecreatefromgif($tempPath);
                if ($image) {
                    imagealphablending($image, false);
                    imagesavealpha($image, true);
                }
                break;
            case 'image/webp':
                $image = @imagecreatefromwebp($tempPath);
                if ($image) {
                    imagealphablending($image, false);
                    imagesavealpha($image, true);
                }
                break;
            default:
                // Si es un SVG u otro formato no soportado directamente por GD, guardar original
                return $file->store($directory, 'public');
        }

        if (!$image) {
            return $file->store($directory, 'public');
        }

        // 3. Redimensionar si supera el tamaño máximo permitido (ej. 1920px en su dimensión más larga)
        $maxDim = 1920;
        if ($width > $maxDim || $height > $maxDim) {
            if ($width > $height) {
                $newWidth = $maxDim;
                $newHeight = (int) ($height * ($maxDim / $width));
            } else {
                $newHeight = $maxDim;
                $newWidth = (int) ($width * ($maxDim / $height));
            }
            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

            // Preservar transparencia para PNG/GIF/WebP redimensionados
            imagealphablending($resizedImage, false);
            imagesavealpha($resizedImage, true);

            imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($image);
            $image = $resizedImage;
        }

        // 4. Generar nombre de archivo único con extensión .webp
        $filename = Str::random(40) . '.webp';
        $targetPath = $directory . '/' . $filename;

        // 5. Guardar en un archivo temporal local como WebP
        $localTempFile = tempnam(sys_get_temp_dir(), 'webp');
        imagewebp($image, $localTempFile, 80); // Compresión de calidad del 80%
        imagedestroy($image);

        // 6. Almacenar el archivo procesado en el disco público de Laravel
        Storage::disk('public')->putFileAs($directory, new \Illuminate\Http\File($localTempFile), $filename);

        // 7. Limpiar archivo temporal local
        @unlink($localTempFile);

        return $targetPath;
    }
}
