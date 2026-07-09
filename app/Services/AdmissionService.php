<?php

namespace App\Services;

use App\Models\AjusteGeneral;

class AdmissionService
{
    public static function ajustesConAdmisionesDinamicas(): AjusteGeneral
    {
        $ajustes = AjusteGeneral::instancia();

        if ($ajustes->admisiones_descripcion) {
            $ajustes->admisiones_descripcion = preg_replace(
                '/año lectivo\s+\d{4}/iu',
                'año lectivo ' . $ajustes->admisiones_anio,
                $ajustes->admisiones_descripcion
            );
        }

        return $ajustes;
    }

    public static function reemplazarAnioEnContenido(string $contenido, AjusteGeneral $ajustes): string
    {
        $contenido = str_replace('{ADMISSION_YEAR}', $ajustes->admisiones_anio, $contenido);
        $contenido = preg_replace(
            '/INSCRIPCIONES ABIERTAS PARA EL AÑO\s+\d{4}/iu',
            'INSCRIPCIONES ABIERTAS PARA EL AÑO ' . $ajustes->admisiones_anio,
            $contenido
        );
        $contenido = preg_replace(
            '/año lectivo\s+\d{4}/iu',
            'año lectivo ' . $ajustes->admisiones_anio,
            $contenido
        );

        return $contenido;
    }
}