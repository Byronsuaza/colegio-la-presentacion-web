import './OfertaEducativa.css';
import { storageUrl } from '../utils/url';

const defaultNiveles = [
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

const defaultRoutes = {
  0: '/nuestra-institucion/seccion-preescolar',
  1: '/nuestra-institucion/seccion-primaria',
  2: '/nuestra-institucion/seccion-bachillerato',
  preescolar: '/nuestra-institucion/seccion-preescolar',
  primaria: '/nuestra-institucion/seccion-primaria',
  bachillerato: '/nuestra-institucion/seccion-bachillerato',
};

const defaultImgs = ['/preescolar.png', '/primaria.png', '/bachillerato.png'];

export default function OfertaEducativa({ ajustes }) {
  const titulo = ajustes?.oferta_titulo || 'Nuestra Oferta Educativa';
  const subtitulo = ajustes?.oferta_subtitulo || 'Tres ciclos formativos diseñados para acompañar al estudiante en cada etapa de su desarrollo, con metodologías diferenciadas y propósitos claros.';

  const nivelesList = Array.isArray(ajustes?.oferta_niveles) && ajustes.oferta_niveles.length > 0
    ? ajustes.oferta_niveles
    : defaultNiveles;

  return (
    <section className="oferta section section--off-white" id="oferta-educativa">
      <div className="container">
        {/* Header */}
        <div className="oferta__header">
          <span className="eyebrow">Formación Integral</span>
          <span className="divider-gold" />
          <h2 className="section-title">
            {titulo}
          </h2>
          <p className="section-subtitle">
            {subtitulo}
          </p>
        </div>

        {/* Panels */}
        <div className="oferta__panels">
          {nivelesList.map((n, index) => {
            const rawImg = n.imagen || n.img || defaultImgs[index % defaultImgs.length];
            const imgSrc = storageUrl(rawImg) || defaultImgs[index % defaultImgs.length];
            const routeHref = n.enlace || defaultRoutes[n.id] || defaultRoutes[index] || '#';
            const features = Array.isArray(n.features) ? n.features : [];

            return (
              <div className="oferta__panel" key={n.id || index} id={`oferta-panel-${n.id || index}`}>
                {/* Image */}
                <div className="oferta__panel-img-wrap">
                  <img src={imgSrc} alt={n.nivel} className="oferta__panel-img" />
                  <div className="oferta__panel-img-overlay" />
                  <div className="oferta__panel-nivel-badge">{n.nivel}</div>
                </div>

                {/* Content */}
                <div className="oferta__panel-body">
                  <div className="oferta__panel-grados">{n.grados}</div>
                  <h3 className="oferta__panel-title">{n.nivel}</h3>
                  <p className="oferta__panel-desc">{n.descripcion}</p>

                  {/* Features */}
                  {features.length > 0 && (
                    <ul className="oferta__panel-features">
                      {features.map((f, fIdx) => (
                        <li key={fIdx} className="oferta__panel-feature">
                          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                            <polyline points="20 6 9 17 4 12"/>
                          </svg>
                          {f}
                        </li>
                      ))}
                    </ul>
                  )}

                  <a href={routeHref} className="oferta__panel-link" id={`oferta-link-${n.id || index}`}>
                    Conocer más
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                      <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                  </a>
                </div>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}
