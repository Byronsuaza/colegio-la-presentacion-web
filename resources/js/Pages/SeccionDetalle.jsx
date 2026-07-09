import './SeccionDetalle.css';
import { Head } from '@inertiajs/react';
import { useState } from 'react';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';
import { storageUrl } from '../utils/url';

// Icon SVG components
const IconGraduationCap = () => (
  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <path d="M22 10v6m0 0l-8.97 4.97a2 2 0 01-2.06 0L2 16m20-6l-8.97-4.97a2 2 0 00-2.06 0L2 10m20 0v6m0 0L2 16" />
    <path d="M6 12.5v5m6-5v5m6-5v5" />
  </svg>
);

const IconHeart = () => (
  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
  </svg>
);

const IconGlobe = () => (
  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <circle cx="12" cy="12" r="10" />
    <line x1="2" y1="12" x2="22" y2="12" />
    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
  </svg>
);

const IconMusic = () => (
  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <path d="M9 18V5l12-2v13" />
    <circle cx="6" cy="18" r="3" />
    <circle cx="18" cy="16" r="3" />
  </svg>
);

const IconActivity = () => (
  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
  </svg>
);

const IconSparkles = () => (
  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <path d="M6.5 3a2.5 2.5 0 1 0 5 0 2.5 2.5 0 0 0-5 0" />
    <path d="M17 12a2.5 2.5 0 1 0 5 0 2.5 2.5 0 0 0-5 0" />
    <path d="M12.5 18a2.5 2.5 0 1 0 5 0 2.5 2.5 0 0 0-5 0" />
  </svg>
);

const IconGlasses = () => (
  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <path d="M23 1H1v11h6v2H1v8h22V3" />
    <path d="M15 1v13" />
  </svg>
);

const IconBeaker = () => (
  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <path d="M4.5 3h15M6 3v16a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3M9 9h6" />
  </svg>
);

const IconTarget = () => (
  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <circle cx="12" cy="12" r="10" />
    <circle cx="12" cy="12" r="6" />
    <circle cx="12" cy="12" r="2" />
  </svg>
);

const IconCheckCircle = () => (
  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
    <polyline points="22 4 12 14.01 9 11.01" />
  </svg>
);

const IconBriefcase = () => (
  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
    <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
  </svg>
);

const IconSearch = () => (
  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <circle cx="11" cy="11" r="8" />
    <path d="m21 21-4.35-4.35" />
  </svg>
);

const iconMap = {
  'graduation-cap': IconGraduationCap,
  'heart': IconHeart,
  'globe': IconGlobe,
  'music': IconMusic,
  'activity': IconActivity,
  'sparkles': IconSparkles,
  'glasses': IconGlasses,
  'beaker': IconBeaker,
  'target': IconTarget,
  'check-circle': IconCheckCircle,
  'briefcase': IconBriefcase,
  'search': IconSearch,
};

const getIcon = (iconName) => {
  const Icon = iconMap[iconName];
  return Icon ? <Icon /> : null;
};

