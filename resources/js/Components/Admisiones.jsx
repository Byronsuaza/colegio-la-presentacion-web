import './Admisiones.css';

const defaultAdmissionsUrl = '/admisiones/inscripcion-en-linea';

function resolveAdmissionsUrl(url) {
  const configuredUrl = url?.trim();
  return configuredUrl && configuredUrl !== '#' ? configuredUrl : defaultAdmissionsUrl;
}

const pasos = [
  {
    num: '01',
    titulo: 'Solicitud de Información',
    desc: 'Completa el formulario en línea o visítanos en nuestra sede. Un asesor de admisiones te contactará para orientarte.',
  },
  {
    num: '02',
    titulo: 'Entrevista Familiar',
    desc: 'Reunión con coordinación académica para conocer el proyecto de vida familiar y los valores que compartimos.',
  },
  {
    num: '03',
    titulo: 'Prueba de Nivelación',
    desc: 'Evaluación diagnóstica adaptada a la edad del estudiante para garantizar una transición académica exitosa.',
  },
  {
    num: '04',
    titulo: 'Matrícula & Bienvenida',
    desc: 'Formalización del proceso, entrega de documentos y ceremonia de bienvenida a la familia presentacionista.',
  },
];

export default function Admisiones({ ajustes }) {
  const admissionsYear = ajustes?.admisiones_anio || '2027';
  const admissionsTitle = ajustes?.admisiones_titulo || 'Únete a la Familia Presentacionista';
  const admissionsDescription = ajustes?.admisiones_descripcion
    || `Las inscripciones para el año lectivo ${admissionsYear} están abiertas. Cupos limitados en todos los niveles. Da el primer paso hacia una educación de excelencia.`;
  const buttonText = ajustes?.admisiones_boton_texto || 'Inscríbete Ahora';
  const buttonUrl = resolveAdmissionsUrl(ajustes?.admisiones_boton_url);
  const callText = ajustes?.admisiones_llamada_texto || `Llamar: ${ajustes?.telefono || '311 6304190'}`;
  const phoneHref = `tel:${(ajustes?.telefono || '3116304190').replace(/\D/g, '')}`;

  return (
    <section className="adm section section--navy" id="admisiones">
      <div className="container">
        <div className="adm__layout">
          <div className="adm__left">
            <span className="eyebrow">Admisiones {admissionsYear}</span>
            <span className="divider-gold" />
            <h2 className="section-title section-title--white">
              {admissionsTitle}
            </h2>
            <p className="section-subtitle section-subtitle--white">
              {admissionsDescription}
            </p>

            <div className="adm__ctas">
              <a href={buttonUrl} className="adm__btn adm__btn--primary" id="adm-inscribete-btn">
                {buttonText}
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                  <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
              </a>
              <a href={phoneHref} className="adm__btn adm__btn--outline" id="adm-llamar-btn">
                {callText}
              </a>
            </div>

            <div className="adm__info-tags">
              <span className="adm__tag">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12" /></svg>
                Cupos disponibles
              </span>
              <span className="adm__tag">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12" /></svg>
                Proceso 100% online
              </span>
            </div>
          </div>

          <div className="adm__right">
            <div className="adm__steps-label">Proceso de admisión</div>
            <div className="adm__steps">
              {pasos.map((paso, index) => (
                <div className="adm__step" key={paso.num} id={`adm-step-${index + 1}`}>
                  <div className="adm__step-num">{paso.num}</div>
                  <div className="adm__step-body">
                    <h4 className="adm__step-title">{paso.titulo}</h4>
                    <p className="adm__step-desc">{paso.desc}</p>
                  </div>
                  {index < pasos.length - 1 && <div className="adm__step-connector" />}
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
