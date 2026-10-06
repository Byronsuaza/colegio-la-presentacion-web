import React, { useState, useCallback } from 'react';
import { Head } from '@inertiajs/react';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';
import ComitesAcademicos from '../Components/ComitesAcademicos';
import PqrsForm from '../Components/PqrsForm';
import PruebasLock from '../Components/PruebasLock';
import { SkeletonGalleryCard } from '../Components/Skeleton';
import '../Components/Skeleton.css';
import { sanitizeHtml } from '../utils/sanitize';
import { storageUrl } from '../utils/url';
import './MenuPage.css';

const resourceHref = (link) => {
  if (link.archivo) {
    const params = new URLSearchParams();
    params.set('title', link.label);
    return `/visor-pdf/${link.archivo}?${params.toString()}`;
  }
  return link.url;
};

const isExternalResource = (link) => {
  if (link.archivo) return false;
  return link.url?.startsWith('http://') || link.url?.startsWith('https://');
};

const isDriveLink = (link) => {
  if (!link?.url) return false;
  const url = link.url.toLowerCase();
  return (
    url.includes('drive.google.com') &&
    (url.includes('/file/d/') || url.includes('id=') || url.includes('/preview') || url.includes('/view'))
  );
};

const getDriveEmbedUrl = (url) => {
  if (!url) return null;
  const cleanUrl = url.trim();
  if (cleanUrl.includes('drive.google.com')) {
    let fileId = '';
    try {
      if (cleanUrl.includes('/file/d/')) {
        fileId = cleanUrl.split('/file/d/')[1]?.split('/')[0]?.split('?')[0] || '';
      } else if (cleanUrl.includes('id=')) {
        const query = cleanUrl.split('?')[1] || '';
        const urlParams = new URLSearchParams(query);
        fileId = urlParams.get('id') || '';
      }
    } catch (e) {
      console.error("Error parsing Drive URL", e);
    }
    return fileId ? `https://drive.google.com/file/d/${fileId}/preview` : cleanUrl;
  }
  return null;
};

const isPureVideoLink = (link) => {
  if (!link?.url) return false;
  const url = link.url.toLowerCase();
  return url.includes('youtube.com') || url.includes('youtu.be') || url.includes('vimeo.com');
};

const getVideoEmbedUrl = (url) => {
  if (!url) return null;
  const cleanUrl = url.trim();

  // YouTube
  if (cleanUrl.includes('youtube.com') || cleanUrl.includes('youtu.be')) {
    let videoId = '';
    try {
      if (cleanUrl.includes('youtube.com/watch')) {
        const urlParams = new URLSearchParams(cleanUrl.split('?')[1]);
        videoId = urlParams.get('v') || '';
      } else if (cleanUrl.includes('youtu.be/')) {
        videoId = cleanUrl.split('youtu.be/')[1]?.split('?')[0] || '';
      } else if (cleanUrl.includes('youtube.com/embed/')) {
        videoId = cleanUrl.split('youtube.com/embed/')[1]?.split('?')[0] || '';
      }
    } catch (e) {
      console.error("Error parsing YouTube URL", e);
    }
    return videoId ? `https://www.youtube.com/embed/${videoId}` : null;
  }
  
  // Vimeo
  if (cleanUrl.includes('vimeo.com')) {
    const videoId = cleanUrl.split('vimeo.com/')[1]?.split('?')[0] || '';
    return videoId ? `https://player.vimeo.com/video/${videoId}` : null;
  }
  
  // Google Drive
  if (cleanUrl.includes('drive.google.com')) {
    return getDriveEmbedUrl(cleanUrl);
  }
  
  return null;
};

