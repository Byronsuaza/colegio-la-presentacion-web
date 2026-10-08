<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Postulacion extends Model
{
    protected $table = 'postulaciones';

    public const ESTADOS = [
        'Nueva' => 'Nueva',
        'En revisión' => 'En revisión',
        'Preseleccionado' => 'Preseleccionado',
        'Descartado' => 'Descartado',
        'Contratado' => 'Contratado',
    ];

    protected $fillable = [
        'nombre_completo',
        'telefono',
        'email',
        'cargo',
        'hoja_vida',
        'estado',
        'notas',
    ];

    protected static function booted()
    {
        // Al eliminar una postulación, borrar también la hoja de vida (datos personales)
        static::deleted(function (Postulacion $postulacion) {
            if ($postulacion->hoja_vida && Storage::disk('local')->exists($postulacion->hoja_vida)) {
                Storage::disk('local')->delete($postulacion->hoja_vida);
            }
        });
    }
}
