import './PagoEnLinea.css';

export default function PagoEnLinea({ ajustes }) {
  const pagoUrl = ajustes?.pago_en_linea_url || '#';
  
  return (
    <section className="pago section" id="pago-en-linea">
      <div className="container">
        <div className="pago__inner">
          <div className="pago__icon">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
              <path d="M7 11V7a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4" />
              <line x1="10" y1="16" x2="14" y2="16" />
            </svg>
          </div>
          
          <h2 className="pago__title">Pago en Línea</h2>
          <p className="pago__subtitle">
            Realiza el pago de matrículas, pensiones y otros servicios de forma segura desde cualquier lugar
          </p>
          
          <a href={pagoUrl} target="_blank" rel="noopener noreferrer" className="pago__btn">
            Acceder al Sistema de Pago
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
              <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6" />
              <polyline points="10 14 21 3" />
            </svg>
          </a>
          
          <div className="pago__features">
            <div className="pago__feature">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              </svg>
              <span>Pago Seguro</span>
            </div>
            <div className="pago__feature">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg>
              <span>Disponible 24/7</span>
            </div>
            <div className="pago__feature">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                <polyline points="22 4 20 4 20 14 22 14 22 4" />
                <polyline points="2 7 4 4 4 14 2 11" />
                <line x1="5" y1="4" x2="19" y2="4" />
                <path d="M5 20h14a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2z" />
              </svg>
              <span>Múltiples Métodos</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