export default function MenuPage({ page, sectionPages = [], ajustes, galleryAlbums = [], areasAcademicas = [], pruebasProtegida = false }) {
  const isPruebas = page.base === 'gestion-academica' && page.slug === 'pruebas-diagnosticas';
  const [unlocked, setUnlocked] = useState(false);
  const handleUnlock = useCallback(() => setUnlocked(true), []);

  const isLocked = isPruebas && pruebasProtegida && !unlocked;
  const currentPath = `/${page.base}/${page.slug}`;
  const imageUrl = storageUrl(page.image);
  const hasContent = Boolean(page.content);
  const contentHasImage = hasContent && /<img[\s>]/i.test(page.content);
  const showFeaturedImage = imageUrl && !contentHasImage;
  const hasGallery = galleryAlbums.length > 0;

  const allLinks = page.links || [];
  const isAdmisiones = page.base === 'admisiones';

  // Clasificación inteligente de enlaces:
  // 1. Enlaces Google Drive para páginas generales (fuera de videos de admisiones)
  const driveLinks = allLinks.filter((l) => {
    if (l.archivo) return false;
    if (isAdmisiones) {
      const label = (l.label || '').toLowerCase();
      if (label.includes('video') || label.includes('bienvenida')) return false;
    }
    return isDriveLink(l);
  });

  // 2. Enlaces de Video (YouTube/Vimeo en general, o videos de bienvenida en Admisiones)
  const videoLinks = allLinks.filter((l) => {
    if (l.archivo) return false;
    if (driveLinks.includes(l)) return false;
    if (isAdmisiones) {
      return isPureVideoLink(l) || isDriveLink(l);
    }
    return isPureVideoLink(l);
  });

  // 3. Enlaces restantes (documentos o recursos no embed)
  const nonVideoLinks = allLinks.filter((l) => {
    return !l.archivo && !videoLinks.includes(l) && !driveLinks.includes(l);
  });

  // Detección de dispositivos móviles o táctiles
  const [isMobile, setIsMobile] = useState(false);
  React.useEffect(() => {
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
      <Head title={page.title} />
      <Navbar ajustes={ajustes} solid />

      <main className="menu-page">
        <section className="menu-page__hero">
          <div className="container menu-page__hero-inner">
            <span className="menu-page__eyebrow">{page.section}</span>
            <h1 className="menu-page__title">{page.title}</h1>
            <p className="menu-page__intro">
              {page.subtitle || 'Información institucional del Colegio de La Presentación de Neiva.'}
            </p>
          </div>
        </section>

        <section className="menu-page__body section">
          <div className="container menu-page__grid">
            <aside className="menu-page__aside" aria-label={`Secciones de ${page.section}`}>
              <span className="menu-page__aside-title">{page.section}</span>
              <nav className="menu-page__nav">
                {sectionPages.map((item) => {
                  const href = item.url_externa || `/${page.base}/${item.slug}`;
                  const isExternal = Boolean(item.url_externa);
                  return (
                    <a
                      key={item.slug}
                      href={href}
                      className={`menu-page__nav-link ${!isExternal && href === currentPath ? 'menu-page__nav-link--active' : ''}`}
                      target={isExternal ? '_blank' : undefined}
                      rel={isExternal ? 'noopener noreferrer' : undefined}
                    >
                      {item.title}
                    </a>
                  );
                })}
              </nav>
            </aside>

            <article className="menu-page__content">
              {isLocked ? (
                <PruebasLock onUnlock={handleUnlock} />
              ) : page.slug === 'comites-academicos-por-areas' ? (
                <ComitesAcademicos areas={areasAcademicas} />
              ) : page.slug === 'pqrs' ? (
                <PqrsForm />
              ) : (
                <>
                  {showFeaturedImage && (
                    <img
                      src={imageUrl}
                      alt={page.title}
                      className="menu-page__featured-img"
                      loading="lazy"
                    />
                  )}

                  <span className="divider-gold" />
                  <h2 className="menu-page__section-title">{page.title}</h2>

                  {hasContent ? (
                    <div
                      className="menu-page__rich-text"
                      dangerouslySetInnerHTML={{ __html: sanitizeHtml(page.content) }}
                    />
                  ) : (
                    <div className="menu-page__notice">
                      <span className="menu-page__notice-label">Estado</span>
                      <p>
                        Página creada y lista para cargar contenido desde el panel administrador.
                      </p>
                    </div>
                  )}

                  {nonVideoLinks.length > 0 && (
                    <div className="menu-page__resources">
                      <span className="menu-page__notice-label">Recursos</span>
                      <div className="menu-page__resource-list">
                        {nonVideoLinks.map((link) => (
                          <a
                            key={`${link.label}-${link.url || link.archivo}`}
                            href={resourceHref(link)}
                            className="menu-page__resource-link"
                            target={isExternalResource(link) ? '_blank' : undefined}
                            rel={isExternalResource(link) ? 'noopener noreferrer' : undefined}
                          >
                            {link.label}
                          </a>
                        ))}
                      </div>
                    </div>
                  )}

                  {driveLinks.length > 0 && (
                    <DriveSection driveLinks={driveLinks} />
                  )}

                  {videoLinks.length > 0 && (
                    <VideoSection videoLinks={videoLinks} isAdmisiones={isAdmisiones} />
                  )}

                  {page.links?.length > 0 && page.links.some((l) => l.archivo) && (
                    <div className="menu-page__pdf-viewer">
                      <div className="menu-page__pdf-viewer-header">
                        <h3>Documentos</h3>
                      </div>
                      <div className="menu-page__pdf-container">
                        {page.links.map((link) =>
                          link.archivo ? (
                            <div key={`pdf-${link.archivo}`} className="menu-page__pdf-section">
                              <h4>{link.label}</h4>
                              {isMobile ? (
                                <div className="menu-page__pdf-mobile-fallback">
                                  <div className="pdf-fallback-icon" aria-hidden="true">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                      <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                      <polyline points="14 2 14 8 20 8" />
                                    </svg>
                                  </div>
                                  <p>El lector de PDF interactivo podría no visualizarse correctamente en su celular o tablet.</p>
                                  <a 
                                    href={storageUrl(link.archivo)} 
                                    className="menu-page__btn menu-page__btn--primary" 
                                    target="_blank" 
                                    rel="noopener noreferrer"
                                  >
                                    Abrir Documento directamente
                                  </a>
                                </div>
                              ) : (
                                <>
                                  <div className="pdf-actions-bar">
                                    <a 
                                      href={storageUrl(link.archivo)} 
                                      className="pdf-action-link" 
                                      target="_blank" 
                                      rel="noopener noreferrer"
                                    >
                                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" style={{ marginRight: '6px' }}>
                                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                                        <polyline points="15 3 21 3 21 9" />
                                        <line x1="10" y1="14" x2="21" y2="3" />
                                      </svg>
                                      Abrir en pestaña nueva
                                    </a>
                                  </div>
                                  <iframe
                                    src={storageUrl(link.archivo)}
                                    title={link.label}
                                    className="menu-page__pdf-iframe"
                                  />
                                </>
                              )}
                            </div>
                          ) : null
                        )}
                      </div>
                    </div>
                  )}

                  {hasGallery && <GallerySection galleryAlbums={galleryAlbums} />}

                  <div className="menu-page__actions">
                    <a href="/" className="menu-page__btn menu-page__btn--primary">
                      Volver al inicio
                    </a>
                    <a href="/comunicaciones-contacto/contactenos" className="menu-page__btn menu-page__btn--ghost">
                      Contactar al colegio
                    </a>
                  </div>
                </>
              )}
            </article>
          </div>
        </section>
      </main>

      <Footer ajustes={ajustes} />
    </>
  );
}

/* ─── Google Drive Document Viewer Component ──────────────────────── */
function DriveSection({ driveLinks }) {
  const [activeIdx, setActiveIdx] = React.useState(0);

  if (!driveLinks || driveLinks.length === 0) return null;

  const currentDoc = driveLinks[activeIdx] || driveLinks[0];
  const embedUrl = getDriveEmbedUrl(currentDoc.url);

  return (
    <div className="menu-page__drive-viewer">
      <div className="menu-page__drive-header">
        <div className="menu-page__drive-header-text">
          <div className="menu-page__drive-badge">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
              <polyline points="14 2 14 8 20 8" />
              <line x1="16" y1="13" x2="8" y2="13" />
              <line x1="16" y1="17" x2="8" y2="17" />
              <polyline points="10 9 9 9 8 9" />
            </svg>
            <span>Documento Interactivo / Recurso en Línea</span>
          </div>
          <h3 className="menu-page__drive-title">{currentDoc.label || 'Documento Institucional'}</h3>
        </div>

        {currentDoc.url && (
          <a
            href={currentDoc.url}
            target="_blank"
            rel="noopener noreferrer"
            className="menu-page__drive-open-btn"
          >
            <span>Abrir en Google Drive</span>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
              <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
              <polyline points="15 3 21 3 21 9" />
              <line x1="10" y1="14" x2="21" y2="3" />
            </svg>
          </a>
        )}
      </div>

      {driveLinks.length > 1 && (
        <div className="menu-page__drive-tabs">
          {driveLinks.map((doc, idx) => (
            <button
              key={idx}
              type="button"
              className={`menu-page__drive-tab ${idx === activeIdx ? 'menu-page__drive-tab--active' : ''}`}
              onClick={() => setActiveIdx(idx)}
            >
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
              </svg>
              <span>{doc.label}</span>
            </button>
          ))}
        </div>
      )}

      <div className="menu-page__drive-card">
        <div className="menu-page__drive-iframe-wrap">
          {embedUrl ? (
            <iframe
              src={embedUrl}
              title={currentDoc.label || 'Documento Google Drive'}
              frameBorder="0"
              allow="autoplay"
              allowFullScreen
            />
          ) : (
            <div className="menu-page__video-placeholder">
              <p>No se pudo generar la vista previa interactiva de este enlace.</p>
              <a
                href={currentDoc.url}
                target="_blank"
                rel="noopener noreferrer"
                className="menu-page__video-direct-btn"
              >
                Abrir en Google Drive
              </a>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}

/* ─── Video Section Component ───────────────────────────────────── */
function VideoSection({ videoLinks, isAdmisiones = false }) {
  const [activeIdx, setActiveIdx] = React.useState(0);

  if (!videoLinks || videoLinks.length === 0) return null;

  const currentVideo = videoLinks[activeIdx] || videoLinks[0];
  const embedUrl = getVideoEmbedUrl(currentVideo.url);
  const hasPlaylist = videoLinks.length > 1;

  return (
    <div className="menu-page__video-viewer">
      <div className="menu-page__video-viewer-header">
        <span className="menu-page__notice-label">Material Audiovisual</span>
        <h3>
          {isAdmisiones ? 'Videos Informativos y de Bienvenida' : (currentVideo.label || 'Video Informativo')}
        </h3>
      </div>
      
      <div className={`menu-page__video-player-container ${hasPlaylist ? 'menu-page__video-player-container--with-playlist' : 'menu-page__video-player-container--single'}`}>
        {/* Main video player */}
        <div className="menu-page__video-main">
          {embedUrl ? (
            <div className="menu-page__video-ratio">
              <iframe
                src={embedUrl}
                title={currentVideo.label}
                frameBorder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowFullScreen
              />
            </div>
          ) : (
            <div className="menu-page__video-placeholder">
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
                <polygon points="5 3 19 12 5 21 5 3"/>
              </svg>
              <p>No se pudo incrustar este video automáticamente.</p>
              <a href={currentVideo.url} target="_blank" rel="noopener noreferrer" className="menu-page__video-direct-btn">
                Ver Video Directamente
              </a>
            </div>
          )}
        </div>

        {/* Playlist selection menu */}
        {hasPlaylist && (
          <div className="menu-page__video-playlist">
            <span className="menu-page__playlist-title">Videos Disponibles</span>
            <div className="menu-page__playlist-items">
              {videoLinks.map((video, idx) => {
                const isActive = idx === activeIdx;
                return (
                  <button
                    key={idx}
                    className={`menu-page__playlist-item ${isActive ? 'menu-page__playlist-item--active' : ''}`}
                    onClick={() => setActiveIdx(idx)}
                    type="button"
                  >
                    <div className="menu-page__playlist-icon">
                      {isActive ? (
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                          <polygon points="5 3 19 12 5 21 5 3"/>
                        </svg>
                      ) : (
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                          <polygon points="5 3 19 12 5 21 5 3"/>
                        </svg>
                      )}
                    </div>
                    <span className="menu-page__playlist-label">{video.label}</span>
                  </button>
                );
              })}
            </div>
          </div>
        )}
      </div>
    </div>
  );
}

/* ─── Gallery Section + Album Modal ─────────────────────────────── */
function GallerySection({ galleryAlbums }) {
  const [activeAlbum, setActiveAlbum] = React.useState(null);
  const [activeIdx, setActiveIdx] = React.useState(0);

  const allImages = activeAlbum
    ? (activeAlbum.imagenes || []).map((img) => storageUrl(img)).filter(Boolean)
    : [];

  const modalRef = React.useRef(null);

  const openAlbum = (album) => {
    setActiveAlbum(album);
    setActiveIdx(0);
    document.body.style.overflow = 'hidden';
  };

  const closeAlbum = () => {
    setActiveAlbum(null);
    document.body.style.overflow = '';
  };

  const prev = () => setActiveIdx((i) => (i - 1 + allImages.length) % allImages.length);
  const next = () => setActiveIdx((i) => (i + 1) % allImages.length);

  React.useEffect(() => {
    if (!activeAlbum) return;
    const handler = (e) => {
      if (e.key === 'Escape') {
        closeAlbum();
        return;
      }
      if (e.key === 'ArrowLeft') {
        prev();
        return;
      }
      if (e.key === 'ArrowRight') {
        next();
        return;
      }

      // Trampa de foco (Accessibility Focus Trap) para teclado
      if (e.key === 'Tab' && modalRef.current) {
        const focusableElements = modalRef.current.querySelectorAll(
          'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
        );
        
        if (focusableElements.length > 0) {
          const firstElement = focusableElements[0];
          const lastElement = focusableElements[focusableElements.length - 1];

          if (e.shiftKey) { // Shift + Tab
            if (document.activeElement === firstElement) {
              lastElement.focus();
              e.preventDefault();
            }
          } else { // Tab
            if (document.activeElement === lastElement) {
              firstElement.focus();
              e.preventDefault();
            }
          }
        }
      }
    };
    
    window.addEventListener('keydown', handler);
    
    // Auto enfocamos el botón de cierre para iniciar la navegación de teclado
    setTimeout(() => {
      const closeBtn = modalRef.current?.querySelector('.album-modal__close');
      closeBtn?.focus();
    }, 50);

    return () => window.removeEventListener('keydown', handler);
  }, [activeAlbum, activeIdx, allImages.length]);

  return (
    <>
      <section className="gallery-albums" aria-label="Álbumes de galería">
        <div className="gallery-albums__header">
          <span className="menu-page__notice-label">Álbumes</span>
          <h3>Actividades y eventos</h3>
        </div>

        <div className="gallery-albums__grid">
          {galleryAlbums.length === 0 ? (
            <>
              <SkeletonGalleryCard />
              <SkeletonGalleryCard />
              <SkeletonGalleryCard />
            </>
          ) : (
            galleryAlbums.map((album) => {
              const cover = storageUrl(album.portada || album.imagenes?.[0]);
              const mediaCount = (album.imagenes?.length || 0) + (album.videos?.length || 0);

              return (
                <article
                  className="gallery-card"
                  key={album.id}
                  onClick={() => openAlbum(album)}
                  role="button"
                  tabIndex={0}
                  aria-label={`Abrir álbum: ${album.titulo}`}
                  onKeyDown={(e) => e.key === 'Enter' && openAlbum(album)}
                >
                  <div className="gallery-card__media">
                    {cover ? (
                      <img src={cover} alt={album.titulo} loading="lazy" />
                    ) : (
                      <div className="gallery-card__placeholder">
                        {album.titulo.slice(0, 1)}
                      </div>
                    )}
                    <span className="gallery-card__count">{mediaCount} recursos</span>
                    <div className="gallery-card__overlay">
                      <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                        <circle cx="8.5" cy="8.5" r="1.5" />
                        <polyline points="21 15 16 10 5 21" />
                      </svg>
                      <span>Ver álbum</span>
                    </div>
                  </div>
                  <div className="gallery-card__body">
                    <span className="gallery-card__category">{album.categoria}</span>
                    <h4>{album.titulo}</h4>
                    {album.descripcion && <p>{album.descripcion}</p>}
                    {album.imagenes?.length > 0 && (
                      <div className="gallery-card__thumbs">
                        {album.imagenes.slice(0, 4).map((image) => (
                          <img src={storageUrl(image)} alt="" loading="lazy" key={image} />
                        ))}
                      </div>
                    )}
                  </div>
                </article>
              );
            })
          )}
        </div>
      </section>

      {/* Album Modal */}
      {activeAlbum && (
        <div
          className="album-modal__backdrop"
          onClick={closeAlbum}
          role="dialog"
          aria-modal="true"
          aria-label={`Álbum: ${activeAlbum.titulo}`}
        >
          <div className="album-modal" onClick={(e) => e.stopPropagation()} ref={modalRef}>

            {/* Header */}
            <div className="album-modal__header">
              <div className="album-modal__header-info">
                {activeAlbum.categoria && (
                  <span className="album-modal__category">{activeAlbum.categoria}</span>
                )}
                <h2 className="album-modal__title">{activeAlbum.titulo}</h2>
                {activeAlbum.descripcion && (
                  <p className="album-modal__desc">{activeAlbum.descripcion}</p>
                )}
              </div>
              <button className="album-modal__close" onClick={closeAlbum} aria-label="Cerrar álbum">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                  <line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" />
                </svg>
              </button>
            </div>

            {/* Main Image Viewer */}
            {allImages.length > 0 && (
              <div className="album-modal__viewer">
                <button
                  className="album-modal__nav album-modal__nav--prev"
                  onClick={prev}
                  aria-label="Imagen anterior"
                  disabled={allImages.length <= 1}
                >
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                    <polyline points="15 18 9 12 15 6" />
                  </svg>
                </button>

                <div className="album-modal__img-wrap">
                  <img
                    key={allImages[activeIdx]}
                    src={allImages[activeIdx]}
                    alt={`${activeAlbum.titulo} – foto ${activeIdx + 1}`}
                    className="album-modal__img"
                  />
                  <span className="album-modal__counter">
                    {activeIdx + 1} / {allImages.length}
                  </span>
                </div>

                <button
                  className="album-modal__nav album-modal__nav--next"
                  onClick={next}
                  aria-label="Imagen siguiente"
                  disabled={allImages.length <= 1}
                >
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                    <polyline points="9 18 15 12 9 6" />
                  </svg>
                </button>
              </div>
            )}

            {/* Thumbnail Strip */}
            {allImages.length > 1 && (
              <div className="album-modal__thumbs">
                {allImages.map((img, idx) => (
                  <button
                    key={img}
                    className={`album-modal__thumb ${idx === activeIdx ? 'album-modal__thumb--active' : ''}`}
                    onClick={() => setActiveIdx(idx)}
                    aria-label={`Ver foto ${idx + 1}`}
                  >
                    <img src={img} alt="" loading="lazy" />
                  </button>
                ))}
              </div>
            )}

            {/* Videos */}
            {activeAlbum.videos?.length > 0 && (
              <div className="album-modal__videos">
                <span className="album-modal__videos-label">Videos</span>
                <div className="album-modal__video-links">
                  {activeAlbum.videos.map((video) => (
                    <a
                      key={`${activeAlbum.id}-${video.url}`}
                      href={video.url}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="album-modal__video-link"
                    >
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                        <polygon points="5 3 19 12 5 21 5 3" />
                      </svg>
                      {video.label}
                    </a>
                  ))}
                </div>
              </div>
            )}

          </div>
        </div>
      )}
    </>
  );
}
