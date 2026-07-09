import React, { useState, useMemo } from 'react';
import { Head } from '@inertiajs/react';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';
import './EventosCalendario.css';

const parseDate = (dateStr) => {
  if (!dateStr) return { day: '', month: '' };
  
  const months = ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'];
  
  const parts = dateStr.split('T')[0].split('-');
  if (parts.length === 3) {
    const monthIndex = parseInt(parts[1], 10) - 1;
    const day = parseInt(parts[2], 10);
    
    return {
      day: day.toString().padStart(2, '0'),
      month: months[monthIndex] || '',
      fullDate: new Date(`${parts[0]}-${parts[1]}-${parts[2]}`)
    };
  }
  
  try {
    const d = new Date(dateStr);
    return {
      day: d.getDate().toString().padStart(2, '0'),
      month: months[d.getMonth()] || '',
      fullDate: d
    };
  } catch (e) {
    return { day: '', month: '', fullDate: null };
  }
};

export default function EventosCalendario({ eventos = [], ajustes = {} }) {
  const [filtroMes, setFiltroMes] = useState(new Date().getMonth());
  const [filtroAnio, setFiltroAnio] = useState(new Date().getFullYear());

  const eventosConFecha = useMemo(() => {
    return eventos
      .map(evento => ({
        ...evento,
        ...parseDate(evento.fecha)
      }))
      .sort((a, b) => {
        if (!a.fullDate || !b.fullDate) return 0;
        return a.fullDate - b.fullDate;
      });
  }, [eventos]);

  const eventosFiltrados = useMemo(() => {
    return eventosConFecha.filter(evento => {
      if (!evento.fullDate) return false;
      return evento.fullDate.getMonth() === filtroMes && 
             evento.fullDate.getFullYear() === filtroAnio;
    });
  }, [eventosConFecha, filtroMes, filtroAnio]);

  const eventosProximos = useMemo(() => {
    const hoy = new Date();
    hoy.setHours(0, 0, 0, 0);
    return eventosConFecha
      .filter(evento => evento.fullDate && evento.fullDate >= hoy)
      .slice(0, 10);
  }, [eventosConFecha]);

  const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
  
  const mesActual = meses[filtroMes];
  const anios = [...new Set(eventosConFecha.map(e => e.fullDate?.getFullYear()).filter(Boolean))];
  
  if (anios.length === 0) {
    anios.push(new Date().getFullYear());
  }

  const handleMesAnterior = () => {
    if (filtroMes === 0) {
      setFiltroMes(11);
      setFiltroAnio(filtroAnio - 1);
    } else {
      setFiltroMes(filtroMes - 1);
    }
  };

  const handleMesSiguiente = () => {
    if (filtroMes === 11) {
      setFiltroMes(0);
      setFiltroAnio(filtroAnio + 1);
    } else {
      setFiltroMes(filtroMes + 1);
    }
  };

  return (
    <>
      <Head title="Calendario de Eventos" />
      <Navbar ajustes={ajustes} solid />
      <main className="eventos-calendario">
        {/* Hero Section */}
        <section className="eventos-calendario__hero">
          <div className="container">
            <div className="eventos-calendario__hero-content">
              <span className="eyebrow">Agenda Escolar</span>
              <span className="divider-gold" />
              <h1 className="eventos-calendario__title">Calendario de <em>Eventos</em></h1>
              <p className="eventos-calendario__subtitle">
                Descubre todas las actividades, ceremonias y proyectos transversales de nuestra comunidad educativa
              </p>
            </div>
          </div>
        </section>

        {/* Main Content */}
        <section className="eventos-calendario__content">
          <div className="container">
            <div className="eventos-calendario__layout">
              {/* Left: Calendar Filter */}
              <aside className="eventos-calendario__sidebar">
                <div className="eventos-calendario__filter-card">
                  <h3 className="eventos-calendario__filter-title">Filtrar por Mes</h3>
                  
                  <div className="eventos-calendario__month-nav">
                    <button 
                      className="eventos-calendario__nav-btn" 
                      onClick={handleMesAnterior}
                      aria-label="Mes anterior"
                    >
                      ←
                    </button>
                    <span className="eventos-calendario__month-display">
                      {mesActual} {filtroAnio}
                    </span>
                    <button 
                      className="eventos-calendario__nav-btn" 
                      onClick={handleMesSiguiente}
                      aria-label="Mes siguiente"
                    >
                      →
                    </button>
                  </div>

                  <div className="eventos-calendario__year-select">
                    <label htmlFor="anio-filter">Año:</label>
                    <select 
                      id="anio-filter"
                      value={filtroAnio}
                      onChange={(e) => setFiltroAnio(parseInt(e.target.value))}
                      className="eventos-calendario__select"
                    >
                      {anios.map(anio => (
                        <option key={anio} value={anio}>{anio}</option>
                      ))}
                    </select>
                  </div>

                  <div className="eventos-calendario__month-grid">
                    {meses.map((mes, index) => (
                      <button
                        key={mes}
                        className={`eventos-calendario__month-btn ${
                          index === filtroMes ? 'active' : ''
                        }`}
                        onClick={() => setFiltroMes(index)}
                        title={mes}
                      >
                        {mes.substring(0, 3)}
                      </button>
                    ))}
                  </div>

                  <div className="eventos-calendario__stats">
                    <p className="eventos-calendario__stat-item">
                      <span className="stat-label">Eventos encontrados:</span>
                      <span className="stat-value">{eventosFiltrados.length}</span>
                    </p>
                    <p className="eventos-calendario__stat-item">
                      <span className="stat-label">Total de eventos:</span>
                      <span className="stat-value">{eventos.length}</span>
                    </p>
                  </div>
                </div>

                {/* Próximos Eventos */}
                <div className="eventos-calendario__proximos-card">
                  <h3 className="eventos-calendario__filter-title">Próximos Eventos</h3>
                  <div className="eventos-calendario__proximos-list">
                    {eventosProximos.length > 0 ? (
                      eventosProximos.map((evento, index) => (
                        <div 
                          key={evento.id || index}
                          className="eventos-calendario__proximos-item"
                        >
                          <div className="eventos-calendario__proximos-date">
                            <span className="proximos-day">{evento.day}</span>
                            <span className="proximos-month">{evento.month}</span>
                          </div>
                          <div className="eventos-calendario__proximos-info">
                            <h4>{evento.titulo}</h4>
                            {evento.hora && <p className="proximos-hora">{evento.hora}</p>}
                          </div>
                        </div>
                      ))
                    ) : (
                      <p className="eventos-calendario__empty-text">No hay eventos próximos</p>
                    )}
                  </div>
                </div>
              </aside>

              {/* Right: Events List */}
              <div className="eventos-calendario__main">
                {eventosFiltrados.length > 0 ? (
                  <div className="eventos-calendario__list">
                    {eventosFiltrados.map((evento, index) => (
                      <div 
                        key={evento.id || index}
                        className="eventos-calendario__event-card"
                        style={{ animationDelay: `${index * 0.05}s` }}
                      >
                        <div className="eventos-calendario__event-date-badge">
                          <span className="badge-day">{evento.day}</span>
                          <span className="badge-month">{evento.month}</span>
                        </div>
                        
                        <div className="eventos-calendario__event-body">
                          <h3 className="eventos-calendario__event-title">{evento.titulo}</h3>
                          
                          <div className="eventos-calendario__event-meta">
                            {evento.hora && (
                              <span className="meta-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                  <circle cx="12" cy="12" r="10" />
                                  <polyline points="12 6 12 12 16 14" />
                                </svg>
                                <strong>Hora:</strong> {evento.hora}
                              </span>
                            )}
                            {evento.lugar && (
                              <span className="meta-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                  <circle cx="12" cy="12" r="3" />
                                </svg>
                                <strong>Lugar:</strong> {evento.lugar}
                              </span>
                            )}
                          </div>

                          {evento.descripcion && (
                            <p className="eventos-calendario__event-description">
                              {evento.descripcion}
                            </p>
                          )}
                        </div>
                      </div>
                    ))}
                  </div>
                ) : (
                  <div className="eventos-calendario__empty-state">
                    <div className="empty-icon">
                      <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1" strokeLinecap="round" strokeLinejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                      </svg>
                    </div>
                    <h3>No hay eventos en {mesActual} {filtroAnio}</h3>
                    <p>Selecciona otro mes o año para ver los eventos disponibles</p>
                  </div>
                )}
              </div>
            </div>
          </div>
        </section>
      </main>
      <Footer ajustes={ajustes} />
    </>
  );
}
