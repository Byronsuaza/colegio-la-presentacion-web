import { useEffect, useRef } from 'react';
import './ValorSection.css';

const defaultIcons = [
  <svg key="star" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round">
    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
  </svg>,
  <svg key="heart" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round">
    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
  </svg>,
  <svg key="innov" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round">
    <circle cx="12" cy="12" r="10"/>
    <path d="M12 8v4l3 3"/>
    <path d="M9.09 9A5 5 0 1 0 17 15.45"/>
    <path d="M12 2a10 10 0 0 1 8.66 5"/>
  </svg>,
];

const defaultValores = [
  {
    id: 'excelencia',
    titulo: 'Excelencia Académica',
    descripcion: 'Comprometidos con los más altos estándares educativos. Resultados ICFES Superior, metodologías activas y docentes especializados forman estudiantes de élite intelectual.',
  },
  {
    id: 'valores',
    titulo: 'Formación en Valores',
    descripcion: 'Inspirados en el carisma dominico de Marie Poussepin, cultivamos la fe, la solidaridad, la honestidad y el compromiso social como pilares del desarrollo humano integral.',
  },
  {
    id: 'innovacion',
    titulo: 'Innovación Pedagógica',
    descripcion: 'Integramos tecnología de vanguardia, pensamiento crítico y aprendizaje basado en proyectos para preparar ciudadanos creativos y competentes en el siglo XXI.',
  },
];

export default function ValorSection({ ajustes }) {
  const gridRef = useRef(null);

  const titulo = ajustes?.valor_titulo || 'Una Educación que Transforma Vidas';
  const subtitulo = ajustes?.valor_subtitulo || 'Cada estudiante es el centro de nuestro proceso educativo. Formamos personas íntegras, comprometidas con la sociedad y preparadas para los desafíos del mundo contemporáneo.';
  const frase = ajustes?.valor_frase || 'La verdadera educación es aquella que forma el corazón, ilumina la mente y fortalece el espíritu para servir a los demás.';
  const fraseAutor = ajustes?.valor_frase_autor || '— Inspirados en el Carisma de Marie Poussepin';

  const pilaresList = Array.isArray(ajustes?.valor_pilares) && ajustes.valor_pilares.length > 0
    ? ajustes.valor_pilares
    : defaultValores;

  useEffect(() => {
    const cards = gridRef.current?.querySelectorAll('.valor__card');
    if (!cards) return;
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15 }
    );
    cards.forEach((card) => observer.observe(card));
    return () => observer.disconnect();
  }, [pilaresList]);

  return (
    <section className="valor section" id="propuesta-valor">
      <div className="container">
        {/* Header */}
        <div className="valor__header">
          <span className="eyebrow">Nuestra Propuesta</span>
          <span className="divider-gold divider-gold--center" />
          <h2 className="section-title" style={{ textAlign: 'center' }}>
            {titulo}
          </h2>
          <p className="section-subtitle" style={{ textAlign: 'center', margin: '0 auto' }}>
            {subtitulo}
          </p>
        </div>

        {/* Cards Grid */}
        <div className="valor__grid" ref={gridRef}>
          {pilaresList.map((v, i) => (
            <div
              className="valor__card"
              key={v.id || i}
              id={`valor-card-${v.id || i}`}
              style={{ transitionDelay: `${i * 0.15}s` }}
            >
              <div className="valor__card-icon">
                {defaultIcons[i % defaultIcons.length]}
              </div>
              <div className="valor__card-number">0{i + 1}</div>
              <h3 className="valor__card-title">{v.titulo || v.title}</h3>
              <p className="valor__card-desc">{v.descripcion || v.desc}</p>
              <div className="valor__card-bar" />
            </div>
          ))}
        </div>

        {/* Bottom Quote */}
        <div className="valor__quote">
          <svg width="28" height="22" viewBox="0 0 28 22" fill="none" className="valor__quote-mark">
            <path d="M0 22V13.44C0 8.96 1.6 5.28 4.8 2.4 7.04.8 9.6 0 12.48 0v3.84c-2.24.32-4 1.2-5.28 2.64C5.92 7.84 5.28 9.6 5.28 11.68H8.8V22H0zm15.52 0V13.44c0-4.48 1.6-8.16 4.8-11.04C22.56.8 25.12 0 28 0v3.84c-2.24.32-4 1.2-5.28 2.64-1.28 1.36-1.92 3.12-1.92 5.2H24V22h-8.48z" fill="currentColor"/>
          </svg>
          <blockquote className="valor__quote-text">
            {frase}
          </blockquote>
          <cite className="valor__quote-author">{fraseAutor}</cite>
        </div>
      </div>
    </section>
  );
}
