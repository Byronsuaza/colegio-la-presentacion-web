<?php

namespace Database\Seeders;

use App\Models\AjusteGeneral;
use App\Models\PaginaContenido;
use Illuminate\Database\Seeder;

class InscripcionesContenidoSeeder extends Seeder
{
    public function run(): void
    {
        $page = PaginaContenido::where('base', 'admisiones')
            ->where('slug', 'inscripcion-en-linea')
            ->firstOrFail();

        $page->update([
            'titulo' => 'Inscripciones Abiertas para el año 2026',
            'subtitulo' => 'Disponibilidad de cupos en preescolar, primaria y bachillerato hasta grado noveno.',
            'contenido' => <<<'HTML'
<h2>COLEGIO DE LA PRESENTACIÓN - NEIVA</h2>
<h3>INSCRIPCIONES ABIERTAS PARA EL AÑO 2026</h3>
<p><strong>Disponibilidad de cupos:</strong> preescolar, primaria y bachillerato, hasta grado noveno.</p>
<p><strong>Se reciben niños desde preescolar.</strong></p>
<p><strong>Informes:</strong> Cel. 3116304190 - 3102141243</p>
<p><strong>Correo electrónico:</strong> info@colpresentacioneiva.edu.co</p>

<h3>Instructivo para la inscripción / separación de cupo</h3>
<ol>
    <li>Cancelar de manera presencial en la Tesorería del Colegio por concepto de inscripción la suma de $50.000, o consignar en la cuenta de ahorros No. 387000706 del Banco de Occidente a nombre de Hermanas de la Caridad Dominicas de la Presentación de la Santísima Virgen. Nit. 890801160-7.</li>
    <li>Traer la documentación de forma física o enviarla al correo electrónico institucional: recibo de pago, cédulas del padre, madre o acudiente, registro civil del aspirante, tarjeta de identidad actualizada y boletines o informes valorativos del colegio de procedencia.</li>
    <li>Realizar la inscripción ingresando al enlace de inscripción en línea, digitando el número de identificación del estudiante y el código o pin asignado. Al finalizar, guardar e imprimir la inscripción para traerla de forma física.</li>
    <li>Asistir a la entrevista en familia: padres o acudientes y aspirante, con la Asesora Escolar o su delegada.</li>
    <li>Presentar la valoración diagnóstica para estudiantes de primero en adelante en las áreas de matemáticas, español e inglés.</li>
    <li>Conocer los resultados de la prueba diagnóstica, recomendaciones y proceso a seguir.</li>
    <li>Asistir a la reunión de inducción para padres o madres, donde se informará el proceso, requisitos y fecha de matrícula.</li>
    <li>Recibir los documentos para matrícula: contratos, pagarés y recibo de consignación.</li>
    <li>Formalizar la matrícula para estudiantes nuevos.</li>
</ol>
HTML,
            'enlaces' => [
                [
                    'label' => 'Inscripción en línea / Separación de cupo',
                    'url' => 'https://www.syscolegios.org/HojasdeVida/control_est.php',
                ],
                [
                    'label' => 'Video bienvenida 1',
                    'url' => 'https://drive.google.com/file/d/12hu2rNuz1vh3OSxN4t33FA5R6DeZLQ07/view?usp=sharing',
                ],
                [
                    'label' => 'Video bienvenida 2',
                    'url' => 'https://drive.google.com/file/d/12lBKqYMlyOlN3D1raekACnLbHhtlAgsh/view?usp=sharing',
                ],
                [
                    'label' => 'Requisitos para matrícula',
                    'url' => 'https://drive.google.com/file/d/0B2KJSlc0hVL-VUd2QUt2NEYtYnc/view?usp=sharing',
                ],
            ],
            'publicada' => true,
        ]);

        AjusteGeneral::instancia()->forceFill([
            'admisiones_anio' => '2026',
            'admisiones_boton_texto' => 'Inscripción en Línea',
            'admisiones_boton_url' => 'https://www.syscolegios.org/HojasdeVida/control_est.php',
            'admisiones_descripcion' => 'Las inscripciones para el año lectivo 2026 están abiertas. Cupos disponibles en preescolar, primaria y bachillerato hasta grado noveno.',
        ])->save();
    }
}
