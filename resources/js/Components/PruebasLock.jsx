import React, { useState, useCallback } from 'react';
import './PruebasLock.css';

/**
 * Bloqueo inline de contraseña para Pruebas Diagnósticas.
 * El desbloqueo vive solo en el estado de React: al navegar fuera y volver,
 * la página se bloquea automáticamente de nuevo.
 */
export default function PruebasLock({ onUnlock }) {
  const [password, setPassword]   = useState('');
  const [showPwd, setShowPwd]     = useState(false);
  const [loading, setLoading]     = useState(false);
  const [error, setError]         = useState('');
  const [isShaking, setIsShaking] = useState(false);

  const triggerShake = useCallback(() => {
    setIsShaking(true);
    setTimeout(() => setIsShaking(false), 500);
  }, []);

  const handleSubmit = useCallback(async (e) => {
    e.preventDefault();
    if (!password.trim()) {
      setError('Por favor ingresa la contraseña.');
      triggerShake();
      return;
    }

    setLoading(true);
    setError('');

    try {
      const getCsrfToken = () => {
        const match = document.cookie.match(/XSRF-TOKEN=([^;]+)/);
        return match ? decodeURIComponent(match[1]) : '';
      };

      const response = await fetch('/api/pruebas-diagnosticas/verificar', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-XSRF-TOKEN': getCsrfToken(),
        },
        body: JSON.stringify({ password }),
      });

      if (response.ok) {
        const data = await response.json();
        if (data.ok) {
          onUnlock();
          return;
        }
      }

      if (response.status === 429) {
        setError('Demasiados intentos. Espera un momento e inténtalo de nuevo.');
      } else {
        setError('Contraseña incorrecta. Verifica e inténtalo de nuevo.');
      }
      triggerShake();
    } catch {
      setError('Error de conexión. Por favor recarga la página.');
      triggerShake();
    } finally {
      setLoading(false);
    }
  }, [password, onUnlock, triggerShake]);

  return (
    <div className="pruebas-lock" role="region" aria-label="Acceso restringido a Pruebas Diagnósticas">

      {/* Ícono */}
      <div className="pruebas-lock__icon-wrap" aria-hidden="true">
        <div className="pruebas-lock__icon-ring">
          <svg
            width="28" height="28"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth="1.8"
            strokeLinecap="round"
            strokeLinejoin="round"
          >
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
          </svg>
        </div>
      </div>

      {/* Encabezado */}
      <div className="pruebas-lock__header">
        <span className="pruebas-lock__eyebrow">Área restringida</span>
        <h2 className="pruebas-lock__title">Acceso con contraseña</h2>
        <p className="pruebas-lock__subtitle">
          Esta sección es de acceso privado. Ingresa la contraseña proporcionada por la institución para ver las pruebas diagnósticas.
        </p>
      </div>

      {/* Tarjeta con formulario */}
      <div className="pruebas-lock__card">
        <form className="pruebas-lock__form" onSubmit={handleSubmit} noValidate>

          <div>
            <label htmlFor="pruebas-password" className="pruebas-lock__label">
              Contraseña
            </label>
            <div className="pruebas-lock__input-wrap">
              <input
                id="pruebas-password"
                type={showPwd ? 'text' : 'password'}
                className={`pruebas-lock__input${isShaking ? ' is-error' : ''}`}
                value={password}
                onChange={(e) => { setPassword(e.target.value); setError(''); }}
                placeholder="Ingresa la contraseña"
                autoComplete="current-password"
                autoFocus
                disabled={loading}
                aria-describedby={error ? 'pruebas-error-msg' : undefined}
              />
              <button
                type="button"
                className="pruebas-lock__toggle"
                onClick={() => setShowPwd((v) => !v)}
                aria-label={showPwd ? 'Ocultar contraseña' : 'Mostrar contraseña'}
                tabIndex={-1}
              >
                {showPwd ? (
                  <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94" />
                    <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19" />
                    <line x1="1" y1="1" x2="23" y2="23" />
                  </svg>
                ) : (
                  <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                    <circle cx="12" cy="12" r="3" />
                  </svg>
                )}
              </button>
            </div>
          </div>

          {/* Mensaje de error */}
          {error && (
            <div className="pruebas-lock__error" id="pruebas-error-msg" role="alert">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="12" />
                <line x1="12" y1="16" x2="12.01" y2="16" />
              </svg>
              {error}
            </div>
          )}

          {/* Botón */}
          <button
            type="submit"
            id="pruebas-lock-submit"
            className="pruebas-lock__btn"
            disabled={loading}
          >
            {loading ? (
              <>
                <span className="pruebas-lock__spinner" aria-hidden="true" />
                Verificando…
              </>
            ) : (
              <>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                  <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
                Ingresar
              </>
            )}
          </button>
        </form>

        <p className="pruebas-lock__footer">
          ¿No tienes la contraseña?{' '}
          <a href="/comunicaciones-contacto/contactenos">Contáctanos</a>
        </p>
      </div>

    </div>
  );
}
