import React, { useState, useEffect, useRef } from 'react';
import { usePage } from '@inertiajs/react';
import './ColegiosProvincia.css';

const DEFAULT_COLEGIOS = [
  {
    nombre: 'Colegio de La Presentación Fusagasugá',
    ciudad: 'Fusagasugá',
    logo: '/images/provincia/logoFusagasuga.webp',
    url: 'https://colpres.edu.co/colegio-la-presentacion-fusagasuga',
  },
  {
    nombre: 'Colegio de La Presentación Zipaquirá',
    ciudad: 'Zipaquirá',
    logo: '/images/provincia/logoZipaquira.webp',
    url: 'https://colpresentacionzipa.edu.co/',
  },
  {
    nombre: 'Colegio de La Presentación Neiva',
    ciudad: 'Neiva',
    logo: '/images/provincia/logoNeiva.webp',
    url: 'https://colpresentacioneiva.edu.co/',
  },
  {
    nombre: 'Colegio de La Presentación Pitalito',
    ciudad: 'Pitalito',
    logo: '/images/provincia/logoPitalito.webp',
    url: 'https://lapresentacionpitalito.edu.co/',
  },
  {
    nombre: 'Colegio Santa Teresa Cúcuta',
    ciudad: 'Cúcuta',
    logo: '/images/provincia/staTeresaCucuta.png',
    url: 'https://colpresantateresacucuta.edu.co/',
  },
  {
    nombre: 'Colegio de La Presentación Mérida',
    ciudad: 'Mérida',
    logo: '/images/provincia/merida.png',
    url: 'https://lapresentacioncolegio.com/',
  },
  {
    nombre: 'Ciudadela La Presentación',
    ciudad: 'Medellín',
    logo: '/images/provincia/ciudadelapresentacion.png',
    url: 'https://www.ciudadelapresentacion.edu.co/',
  },
];

export default function ColegiosProvincia() {
  const { colegiosProvincia = [] } = usePage().props;
  const colegios = colegiosProvincia && colegiosProvincia.length > 0 ? colegiosProvincia : DEFAULT_COLEGIOS;
  const [currentIndex, setCurrentIndex] = useState(0);
  const [isPaused, setIsPaused] = useState(false);
  const sliderRef = useRef(null);

  // Total de elementos visibles según pantalla (para calcular páginas)
  const [visibleCount, setVisibleCount] = useState(4);

  useEffect(() => {
    const handleResize = () => {
      if (window.innerWidth < 640) {
        setVisibleCount(1);
      } else if (window.innerWidth < 960) {
        setVisibleCount(2);
      } else if (window.innerWidth < 1200) {
        setVisibleCount(3);
      } else {
        setVisibleCount(4);
      }
    };

    handleResize();
    window.addEventListener('resize', handleResize);
    return () => window.removeEventListener('resize', handleResize);
  }, []);

  const maxIndex = Math.max(0, colegios.length - visibleCount);

  // Autoplay continuo
  useEffect(() => {
    if (isPaused) return;

    const interval = setInterval(() => {
      setCurrentIndex((prev) => (prev >= maxIndex ? 0 : prev + 1));
    }, 3800);

    return () => clearInterval(interval);
  }, [isPaused, maxIndex]);

  const handlePrev = () => {
    setCurrentIndex((prev) => (prev <= 0 ? maxIndex : prev - 1));
  };

  const handleNext = () => {
    setCurrentIndex((prev) => (prev >= maxIndex ? 0 : prev + 1));
  };

  return (
    <section 
      className="provincia-section" 
      aria-label="Colegios de la Provincia Nuestra Señora de La Presentación"
      onMouseEnter={() => setIsPaused(true)}
      onMouseLeave={() => setIsPaused(false)}
    >
      <div className="container provincia__container">
        {/* Banner / Encabezado institucional */}
        <div className="provincia__header">
          <img
            src="/images/provincia/provincia.png"
            alt="Provincia Nuestra Señora de La Presentación - Te invitamos a conocer nuestros Colegios"
            className="provincia__header-img"
            loading="lazy"
          />
          <h2 className="sr-only">Provincia Nuestra Señora de La Presentación - Te invitamos a conocer nuestros Colegios</h2>
        </div>

        {/* Carrusel */}
        <div className="provincia__carousel-wrapper">
          <button 
            type="button" 
            className="provincia__nav-btn provincia__nav-btn--prev"
            onClick={handlePrev}
            aria-label="Colegio anterior"
          >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
              <polyline points="15 18 9 12 15 6" />
            </svg>
          </button>

          <div className="provincia__track-container" ref={sliderRef}>
            <div 
              className="provincia__track"
              style={{
                transform: `translateX(-${currentIndex * (100 / visibleCount)}%)`,
              }}
            >
              {colegios.map((colegio, idx) => (
                <div 
                  key={idx} 
                  className="provincia__slide"
                  style={{ flex: `0 0 ${100 / visibleCount}%` }}
                >
                  <a
                    href={colegio.url}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="provincia__card"
                    title={`Visitar sitio web oficial: ${colegio.nombre}`}
                  >
                    <div className="provincia__logo-wrapper">
                      <img
                        src={colegio.logo}
                        alt={colegio.nombre}
                        className="provincia__logo-img"
                        loading="lazy"
                      />
                    </div>
                    <span className="provincia__card-nombre">{colegio.ciudad}</span>
                  </a>
                </div>
              ))}
            </div>
          </div>

          <button 
            type="button" 
            className="provincia__nav-btn provincia__nav-btn--next"
            onClick={handleNext}
            aria-label="Siguiente colegio"
          >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
              <polyline points="9 18 15 12 9 6" />
            </svg>
          </button>
        </div>

        {/* Indicadores de paginación (dots) */}
        <div className="provincia__dots" role="tablist" aria-label="Navegación de colegios">
          {Array.from({ length: maxIndex + 1 }).map((_, dotIdx) => (
            <button
              key={dotIdx}
              type="button"
              className={`provincia__dot ${currentIndex === dotIdx ? 'provincia__dot--active' : ''}`}
              onClick={() => setCurrentIndex(dotIdx)}
              aria-label={`Ir al grupo ${dotIdx + 1}`}
              role="tab"
              aria-selected={currentIndex === dotIdx}
            />
          ))}
        </div>
      </div>
    </section>
  );
}
