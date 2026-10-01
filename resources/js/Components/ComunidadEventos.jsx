import React from 'react';
import './ComunidadEventos.css';

import { parseDate } from '../utils/date';

function getCanvaUrls(rawUrl) {
  if (!rawUrl) return { embedUrl: '', directUrl: '' };

  let url = rawUrl.trim();

  // Si pegaron un iframe completo: <iframe ... src="..." ...>
  const srcMatch = url.match(/src=["']([^"']+)["']/i);
  if (srcMatch) {
    url = srcMatch[1];
  }

  if (url.includes('canva.com')) {
    // Si viene con /edit, cambiar a /view
    url = url.replace(/\/edit(\?.*)?$/i, '/view');

    // Enlace directo limpio
    const directUrl = url.split('?')[0];

    // Asegurar el parámetro ?embed para el iframe
    let embedUrl = url;
    if (!embedUrl.includes('embed')) {
      const sep = embedUrl.includes('?') ? '&' : '?';
      embedUrl = `${embedUrl}${sep}embed`;
    }

    return { embedUrl, directUrl };
  }

  return { embedUrl: url, directUrl: url };
}

export default function ComunidadEventos({ eventos = [], ajustes = {} }) {
  const { embedUrl, directUrl } = getCanvaUrls(ajustes?.evangelio_embed_url);

  return (
    <section className="comunidad-eventos section" id="comunidad-eventos">
      <div className="container">
        <div className="comunidad-eventos__layout">
          {/* Columna Izquierda: Pastoral y Evangelio */}
          <div className="comunidad-eventos__col-pastoral">
            <span className="eyebrow">Pastoral Educativa</span>
            <span className="divider-gold" />
            <h2 className="section-title">
              Evangelio de la <em>Semana</em>
            </h2>
            <p className="section-subtitle">
              Vivimos y cultivamos los valores del Evangelio a través de la reflexión y la oración en comunidad,
              inspirados en el legado de Marie Poussepin.
            </p>

            <div className="comunidad-eventos__pastoral-card">
              {embedUrl ? (
                <>
                  <div className="comunidad-eventos__pastoral-iframe-container">
                    <iframe
                      loading="lazy"
                      title="Evangelio de la Semana - Canva Presentation"
                      className="comunidad-eventos__pastoral-iframe"
                      src={embedUrl}
                      allowFullScreen
                      allow="fullscreen"
                    />
                  </div>
                  {directUrl && (
                    <div className="comunidad-eventos__pastoral-actions">
                      <a
                        href={directUrl}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="comunidad-eventos__canva-btn"
                        title="Abrir presentación en Canva"
                      >
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                          <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                          <polyline points="15 3 21 3 21 9"></polyline>
                          <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                        Ver presentación completa
                      </a>
                    </div>
                  )}
                </>
              ) : (
                <div className="comunidad-eventos__pastoral-empty">
                  <div className="comunidad-eventos__empty-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.2" strokeLinecap="round" strokeLinejoin="round">
                      <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                      <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                    </svg>
                  </div>
                  <blockquote className="comunidad-eventos__empty-quote">
                    "Instruid a los niños en las máximas de la piedad y la caridad cristiana."
                  </blockquote>
                  <cite className="comunidad-eventos__empty-author">— Marie Poussepin</cite>
                  <p className="comunidad-eventos__empty-desc">
                    El Evangelio de la semana estará disponible próximamente. Consúltalo directamente con el departamento de pastoral.
                  </p>
                </div>
              )}
            </div>
          </div>

          {/* Columna Derecha: Próximos Eventos */}
          <div className="comunidad-eventos__col-eventos">
            <span className="eyebrow">Agenda Escolar</span>
            <span className="divider-gold" />
            <h2 className="section-title">
              Próximos <em>Eventos</em>
            </h2>
            <p className="section-subtitle">
              Mantente al día con las actividades, ceremonias y proyectos transversales de nuestra comunidad educativa.
            </p>

            <div className="comunidad-eventos__list">
              {eventos && eventos.length > 0 ? (
                eventos.map((evento, index) => {
                  const { day, month } = parseDate(evento.fecha);
                  return (
                    <div 
                      className="comunidad-eventos__item" 
                      key={evento.id || index}
                      id={`evento-item-${evento.id}`}
                      style={{ animationDelay: `${index * 0.1}s` }}
                    >
                      <div className="comunidad-eventos__date-tag">
                        <span className="comunidad-eventos__date-month">{month}</span>
                        <span className="comunidad-eventos__date-day">{day}</span>
                      </div>
                      <div className="comunidad-eventos__item-body">
                        <h3 className="comunidad-eventos__item-title">{evento.titulo}</h3>
                        <div className="comunidad-eventos__item-meta">
                          {evento.hora && (
                            <span className="comunidad-eventos__meta-info">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="comunidad-eventos__meta-icon">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                              </svg>
                              {evento.hora}
                            </span>
                          )}
                          {evento.lugar && (
                            <span className="comunidad-eventos__meta-info">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="comunidad-eventos__meta-icon">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="12" r="3" />
                              </svg>
                              {evento.lugar}
                            </span>
                          )}
                        </div>
                      </div>
                    </div>
                  );
                })
              ) : (
                <div className="comunidad-eventos__list-empty">
                  <div className="comunidad-eventos__empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.2" strokeLinecap="round" strokeLinejoin="round">
                      <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                      <line x1="16" y1="2" x2="16" y2="6" />
                      <line x1="8" y1="2" x2="8" y2="6" />
                      <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                  </div>
                  <p className="comunidad-eventos__empty-text">No hay eventos programados para los próximos días.</p>
                </div>
              )}
            </div>

            <div className="comunidad-eventos__action">
              <a href="/calendario-eventos" className="comunidad-eventos__btn" id="ver-calendario-completo">
                Ver Calendario de Eventos
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                  <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
