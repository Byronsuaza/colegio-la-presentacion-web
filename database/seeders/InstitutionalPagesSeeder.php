<?php

namespace Database\Seeders;

use App\Models\PaginaContenido;
use Illuminate\Database\Seeder;

class InstitutionalPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $base = 'nuestra-institucion';
        $seccion = 'Nuestra Institución';

        // 1. MARIE POUSSEPIN
        PaginaContenido::updateOrCreate(
            ['base' => $base, 'slug' => 'marie-poussepin'],
            [
                'seccion' => $seccion,
                'titulo' => 'Marie Poussepin: Madre de la Caridad',
                'subtitulo' => 'Fundadora de la Congregación de las Dominicas de la Presentación',
                'imagen' => '/marie_poussepin.png',
                'contenido' => '
                    <div class="marie-poussepin-box">
                        <p class="lead-text">Marie Poussepin nació el <strong>14 de octubre de 1653</strong> en Dourdan, Francia. Fue una mujer visionaria que, desde su juventud, combinó una profunda fe con una inteligencia excepcional, transformando la industria de la seda de su región y generando bienestar y oportunidades para su comunidad.</p>
                        <p>A los 42 años, respondiendo al llamado de Dios, se entregó totalmente al servicio de los más necesitados y enfermos, fundando la <em>Congregación de las Dominicas de la Presentación de la Santísima Virgen al Templo</em>, institución que hoy se extiende en más de 40 países de los cinco continentes.</p>
                        <p>Su legado es el pilar de nuestra identidad institucional: <strong>fe, caridad, sencillez y excelencia en el servicio</strong>. El <strong>Colegio de La Presentación de Neiva</strong> es heredero vivo de este carisma, educando a niños y jóvenes capaces de transformar positivamente su entorno social y moral.</p>
                    </div>
                ',
                'enlaces' => [],
                'publicada' => true,
            ]
        );

        // 2. MISIÓN
        PaginaContenido::updateOrCreate(
            ['base' => $base, 'slug' => 'mision'],
            [
                'seccion' => $seccion,
                'titulo' => 'Misión',
                'subtitulo' => 'Nuestra razón de ser y compromiso de formación integral.',
                'imagen' => '/mision_confesional.jpg',
                'contenido' => '
                    <div class="mision-container">
                        <p class="mision-lead">Somos una institución educativa confesional católica de carácter privado, dirigida por las Hermanas de la Caridad Dominicas de la Presentación de la Santísima Virgen, inspiradas en el Evangelio, la pedagogía de Marie Poussepin y los principios de la Educación Personalizada.</p>
                        <p class="mision-lead-sub">Formamos integralmente niños, niñas y jóvenes mediante un currículo pertinente que desarrolla competencias y liderazgos transformadores, comprometidos firmemente con la construcción de una sociedad pacífica, justa y solidaria.</p>
                        
                        <div class="mision-grid">
                            <div class="mision-card">
                                <div class="mision-card__img-wrapper">
                                    <img src="/mision_confesional.jpg" alt="Institución Educativa confesional católica" class="mision-card__img" />
                                </div>
                                <div class="mision-card__body">
                                    <h3>Institución Confesional Católica</h3>
                                    <p>Impartimos educación cimentada en la doctrina de la Iglesia y los valores del Evangelio, promoviendo una fe activa.</p>
                                </div>
                            </div>
                            
                            <div class="mision-card">
                                <div class="mision-card__img-wrapper">
                                    <img src="/mision_formacionIntegral.jpg" alt="Formación Integral" class="mision-card__img" />
                                </div>
                                <div class="mision-card__body">
                                    <h3>Formación Integral</h3>
                                    <p>Desarrollamos de forma armónica todas las dimensiones del ser humano, preparando líderes con criterio y responsabilidad social.</p>
                                </div>
                            </div>
                            
                            <div class="mision-card">
                                <div class="mision-card__img-wrapper">
                                    <img src="/mision_mariePoussepin.jpg" alt="Pedagogía de Marie Poussepin" class="mision-card__img" />
                                </div>
                                <div class="mision-card__body">
                                    <h3>Pedagogía y Personalización</h3>
                                    <p>Guiamos el proceso de enseñanza a través de la Educación Personalizada y la amorosa pedagogía de Marie Poussepin.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                ',
                'enlaces' => [],
                'publicada' => true,
            ]
        );

        // 3. VISIÓN
        PaginaContenido::updateOrCreate(
            ['base' => $base, 'slug' => 'vision'],
            [
                'seccion' => $seccion,
                'titulo' => 'Visión',
                'subtitulo' => 'Nuestra proyección hacia el futuro con excelencia y valores.',
                'imagen' => '/vision.jpg',
                'contenido' => '
                    <div class="vision-container">
                        <div class="vision-text-box">
                            <p class="vision-highlight">Hacia el año 2026 nuestra Institución Educativa será reconocida por entregar a la Iglesia y a la sociedad jóvenes líderes, críticos, comprometidos desde el Evangelio, social y políticamente; con un currículo pertinente y abierto a nuevos paradigmas, que les desarrolle competencias para transformar su entorno, desde la vivencia de la ética de la Verdad y con la centralidad en Jesucristo.</p>
                        </div>
                    </div>
                ',
                'enlaces' => [],
                'publicada' => true,
            ]
        );

        // 4. PRINCIPIOS
        PaginaContenido::updateOrCreate(
            ['base' => $base, 'slug' => 'principios'],
            [
                'seccion' => $seccion,
                'titulo' => 'Principios',
                'subtitulo' => 'Fundamentos éticos, humanos y de personalización de nuestra comunidad.',
                'imagen' => null,
                'contenido' => '
                    <div class="principios-container">
                        <p class="principios-intro">Nuestra propuesta educativa se sustenta en cuatro principios fundamentales de la Educación Personalizada, esenciales para el desarrollo integral y la autorrealización de cada estudiante:</p>
                        
                        <div class="principios-grid">
                            <div class="principio-card">
                                <div class="principio-card__header">
                                    <img src="/mision_formacionIntegral.jpg" alt="Singularidad" class="principio-card__img" />
                                    <span class="principio-card__badge">Singularidad</span>
                                </div>
                                <div class="principio-card__body">
                                    <h3>Singularidad</h3>
                                    <p>Tomo conciencia de mis atributos como ser humano, mediante la práctica del valor de la <strong>Auto-aceptación</strong>, para reconocerme como persona singular, única, indivisible e irrepetible.</p>
                                </div>
                            </div>
                            
                            <div class="principio-card">
                                <div class="principio-card__header">
                                    <img src="/apertura.jpg" alt="Apertura" class="principio-card__img" />
                                    <span class="principio-card__badge">Apertura</span>
                                </div>
                                <div class="principio-card__body">
                                    <h3>Apertura</h3>
                                    <p>Me reconozco como un ser en relación con los demás mediante la práctica del valor del <strong>Respeto</strong>, para hacer realidad en mi vida cotidiana el Principio de Apertura.</p>
                                </div>
                            </div>
                            
                            <div class="principio-card">
                                <div class="principio-card__header">
                                    <img src="/autonomia.jpg" alt="Autonomía" class="principio-card__img" />
                                    <span class="principio-card__badge">Autonomía</span>
                                </div>
                                <div class="principio-card__body">
                                    <h3>Autonomía</h3>
                                    <p>Manifiesto la capacidad de tomar decisiones mediante la práctica del valor de la <strong>Responsabilidad</strong>, para ser consciente de mis obligaciones, de mis límites y de la consecuencia de mis actos.</p>
                                </div>
                            </div>
                            
                            <div class="principio-card">
                                <div class="principio-card__header">
                                    <img src="/trascendencia.jpg" alt="Trascendencia" class="principio-card__img" />
                                    <span class="principio-card__badge">Trascendencia</span>
                                </div>
                                <div class="principio-card__body">
                                    <h3>Trascendencia</h3>
                                    <p>Desarrollo la capacidad de reconocer e interactuar con realidades espirituales, a través de la práctica del valor de la <strong>Coherencia</strong>, para dar, con mi vida, testimonio del Principio de Trascendencia.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                ',
                'enlaces' => [],
                'publicada' => true,
            ]
        );

        // 5. SÍMBOLOS
        PaginaContenido::updateOrCreate(
            ['base' => $base, 'slug' => 'simbolos'],
            [
                'seccion' => $seccion,
                'titulo' => 'Símbolos',
                'subtitulo' => 'Los elementos que identifican, enorgullecen y unen a nuestra comunidad.',
                'imagen' => '/himno.jpg',
                'contenido' => '
                    <div class="simbolos-container">
                        
                        <section class="simbolo-section himno-section">
                            <div class="simbolo-grid">
                                <div class="simbolo-img-container">
                                    <img src="/himno.jpg" alt="Himno de La Presentación" class="simbolo-img" />
                                </div>
                                <div class="simbolo-text-container">
                                    <h3>Himno del Colegio</h3>
                                    <span class="simbolo-meta">Letra: Hermana Margarita de la Encarnación / Música: Antonio Fortich</span>
                                    
                                    <div class="himno-box">
                                        <div class="himno-lyrics">
                                            <p class="himno-coro"><strong>Coro</strong><br>
                                            En espíritu todos unidos<br>
                                            En abrazo fraterno de amor<br>
                                            Fresca savia de tronco robusto<br>
                                            Sueño azul de la Presentación.</p>

                                            <p><strong>I Estrofa</strong><br>
                                            De ideales conquista gloriosa<br>
                                            Codiciándola está el corazón<br>
                                            Cual cosecha de estrellas fulgentes<br>
                                            Y trigales en constelación.</p>

                                            <p><strong>II Estrofa</strong><br>
                                            Nuestras almas cual linfas bullentes<br>
                                            Sean cáliz de todo sabor,<br>
                                            Ritmo alegre y eterno que late<br>
                                            Al latir de la Presentación.</p>

                                            <p><strong>III Estrofa</strong><br>
                                            Juventud, animad vuestro brazo<br>
                                            Vuestro pecho se enciende en ardor<br>
                                            Y marchemos las manos unidos<br>
                                            Como hermana y hermano hasta Dios.</p>

                                            <p><strong>IV Estrofa</strong><br>
                                            En panales de amor libar puedan<br>
                                            Corazones, piedad y virtud,<br>
                                            Cuando posen su planta en el mundo<br>
                                            En sus huellas florezca la luz.</p>

                                            <p><strong>V Estrofa</strong><br>
                                            Todo alumno entronice en su vida<br>
                                            Esta sola palabra ¡verdad!,<br>
                                            Sencillez el crisol de sus obras<br>
                                            Y el camino de su integridad.</p>

                                            <p><strong>VI Estrofa</strong><br>
                                            Del deber en el yunque sagrado<br>
                                            El trabajo también redentor<br>
                                            Pueda hacer nuestra vida fecunda<br>
                                            Para darla y servir la hizo Dios.</p>

                                            <p><strong>VII Estrofa</strong><br>
                                            Tras las huellas que suben al templo<br>
                                            Coloquemos del alma una flor,<br>
                                            Ella es guía, modelo y ejemplo<br>
                                            Y tras ella la Presentación.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <hr class="simbolo-divider" />

                        <section class="simbolo-section escudo-section">
                            <div class="simbolo-grid">
                                <div class="simbolo-img-container">
                                    <img src="/escudo.jpg" alt="Escudo de La Presentación" class="simbolo-img" />
                                </div>
                                <div class="simbolo-text-container">
                                    <h3>El Escudo</h3>
                                    <p>El escudo del colegio de la Presentación consta de un sello con fondo azul. Esculpida en él una pequeña <strong>abeja dorada</strong>, enmarcada en una <strong>decena del santo rosario</strong>.</p>
                                    <p>El fondo azul simboliza para los estudiantes de la Presentación la armonía de la sencillez de su vida. La pequeña abeja dorada es el símbolo del trabajo constante y discreto, constructor y de hondo sentido social. El trabajo tiene un valor trascendente cuando se proyecta a la sociedad y al entorno inmediato, haciéndose todo por amor e identificación evangélica con el servicio.</p>
                                    <p>El rosario que enmarca el sello representa la piedad constante que debe inspirar la vida de un estudiante Presentación, demostrando que su fe tiene profundas e ineludibles implicaciones sociales.</p>
                                </div>
                            </div>
                        </section>

                        <hr class="simbolo-divider" />

                        <section class="simbolo-section bandera-section">
                            <div class="simbolo-grid">
                                <div class="simbolo-img-container">
                                    <img src="/bandera.jpg" alt="Bandera de La Presentación" class="simbolo-img" />
                                </div>
                                <div class="simbolo-text-container">
                                    <h3>La Bandera</h3>
                                    <p>La Bandera del colegio de la Presentación está conformada por una <strong>franja blanca</strong> y una <strong>franja azul rey</strong>, colocadas en forma horizontal, simbolizando la pureza de vida, la sencillez y la armonía.</p>
                                    <p>El color blanco encarna la pureza e integridad moral que debe adornar a todo estudiante Presentación, y el color azul simboliza la sencillez virtuosa que les caracteriza. Vivenciar estas virtudes permite alcanzar el equilibrio e integrar razones morales que persigan permanentemente lo bueno, bello, verdadero y digno en la existencia humana.</p>
                                </div>
                            </div>
                        </section>

                        <hr class="simbolo-divider" />

                        <section class="simbolo-section lema-section">
                            <h3>Nuestro Lema: Piedad, Sencillez y Trabajo</h3>
                            <div class="lema-grid">
                                <div class="lema-card">
                                    <div class="lema-card__header lema-card__header--piedad">PIEDAD</div>
                                    <div class="lema-card__body">
                                        <p>La virtud que permite descubrir la presencia viva de Dios. Inspira la relación espiritual personal y fomenta el compromiso social a través de la solidaridad, la justicia activa y la búsqueda incesante de la paz colectiva.</p>
                                    </div>
                                </div>
                                
                                <div class="lema-card">
                                    <div class="lema-card__header lema-card__header--sencillez">SENCILLEZ</div>
                                    <div class="lema-card__body">
                                        <p>La virtud de la transparencia, rectitud, honestidad y coherencia. Permite reconocer los propios dones y ponerlos desinteresadamente al servicio del prójimo con respeto y profundos buenos modales.</p>
                                    </div>
                                </div>
                                
                                <div class="lema-card">
                                    <div class="lema-card__header lema-card__header--trabajo">TRABAJO</div>
                                    <div class="lema-card__body">
                                        <p>La virtud redentora y transformadora que potencia los talentos en favor del bien común. Representa el sentido de responsabilidad, la creatividad permanente y el deseo noble de edificar una sociedad mejor.</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                ',
                'enlaces' => [],
                'publicada' => true,
            ]
        );

        // 6. RECTORA
        PaginaContenido::updateOrCreate(
            ['base' => $base, 'slug' => 'rectora'],
            [
                'seccion' => $seccion,
                'titulo' => 'Rectora',
                'subtitulo' => 'Saludo oficial y mensaje de bienvenida de nuestra Rectora.',
                'imagen' => '/rectora.jpg',
                'contenido' => '
                    <div class="rectora-profile">
                        <div class="rectora-card">
                            <div class="rectora-image-wrapper">
                                <img src="/rectora.jpg" alt="Hna. Yolanda Gómez Aristizabal" class="rectora-photo" />
                            </div>
                            <div class="rectora-info">
                                <h3>Hna. Yolanda Gómez Aristizabal</h3>
                                <span class="rectora-title">Rectora de la Institución</span>
                            </div>
                        </div>
                        <div class="rectora-message">
                            <blockquote class="rectora-quote">
                                "Bienvenidos a nuestra amada comunidad educativa. Educamos con el corazón, convencidas de que la piedad, sencillez y el trabajo redentor son el camino seguro hacia la excelencia integral humana y espiritual."
                            </blockquote>
                            <p>Nuestra institución asume con absoluta seriedad la formación de niños, niñas y jóvenes basada en principios éticos y cristianos de primer orden. Trabajamos de forma articulada para mantener vivo el legado de Marie Poussepin en cada rincón, aula y acción de nuestra propuesta educativa.</p>
                            <p>Agradecemos profundamente a los padres y acudientes la inmensa confianza depositada en nuestro colegio al entregarnos la formación de sus hijos, un camino que recorremos con alegría, fe y dedicación de la mano de Dios y de la Santísima Virgen María.</p>
                        </div>
                    </div>
                ',
                'enlaces' => [],
                'publicada' => true,
            ]
        );

        // 7. EN MANOS DE ELLAS
        PaginaContenido::updateOrCreate(
            ['base' => $base, 'slug' => 'en-manos-de-ellas'],
            [
                'seccion' => $seccion,
                'titulo' => 'En manos de Ellas',
                'subtitulo' => 'La admirable obra pedagógica de la Congregación de Hermanas Dominicas.',
                'imagen' => '/en_manos_de_ellas.jpg',
                'contenido' => '
                    <div class="ellas-container">
                        <div class="ellas-grid">
                            <div class="ellas-image-container">
                                <img src="/en_manos_de_ellas.jpg" alt="Obra de las Hermanas Dominicas" class="ellas-img" />
                            </div>
                            <div class="ellas-text-container">
                                <h3>El Legado Educativo de las Hermanas Dominicas</h3>
                                <p>La conducción, dirección académica y orientación espiritual del <strong>Colegio de La Presentación de Neiva</strong> reside con orgullo bajo el amparo de la <strong>Congregación de las Hermanas de la Caridad Dominicas de la Presentación de la Santísima Virgen</strong>.</p>
                                <p>Guiadas e inspiradas día a día por la caridad y el carácter visionario de la Beata Marie Poussepin, las Hermanas se dedican incansablemente al servicio formativo y al desarrollo integral humano y moral de las generaciones del departamento del Huila.</p>
                                <p>Su admirable dedicación promueve una sólida cultura del saber cimentada en la compasión, la piedad cristiana y el servicio altruista a la comunidad, garantizando una educación de altísima calidad que transforma y trasciende vidas.</p>
                            </div>
                        </div>
                    </div>
                ',
                'enlaces' => [],
                'publicada' => true,
            ]
        );

        // 8. RECORRIDO HISTÓRICO
        PaginaContenido::updateOrCreate(
            ['base' => $base, 'slug' => 'recorrido-historico'],
            [
                'seccion' => $seccion,
                'titulo' => 'Recorrido Histórico',
                'subtitulo' => 'Explora las memorias y tomos documentales de nuestra historia.',
                'imagen' => null,
                'contenido' => '
                    <div class="recorrido-container">
                        <p class="timeline-intro">Explora el fascinante recorrido de nuestra historia a través de los tomos documentales oficiales cuidadosamente recopilados e indexados por la institución. Haz clic en los botones para abrir los documentos en PDF almacenados en Google Drive:</p>
                        
                        <div class="timeline">
                            
                            <div class="timeline-item">
                                <div class="timeline-badge">1882</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>Fundación e Inicio</h4>
                                        <span class="timeline-era">Año 1882</span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Establecimiento oficial de la Congregación de las Hermanas de la Caridad Dominicas de la Presentación en Neiva. Primeros pasos pedagógicos y siembra del carisma institucional.</p>
                                        <a href="https://drive.google.com/file/d/1bCondc48P45kMEe7zCQ4sPaDRmS28QF3/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="timeline-btn">
                                            <span class="timeline-btn-icon">📄</span> Abrir Tomo Histórico 1882
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-badge">1892</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>Consolidación de la Obra</h4>
                                        <span class="timeline-era">1892 - 1930</span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Expansión de la infraestructura física del colegio, consolidación de la matrícula escolar inicial y reconocimiento social pleno en el Huila.</p>
                                        <a href="https://drive.google.com/file/d/1bK79fZxTaz-dghBit__d5tokmUVCfTb6/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="timeline-btn">
                                            <span class="timeline-btn-icon">📄</span> Abrir Tomo Histórico 1892 - 1930
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-badge">1940</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>Crecimiento y Modernización Académica</h4>
                                        <span class="timeline-era">1940 - 1952</span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Reformas pedagógicas curriculares relevantes, adopción de nuevos estándares educativos y dinamización cultural y académica en el entorno local.</p>
                                        <a href="https://drive.google.com/file/d/1bMWkSIbuMEU9jVVUKpbgbpunR_AcarS5/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="timeline-btn">
                                            <span class="timeline-btn-icon">📄</span> Abrir Tomo Histórico 1940 - 1952
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-badge">1953</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>Bodas de Brillante de la Obra</h4>
                                        <span class="timeline-era">1953 - 1972</span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Conmemoración de la dilatada presencia institucional, fomento del liderazgo escolar femenino regional y expansión de actividades de proyección social.</p>
                                        <a href="https://drive.google.com/file/d/1bOpqUq358t72vG73JbYT-eZXpg92eNKP/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="timeline-btn">
                                            <span class="timeline-btn-icon">📄</span> Abrir Tomo Histórico 1953 - 1972
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-badge">1973</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>Centenario de Labor Educativa</h4>
                                        <span class="timeline-era">1973 - 1982</span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Hito histórico centenario del colegio en la región, fortaleciendo el carisma educativo de la Congregación y renovando la misión pedagógica personalizada.</p>
                                        <a href="https://drive.google.com/file/d/1bO1_ofl-IM_WMb_kj-2NOghdBY8ZWY50/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="timeline-btn">
                                            <span class="timeline-btn-icon">📄</span> Abrir Tomo Histórico 1973 - 1982
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-badge">1983</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>Nuevos Horizontes e Innovaciones</h4>
                                        <span class="timeline-era">1983 - 1993</span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Adopción gradual de sistemas informáticos, remodelación de laboratorios científicos y mayor apertura a la investigación académica juvenil.</p>
                                        <a href="https://drive.google.com/file/d/1bPEgYH5UN143QPFWQQ519kpnqBsPN0VC/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="timeline-btn">
                                            <span class="timeline-btn-icon">📄</span> Abrir Tomo Histórico 1983 - 1993
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-badge">1994</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>Excelencia Sostenida</h4>
                                        <span class="timeline-era">1994 - 1999</span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Excelentes resultados en evaluaciones e ICFES a nivel departamental, consolidación de metodologías innovadoras y activa participación deportiva intercolegiada.</p>
                                        <a href="https://drive.google.com/file/d/1bPPPUcQCRhq8C-AT6_C63xiI68ubrRh6/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="timeline-btn">
                                            <span class="timeline-btn-icon">📄</span> Abrir Tomo Histórico 1994 - 1999
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-badge">2000</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>Siglo XXI e Integración Tecnológica</h4>
                                        <span class="timeline-era">2000 - 2009</span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Desarrollo pleno de habilidades tecnológicas asociadas al aprendizaje significativo, robustecimiento de la enseñanza del inglés y expansión de la banda marcial.</p>
                                        <a href="https://drive.google.com/file/d/1bRtEKKpdsoU736cpy76RHgxbVZQnQIC5/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="timeline-btn">
                                            <span class="timeline-btn-icon">📄</span> Abrir Tomo Histórico 2000 - 2009
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-badge">2010</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>Liderazgo e Innovación Continua</h4>
                                        <span class="timeline-era">2010 - 2019</span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Implementación de comités por áreas de calidad y procesos institucionales de alto impacto pastoral y comunitario en estrecha alianza con las familias.</p>
                                        <a href="https://drive.google.com/file/d/1bTB1g0ylehc9CN2rorZmOBch77MJtzKi/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="timeline-btn">
                                            <span class="timeline-btn-icon">📄</span> Abrir Tomo Histórico 2010 - 2019
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-badge">2022</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>Resiliencia, Desafíos y Futuro</h4>
                                        <span class="timeline-era">2020 - 2022</span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Adaptación digital resiliente ante la contingencia de salud pública mundial, garantizando el carisma de la Presentación intacto y robusteciendo la educación del futuro.</p>
                                        <a href="https://drive.google.com/file/d/1bHL7SRa2HAlF11EcXI2WdaTRW5FWFIzI/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="timeline-btn">
                                            <span class="timeline-btn-icon">📄</span> Abrir Tomo Histórico 2020 - 2022
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                ',
                'enlaces' => [],
                'publicada' => true,
            ]
        );
    }
}