export default function SeccionDetalle({ seccion, menuPage, ajustes, sectionPages, seccionData }) {
  const [expandedObjective, setExpandedObjective] = useState(null);

  // Use database data if available, otherwise fall back to hard-coded data
  let data;
  
  if (seccionData) {
    const galleryImages = seccionData.galeria?.map((g) => storageUrl(g.url)).filter(Boolean) ?? [];

    data = {
      title: seccionData.titulo,
      description: seccionData.descripcion_completa || seccionData.descripcion_corta,
      image: storageUrl(seccionData.imagen_hero) || '/placeholder.png',
      images: galleryImages.length > 0 ? galleryImages : ['/placeholder.png'],
      objectives: seccionData.objetivos || [],
      features: seccionData.caracteristicas || [],
      stats: Object.entries(seccionData.estadisticas || {}).map(([label, number]) => ({ label, number })),
      coordinator: {
        name: seccionData.coordinador_nombre || 'Coordinador Académico',
        title: seccionData.coordinador_nombre || '',
        email: seccionData.coordinador_correo,
        phone: seccionData.coordinador_telefono,
      },
      grades: seccionData.grados?.map((g) => g.nombre) || [],
    };
  } else {
    // Fallback to hard-coded data (for backward compatibility)
    const sectionData = {
      preescolar: {
        title: 'Sección I - Preescolar',
        subtitle: 'Jardín y Transición',
        tagline: 'Formación Integral desde los Primeros Años',
        description: 'Nuestra Sección I del Colegio de La Presentación de Neiva desarrolla una formación integral del (la) estudiante, incorpora procesos de desarrollo cognitivo y refuerzo afectivo a través de la promoción de la interacción y de la experiencia de cada uno.',
        objectives: [
          { title: 'Potenciar Talentos', desc: 'Potenciar los valores, capacidades y talentos de cada alumno en un ambiente seguro y acogedor' },
          { title: 'Interacción Social', desc: 'Promover la interacción con otros compañeros que permita la construcción de experiencias de aprendizaje enriquecidas' },
          { title: 'Desarrollo Crítico', desc: 'Desarrollar habilidades de creatividad, resolución de problemas y razonamiento crítico' },
          { title: 'Desarrollo Integral', desc: 'Estimular el desarrollo cognitivo y afectivo integral en cada etapa' },
        ],
        features: [
          { icon: 'graduation-cap', title: 'Aulas Montessori', desc: 'Ambientes preparados para el aprendizaje autónomo' },
          { icon: 'heart', title: 'Psicorientación', desc: 'Acompañamiento emocional y psicológico integral' },
          { icon: 'globe', title: 'Inglés desde los 3', desc: 'Inmersión bilingüe desde temprana edad' },
          { icon: 'music', title: 'Arte y Música', desc: 'Educación artística y musical diferenciada' },
          { icon: 'activity', title: 'Movimiento', desc: 'Psicomotricidad y desarrollo físico integral' },
          { icon: 'sparkles', title: 'Estimulación', desc: 'Actividades de estimulación temprana adaptadas' },
        ],
        images: ['/preescolar.png', '/preescolar.png', '/preescolar.png'],
        image: '/preescolar.png',
        coordinator: {
          name: 'Coordinadora Académica',
          title: 'Sección I - Preescolar y 1° grado',
        },
        grades: ['Jardín', 'Transición'],
        color: '#2B7BA8',
        stats: [
          { number: '100+', label: 'Estudiantes' },
          { number: '3', label: 'Años de inicio' },
          { number: '15', label: 'Profesores' },
        ],
      },
      primaria: {
        title: 'Sección II - Básica Primaria',
        subtitle: 'Grados 1° a 5°',
        tagline: 'Consolidando Competencias, Formando Ciudadanos',
        description: 'En la Sección II del Colegio de La Presentación de Neiva, tenemos la gran tarea de mantener y fomentar la curiosidad, el interés y la creatividad de nuestros estudiantes logrando avanzar en el desarrollo de su autonomía y autorregulación.',
        objectives: [
          { title: 'Pensamiento Crítico', desc: 'Desarrollar el pensamiento crítico a través de proyectos de aula contextualizados' },
          { title: 'Competencias Fundamentales', desc: 'Consolidar competencias fundamentales con metodología activa e interdisciplinar' },
          { title: 'Ciudadanía', desc: 'Formar ciudadanos comprometidos con su entorno y comunidad' },
          { title: 'Bilingüismo', desc: 'Fortalecer habilidades de comunicación en inglés y español' },
          { title: 'Cooperación', desc: 'Promover el trabajo cooperativo y el respeto mutuo' },
        ],
        features: [
          { icon: 'globe', title: 'Bilingüismo', desc: 'Programa de inmersión bilingüe avanzado' },
          { icon: 'beaker', title: 'Laboratorios STEM', desc: 'Laboratorios de Ciencia, Tecnología, Ingeniería y Matemáticas' },
          { icon: 'music', title: 'Arte y Deporte', desc: 'Integración de arte y deporte en el currículo' },
          { icon: 'target', title: 'Proyectos', desc: 'Clubs y proyectos especiales según intereses' },
          { icon: 'check-circle', title: 'Metodología', desc: 'Metodología de proyectos interdisciplinares' },
          { icon: 'briefcase', title: 'Tecnología', desc: 'Integración de tecnología educativa avanzada' },
        ],
        images: ['/primaria.png', '/primaria.png', '/primaria.png'],
        image: '/primaria.png',
        coordinator: {
          name: 'Coordinadora Académica',
          title: 'Sección II - 2° a 5° Grados',
        },
        grades: ['1°', '2°', '3°', '4°', '5°'],
        color: '#1A5480',
        stats: [
          { number: '300+', label: 'Estudiantes' },
          { number: '40', label: 'Docentes' },
          { number: '10', label: 'Laboratorios' },
        ],
      },
      bachillerato: {
        title: 'Sección III - Bachillerato',
        subtitle: 'Grados 6° a 11°',
        tagline: 'Formando Líderes para un Mundo Cambiante',
        description: 'La Sección III del Colegio de La Presentación de Neiva es un programa educativo innovador, basado en metodologías pedagógicas constructivas, que tiene como objetivo desarrollar el pensamiento crítico, la autonomía y la creatividad de nuestros estudiantes.',
        objectives: [
          { title: 'Personas Íntegras', desc: 'Formar personas íntegras comprometidas con la comunidad y su entorno' },
          { title: 'Liderazgo', desc: 'Desarrollar líderes con visión en un mundo cambiante y dinámico' },
          { title: 'Excelencia Académica', desc: 'Preparar académicamente para universidades de prestigio nacional e internacional' },
          { title: 'Autonomía', desc: 'Fortalecer el pensamiento crítico y la autonomía en la toma de decisiones' },
          { title: 'Formación Integral', desc: 'Integrar formación académica, espiritual y de carácter' },
        ],
        features: [
          { icon: 'glasses', title: 'Preuniversitario', desc: 'Programa especializado de preparación para pruebas ICFES' },
          { icon: 'target', title: 'Proyecto de Vida', desc: 'Construcción personalizada del proyecto de vida' },
          { icon: 'search', title: 'Pruebas Int\'l', desc: 'Preparación en pruebas internacionales avanzadas' },
          { icon: 'briefcase', title: 'Emprendimiento', desc: 'Énfasis en emprendimiento e innovación empresarial' },
          { icon: 'heart', title: 'Liderazgo', desc: 'Programas de liderazgo y servicio comunitario' },
          { icon: 'check-circle', title: 'Investigación', desc: 'Metodología de investigación científica avanzada' },
        ],
        images: ['/bachillerato.png', '/bachillerato.png', '/bachillerato.png'],
        image: '/bachillerato.png',
        coordinator: {
          name: 'Coordinador Académico',
          title: 'Sección III - 6° a 11°',
        },
        grades: ['6°', '7°', '8°', '9°', '10°', '11°'],
        color: '#1B5E8A',
        stats: [
          { number: '400+', label: 'Estudiantes' },
          { number: '50', label: 'Docentes' },
          { number: '100%', label: 'Universidades' },
        ],
      },
    };
    
    data = sectionData[seccion];
  }

  if (!data) {
    return <div className="container"><p>Sección no encontrada</p></div>;
  }

  const compactHeroSections = ['preescolar', 'primaria', 'bachillerato'];
  const isCompactHero = compactHeroSections.includes(seccion);

  return (
    <>
      <Head title={data.title} />
      <Navbar ajustes={ajustes} />
      <main>
        {/* Hero Section (compact for specific sections) */}
        {isCompactHero ? (
          <section className="seccion-hero seccion-hero--compact" style={{ backgroundImage: `url(${data.image})` }}>
            <div className="seccion-hero__overlay" />
            <div className="container">
              <div className="seccion-hero__content seccion-hero__content--compact">
                <span className="seccion-hero__eyebrow seccion-hero__eyebrow--compact">{data.subtitle}</span>
                <h1 className="seccion-hero__title seccion-hero__title--compact">{data.title}</h1>
                {data.tagline && <p className="seccion-hero__tagline seccion-hero__tagline--compact">{data.tagline}</p>}
              </div>
            </div>
          </section>
        ) : (
          <section className="seccion-hero" style={{ backgroundImage: `url(${data.image})` }}>
            <div className="seccion-hero__overlay" />
            <div className="container">
              <div className="seccion-hero__content">
                <span className="seccion-hero__eyebrow">{data.subtitle}</span>
                <h1 className="seccion-hero__title">{data.title}</h1>
                <p className="seccion-hero__tagline">{data.tagline}</p>
              </div>
            </div>
          </section>
        )}

        {/* Stats Bar */}
        <section className="seccion-stats">
          <div className="container">
            <div className="seccion-stats__grid">
              {data.stats.map((stat, idx) => (
                <div key={idx} className="seccion-stat">
                  <div className="seccion-stat__number">{stat.number}</div>
                  <div className="seccion-stat__label">{stat.label}</div>
                </div>
              ))}
            </div>
          </div>
        </section>

        {/* Description */}
        <section className="seccion-description">
          <div className="container">
            <p className="seccion-description__text">{data.description}</p>
          </div>
        </section>

        {/* Objectives Section */}
        <section className="seccion-section seccion-objectives-section">
          <div className="container">
            <h2 className="seccion-section__title">Nuestros Objetivos</h2>
            <div className="seccion-objectives">
              {data.objectives.map((obj, idx) => (
                <div
                  key={idx}
                  className={`seccion-objective ${expandedObjective === idx ? 'seccion-objective--expanded' : ''}`}
                  onClick={() => setExpandedObjective(expandedObjective === idx ? null : idx)}
                >
                  <div className="seccion-objective__header">
                    <div className="seccion-objective__number">{idx + 1}</div>
                    <h3 className="seccion-objective__title">{obj.title || obj.titulo}</h3>
                    <svg className="seccion-objective__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                      <polyline points="6 9 12 15 18 9" />
                    </svg>
                  </div>
                  <p className="seccion-objective__desc">{obj.desc || obj.descripcion}</p>
                </div>
              ))}
            </div>
          </div>
        </section>

        {/* Features Section */}
        <section className="seccion-section seccion-features-section">
          <div className="container">
            <h2 className="seccion-section__title">Características y Programas</h2>
            <div className="seccion-features">
              {data.features.map((feature, idx) => (
                <div key={idx} className="seccion-feature-card">
                  <div className="seccion-feature-icon">{getIcon(feature.icon)}</div>
                  <h3 className="seccion-feature-title">{feature.title || feature.titulo}</h3>
                  <p className="seccion-feature-desc">{feature.desc || feature.descripcion}</p>
                </div>
              ))}
            </div>
          </div>
        </section>

        {/* Image Gallery */}
        <section className="seccion-section seccion-gallery-section">
          <div className="container">
            <h2 className="seccion-section__title">Galería de la Sección</h2>
            <div className="seccion-gallery">
              {data.images.map((img, idx) => (
                <div key={idx} className="seccion-gallery__item">
                  <img src={img} alt={`${data.title} - ${idx + 1}`} />
                </div>
              ))}
            </div>
          </div>
        </section>

        {/* Grades Section */}
        <section className="seccion-section seccion-grades-section">
          <div className="container">
            <h2 className="seccion-section__title">Grados que Atendemos</h2>
            <div className="seccion-grades">
              {data.grades.map((grade, idx) => (
                <div key={idx} className="seccion-grade-badge">
                  {grade}
                </div>
              ))}
            </div>
          </div>
        </section>

        {/* Coordinator Info */}
        <section className="seccion-section seccion-coordinator-section">
          <div className="container">
            <div className="seccion-coordinator">
              <div className="seccion-coordinator__icon">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                  <circle cx="12" cy="7" r="4" />
                </svg>
              </div>
              <h3>Coordinación Académica</h3>
              <p className="seccion-coordinator__role">{data.coordinator.title}</p>
            </div>
          </div>
        </section>

        {/* CTA Section */}
        <section className="seccion-cta">
          <div className="container">
            <h2>¿Interesado en esta Sección?</h2>
            <p>Inicia tu camino en el Colegio de La Presentación</p>
            <a href="/admisiones/inscripcion-en-linea" className="seccion-cta__btn">
              Solicitar Información
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                <path d="M5 12h14M12 5l7 7-7 7" />
              </svg>
            </a>
          </div>
        </section>
      </main>
      <Footer ajustes={ajustes} />
    </>
  );
}
