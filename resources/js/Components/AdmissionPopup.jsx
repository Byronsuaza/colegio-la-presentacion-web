import { useEffect, useState } from 'react';
import { storageUrl } from '../utils/url';
import './AdmissionPopup.css';

export default function AdmissionPopup({ ajustes = {} }) {
  const [isOpen, setIsOpen] = useState(false);
  const popupImage = ajustes?.popup_imagen ? storageUrl(ajustes.popup_imagen) : '/images/admisiones-popup-2027.png';
  const admissionsUrl = ajustes?.popup_button_url || '/admisiones/inscripcion-en-linea';
  const buttonText = ajustes?.popup_button_text || 'Más información';

  if (ajustes?.popup_habilitado === false) {
    return null;
  }

  useEffect(() => {
    const timer = window.setTimeout(() => setIsOpen(true), 450);
    return () => window.clearTimeout(timer);
  }, []);

  useEffect(() => {
    if (!isOpen) return undefined;

    const previousOverflow = document.body.style.overflow;
    const handleKeyDown = (event) => {
      if (event.key === 'Escape') {
        setIsOpen(false);
      }
    };

    document.body.style.overflow = 'hidden';
    window.addEventListener('keydown', handleKeyDown);

    return () => {
      document.body.style.overflow = previousOverflow;
      window.removeEventListener('keydown', handleKeyDown);
    };
  }, [isOpen]);

  if (!isOpen) {
    return null;
  }

  const closePopup = () => setIsOpen(false);
  const goToAdmissions = (event) => {
    if (!admissionsUrl.startsWith('/')) {
      event.preventDefault();
      closePopup();

      window.setTimeout(() => {
        const admissionsSection = document.querySelector(admissionsUrl);

        if (admissionsSection) {
          window.history.pushState(null, '', admissionsUrl);
          admissionsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }, 0);
    }
  };

  return (
    <div
      className="admission-popup"
      role="dialog"
      aria-modal="true"
      aria-label="Matrículas abiertas 2027"
      onMouseDown={(event) => {
        if (event.target === event.currentTarget) {
          closePopup();
        }
      }}
    >
      <div className="admission-popup__panel">
        <button
          className="admission-popup__close"
          type="button"
          aria-label="Cerrar aviso de matrículas"
          onClick={closePopup}
        >
          <span aria-hidden="true">&times;</span>
        </button>

        <img
          className="admission-popup__image"
          src={popupImage}
          alt="Matrículas abiertas 2027 del Colegio La Presentación Neiva"
        />

        <div className="admission-popup__actions">
          <a className="admission-popup__button" href={admissionsUrl} onClick={goToAdmissions}>
            {buttonText}
          </a>
        </div>
      </div>
    </div>
  );
}
