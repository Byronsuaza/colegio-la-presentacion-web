import React, { useEffect } from 'react';
import './Toast.css';

/**
 * Simple toast notification.
 * Props:
 *   - type: 'success' | 'error' (affects styling)
 *   - message: string
 *   - onClose: function to call when toast is dismissed
 */
export default function Toast({ type = 'success', message, onClose }) {
  // Auto‑close after 5 s
  useEffect(() => {
    const timer = setTimeout(() => {
      if (onClose) onClose();
    }, 5000);
    return () => clearTimeout(timer);
  }, []);

  return (
    <div className={`toast toast--${type}`} role="alert">
      <span className="toast__message">{message}</span>
      <button type="button" className="toast__close" onClick={onClose} aria-label="Cerrar">
        ×
      </button>
    </div>
  );
}
