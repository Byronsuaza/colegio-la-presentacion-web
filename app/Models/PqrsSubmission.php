<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PqrsSubmission extends Model
{
    protected $table = 'pqrs_submissions';

    protected $fillable = [
        'tipo',
        'nombre_completo',
        'tipo_documento',
        'documento',
        'email',
        'telefono',
        'relacion',
        'estudiante_nombre',
        'estudiante_grado',
        'mensaje',
        'adjunto',
        'estado',
        'respuesta',
        'respondido_at',
    ];

    protected $casts = [
        'respondido_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::saving(function ($submission) {
            if ($submission->isDirty('estado') && $submission->estado === 'Respondido' && is_null($submission->respondido_at)) {
                $submission->respondido_at = now();
            }
        });
    }
}
