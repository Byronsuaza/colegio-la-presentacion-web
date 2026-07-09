import React from 'react';
import './PdfModal.css';

export default function PdfModal({ isOpen, onClose, title, pdfUrl }) {
  if (!isOpen) return null;

  return (
    <div className="pdf-modal-overlay" onClick={onClose}>
      <div className="pdf-modal" onClick={(e) => e.stopPropagation()}>
        <div className="pdf-modal__header">
          <h2>{title}</h2>
          <button className="pdf-modal__close" onClick={onClose}>
            ✕
          </button>
        </div>
        <iframe
          src={pdfUrl}
          title={title}
          className="pdf-modal__iframe"
        />
      </div>
    </div>
  );
}
