import React, { useState, useEffect, useRef } from 'react';
import './PqrsForm.css';
import Toast from './Toast';

export default function PqrsForm() {
  const [formData, setFormData] = useState({
    tipo: '',
    nombre_completo: '',
    tipo_documento: '',
    documento: '',
    email: '',
    telefono: '',
    relacion: '',
    estudiante_nombre: '',
    estudiante_grado: '',
    mensaje: '',
    habeas_data: false,
  });

  const [file, setFile] = useState(null);
  const [errors, setErrors] = useState({});
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [submitResult, setSubmitResult] = useState(null);
  const [turnstileToken, setTurnstileToken] = useState('');
  const [turnstileReady, setTurnstileReady] = useState(false);
  const turnstileRef = useRef(null);
  const widgetIdRef = useRef(null);

  // Montar el widget de Turnstile cuando el script esté listo
  useEffect(() => {
    const siteKey = window.__TURNSTILE_SITE_KEY__;
    if (!siteKey) return; // Sin site key, no se muestra el widget

    const mountWidget = () => {
      if (
        turnstileRef.current &&
        window.turnstile &&
        !widgetIdRef.current
      ) {
        widgetIdRef.current = window.turnstile.render(turnstileRef.current, {
          sitekey: siteKey,
          callback: (token) => {
            setTurnstileToken(token);
            setTurnstileReady(true);
            setErrors((prev) => ({ ...prev, turnstile: null }));
          },
          'expired-callback': () => {
            setTurnstileToken('');
            setTurnstileReady(false);
          },
          'error-callback': () => {
            setTurnstileToken('');
            setTurnstileReady(false);
          },
          theme: 'light',
          language: 'es',
        });
      }
    };

    // El script puede ya estar cargado o cargarse después
    if (window.turnstile) {
      mountWidget();
    } else {
      // Esperar a que el script cargue
      const interval = setInterval(() => {
        if (window.turnstile) {
          clearInterval(interval);
          mountWidget();
        }
      }, 200);
      return () => clearInterval(interval);
    }

    return () => {
      // Destruir el widget al desmontar el componente
      if (widgetIdRef.current && window.turnstile) {
        window.turnstile.remove(widgetIdRef.current);
        widgetIdRef.current = null;
      }
    };
  }, []);

  // Resetear el widget después de un envío exitoso o fallido
  const resetTurnstile = () => {
    if (widgetIdRef.current && window.turnstile) {
      window.turnstile.reset(widgetIdRef.current);
    }
    setTurnstileToken('');
    setTurnstileReady(false);
  };

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: type === 'checkbox' ? checked : value,
    }));
    if (errors[name]) {
      setErrors((prev) => ({ ...prev, [name]: null }));
    }
  };

  const [isDragging, setIsDragging] = useState(false);
  const fileInputRef = useRef(null);

  const validateAndSetFile = (selectedFile) => {
    if (selectedFile) {
      if (selectedFile.size > 5 * 1024 * 1024) {
        setErrors((prev) => ({
          ...prev,
          adjunto: 'El archivo no debe superar los 5MB.',
        }));
        setFile(null);
      } else {
        setFile(selectedFile);
        setErrors((prev) => ({ ...prev, adjunto: null }));
      }
    }
  };

  const handleFileChange = (e) => {
    const selectedFile = e.target.files[0];
    validateAndSetFile(selectedFile);
  };

  const handleDragOver = (e) => {
    e.preventDefault();
    e.stopPropagation();
  };

  const handleDragEnter = (e) => {
    e.preventDefault();
    e.stopPropagation();
    setIsDragging(true);
  };

  const handleDragLeave = (e) => {
    e.preventDefault();
    e.stopPropagation();
    setIsDragging(false);
  };

  const handleDrop = (e) => {
    e.preventDefault();
    e.stopPropagation();
    setIsDragging(false);

    if (e.dataTransfer.files && e.dataTransfer.files[0]) {
      const droppedFile = e.dataTransfer.files[0];
      
      // Validar tipo de archivo permitido antes de procesar
      const allowedExtensions = ['.pdf', '.doc', '.docx', '.jpg', '.jpeg', '.png'];
      const fileName = droppedFile.name.toLowerCase();
      const isAllowed = allowedExtensions.some(ext => fileName.endsWith(ext));
      
      if (!isAllowed) {
        setErrors((prev) => ({
          ...prev,
          adjunto: 'Formato no permitido. Solo PDF, Word o Imágenes.',
        }));
        setFile(null);
        return;
      }
      
      validateAndSetFile(droppedFile);
    }
  };

  const triggerFileSelect = () => {
    if (fileInputRef.current) {
      fileInputRef.current.click();
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    // Verificar que Turnstile fue completado (solo si el site_key está configurado)
    const siteKey = window.__TURNSTILE_SITE_KEY__;
    if (siteKey && !turnstileToken) {
      setErrors((prev) => ({
        ...prev,
        turnstile: 'Por favor, complete la verificación de seguridad.',
      }));
      return;
    }

    setIsSubmitting(true);
    setErrors({});
    setSubmitResult(null);

    const data = new FormData();
    Object.keys(formData).forEach((key) => {
      if (key === 'habeas_data') {
        data.append(key, formData[key] ? '1' : '0');
      } else {
        data.append(key, formData[key] || '');
      }
    });

    if (file) {
      data.append('adjunto', file);
    }

    // Enviar el token de Turnstile al backend
    if (turnstileToken) {
      data.append('cf-turnstile-response', turnstileToken);
    }

    try {
      const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

      const response = await fetch('/pqrs', {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          ...(token && { 'X-CSRF-TOKEN': token }),
        },
        body: data,
      });

      const result = await response.json();

      if (!response.ok) {
        if (response.status === 422 && result.errors) {
          const formattedErrors = {};
          Object.keys(result.errors).forEach((key) => {
            formattedErrors[key] = result.errors[key][0];
          });
          setErrors(formattedErrors);

          const firstErrorField = Object.keys(formattedErrors)[0];
          const element = document.getElementsByName(firstErrorField)[0];
          if (element) {
            element.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
        } else {
          setSubmitResult({
            success: false,
            message: result.message || 'Ocurrió un error inesperado al procesar la solicitud.',
          });
        }
        resetTurnstile();
      } else {
        setSubmitResult({
          success: true,
          message: result.message,
          ticket: result.ticket,
        });
        setFormData({
          tipo: '',
          nombre_completo: '',
          tipo_documento: '',
          documento: '',
          email: '',
          telefono: '',
          relacion: '',
          estudiante_nombre: '',
          estudiante_grado: '',
          mensaje: '',
          habeas_data: false,
        });
        setFile(null);
        resetTurnstile();
      }
    } catch (error) {
      setSubmitResult({
        success: false,
        message: 'No se pudo conectar con el servidor. Por favor, intente más tarde.',
      });
      resetTurnstile();
    } finally {
      setIsSubmitting(false);
    }
  };

  const showStudentFields =
    formData.relacion === 'Padre de familia' || formData.relacion === 'Estudiante';

  return (
    <div className="pqrs-form-container">
      <div className="pqrs-intro">
        <p>
          En el Colegio de La Presentación de Neiva valoramos sus comentarios. A través de este
          canal institucional puede radicar de forma oficial sus <strong>Peticiones, Quejas,
          Reclamos, Sugerencias o Felicitaciones (PQRS)</strong>.
        </p>
        <p className="pqrs-instructions">
          Los campos marcados con <span className="required-star">*</span> son obligatorios.
        </p>
      </div>

      {submitResult && submitResult.success && (
        <div className="pqrs-success-card">
          <div className="success-icon-container">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
              <polyline points="22 4 12 14.01 9 11.01" />
            </svg>
          </div>
          <h3>¡Solicitud Radicada Exitosamente!</h3>
          <p className="success-message">{submitResult.message}</p>
          <div className="ticket-box">
            <span className="ticket-label">Número de Ticket</span>
            <span className="ticket-value">#{submitResult.ticket}</span>
          </div>
          <p className="success-footer">
            Hemos enviado un correo de confirmación. Su solicitud será atendida en los plazos
            legales e institucionales correspondientes.
          </p>
          <button
            type="button"
            className="btn-reset"
            onClick={() => setSubmitResult(null)}
          >
            Radicar otra solicitud
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

      {(!submitResult || !submitResult.success) && (
        <form onSubmit={handleSubmit} className="pqrs-form" noValidate>
          <div className="form-section">
            <h3 className="section-title">1. Tipo de Solicitud</h3>
            <div className="form-group">
              <label htmlFor="tipo">
                ¿Qué tipo de solicitud desea radicar? <span className="required-star">*</span>
              </label>
              <select
                id="tipo"
                name="tipo"
                value={formData.tipo}
                onChange={handleChange}
                className={errors.tipo ? 'input-error' : ''}
                required
              >
                <option value="">-- Seleccione una opción --</option>
                <option value="Petición">Petición (Solicitud de información o trámite)</option>
                <option value="Queja">Queja (Manifestación de inconformidad por un servicio)</option>
                <option value="Reclamo">Reclamo (Exigencia por incumplimiento o mala atención)</option>
                <option value="Sugerencia">Sugerencia (Idea para mejorar los servicios)</option>
                <option value="Felicitación">Felicitación (Reconocimiento del buen servicio)</option>
              </select>
              {errors.tipo && <span className="error-text">{errors.tipo}</span>}
            </div>
          </div>

          <div className="form-section">
            <h3 className="section-title">2. Información del Solicitante</h3>
            <div className="form-grid">
              <div className="form-group">
                <label htmlFor="nombre_completo">
                  Nombre Completo <span className="required-star">*</span>
                </label>
                <input
                  type="text"
                  id="nombre_completo"
                  name="nombre_completo"
                  value={formData.nombre_completo}
                  onChange={handleChange}
                  className={errors.nombre_completo ? 'input-error' : ''}
                  required
                />
                {errors.nombre_completo && (
                  <span className="error-text">{errors.nombre_completo}</span>
                )}
              </div>

              <div className="form-group">
                <label htmlFor="tipo_documento">
                  Tipo de Documento <span className="required-star">*</span>
                </label>
                <select
                  id="tipo_documento"
                  name="tipo_documento"
                  value={formData.tipo_documento}
                  onChange={handleChange}
                  className={errors.tipo_documento ? 'input-error' : ''}
                  required
                >
                  <option value="">-- Seleccione --</option>
                  <option value="Cédula de Ciudadanía">Cédula de Ciudadanía (C.C.)</option>
                  <option value="Tarjeta de Identidad">Tarjeta de Identidad (T.I.)</option>
                  <option value="Cédula de Extranjería">Cédula de Extranjería (C.E.)</option>
                  <option value="Registro Civil">Registro Civil (R.C.)</option>
                </select>
                {errors.tipo_documento && (
                  <span className="error-text">{errors.tipo_documento}</span>
                )}
              </div>

              <div className="form-group">
                <label htmlFor="documento">
                  Número de Documento <span className="required-star">*</span>
                </label>
                <input
                  type="text"
                  id="documento"
                  name="documento"
                  value={formData.documento}
                  onChange={handleChange}
                  className={errors.documento ? 'input-error' : ''}
                  required
                />
                {errors.documento && <span className="error-text">{errors.documento}</span>}
              </div>

              <div className="form-group">
                <label htmlFor="email">
                  Correo Electrónico <span className="required-star">*</span>
                </label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  value={formData.email}
                  onChange={handleChange}
                  className={errors.email ? 'input-error' : ''}
                  required
                />
                {errors.email && <span className="error-text">{errors.email}</span>}
              </div>

              <div className="form-group">
                <label htmlFor="telefono">
                  Teléfono / Celular <span className="required-star">*</span>
                </label>
                <input
                  type="tel"
                  id="telefono"
                  name="telefono"
                  value={formData.telefono}
                  onChange={handleChange}
                  className={errors.telefono ? 'input-error' : ''}
                  required
                />
                {errors.telefono && <span className="error-text">{errors.telefono}</span>}
              </div>

              <div className="form-group">
                <label htmlFor="relacion">
                  Relación con la Institución <span className="required-star">*</span>
                </label>
                <select
                  id="relacion"
                  name="relacion"
                  value={formData.relacion}
                  onChange={handleChange}
                  className={errors.relacion ? 'input-error' : ''}
                  required
                >
                  <option value="">-- Seleccione --</option>
                  <option value="Padre de familia">Padre de Familia / Acudiente</option>
                  <option value="Estudiante">Estudiante Activo</option>
                  <option value="Egresado">Egresado / Exalumna</option>
                  <option value="Docente o Administrativo">Docente o Administrativo</option>
                  <option value="Externo">Externo / Proveedor</option>
                </select>
                {errors.relacion && <span className="error-text">{errors.relacion}</span>}
              </div>
            </div>
          </div>

          {showStudentFields && (
            <div className="form-section student-section">
              <h3 className="section-title">3. Datos del Estudiante</h3>
              <div className="form-grid col-2">
                <div className="form-group">
                  <label htmlFor="estudiante_nombre">Nombre Completo del Estudiante</label>
                  <input
                    type="text"
                    id="estudiante_nombre"
                    name="estudiante_nombre"
                    value={formData.estudiante_nombre}
                    onChange={handleChange}
                  />
                </div>

                <div className="form-group">
                  <label htmlFor="estudiante_grado">Grado / Curso</label>
                  <input
                    type="text"
                    id="estudiante_grado"
                    name="estudiante_grado"
                    value={formData.estudiante_grado}
                    onChange={handleChange}
                    placeholder="Ejemplo: Transición, Quinto A, Noveno"
                  />
                </div>
              </div>
            </div>
          )}

          <div className="form-section">
            <h3 className="section-title">
              {showStudentFields ? '4. Detalle de la Solicitud' : '3. Detalle de la Solicitud'}
            </h3>
            <div className="form-group">
              <label htmlFor="mensaje">
                Mensaje o Descripción de la Solicitud <span className="required-star">*</span>
              </label>
              <textarea
                id="mensaje"
                name="mensaje"
                value={formData.mensaje}
                onChange={handleChange}
                rows="6"
                className={errors.mensaje ? 'input-error' : ''}
                placeholder="Por favor describa con claridad y detalle los hechos o la información solicitada..."
                required
              />
              {errors.mensaje && <span className="error-text">{errors.mensaje}</span>}
            </div>

            <div className="form-group file-upload-group">
              <label>Adjuntar Documento Soporte (Opcional)</label>
              
              <div 
                className={`pqrs-drag-drop-zone ${isDragging ? 'is-dragging' : ''} ${file ? 'has-file' : ''} ${errors.adjunto ? 'has-error' : ''}`}
                onDragOver={handleDragOver}
                onDragEnter={handleDragEnter}
                onDragLeave={handleDragLeave}
                onDrop={handleDrop}
                onClick={triggerFileSelect}
                role="button"
                tabIndex={0}
                onKeyDown={(e) => e.key === 'Enter' && triggerFileSelect()}
              >
                <input
                  type="file"
                  id="adjunto"
                  name="adjunto"
                  ref={fileInputRef}
                  onChange={handleFileChange}
                  accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                  style={{ display: 'none' }}
                />

                <div className="drag-drop-content">
                  {file ? (
                    <div className="file-preview-container">
                      <div className="file-icon">
                        {file.name.toLowerCase().endsWith('.pdf') ? (
                          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="pdf-icon">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                            <polyline points="10 9 9 9 8 9" />
                          </svg>
                        ) : (
                          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="img-icon">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <polyline points="21 15 16 10 5 21" />
                          </svg>
                        )}
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
                        <strong>Arrastre y suelte su archivo aquí</strong>, o haga clic para explorar
                      </p>
                      <span className="file-info">
                        Formatos permitidos: PDF, Word (doc/docx), Imágenes (jpg/png). Máx 5MB.
                      </span>
                    </>
                  )}
                </div>
              </div>
              {errors.adjunto && <span className="error-text">{errors.adjunto}</span>}
            </div>
          </div>

          <div className="form-section habeas-data-section">
            <div className="checkbox-group">
              <input
                type="checkbox"
                id="habeas_data"
                name="habeas_data"
                checked={formData.habeas_data}
                onChange={handleChange}
                className={errors.habeas_data ? 'input-error' : ''}
                required
              />
              <label htmlFor="habeas_data">
                Acepto el tratamiento de mis datos personales de acuerdo con la{' '}
                <a href="/calidad-y-pastoral/politica-de-privacidad" target="_blank" rel="noopener noreferrer">
                  Política de Privacidad
                </a>{' '}
                y la Ley de Habeas Data de la institución. <span className="required-star">*</span>
              </label>
            </div>
            {errors.habeas_data && <span className="error-text">{errors.habeas_data}</span>}
          </div>

          {/* ── Cloudflare Turnstile Widget ── */}
          {window.__TURNSTILE_SITE_KEY__ && (
            <div className="form-section turnstile-section">
              <div
                ref={turnstileRef}
                className="turnstile-widget"
                id="pqrs-turnstile-widget"
              />
              {errors.turnstile && (
                <span className="error-text turnstile-error">{errors.turnstile}</span>
              )}
            </div>
          )}

          <button type="submit" className="btn-submit" disabled={isSubmitting}>
            {isSubmitting ? (
              <span className="loading-spinner">
                <svg className="spinner" viewBox="0 0 24 24">
                  <circle className="path" cx="12" cy="12" r="10" fill="none" strokeWidth="3"></circle>
                </svg>
                Procesando solicitud...
              </span>
            ) : (
              'Radicar Solicitud PQRS'
            )}
          </button>
        </form>
      )}
    </div>
  );
}
