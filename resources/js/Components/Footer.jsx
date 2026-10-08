import './Footer.css';
import ColegiosProvincia from './ColegiosProvincia';
import { storageUrl } from '../utils/url';

const defaultCertificaciones = [
  {
    imagen: '/images/certificaciones/icontec-iqnet.png',
    titulo: 'Certificación Icontec ISO 21001 e IQNet - SGOE-CER950417',
    alt: 'Certificación Icontec ISO 21001 e IQNet',
  },
  {
    imagen: '/images/certificaciones/icontec-iso9001.png',
    titulo: 'Certificación Icontec ISO 9001',
    alt: 'Certificación Icontec ISO 9001',
  },
];

const socialLinks = [
  {
    id: 'facebook',
    label: 'Facebook',
    href: 'https://facebook.com/colegiopresentacionneiva',
    icon: (
      <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
      </svg>
    ),
  },
  {
    id: 'instagram',
    label: 'Instagram',
    href: 'https://instagram.com/colegiopresentacionneiva',
    icon: (
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
        <circle cx="12" cy="12" r="4"/>
        <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor"/>
      </svg>
    ),
  },
  {
    id: 'whatsapp',
    label: 'WhatsApp',
    href: 'https://wa.me/573100000000',
    icon: (
      <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
      </svg>
    ),
  },
];

const getAdmissionsYear = (ajustes) => ajustes?.admisiones_anio || '2027';

const getFooterLinks = (ajustes) => ({
  institucional: [
    { label: 'Quiénes Somos', href: '/nuestra-institucion/recorrido-historico' },
    { label: 'Misión y Visión', href: '/nuestra-institucion/mision' },
    { label: 'Marie Poussepin', href: '/nuestra-institucion/marie-poussepin' },
    { label: 'Gobierno Escolar', href: '/nuestra-institucion/organizacion' },
    { label: 'Proyecto Educativo (PEI)', href: '/nuestra-institucion/pei-general' },
    { label: 'Trabaja con Nosotros', href: '/comunicaciones-contacto/trabaja-con-nosotros' },
  ],
  educativa: [
    { label: 'Preescolar', href: '/nuestra-institucion/seccion-preescolar' },
    { label: 'Básica Primaria', href: '/nuestra-institucion/seccion-primaria' },
    { label: 'Bachillerato', href: '/nuestra-institucion/seccion-bachillerato' },
    { label: 'Plan de Estudios', href: '/gestion-academica/plan-de-estudios' },
    { label: 'Calendario Académico', href: '/gestion-academica/calendario-academico' },
  ],
  servicios: [
    { label: `Admisiones ${getAdmissionsYear(ajustes)}`, href: '/admisiones/inscripcion-en-linea' },
    { label: 'Plataforma SYSCOLEGIOS', href: 'https://www.syscolegios.org/', external: true },
    { label: 'PQRS', href: '/comunicaciones-contacto/pqrs' },
    { label: 'Contáctenos', href: '/comunicaciones-contacto/contactenos' },
    { label: 'Comunidad de Egresados', href: '/servicios/egresados-exalumnos' },
  ],
});

