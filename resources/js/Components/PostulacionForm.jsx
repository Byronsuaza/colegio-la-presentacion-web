import React, { useState, useEffect, useRef } from 'react';
import './PqrsForm.css';

const BANCO_HV = 'Banco de hojas de vida (postulación espontánea)';
const MAX_SIZE = 5 * 1024 * 1024;
const ALLOWED_EXT = ['.pdf', '.doc', '.docx'];

const initialForm = {
  nombre_completo: '',
  telefono: '',
  email: '',
  cargo: '',
  habeas_data: false,
};

export default function PostulacionForm({ vacantes = [] }) {
  const opcionesCargo = [
    ...(Array.isArray(vacantes) ? vacantes.filter(Boolean) : []),
    BANCO_HV,
  ];

  const [formData, setFormData] = useState(initialForm);
  const [file, setFile] = useState(null);
  const [errors, setErrors] = useState({});
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [submitResult, setSubmitResult] = useState(null);
  const [isDragging, setIsDragging] = useState(false);
  const [turnstileToken, setTurnstileToken] = useState('');
  const turnstileRef = useRef(null);
  const widgetIdRef = useRef(null);
  const fileInputRef = useRef(null);

  // Cloudflare Turnstile (mismo esquema que el formulario PQRS)
  useEffect(() => {
    const siteKey = window.__TURNSTILE_SITE_KEY__;
    if (!siteKey) return undefined;

    const mountWidget = () => {
      if (turnstileRef.current && window.turnstile && !widgetIdRef.current) {
        widgetIdRef.current = window.turnstile.render(turnstileRef.current, {
          sitekey: siteKey,
          callback: (token) => {
            setTurnstileToken(token);
            setErrors((prev) => ({ ...prev, turnstile: null }));
          },
          'expired-callback': () => setTurnstileToken(''),
          'error-callback': () => setTurnstileToken(''),
          theme: 'light',
          language: 'es',
        });
      }
    };

    let interval;
    if (window.turnstile) {
      mountWidget();
    } else {
      interval = setInterval(() => {
        if (window.turnstile) {
          clearInterval(interval);
          mountWidget();
        }
      }, 200);
    }

    return () => {
      if (interval) clearInterval(interval);
      if (widgetIdRef.current && window.turnstile) {
        window.turnstile.remove(widgetIdRef.current);
        widgetIdRef.current = null;
      }
    };
  }, [submitResult?.success]);

  const resetTurnstile = () => {
    if (widgetIdRef.current && window.turnstile) {
      window.turnstile.reset(widgetIdRef.current);
    }
    setTurnstileToken('');
  };

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData((prev) => ({ ...prev, [name]: type === 'checkbox' ? checked : value }));
    if (errors[name]) setErrors((prev) => ({ ...prev, [name]: null }));
  };

  const validateAndSetFile = (selected) => {
    if (!selected) return;
    const name = selected.name.toLowerCase();
    if (!ALLOWED_EXT.some((ext) => name.endsWith(ext))) {
      setErrors((prev) => ({ ...prev, hoja_vida: 'Formato no permitido. Solo PDF o Word (doc, docx).' }));
      setFile(null);
      return;
    }
    if (selected.size > MAX_SIZE) {
      setErrors((prev) => ({ ...prev, hoja_vida: 'La hoja de vida no debe superar los 5MB.' }));
      setFile(null);
      return;
    }
    setFile(selected);
    setErrors((prev) => ({ ...prev, hoja_vida: null }));
  };

  const stop = (e) => {
    e.preventDefault();
    e.stopPropagation();
  };

  const handleDrop = (e) => {
    stop(e);
    setIsDragging(false);
    if (e.dataTransfer.files && e.dataTransfer.files[0]) {
      validateAndSetFile(e.dataTransfer.files[0]);
    }
  };

  const triggerFileSelect = () => fileInputRef.current?.click();

  const handleSubmit = async (e) => {
    e.preventDefault();

    // Validación rápida en el navegador
    const localErrors = {};
    if (!formData.nombre_completo.trim()) localErrors.nombre_completo = 'El nombre completo es obligatorio.';
    if (!formData.telefono.trim()) localErrors.telefono = 'El número de contacto es obligatorio.';
    if (!formData.email.trim()) localErrors.email = 'El correo electrónico es obligatorio.';
    if (!formData.cargo) localErrors.cargo = 'Seleccione el cargo o vacante a la que aplica.';
    if (!file) localErrors.hoja_vida = 'Debe adjuntar su hoja de vida.';
    if (!formData.habeas_data) localErrors.habeas_data = 'Debe autorizar el tratamiento de sus datos personales.';
    if (window.__TURNSTILE_SITE_KEY__ && !turnstileToken) {
      localErrors.turnstile = 'Por favor, complete la verificación de seguridad.';
    }

    if (Object.keys(localErrors).length > 0) {
      setErrors(localErrors);
      const first = document.getElementsByName(Object.keys(localErrors)[0])[0];
      first?.scrollIntoView({ behavior: 'smooth', block: 'center' });
      return;
    }

    setIsSubmitting(true);
    setErrors({});
    setSubmitResult(null);

    const data = new FormData();
    data.append('nombre_completo', formData.nombre_completo);
    data.append('telefono', formData.telefono);
    data.append('email', formData.email);
    data.append('cargo', formData.cargo);
    data.append('habeas_data', formData.habeas_data ? '1' : '0');
    data.append('hoja_vida', file);
    if (turnstileToken) data.append('cf-turnstile-response', turnstileToken);

    try {
      const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      const response = await fetch('/postulaciones', {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          Accept: 'application/json',
          ...(csrf && { 'X-CSRF-TOKEN': csrf }),
        },
        body: data,
      });

      if (response.status === 429) {
        setSubmitResult({ success: false, message: 'Ha realizado demasiados intentos. Por favor, espere unos minutos e intente de nuevo.' });
        resetTurnstile();
        return;
      }

      if (response.status === 413) {
        setErrors({ hoja_vida: 'El archivo es demasiado grande. Máximo 5MB.' });
        resetTurnstile();
        return;
      }

      const result = await response.json();

      if (!response.ok) {
        if (response.status === 422 && result.errors) {
          const formatted = {};
          Object.keys(result.errors).forEach((key) => {
            formatted[key] = result.errors[key][0];
          });
          setErrors(formatted);
          const first = document.getElementsByName(Object.keys(formatted)[0])[0];
          first?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
          setSubmitResult({ success: false, message: result.message || 'Ocurrió un error inesperado al enviar la postulación.' });
        }
        resetTurnstile();
      } else {
        setSubmitResult({ success: true, message: result.message, radicado: result.radicado });
        setFormData(initialForm);
        setFile(null);
      }
    } catch (error) {
      setSubmitResult({ success: false, message: 'No se pudo conectar con el servidor. Por favor, intente más tarde.' });
      resetTurnstile();
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div className="pqrs-form-container" id="postulacion-form">
      {submitResult?.success && (
        <div className="pqrs-success-card">
          <div className="success-icon-container">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
              <polyline points="22 4 12 14.01 9 11.01" />
            </svg>
          </div>
          <h3>¡Postulación enviada!</h3>
          <p className="success-message">{submitResult.message}</p>
          <div className="ticket-box">
            <span className="ticket-label">Número de postulación</span>
            <span className="ticket-value">#{submitResult.radicado}</span>
          </div>
          <p className="success-footer">Gracias por tu interés en formar parte de la familia Presentación.</p>
          <button type="button" className="btn-reset" onClick={() => setSubmitResult(null)}>
            Enviar otra postulación
          </button>
        </div>
      )}

      {submitResult && !submitResult.success && (
        <div className="pqrs-error-card">
          <div className="error-icon-container">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
              <circle cx="12" cy="12" r="10" />
              <line x1="12" y1="8" x2="12" y2="12" />
              <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
          </div>
          <p>{submitResult.message}</p>
        </div>
      )}

      {!submitResult?.success && (
        <form onSubmit={handleSubmit} className="pqrs-form" noValidate>
          <div className="pqrs-intro">
            <p className="pqrs-instructions">
              Los campos marcados con <span className="required-star">*</span> son obligatorios.
            </p>
          </div>

          <div className="form-section">
            <h3 className="section-title">1. Datos del Postulante</h3>
            <div className="form-grid">
              <div className="form-group">
                <label htmlFor="post-nombre">
                  Nombre Completo <span className="required-star">*</span>
                </label>
                <input
                  type="text"
                  id="post-nombre"
                  name="nombre_completo"
                  autoComplete="name"
                  value={formData.nombre_completo}
                  onChange={handleChange}
                  className={errors.nombre_completo ? 'input-error' : ''}
                  required
                />
                {errors.nombre_completo && <span className="error-text">{errors.nombre_completo}</span>}
              </div>

              <div className="form-group">
                <label htmlFor="post-telefono">
                  Número de Contacto <span className="required-star">*</span>
                </label>
                <input
                  type="tel"
                  id="post-telefono"
                  name="telefono"
                  autoComplete="tel"
                  placeholder="Ej: 310 000 0000"
                  value={formData.telefono}
                  onChange={handleChange}
                  className={errors.telefono ? 'input-error' : ''}
                  required
                />
                {errors.telefono && <span className="error-text">{errors.telefono}</span>}
              </div>

              <div className="form-group">
                <label htmlFor="post-email">
                  Correo Electrónico <span className="required-star">*</span>
                </label>
                <input
                  type="email"
                  id="post-email"
                  name="email"
                  autoComplete="email"
                  value={formData.email}
                  onChange={handleChange}
                  className={errors.email ? 'input-error' : ''}
                  required
                />
                {errors.email && <span className="error-text">{errors.email}</span>}
              </div>

              <div className="form-group">
                <label htmlFor="post-cargo">
                  Cargo o Vacante a la que Aplica <span className="required-star">*</span>
                </label>
                <select
                  id="post-cargo"
                  name="cargo"
                  value={formData.cargo}
                  onChange={handleChange}
                  className={errors.cargo ? 'input-error' : ''}
                  required
                >
                  <option value="">-- Seleccione --</option>
                  {opcionesCargo.map((cargo) => (
                    <option key={cargo} value={cargo}>{cargo}</option>
                  ))}
                </select>
                {errors.cargo && <span className="error-text">{errors.cargo}</span>}
              </div>
            </div>
          </div>

          <div className="form-section">
            <h3 className="section-title">2. Hoja de Vida</h3>
            <div className="form-group file-upload-group">
              <label>
                Adjuntar Hoja de Vida <span className="required-star">*</span>
              </label>
              <div
                className={`pqrs-drag-drop-zone ${isDragging ? 'is-dragging' : ''} ${file ? 'has-file' : ''} ${errors.hoja_vida ? 'has-error' : ''}`}
                onDragOver={stop}
                onDragEnter={(e) => { stop(e); setIsDragging(true); }}
                onDragLeave={(e) => { stop(e); setIsDragging(false); }}
                onDrop={handleDrop}
                onClick={triggerFileSelect}
                role="button"
                tabIndex={0}
                onKeyDown={(e) => e.key === 'Enter' && triggerFileSelect()}
              >
                <input
                  type="file"
                  id="post-hoja-vida"
                  name="hoja_vida"
                  ref={fileInputRef}
                  onChange={(e) => validateAndSetFile(e.target.files[0])}
                  accept=".pdf,.doc,.docx"
                  style={{ display: 'none' }}
                />
                <div className="drag-drop-content">
                  {file ? (
                    <div className="file-preview-container">
                      <div className="file-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="pdf-icon">
                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                          <polyline points="14 2 14 8 20 8" />
                          <line x1="16" y1="13" x2="8" y2="13" />
                          <line x1="16" y1="17" x2="8" y2="17" />
                        </svg>
                      </div>
                      <div className="file-details">
                        <span className="file-name">{file.name}</span>
                        <span className="file-size">({(file.size / (1024 * 1024)).toFixed(2)} MB)</span>
                      </div>
                      <button
                        type="button"
                        className="btn-remove-file-badge"
                        onClick={(e) => {
                          e.stopPropagation();
                          setFile(null);
                          if (fileInputRef.current) fileInputRef.current.value = '';
                        }}
                        aria-label="Quitar archivo"
                      >
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                          <line x1="18" y1="6" x2="6" y2="18" />
                          <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                      </button>
                    </div>
                  ) : (
                    <>
                      <div className="upload-cloud-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                          <polyline points="17 8 12 3 7 8" />
                          <line x1="12" y1="3" x2="12" y2="15" />
                        </svg>
                      </div>
                      <p className="upload-prompt">
                        <strong>Arrastre y suelte su hoja de vida aquí</strong>, o haga clic para explorar
                      </p>
                      <span className="file-info">Formatos permitidos: PDF o Word (doc/docx). Máx 5MB.</span>
                    </>
                  )}
                </div>
              </div>
              {errors.hoja_vida && <span className="error-text">{errors.hoja_vida}</span>}
            </div>
          </div>

          <div className="form-section habeas-data-section">
            <div className="checkbox-group">
              <input
                type="checkbox"
                id="post-habeas"
                name="habeas_data"
                checked={formData.habeas_data}
                onChange={handleChange}
                className={errors.habeas_data ? 'input-error' : ''}
                required
              />
              <label htmlFor="post-habeas">
                Autorizo al Colegio de La Presentación de Neiva para el tratamiento de mis datos personales y de la
                información contenida en mi hoja de vida, con fines exclusivos de selección de personal, de acuerdo con la{' '}
                <a href="/calidad-y-pastoral/politica-de-privacidad" target="_blank" rel="noopener noreferrer">
                  Política de Privacidad
                </a>{' '}
                y la Ley 1581 de 2012. <span className="required-star">*</span>
              </label>
            </div>
            {errors.habeas_data && <span className="error-text">{errors.habeas_data}</span>}
          </div>

          {window.__TURNSTILE_SITE_KEY__ && (
            <div className="form-section turnstile-section">
              <div ref={turnstileRef} className="turnstile-widget" id="postulacion-turnstile-widget" />
              {errors.turnstile && <span className="error-text turnstile-error">{errors.turnstile}</span>}
            </div>
          )}

          <button type="submit" className="btn-submit" id="postulacion-submit" disabled={isSubmitting}>
            {isSubmitting ? (
              <span className="loading-spinner">
                <svg className="spinner" viewBox="0 0 24 24">
                  <circle className="path" cx="12" cy="12" r="10" fill="none" strokeWidth="3" />
                </svg>
                Enviando postulación...
              </span>
            ) : (
              'Enviar Postulación'
            )}
          </button>
        </form>
      )}
    </div>
  );
}
