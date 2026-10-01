import React, { useState } from 'react';
import NoticiaModal from './NoticiaModal';
import './Noticias.css';
import { storageUrl } from '../utils/url';
import { formatDate } from '../utils/date';
import { makeExcerpt } from '../utils/text';

const bgColors = ['var(--navy)', 'var(--navy-light)', 'var(--navy-mid)', 'var(--navy)', 'var(--navy-light)'];

export default function Noticias({ noticias = [] }) {
  const [selectedNoticia, setSelectedNoticia] = useState(null);
  const [modalOpen, setModalOpen] = useState(false);

  if (!noticias || noticias.length === 0) {
    return null;
  }

  const handleReadNoticia = (noticia) => {
    setSelectedNoticia(noticia);
    setModalOpen(true);
  };

  const displayNoticias = noticias.slice(0, 3).map((noticia, index) => {
    const rawImage = noticia.imagen || noticia.image || null;
    return {
      id: `noticia-${noticia.id}`,
      categoria: noticia.categoria || 'General',
      fecha: formatDate(noticia.created_at),
      titulo: noticia.titulo,
      descripcion: makeExcerpt(noticia.contenido),
      contenido: noticia.contenido,
      imagen: rawImage ? storageUrl(String(rawImage).trim()) : null,
      destacada: noticia.destacada,
      bgColor: bgColors[index % bgColors.length],
      created_at: noticia.created_at,
    };
  });

  return (
    <section className="noticias section" id="noticias">
      <div className="container">
        <div className="noticias__header">
          <div>
            <span className="eyebrow">Vida Institucional</span>
            <span className="divider-gold" />
            <h2 className="section-title">
              Noticias &<br />
              <em className="noticias__title-em">Eventos</em>
            </h2>
          </div>
          <a href="/noticias" className="noticias__ver-todas" id="noticias-ver-todas-btn">
            Ver todas las noticias
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
        </div>

        <div className="noticias__bento">
          {displayNoticias.map((noticia, index) => (
            <article
              key={noticia.id}
              className="noticias__card"
              onClick={() => handleReadNoticia(noticia)}
            >
              <div className="noticias__card-media">
                {noticia.imagen ? (
                  <img
                    src={noticia.imagen}
                    alt={noticia.titulo}
                    className="noticias__card-img"
                    loading="lazy"
                  />
                ) : (
                  <div className="noticias__card-img-placeholder" />
                )}
              </div>

              <div className="noticias__card-inner">
                <div className="noticias__card-top">
                  <span className={`noticias__cat ${noticia.destacada ? 'noticias__cat--gold' : ''}`}>
                    {noticia.categoria}
                  </span>
                  {noticia.destacada && <span className="noticias__featured-badge">Destacado</span>}
                </div>

                <div className="noticias__card-bottom">
                  <span className="noticias__fecha">{formatDate(noticia.created_at)}</span>
                  <h3 className="noticias__card-title">
                    {noticia.titulo}
                  </h3>
                  <p className="noticias__card-desc">
                    {noticia.descripcion}
                  </p>
                  <span className="noticias__read-link">Leer más</span>
                </div>
              </div>
            </article>
          ))}
        </div>
      </div>

      <NoticiaModal 
        isOpen={modalOpen} 
        onClose={() => setModalOpen(false)} 
        noticia={selectedNoticia} 
      />
    </section>
  );
}
