import React, { useEffect } from 'react';
import { sanitizeHtml } from '../utils/sanitize';
import { storageUrl } from '../utils/url';
import './NoticiaModal.css';

export default function NoticiaModal({ isOpen, onClose, noticia }) {
  // Prevent background scroll when modal is open
  useEffect(() => {
    if (isOpen) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }
    return () => {
      document.body.style.overflow = '';
    };
  }, [isOpen]);

  // Handle ESC key press
  useEffect(() => {
    const handleKeyDown = (e) => {
      if (e.key === 'Escape') onClose();
    };
    if (isOpen) {
      window.addEventListener('keydown', handleKeyDown);
    }
    return () => {
      window.removeEventListener('keydown', handleKeyDown);
    };
  }, [isOpen, onClose]);

  if (!isOpen || !noticia) return null;

  return (
    <div className="noticia-modal-overlay" onClick={onClose} aria-modal="true" role="dialog">
      <div className="noticia-modal" onClick={(e) => e.stopPropagation()}>
        <button className="noticia-modal__close" onClick={onClose} aria-label="Cerrar modal">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
          </svg>
        </button>

        <div className="noticia-modal__container">
          {noticia.imagen && (
            <div className="noticia-modal__banner">
              <img src={storageUrl(noticia.imagen)} alt={noticia.titulo} className="noticia-modal__image" />
              <div className="noticia-modal__banner-overlay" />
            </div>
          )}

          <div className="noticia-modal__body">
            <div className="noticia-modal__meta">
              <span className="noticia-modal__category">{noticia.categoria}</span>
              {noticia.destacada && <span className="noticia-modal__featured">Destacado</span>}
              <span className="noticia-modal__date">{noticia.fecha}</span>
            </div>

            <h2 className="noticia-modal__title">{noticia.titulo}</h2>
            
            <div className="noticia-modal__divider" />

            <div 
              className="noticia-modal__content rich-text"
              dangerouslySetInnerHTML={{ __html: sanitizeHtml(noticia.contenido || noticia.descripcion) }}
            />
          </div>
        </div>
      </div>
    </div>
  );
}
