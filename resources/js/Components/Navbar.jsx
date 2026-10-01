import { useEffect, useState } from 'react';
import { usePage } from '@inertiajs/react';
import './Navbar.css';

const getLinkHref = (link, base) => {
  if (link.url_externa) return link.url_externa;
  if (link.href) return link.href;
  return `${base}/${link.slug}`;
};

const isExternal = (link) =>
  Boolean(link.external || link.url_externa);

const renderLink = (link, className, onClick, base = '') => (
  <a
    key={link.label}
    href={getLinkHref(link, base)}
    className={className}
    onClick={onClick}
    target={isExternal(link) ? '_blank' : undefined}
    rel={isExternal(link) ? 'noopener noreferrer' : undefined}
  >
    {link.label}
  </a>
);

export default function Navbar({ ajustes, solid = false }) {
  const { navGroups = [] } = usePage().props;
  const isBrowser = typeof window !== 'undefined';
  const isHomePath = isBrowser && window.location && window.location.pathname === '/';
  const [scrolled, setScrolled] = useState(solid || (isBrowser && !isHomePath));
  const [menuOpen, setMenuOpen] = useState(false);
  const [activeDropdown, setActiveDropdown] = useState(null);
  const admissionsYear = ajustes?.admisiones_anio || '2027';
  const admissionsLabel = `Admisiones ${admissionsYear}`;

  // Filtrar la sección de Admisiones del menú principal (se muestra aparte como CTA)
  const mainNavGroups = navGroups.filter((g) => g.base !== '/admisiones');
  const admisionesGroup = navGroups.find((g) => g.base === '/admisiones');
  const dynamicAdmissionsLinks = admisionesGroup?.columns?.flatMap((c) => c.links);
  const admissionsLinks = dynamicAdmissionsLinks && dynamicAdmissionsLinks.length > 0
    ? dynamicAdmissionsLinks
    : [
        { label: 'Inscripción en Línea', href: '/admisiones/inscripcion-en-linea' },
        { label: 'Separación de Cupo', href: 'https://www.syscolegios.org/HojasdeVida/control_est.php', external: true },
      ];

  useEffect(() => {
    const handleScroll = () => setScrolled(solid || (!isHomePath) || window.scrollY > 60);
    window.addEventListener('scroll', handleScroll, { passive: true });
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  useEffect(() => {
    document.body.classList.toggle('navbar-menu-open', menuOpen);
    return () => document.body.classList.remove('navbar-menu-open');
  }, [menuOpen]);

  const closeMobileMenu = () => {
    setMenuOpen(false);
    setActiveDropdown(null);
  };

  const toggleDropdown = (label) => {
    setActiveDropdown((current) => (current === label ? null : label));
  };

  return (
    <nav className={`navbar ${(scrolled || solid) ? 'navbar--scrolled' : ''}`} id="navbar">
      <div className="navbar__container">
        <a href="/" className="navbar__logo" aria-label="Ir al inicio">
          <img
            src="/logo.png"
            alt="Escudo Colegio de La Presentación de Neiva"
            className="navbar__logo-img"
          />
        </a>

        <ul className="navbar__links" aria-label="Menú principal">
          {mainNavGroups.map((item, index) => (
            <li
              key={item.label}
              className={`navbar__item ${index >= mainNavGroups.length - 2 ? 'navbar__item--align-end' : ''}`}
            >
              <button className="navbar__link" type="button" aria-haspopup="true">
                {item.label}
                <svg className="navbar__dropdown-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                  <polyline points="6 9 12 15 18 9" />
                </svg>
              </button>

              <div className={`navbar__dropdown navbar__dropdown--cols-${Math.min(item.columns.length, 4)}`}>
                <div className={`navbar__mega-grid navbar__mega-grid--${Math.min(item.columns.length, 4)}`}>
                  {item.columns.map((column) => (
                    <div key={column.title} className="navbar__mega-column">
                      <span className="navbar__mega-title">{column.title}</span>
                      {column.links.map((link) => renderLink(link, 'navbar__dropdown-link', undefined, item.base))}
                    </div>
                  ))}
                </div>
              </div>
            </li>
          ))}
        </ul>

        <div className="navbar__ctas">
          <a
            href={ajustes?.pago_en_linea_url || '#'}
            className="navbar__pago-btn"
            target="_blank"
            rel="noopener noreferrer"
            id="navbar-pago-btn"
          >
            Pago en Línea
          </a>

          <div className="navbar__cta-wrap">
            <a href="/admisiones/inscripcion-en-linea" className="navbar__cta" id="navbar-admisiones-btn">
              {admissionsLabel}
            </a>
            <div className="navbar__cta-menu" aria-label="Opciones de admisiones">
              {admissionsLinks.map((link) => renderLink(link, 'navbar__cta-link', undefined, '/admisiones'))}
            </div>
          </div>
        </div>

        <button
          className={`navbar__hamburger ${menuOpen ? 'navbar__hamburger--open' : ''}`}
          onClick={() => setMenuOpen((open) => !open)}
          aria-expanded={menuOpen}
          aria-label={menuOpen ? 'Cerrar menú' : 'Abrir menú'}
          id="navbar-hamburger-btn"
          type="button"
        >
          <span /><span /><span />
        </button>
      </div>

      <div className={`navbar__mobile ${menuOpen ? 'navbar__mobile--open' : ''}`}>
        {mainNavGroups.map((item) => (
          <div key={item.label} className="navbar__mobile-item">
            <button
              className={`navbar__mobile-link-btn ${activeDropdown === item.label ? 'navbar__mobile-link-btn--active' : ''}`}
              onClick={() => toggleDropdown(item.label)}
              aria-expanded={activeDropdown === item.label}
              type="button"
            >
              {item.label}
              <svg className={`navbar__mobile-icon ${activeDropdown === item.label ? 'navbar__mobile-icon--open' : ''}`} width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                <polyline points="6 9 12 15 18 9" />
              </svg>
            </button>

            <div className={`navbar__mobile-dropdown ${activeDropdown === item.label ? 'navbar__mobile-dropdown--open' : ''}`}>
              {item.columns.map((column) => (
                <div key={column.title} className="navbar__mobile-group">
                  <span className="navbar__mobile-title">{column.title}</span>
                  {column.links.map((link) => renderLink(link, 'navbar__mobile-sublink', closeMobileMenu, item.base))}
                </div>
              ))}
            </div>
          </div>
        ))}

        <div className="navbar__mobile-admissions">
          <a
            href={ajustes?.pago_en_linea_url || '#'}
            className="navbar__mobile-pago"
            target="_blank"
            rel="noopener noreferrer"
            onClick={closeMobileMenu}
          >
            Pago en Línea
          </a>
          <a href="/admisiones/inscripcion-en-linea" className="navbar__mobile-cta" style={{ marginTop: '0.75rem' }} onClick={closeMobileMenu}>
            {admissionsLabel}
          </a>
          <div className="navbar__mobile-admissions-links">
            {admissionsLinks.map((link) => renderLink(link, 'navbar__mobile-admissions-link', closeMobileMenu, '/admisiones'))}
          </div>
        </div>
      </div>
    </nav>
  );
}