export default function Footer({ ajustes, mostrarProvincia = true }) {
  const year = new Date().getFullYear();
  const footerLinks = getFooterLinks(ajustes);
  
  // Mix static links with dynamic ones if available
  const dynamicSocialLinks = socialLinks.map(link => {
    if (ajustes && ajustes[link.id]) {
      return { ...link, href: ajustes[link.id] };
    }
    return link;
  });

  // Dynamic certifications (Icontec, IQNet, etc.)
  const rawCertificaciones = ajustes?.footer_certificaciones;
  const certificacionesList = Array.isArray(rawCertificaciones) && rawCertificaciones.length > 0
    ? rawCertificaciones
    : defaultCertificaciones;

  return (
    <footer className="footer" id="footer">
      {mostrarProvincia && <ColegiosProvincia />}

      {/* Top Bar */}
      <div className="footer__top">
        <div className="container footer__top-inner">
          <div className="footer__brand">
            <img
              src="/logo.png"
              alt="Escudo Colegio de La Presentación de Neiva"
              className="footer__logo-img"
            />
          </div>

          <p className="footer__tagline">
            Formando personas íntegras desde {ajustes?.footer_anio_fundacion || '1882'},<br />
            {ajustes?.footer_lema || 'inspiradas en el carisma de Marie Poussepin.'}
          </p>

          {certificacionesList && certificacionesList.length > 0 && (
            <div className="footer__certifications">
              {certificacionesList.map((cert, index) => {
                const src = storageUrl(cert.imagen) || cert.imagen;
                if (!src) return null;
                const altText = cert.alt || cert.titulo || 'Certificación Icontec';
                const imgElement = (
                  <img
                    src={src}
                    alt={altText}
                    className="footer__cert-img"
                    title={cert.titulo || altText}
                    loading="lazy"
                  />
                );

                if (cert.url) {
                  return (
                    <a
                      key={index}
                      href={cert.url}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="footer__cert-link"
                      aria-label={cert.titulo || altText}
                    >
                      {imgElement}
                    </a>
                  );
                }

                return (
                  <div key={index} className="footer__cert-wrapper">
                    {imgElement}
                  </div>
                );
              })}
            </div>
          )}

          <div className="footer__social">
            {dynamicSocialLinks.map((s) => (
              <a
                key={s.id}
                href={s.href}
                className="footer__social-link"
                id={`footer-social-${s.id}`}
                aria-label={s.label}
                target="_blank"
                rel="noopener noreferrer"
              >
                {s.icon}
              </a>
            ))}
          </div>
        </div>
      </div>

      {/* Main Footer */}
      <div className="footer__main">
        <div className="container footer__main-grid">
          {/* Map */}
          <div className="footer__map-col">
            <h4 className="footer__col-title">Ubicación</h4>
            <div className="footer__map-wrap">
              <iframe
                title="Ubicación Colegio La Presentación Neiva"
                src="https://maps.google.com/maps?q=Cra.%207%20No.%208-19%20-%20Neiva,%20Huila,%20Colombia&t=&z=15&ie=UTF8&iwloc=&output=embed"
                width="100%"
                height="200"
                style={{ border: 0, borderRadius: '6px', filter: 'grayscale(30%) contrast(1.05)' }}
                allowFullScreen=""
                loading="lazy"
                referrerPolicy="no-referrer-when-downgrade"
              />
            </div>
            <div className="footer__address">
              <p>
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                </svg>
                {ajustes?.direccion || 'Cra. 7 No. 8-19 - Neiva, Huila, Colombia.'}
              </p>
              <p>
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.18 2 2 0 0 1 3.58 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.54a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                {ajustes?.telefono || '311 6304190'}
              </p>
              <p>
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                </svg>
                {ajustes?.email || 'info@colpresentacioneiva.edu.co'}
              </p>
            </div>
          </div>

          {/* Links */}
          <div className="footer__links-col">
            <h4 className="footer__col-title">Institucional</h4>
            <ul className="footer__links-list">
              {footerLinks.institucional.map((l) => (
                <li key={l.label}>
                  {l.href && !l.href.startsWith('#') ? (
                    <a href={l.href} className="footer__link" target={l.external ? "_blank" : undefined} rel={l.external ? "noopener noreferrer" : undefined}>{l.label}</a>
                  ) : (
                    <span className="footer__link footer__link--static">{l.label}</span>
                  )}
                </li>
              ))}
            </ul>
          </div>

          <div className="footer__links-col">
            <h4 className="footer__col-title">Oferta Educativa</h4>
            <ul className="footer__links-list">
              {footerLinks.educativa.map((l) => (
                <li key={l.label}>
                  {l.href && !l.href.startsWith('#') ? (
                    <a href={l.href} className="footer__link" target={l.external ? "_blank" : undefined} rel={l.external ? "noopener noreferrer" : undefined}>{l.label}</a>
                  ) : (
                    <span className="footer__link footer__link--static">{l.label}</span>
                  )}
                </li>
              ))}
            </ul>
          </div>

          <div className="footer__links-col">
            <h4 className="footer__col-title">Servicios</h4>
            <ul className="footer__links-list">
              {footerLinks.servicios.map((l) => (
                <li key={l.label}>
                  {l.href && !l.href.startsWith('#') ? (
                    <a href={l.href} className="footer__link" target={l.external ? "_blank" : undefined} rel={l.external ? "noopener noreferrer" : undefined}>{l.label}</a>
                  ) : (
                    <span className="footer__link footer__link--static">{l.label}</span>
                  )}
                </li>
              ))}
            </ul>
          </div>
        </div>
      </div>

      {/* Bottom Bar */}
      <div className="footer__bottom">
        <div className="container footer__bottom-inner">
          <p className="footer__copyright">
            © {year} Colegio de La Presentación de Neiva. Todos los derechos reservados.
          </p>
          <div className="footer__legal">
            <a href="/calidad-y-pastoral/politica-de-privacidad" className="footer__legal-link">Política de Privacidad</a>
            <span className="footer__legal-sep">·</span>
            <a href="/gestion-comunitaria/manual-de-convivencia" className="footer__legal-link">Manual de Convivencia</a>
            <span className="footer__legal-sep">·</span>
            <span className="footer__legal-info">Código DANE: 341001000105</span>
          </div>
        </div>
      </div>
    </footer>
  );
}
