import './OfertaEducativa.css';

const niveles = [
  {
    id: 'preescolar',
    img: '/preescolar.png',
    nivel: 'Preescolar',
    grados: 'Jardín · Transición',
    descripcion: 'Ambientes lúdicos y afectivos que estimulan el desarrollo integral de la primera infancia. Potenciamos la creatividad, la socialización y el amor por el aprendizaje desde los primeros años.',
    features: ['Aulas Montessori', 'Psicorientación', 'Inglés desde los 3 años'],
    color: '#E3F0F7',
    accentColor: '#2B7BA8',
  },
  {
    id: 'primaria',
    img: '/primaria.png',
    nivel: 'Básica Primaria',
    grados: 'Grados 1° — 5°',
    descripcion: 'Consolidamos las competencias fundamentales con una metodología activa e interdisciplinar. Formamos pensadores críticos, lectores apasionados y ciudadanos comprometidos con su entorno.',
    features: ['Bilingüismo', 'Laboratorios Stem', 'Arte y Deporte'],
    color: '#E8EEF4',
    accentColor: '#1A5480',
  },
  {
    id: 'bachillerato',
    img: '/bachillerato.png',
    nivel: 'Bachillerato',
    grados: 'Grados 6° — 11°',
    descripcion: 'Preparación académica de élite orientada al ingreso a universidades de prestigio. Profundizamos en ciencias, humanidades y tecnología con énfasis en liderazgo y emprendimiento social.',
    features: ['Preuniversitario', 'Proyecto de Vida', 'ICFES Superior'],
    color: '#EDE8F4',
    accentColor: '#1B5E8A',
  },
];

const sectionRoutes = {
  preescolar: '/nuestra-institucion/seccion-preescolar',
  primaria: '/nuestra-institucion/seccion-primaria',
  bachillerato: '/nuestra-institucion/seccion-bachillerato',
};

export default function OfertaEducativa() {
  const getRoute = (id) => sectionRoutes[id] || '#';
  return (
    <section className="oferta section section--off-white" id="oferta-educativa">
      <div className="container">
        {/* Header */}
        <div className="oferta__header">
          <span className="eyebrow">Formación Integral</span>
          <span className="divider-gold" />
          <h2 className="section-title">
            Nuestra Oferta<br />
            <em className="oferta__title-em">Educativa</em>
          </h2>
          <p className="section-subtitle">
            Tres ciclos formativos diseñados para acompañar al estudiante en cada etapa de su desarrollo,
            con metodologías diferenciadas y propósitos claros.
          </p>
        </div>

        {/* Panels */}
        <div className="oferta__panels">
          {niveles.map((n) => (
            <div className="oferta__panel" key={n.id} id={`oferta-panel-${n.id}`}>
              {/* Image */}
              <div className="oferta__panel-img-wrap">
                <img src={n.img} alt={n.nivel} className="oferta__panel-img" />
                <div className="oferta__panel-img-overlay" />
                <div className="oferta__panel-nivel-badge">{n.nivel}</div>
              </div>

              {/* Content */}
              <div className="oferta__panel-body">
                <div className="oferta__panel-grados">{n.grados}</div>
                <h3 className="oferta__panel-title">{n.nivel}</h3>
                <p className="oferta__panel-desc">{n.descripcion}</p>

                {/* Features */}
                <ul className="oferta__panel-features">
                  {n.features.map((f) => (
                    <li key={f} className="oferta__panel-feature">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                      </svg>
                      {f}
                    </li>
                  ))}
                </ul>

                <a href={getRoute(n.id)} className="oferta__panel-link" id={`oferta-link-${n.id}`}>
                  Conocer más
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                  </svg>
                </a>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
