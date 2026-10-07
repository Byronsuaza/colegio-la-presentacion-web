<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $datos = [
            'intro' => 'Explora el fascinante recorrido de nuestra historia a través de los tomos documentales oficiales cuidadosamente recopilados e indexados por la institución. Haz clic en los botones para abrir los documentos en PDF almacenados en Google Drive:',
            'tomos' => [
                [
                    'badge' => '1882',
                    'era' => 'Año 1882',
                    'titulo' => 'Fundación e Inicio',
                    'descripcion' => 'Establecimiento oficial de la Congregación de las Hermanas de la Caridad Dominicas de la Presentación en Neiva. Primeros pasos pedagógicos y siembra del carisma institucional.',
                    'url_documento' => 'https://drive.google.com/file/d/1bCondc48P45kMEe7zCQ4sPaDRmS28QF3/view?usp=drive_link',
                    'archivo_pdf' => null,
                    'texto_boton' => 'Abrir Tomo Histórico 1882',
                ],
                [
                    'badge' => '1892',
                    'era' => '1892 - 1930',
                    'titulo' => 'Consolidación de la Obra',
                    'descripcion' => 'Expansión de la infraestructura física del colegio, consolidación de la matrícula escolar inicial y reconocimiento social pleno en el Huila.',
                    'url_documento' => 'https://drive.google.com/file/d/1bK79fZxTaz-dghBit__d5tokmUVCfTb6/view?usp=drive_link',
                    'archivo_pdf' => null,
                    'texto_boton' => 'Abrir Tomo Histórico 1892 - 1930',
                ],
                [
                    'badge' => '1940',
                    'era' => '1940 - 1952',
                    'titulo' => 'Crecimiento y Modernización Académica',
                    'descripcion' => 'Reformas pedagógicas curriculares relevantes, adopción de nuevos estándares educativos y dinamización cultural y académica en el entorno local.',
                    'url_documento' => 'https://drive.google.com/file/d/1bMWkSIbuMEU9jVVUKpbgbpunR_AcarS5/view?usp=drive_link',
                    'archivo_pdf' => null,
                    'texto_boton' => 'Abrir Tomo Histórico 1940 - 1952',
                ],
                [
                    'badge' => '1953',
                    'era' => '1953 - 1972',
                    'titulo' => 'Bodas de Brillante de la Obra',
                    'descripcion' => 'Conmemoración de la dilatada presencia institucional, fomento del liderazgo escolar femenino regional y expansión de actividades de proyección social.',
                    'url_documento' => 'https://drive.google.com/file/d/1bOpqUq358t72vG73JbYT-eZXpg92eNKP/view?usp=drive_link',
                    'archivo_pdf' => null,
                    'texto_boton' => 'Abrir Tomo Histórico 1953 - 1972',
                ],
                [
                    'badge' => '1973',
                    'era' => '1973 - 1982',
                    'titulo' => 'Centenario de Labor Educativa',
                    'descripcion' => 'Hito histórico centenario del colegio en la región, fortaleciendo el carisma educativo de la Congregación y renovando la misión pedagógica personalizada.',
                    'url_documento' => 'https://drive.google.com/file/d/1bO1_ofl-IM_WMb_kj-2NOghdBY8ZWY50/view?usp=drive_link',
                    'archivo_pdf' => null,
                    'texto_boton' => 'Abrir Tomo Histórico 1973 - 1982',
                ],
                [
                    'badge' => '1983',
                    'era' => '1983 - 1993',
                    'titulo' => 'Nuevos Horizontes e Innovaciones',
                    'descripcion' => 'Adopción gradual de sistemas informáticos, remodelación de laboratorios científicos y mayor apertura a la investigación académica juvenil.',
                    'url_documento' => 'https://drive.google.com/file/d/1bPEgYH5UN143QPFWQQ519kpnqBsPN0VC/view?usp=drive_link',
                    'archivo_pdf' => null,
                    'texto_boton' => 'Abrir Tomo Histórico 1983 - 1993',
                ],
                [
                    'badge' => '1994',
                    'era' => '1994 - 1999',
                    'titulo' => 'Excelencia Sostenida',
                    'descripcion' => 'Excelentes resultados en evaluaciones e ICFES a nivel departamental, consolidación de metodologías innovadoras y activa participación deportiva intercolegiada.',
                    'url_documento' => 'https://drive.google.com/file/d/1bPPPUcQCRhq8C-AT6_C63xiI68ubrRh6/view?usp=drive_link',
                    'archivo_pdf' => null,
                    'texto_boton' => 'Abrir Tomo Histórico 1994 - 1999',
                ],
                [
                    'badge' => '2000',
                    'era' => '2000 - 2009',
                    'titulo' => 'Siglo XXI e Integración Tecnológica',
                    'descripcion' => 'Desarrollo pleno de habilidades tecnológicas asociadas al aprendizaje significativo, robustecimiento de la enseñanza del inglés y expansión de la banda marcial.',
                    'url_documento' => 'https://drive.google.com/file/d/1bRtEKKpdsoU736cpy76RHgxbVZQnQIC5/view?usp=drive_link',
                    'archivo_pdf' => null,
                    'texto_boton' => 'Abrir Tomo Histórico 2000 - 2009',
                ],
                [
                    'badge' => '2010',
                    'era' => '2010 - 2019',
                    'titulo' => 'Liderazgo e Innovación Continua',
                    'descripcion' => 'Implementación de comités por áreas de calidad y procesos institucionales de alto impacto pastoral y comunitario en estrecha alianza con las familias.',
                    'url_documento' => 'https://drive.google.com/file/d/1bTB1g0ylehc9CN2rorZmOBch77MJtzKi/view?usp=drive_link',
                    'archivo_pdf' => null,
                    'texto_boton' => 'Abrir Tomo Histórico 2010 - 2019',
                ],
                [
                    'badge' => '2022',
                    'era' => '2020 - 2022',
                    'titulo' => 'Resiliencia, Desafíos y Futuro',
                    'descripcion' => 'Adaptación digital resiliente ante la contingencia de salud pública mundial, garantizando el carisma de la Presentación intacto y robusteciendo la educación del futuro.',
                    'url_documento' => 'https://drive.google.com/file/d/1bHL7SRa2HAlF11EcXI2WdaTRW5FWFIzI/view?usp=drive_link',
                    'archivo_pdf' => null,
                    'texto_boton' => 'Abrir Tomo Histórico 2020 - 2022',
                ],
            ],
        ];

        DB::table('pagina_contenidos')
            ->where('slug', 'recorrido-historico')
            ->update([
                'datos_estructurados' => json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('pagina_contenidos')
            ->where('slug', 'recorrido-historico')
            ->update([
                'datos_estructurados' => null,
            ]);
    }
};
