import './AccesosRapidos.css';

const IconPago = () => (
  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
    <line x1="1" y1="10" x2="23" y2="10"/>
  </svg>
);

const IconPortal = () => (
  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <path d="M22 10v6M2 10l10-7 10 7"/>
    <path d="M6 10v6a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-6"/>
  </svg>
);

const IconPQRS = () => (
  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
  </svg>
);

const IconAdmisiones = () => (
  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
    <circle cx="9" cy="7" r="4"/>
    <polyline points="16 11 18 13 22 9"/>
  </svg>
);

const IconArrow = () => (
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
    <path d="M5 12h14M12 5l7 7-7 7"/>
  </svg>
);

export default function AccesosRapidos({ ajustes }) {
  const pagoUrl = ajustes?.pago_en_linea_url || '#';
  const syscolegiosUrl = ajustes?.syscolegios_url || 'https://syscolegios.com';
  const admisionesUrl = ajustes?.admisiones_boton_url || '/admisiones/inscripcion-en-linea';

  const hasPagoUrl = ajustes?.pago_en_linea_url;

  return (
    <section className="accesos section" id="accesos-rapidos" aria-label="Accesos rápidos">
      <div className="container">
        <div className="accesos__header">
          <span className="eyebrow">Accesos Rápidos</span>
          <span className="divider-gold divider-gold--center" />
          <h2 className="section-title" style={{ textAlign: 'center' }}>
            Todo lo que necesitas,<br />
            <em>en un solo lugar</em>
          </h2>
        </div>

        <div className="accesos__grid">

          {/* PAGO EN LÍNEA — Tarjeta destacada */}
          <a
            href={pagoUrl}
            className={`accesos__card accesos__card--pago${!hasPagoUrl ? ' accesos__card--disabled' : ''}`}
            id="acceso-pago-linea"
            target={hasPagoUrl ? '_blank' : undefined}
            rel="noopener noreferrer"
            aria-label="Pago en línea PSE"
          >
            <div className="accesos__card-glow" aria-hidden="true" />
            <div className="accesos__card-badge">Recomendado</div>
            <div className="accesos__card-icon-wrap">
              <IconPago />
            </div>
            <div className="accesos__card-body">
              <h3 className="accesos__card-title">Pago en Línea</h3>
              <p className="accesos__card-desc">
                Paga la pensión y servicios de forma segura a través del botón PSE. Rápido, fácil y sin filas.
              </p>
            </div>
            <div className="accesos__card-action">
              <span>Ir al portal de pago</span>
              <IconArrow />
            </div>
            {!hasPagoUrl && (
              <div className="accesos__card-coming">
                <span>Próximamente</span>
              </div>
            )}
          </a>

          {/* SYSCOLEGIOS */}
          <a
            href={syscolegiosUrl}
            className="accesos__card accesos__card--syscolegios"
            id="acceso-syscolegios"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="Portal Syscolegios"
          >
            <div className="accesos__card-icon-wrap">
              <IconPortal />
            </div>
            <div className="accesos__card-body">
              <h3 className="accesos__card-title">Portal Syscolegios</h3>
              <p className="accesos__card-desc">
                Consulta notas, horarios, asistencia y comunicados académicos de tu acudido.
              </p>
            </div>
            <div className="accesos__card-action">
              <span>Entrar al portal</span>
              <IconArrow />
            </div>
          </a>

          {/* PQRS */}
          <a
            href="/comunicaciones-contacto/pqrs"
            className="accesos__card accesos__card--pqrs"
            id="acceso-pqrs"
            aria-label="Radicar PQRS"
          >
            <div className="accesos__card-icon-wrap">
              <IconPQRS />
            </div>
            <div className="accesos__card-body">
              <h3 className="accesos__card-title">PQRS</h3>
              <p className="accesos__card-desc">
                Peticiones, quejas, reclamos, sugerencias y felicitaciones. Atendemos tu voz.
              </p>
            </div>
            <div className="accesos__card-action">
              <span>Radicar solicitud</span>
              <IconArrow />
            </div>
          </a>

          {/* ADMISIONES */}
          <a
            href={admisionesUrl}
            className="accesos__card accesos__card--admisiones"
            id="acceso-admisiones"
            aria-label="Proceso de admisiones"
          >
            <div className="accesos__card-icon-wrap">
              <IconAdmisiones />
            </div>
            <div className="accesos__card-body">
              <h3 className="accesos__card-title">Admisiones {ajustes?.admisiones_anio || '2027'}</h3>
              <p className="accesos__card-desc">
                Inicia el proceso de matrícula. Cupos limitados en preescolar, primaria y bachillerato.
              </p>
            </div>
            <div className="accesos__card-action">
              <span>Inscribirse ahora</span>
              <IconArrow />
            </div>
          </a>

        </div>
      </div>
    </section>
  );
}
