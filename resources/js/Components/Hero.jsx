import { useCallback, useEffect, useRef, useState } from 'react';
import { storageUrl } from '../utils/url';
import './Hero.css';

const defaultSlides = [
  { src: '/hero.jpg', alt: 'Campus Colegio de La Presentaci\u00f3n de Neiva' },
  { src: '/hero2.jpg', alt: 'Vida estudiantil - La Presentaci\u00f3n Neiva' },
  { src: '/hero3.jpg', alt: 'Instalaciones acad\u00e9micas - La Presentaci\u00f3n Neiva' },
  { src: '/hero4.jpg', alt: 'Comunidad educativa - La Presentaci\u00f3n Neiva' },
  { src: '/hero5.jpg', alt: 'Actividades institucionales - La Presentaci\u00f3n Neiva' },
  { src: '/hero6.jpg', alt: 'Espacios de aprendizaje - La Presentaci\u00f3n Neiva' },
  { src: '/hero7.jpg', alt: 'Formaci\u00f3n integral - La Presentaci\u00f3n Neiva' },
  { src: '/hero8.jpg', alt: 'Excelencia acad\u00e9mica - La Presentaci\u00f3n Neiva' },
];

const AUTO_PLAY_INTERVAL = 5000;

export default function Hero({ slides = [], ajustes }) {
  const admissionsYear = ajustes?.admisiones_anio || '2027';
  const displaySlides = slides && slides.length > 0
    ? slides.map((slide) => ({
        src: storageUrl(slide.imagen),
        alt: slide.titulo || 'Colegio de La Presentaci\u00f3n',
      }))
    : defaultSlides;

  const [current, setCurrent] = useState(0);
  const timerRef = useRef(null);

  const goTo = useCallback((index) => {
    setCurrent(index);
  }, []);

  const goNext = useCallback(() => {
    setCurrent((index) => (index + 1) % displaySlides.length);
  }, [displaySlides.length]);

  const goPrev = useCallback(() => {
    setCurrent((index) => (index - 1 + displaySlides.length) % displaySlides.length);
  }, [displaySlides.length]);

  useEffect(() => {
    timerRef.current = setInterval(goNext, AUTO_PLAY_INTERVAL);
    return () => clearInterval(timerRef.current);
  }, [goNext]);

  useEffect(() => {
    const onKey = (event) => {
      if (event.key === 'ArrowRight') goNext();
      if (event.key === 'ArrowLeft') goPrev();
    };

    window.addEventListener('keydown', onKey);
    return () => window.removeEventListener('keydown', onKey);
  }, [goNext, goPrev]);

  return (
    <section className="hero" id="inicio">
      <div className="hero__slides">
        {displaySlides.map((slide, index) => (
          <div
            key={slide.src}
            className={`hero__slide ${index === current ? 'hero__slide--active' : ''}`}
          >
            <img
              src={slide.src}
              alt={slide.alt}
              className="hero__bg-img"
              loading={index === 0 ? 'eager' : 'lazy'}
            />
            <div className="hero__overlay" />
            <div className="hero__gradient" />
          </div>
        ))}
      </div>

      <div className="hero__content">
        <div className="hero__badge">
          <span className="hero__badge-line" />
          <span className="hero__badge-text">Desde 1882 {'\u00b7'} Formando el futuro</span>
          <span className="hero__badge-line" />
        </div>

        <h1 className="hero__title">
          <span className="hero__title-small">Colegio de La</span>
          <span className="hero__title-main">{'Presentaci\u00f3n'}</span>
          <span className="hero__title-location">de Neiva</span>
        </h1>

        <p className="hero__subtitle">
          {'Excelencia acad\u00e9mica, formaci\u00f3n en valores y tradici\u00f3n dominica'}<br />
          {'al servicio de la transformaci\u00f3n de Colombia.'}
        </p>

        <div className="hero__actions">
          <a href="#admisiones" className="hero__btn hero__btn--primary" id="hero-admisiones-btn">
            Admisiones {admissionsYear}
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
          <a href="#oferta-educativa" className="hero__btn hero__btn--secondary" id="hero-oferta-btn">
            Nuestra Propuesta
          </a>
        </div>
      </div>

      <button
        className="hero__arrow hero__arrow--left"
        onClick={goPrev}
        aria-label="Imagen anterior"
        id="hero-arrow-prev"
        type="button"
      >
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
          <polyline points="15 18 9 12 15 6" />
        </svg>
      </button>
      <button
        className="hero__arrow hero__arrow--right"
        onClick={goNext}
        aria-label="Siguiente imagen"
        id="hero-arrow-next"
        type="button"
      >
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
          <polyline points="9 18 15 12 9 6" />
        </svg>
      </button>

      <div className="hero__dots" role="tablist">
        {displaySlides.map((slide, index) => (
          <button
            key={slide.src}
            className={`hero__dot ${index === current ? 'hero__dot--active' : ''}`}
            onClick={() => goTo(index)}
            aria-label={`Ir a imagen ${index + 1}`}
            id={`hero-dot-${index + 1}`}
            type="button"
          />
        ))}
      </div>

      <div className="hero__progress-wrap">
        <div
          className="hero__progress-bar hero__progress-bar--running"
          key={current}
          style={{ animationDuration: `${AUTO_PLAY_INTERVAL}ms` }}
        />
      </div>

      <div className="hero__scroll">
        <div className="hero__scroll-mouse">
          <div className="hero__scroll-dot" />
        </div>
        <span className="hero__scroll-text">Descubrir</span>
      </div>
    </section>
  );
}
