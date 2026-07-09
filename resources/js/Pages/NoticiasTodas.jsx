import React, { useState, useMemo } from 'react';
import { Head } from '@inertiajs/react';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';
import NoticiaModal from '../Components/NoticiaModal';
import { storageUrl } from '../utils/url';
import './NoticiasTodas.css';

const bgColors = ['var(--navy)', 'var(--navy-light)', 'var(--navy-mid)'];

const formatDate = (value) => {
  const date = new Date(value);
  if (Number.isNaN(date.getTime())) {
    return '';
  }
  return date.toLocaleDateString('es-ES', {
    day: 'numeric',
    month: 'short',
    year: 'numeric',
  });
};

const makeExcerpt = (content) => {
  const cleanContent = content ? content.replace(/<[^>]+>/g, '') : '';
  return cleanContent.length > 140 ? `${cleanContent.substring(0, 140)}...` : cleanContent;
};

export default function NoticiasTodas({ noticias = [], ajustes = {} }) {
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedCategory, setSelectedCategory] = useState('Todas');
  const [selectedNoticia, setSelectedNoticia] = useState(null);
  const [modalOpen, setModalOpen] = useState(false);

  const mappedNoticias = useMemo(() => {
    return noticias.map((noticia, index) => ({
      ...noticia,
      id: noticia.id,
      categoria: noticia.categoria || 'General',
      fecha: formatDate(noticia.created_at),
      excerpt: makeExcerpt(noticia.contenido),
      imagen: storageUrl(noticia.imagen),
      bgColor: bgColors[index % bgColors.length],
    }));
  }, [noticias]);

  const categorias = useMemo(() => {
    const cats = new Set(mappedNoticias.map(n => n.categoria));
    return ['Todas', ...Array.from(cats)];
  }, [mappedNoticias]);

  const noticiasFiltradas = useMemo(() => {
    return mappedNoticias.filter(noticia => {
      const matchesSearch =
        noticia.titulo.toLowerCase().includes(searchTerm.toLowerCase()) ||
        noticia.excerpt.toLowerCase().includes(searchTerm.toLowerCase());
      const matchesCategory =
        selectedCategory === 'Todas' ||
        noticia.categoria === selectedCategory;
      return matchesSearch && matchesCategory;
    });
  }, [mappedNoticias, searchTerm, selectedCategory]);

  const handleReadNoticia = (noticia) => {
    setSelectedNoticia(noticia);
    setModalOpen(true);
  };

  return (
    <>
      <Head title="Noticias y Actualidad" />
      <Navbar ajustes={ajustes} solid />

      <main className="noticias-todas-page">

        {/* Hero Banner */}
        <section className="noticias-todas__hero">
          <div className="container">
            <div className="noticias-todas__hero-content">
              <span className="eyebrow">Actualidad Presentacionista</span>
              <span className="divider-gold" />
              <h1 className="noticias-todas__title">Noticias &amp; <em>Eventos</em></h1>
              <p className="noticias-todas__subtitle">
                Mantente al día con los logros, actividades académicas, pastorales y culturales de nuestra institución
              </p>
            </div>
          </div>
        </section>

        {/* Sticky Toolbar — its own dark section */}
        <div className="noticias-todas__toolbar-section">
          <div className="container">
            <div className="noticias-todas__toolbar">

              {/* Search Bar */}
              <div className="noticias-todas__search">
                <svg className="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                  <circle cx="11" cy="11" r="8" />
                  <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
                <input
                  type="text"
                  placeholder="Buscar noticias..."
                  value={searchTerm}
                  onChange={(e) => setSearchTerm(e.target.value)}
                  className="noticias-todas__search-input"
                  id="buscar-noticias-input"
                />
                {searchTerm && (
                  <button
                    onClick={() => setSearchTerm('')}
                    className="noticias-todas__search-clear"
                    title="Limpiar búsqueda"
                    aria-label="Limpiar búsqueda"
                  >
                    ✕
                  </button>
                )}
              </div>

              {/* Category Filters */}
              <div className="noticias-todas__categories" role="tablist" aria-label="Filtrar por categoría">
                {categorias.map(cat => (
                  <button
                    key={cat}
                    role="tab"
                    aria-selected={selectedCategory === cat}
                    className={`noticias-todas__category-btn${selectedCategory === cat ? ' active' : ''}`}
                    onClick={() => setSelectedCategory(cat)}
                  >
                    {cat}
                  </button>
                ))}
              </div>

              {/* Result count */}
              <span className="noticias-todas__count">
                {noticiasFiltradas.length} {noticiasFiltradas.length === 1 ? 'resultado' : 'resultados'}
              </span>

            </div>
          </div>
        </div>

        {/* News Grid */}
        <section className="noticias-todas__content">
          <div className="container">
            {noticiasFiltradas.length > 0 ? (
              <div className="noticias-todas__grid">
                {noticiasFiltradas.map((noticia, index) => (
                  <article
                    key={noticia.id}
                    className="noticias-todas__card"
                    style={{ background: noticia.bgColor, animationDelay: `${index * 0.06}s` }}
                  >
                    {noticia.imagen ? (
                      <div className="noticias-todas__card-img-wrap">
                        <img
                          src={noticia.imagen}
                          alt={noticia.titulo}
                          className="noticias-todas__card-img"
                          loading="lazy"
                        />
                      </div>
                    ) : (
                      <div className="noticias-todas__card-img-wrap noticias-todas__card-img-placeholder">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1" strokeLinecap="round" strokeLinejoin="round" style={{ opacity: 0.25, color: '#d4af37' }}>
                          <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                          <circle cx="8.5" cy="8.5" r="1.5" />
                          <polyline points="21 15 16 10 5 21" />
                        </svg>
                      </div>
                    )}
                    <div className="noticias-todas__card-body">
                      <div className="noticias-todas__card-meta">
                        <span className="noticias-todas__card-cat">{noticia.categoria}</span>
                        <span className="noticias-todas__card-date">{noticia.fecha}</span>
                      </div>
                      <h3 className="noticias-todas__card-title">{noticia.titulo}</h3>
                      <p className="noticias-todas__card-desc">{noticia.excerpt}</p>
                      <a
                        href="#"
                        onClick={(e) => { e.preventDefault(); handleReadNoticia(noticia); }}
                        className="noticias-todas__card-link"
                        aria-label={`Leer noticia: ${noticia.titulo}`}
                      >
                        Leer más
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                          <line x1="5" y1="12" x2="19" y2="12" />
                          <polyline points="12 5 19 12 12 19" />
                        </svg>
                      </a>
                    </div>
                  </article>
                ))}
              </div>
            ) : (
              <div className="noticias-todas__empty">
                <div className="empty-icon-wrap">
                  <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.2" strokeLinecap="round" strokeLinejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    <line x1="8" y1="11" x2="14" y2="11" />
                  </svg>
                </div>
                <h3>No se encontraron noticias</h3>
                <p>Intenta cambiar los términos de búsqueda o selecciona otra categoría.</p>
                {(searchTerm || selectedCategory !== 'Todas') && (
                  <button
                    onClick={() => { setSearchTerm(''); setSelectedCategory('Todas'); }}
                    className="noticias-todas__reset-btn"
                  >
                    Restablecer filtros
                  </button>
                )}
              </div>
            )}
          </div>
        </section>

      </main>

      <Footer ajustes={ajustes} />

      <NoticiaModal
        isOpen={modalOpen}
        onClose={() => setModalOpen(false)}
        noticia={selectedNoticia}
      />
    </>
  );
}
