import React, { useState } from 'react';
import { sanitizeHtml } from '../utils/sanitize';
import './ComitesAcademicos.css';

export default function ComitesAcademicos({ areas = [] }) {
  const [expandedArea, setExpandedArea] = useState(null);

  const defaultAreas = [
    {
      id: 'castellano',
      titulo: 'Área de Castellano',
      coordinador: 'Coordinador(a)',
      descripcion: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      enlaces: []
    },
    {
      id: 'ciencias',
      titulo: 'Área de Ciencias',
      coordinador: 'Coordinador(a)',
      descripcion: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      enlaces: []
    },
    {
      id: 'ed-fisica',
      titulo: 'Área de Educación Física y Artística',
      coordinador: 'Coordinador(a)',
      descripcion: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      enlaces: []
    },
    {
      id: 'idioma',
      titulo: 'Área de Idioma Extranjero',
      coordinador: 'Coordinador(a)',
      descripcion: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      enlaces: []
    },
    {
      id: 'matematicas',
      titulo: 'Área de Matemáticas',
      coordinador: 'Coordinador(a)',
      descripcion: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      enlaces: []
    },
    {
      id: 'preescolar',
      titulo: 'Área de Preescolar',
      coordinador: 'Coordinador(a)',
      descripcion: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      enlaces: []
    },
    {
      id: 'religion',
      titulo: 'Área de Religión',
      coordinador: 'Coordinador(a)',
      descripcion: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      enlaces: []
    },
    {
      id: 'sociales',
      titulo: 'Área de Sociales',
      coordinador: 'Coordinador(a)',
      descripcion: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      enlaces: []
    }
  ];

  const areasData = areas.length > 0 ? areas : defaultAreas;

  const toggleArea = (areaId) => {
    setExpandedArea(expandedArea === areaId ? null : areaId);
  };

  return (
    <div className="comites-academicos">
      <div className="comites-academicos__grid">
        {areasData.map((area, index) => (
          <div
            key={area.id || index}
            className={`comites-academicos__card ${expandedArea === area.id ? 'expanded' : ''}`}
            style={{ animationDelay: `${index * 0.05}s` }}
          >
            <button
              className="comites-academicos__header"
              onClick={() => toggleArea(area.id)}
              aria-expanded={expandedArea === area.id}
            >
              <div className="comites-academicos__header-content">
                <h3 className="comites-academicos__title">{area.titulo}</h3>
                <div className="comites-academicos__icon">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                  >
                    <polyline points="6 9 12 15 18 9"></polyline>
                  </svg>
                </div>
              </div>
            </button>

            {expandedArea === area.id && (
              <div className="comites-academicos__content">
                {area.coordinador && (
                  <div className="comites-academicos__info">
                    <span className="info-label">Jefe de Área:</span>
                    <span className="info-value">{area.coordinador}</span>
                  </div>
                )}

                {area.descripcion && (
                  <div className="comites-academicos__members">
                    <span className="info-label">Integrantes:</span>
                    <div
                      className="comites-academicos__members-content"
                      dangerouslySetInnerHTML={{ __html: sanitizeHtml(area.descripcion) }}
                    />
                  </div>
                )}

                {area.enlaces && area.enlaces.length > 0 && (
                  <div className="comites-academicos__enlaces">
                    <h4 className="enlaces-title">Documentos</h4>
                    <div className="enlaces-list">
                      {area.enlaces.map((enlace, idx) => (
                        <a
                          key={idx}
                          href={enlace.url}
                          className="enlace-item"
                          target={enlace.url?.startsWith('/') ? '_self' : '_blank'}
                          rel="noopener noreferrer"
                        >
                          <svg
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="2"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                          >
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                          </svg>
                          {enlace.titulo}
                        </a>
                      ))}
                    </div>
                  </div>
                )}
              </div>
            )}
          </div>
        ))}
      </div>
    </div>
  );
}
