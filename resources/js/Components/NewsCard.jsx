import React from 'react';
import { formatDate } from '../utils/date';
import { makeExcerpt } from '../utils/text';
import './NewsCard.css';

export default function NewsCard({ noticia, featured = false, onRead }) {
  const handleReadClick = (e) => {
    e.preventDefault();
    if (onRead) onRead(noticia);
  };

  return (
    <div
      className={`noticias__card ${featured ? 'noticias__card--large' : 'noticias__card--small'}`}
      id={featured ? 'noticia-featured' : noticia.id}
      style={{ background: noticia.bgColor }}
    >
      {noticia.imagen ? (
        <img
          src={noticia.imagen}
          alt={noticia.titulo}
          className="noticias__card-img"
          loading="lazy"
        />
      ) : (
        <div className="noticias__card-img placeholder" />
      )}

      <div className="noticias__card-inner">
        <div className="noticias__card-top">
          <span className={`noticias__cat ${featured ? 'noticias__cat--gold' : ''}`}>
            {noticia.categoria}
          </span>
          {noticia.destacada && <span className="noticias__featured-badge">Destacado</span>}
        </div>

        <div className="noticias__card-bottom">
          <span className="noticias__fecha">{formatDate(noticia.created_at)}</span>
          <h3 className={`noticias__card-title ${featured ? 'noticias__card-title--lg' : ''}`}>
            {noticia.titulo}
          </h3>
          <p className={`noticias__card-desc ${featured ? '' : 'noticias__card-desc--sm'}`}>
            {makeExcerpt(noticia.contenido)}
          </p>
          <a href="#" className="noticias__read-link" id={featured ? 'noticia-featured-link' : `${noticia.id}-link`} onClick={handleReadClick}>
            Leer más →
          </a>
        </div>
      </div>
    </div>
  );
}
