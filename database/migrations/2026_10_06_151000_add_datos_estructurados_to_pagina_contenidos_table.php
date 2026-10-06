<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pagina_contenidos', function (Blueprint $table) {
            $table->json('datos_estructurados')->nullable()->after('contenido');
        });

        // Poblar datos estructurados iniciales para páginas con diseño especial
        \Illuminate\Support\Facades\DB::table('pagina_contenidos')->where('slug', 'rectora')->update([
            'datos_estructurados' => json_encode([
                'foto' => 'paginas/rectora.jpg',
                'nombre' => 'Hna. Yolanda Gómez Aristizabal',
                'cargo' => 'Rectora de la Institución',
                'frase' => 'Bienvenidos a nuestra amada comunidad educativa. Educamos con el corazón, convencidas de que la piedad, sencillez y el trabajo redentor son el camino seguro hacia la excelencia integral humana y espiritual.',
                'mensaje' => "<p>Nuestra institución asume con absoluta seriedad la formación de niños, niñas y jóvenes basada en principios éticos y cristianos de primer orden. Trabajamos de forma articulada para mantener vivo el legado de Marie Poussepin en cada rincón, aula y acción de nuestra propuesta educativa.</p>\n<p>Agradecemos profundamente a los padres y acudientes la inmensa confianza depositada en nuestro colegio al entregarnos la formación de sus hijos, un camino que recorremos con alegría, fe y dedicación de la mano de Dios y de la Santísima Virgen María.</p>",
            ]),
        ]);

        \Illuminate\Support\Facades\DB::table('pagina_contenidos')->where('slug', 'mision')->update([
            'datos_estructurados' => json_encode([
                'intro_principal' => 'Somos una institución educativa confesional católica de carácter privado, dirigida por las Hermanas de la Caridad Dominicas de la Presentación de la Santísima Virgen, inspiradas en el Evangelio, la pedagogía de Marie Poussepin y los principios de la Educación Personalizada.',
                'intro_secundaria' => 'Formamos integralmente niños, niñas y jóvenes mediante un currículo pertinente que desarrolla competencias y liderazgos transformadores, comprometidos firmemente con la construcción de una sociedad pacífica, justa y solidaria.',
                'tarjetas' => [
                    [
                        'imagen' => 'paginas/mision_confesional.jpg',
                        'titulo' => 'Institución Confesional Católica',
                        'descripcion' => 'Impartimos educación cimentada en la doctrina de la Iglesia y los valores del Evangelio, promoviendo una fe activa.',
                    ],
                    [
                        'imagen' => 'paginas/mision_formacionIntegral.jpg',
                        'titulo' => 'Formación Integral',
                        'descripcion' => 'Desarrollamos de forma armónica todas las dimensiones del ser humano, preparando líderes con criterio y responsabilidad social.',
                    ],
                    [
                        'imagen' => 'paginas/mision_mariePoussepin.jpg',
                        'titulo' => 'Pedagogía y Personalización',
                        'descripcion' => 'Guiamos el proceso de enseñanza a través de la Educación Personalizada y la amorosa pedagogía de Marie Poussepin.',
                    ],
                ],
            ]),
        ]);

        \Illuminate\Support\Facades\DB::table('pagina_contenidos')->where('slug', 'principios')->update([
            'datos_estructurados' => json_encode([
                'intro' => 'Nuestra propuesta educativa se sustenta en cuatro principios fundamentales de la Educación Personalizada, esenciales para el desarrollo integral y la autorrealización de cada estudiante:',
                'tarjetas' => [
                    [
                        'imagen' => 'paginas/mision_formacionIntegral.jpg',
                        'badge' => 'Singularidad',
                        'titulo' => 'Singularidad',
                        'descripcion' => 'Tomo conciencia de mis atributos como ser humano, mediante la práctica del valor de la Auto-aceptación, para reconocerme como persona singular, única, indivisible e irrepetible.',
                    ],
                    [
                        'imagen' => 'paginas/apertura.jpg',
                        'badge' => 'Apertura',
                        'titulo' => 'Apertura',
                        'descripcion' => 'Me reconozco como un ser en relación con los demás mediante la práctica del valor del Respeto, para hacer realidad en mi vida cotidiana el Principio de Apertura.',
                    ],
                    [
                        'imagen' => 'paginas/autonomia.jpg',
                        'badge' => 'Autonomía',
                        'titulo' => 'Autonomía',
                        'descripcion' => 'Desarrollo la capacidad de elegir, decidir y actuar con libertad responsable y convicción ética.',
                    ],
                    [
                        'imagen' => 'paginas/trascendencia.jpg',
                        'badge' => 'Trascendencia',
                        'titulo' => 'Trascendencia',
                        'descripcion' => 'Oriento mi vida hacia Dios y el servicio desinteresado a la sociedad y al bien común.',
                    ],
                ],
            ]),
        ]);

        \Illuminate\Support\Facades\DB::table('pagina_contenidos')->where('slug', 'simbolos')->update([
            'datos_estructurados' => json_encode([
                'imagen' => 'paginas/himno.jpg',
                'titulo' => 'Himno del Colegio',
                'meta' => 'Letra: Hermana Margarita de la Encarnación / Música: Antonio Fortich',
                'coro' => "En espíritu todos unidos\nEn abrazo fraterno de amor\nFresca savia de tronco robusto\nSueño azul de la Presentación.",
                'estrofas' => [
                    ['numero' => 'I Estrofa', 'texto' => "De ideales conquista gloriosa\nCodiciándola está el corazón\nCual cosecha de estrellas fulgentes\nY trigales en constelación."],
                    ['numero' => 'II Estrofa', 'texto' => "Nuestras almas cual linfas bullentes\nSean cáliz de todo sabor,\nRitmo alegre y eterno que late\nAl latir de la Presentación."],
                    ['numero' => 'III Estrofa', 'texto' => "Juventud, animad vuestro brazo\nVuestro pecho se enciende en ardor\nY marchemos las manos unidos\nComo hermana y hermano hasta Dios."],
                    ['numero' => 'IV Estrofa', 'texto' => "En panales de amor libar puedan\nCorazones, piedad y virtud,\nCuando posen su planta en el mundo\nEn sus huellas florezca la luz."],
                    ['numero' => 'V Estrofa', 'texto' => "Todo alumno entronice en su vida\nEsta sola palabra ¡verdad!,\nSencillez el crisol de sus obras\nY el camino de su integridad."],
                    ['numero' => 'VI Estrofa', 'texto' => "Del deber en el yunque sagrado\nEl trabajo también redentor\nPueda hacer nuestra vida fecunda\nPara darla y servir la hizo Dios."],
                ],
            ]),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagina_contenidos', function (Blueprint $table) {
            $table->dropColumn('datos_estructurados');
        });
    }
};
