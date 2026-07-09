import React, { useState, useEffect } from 'react';
import { Head } from '@inertiajs/react';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';
import './PdfViewer.css';

export default function PdfViewer({ title, pdfUrl, backUrl = '/', ajustes }) {
  const [isMobile, setIsMobile] = useState(false);

  useEffect(() => {
    const checkMobile = () => {
      const userAgent = navigator.userAgent || navigator.vendor || window.opera;
      const isMobileSize = window.innerWidth < 768;
      const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
      setIsMobile(isMobileSize || isTouchDevice || /android|iphone|ipad|ipod/i.test(userAgent));
    };
    checkMobile();
    window.addEventListener('resize', checkMobile);
    return () => window.removeEventListener('resize', checkMobile);
  }, []);

  return (
    <>
      <Head title={title} />
      <Navbar ajustes={ajustes} solid />

      <main className="pdf-viewer">
        <section className="pdf-viewer__header">
          <div className="container pdf-viewer__header-inner">
            <div className="pdf-viewer__titles">
              <span className="pdf-viewer__eyebrow">Documento PDF</span>
              <h1>{title}</h1>
            </div>
            <div className="pdf-viewer__actions">
              <a href={backUrl} className="pdf-viewer__btn pdf-viewer__btn--ghost">
                Volver
              </a>
              <a href={pdfUrl} className="pdf-viewer__btn pdf-viewer__btn--primary" target="_blank" rel="noopener noreferrer">
                {isMobile ? 'Descargar PDF' : 'Abrir en pestaña nueva'}
              </a>
            </div>
          </div>
        </section>

        <section className="pdf-viewer__frame-wrap">
          {isMobile ? (
            <div className="pdf-viewer__mobile-card">
              <div className="pdf-viewer__mobile-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                  <polyline points="14 2 14 8 20 8" />
                  <line x1="12" y1="18" x2="12" y2="12" />
                  <polyline points="9 15 12 18 15 15" />
                </svg>
              </div>
              <h3>Lector de PDF Optimizado</h3>
              <p>
                Los visualizadores de PDF integrados pueden no responder correctamente en pantallas táctiles o móviles. 
                Le recomendamos descargar el documento para leerlo con comodidad.
              </p>
              <a href={pdfUrl} className="pdf-viewer__mobile-btn" target="_blank" rel="noopener noreferrer">
                Descargar Documento PDF
              </a>
            </div>
          ) : (
            <iframe
              src={pdfUrl}
              title={title}
              className="pdf-viewer__frame"
            />
          )}
        </section>
      </main>

      <Footer ajustes={ajustes} />
    </>
  );
}
