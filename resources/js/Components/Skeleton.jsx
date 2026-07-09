import React from 'react';
import './Skeleton.css';

/**
 * Reusable animated skeleton placeholder to improve perceived performance (UX).
 */
export function Skeleton({ width = '100%', height = '1rem', borderRadius = '4px', className = '' }) {
  return (
    <div 
      className={`skeleton-shimmer ${className}`}
      style={{ width, height, borderRadius }}
      aria-hidden="true"
    />
  );
}

/**
 * Skeleton placeholder matching the design of a gallery/album card.
 */
export function SkeletonGalleryCard() {
  return (
    <div className="skeleton-card skeleton-gallery-card">
      <div className="skeleton-card__media">
        <Skeleton width="100%" height="100%" borderRadius="0px" />
      </div>
      <div className="skeleton-card__body">
        <Skeleton width="40%" height="0.75rem" className="mb-2" />
        <Skeleton width="85%" height="1.1rem" className="mb-3" />
        <Skeleton width="100%" height="0.8rem" className="mb-2" />
        <Skeleton width="60%" height="0.8rem" />
      </div>
    </div>
  );
}

/**
 * Skeleton placeholder matching the design of a PDF document card.
 */
export function SkeletonPdfCard() {
  return (
    <div className="skeleton-pdf-card">
      <div className="skeleton-pdf-card__info">
        <Skeleton width="70%" height="1.1rem" className="mb-2" />
        <Skeleton width="40%" height="0.8rem" />
      </div>
      <Skeleton width="90px" height="38px" borderRadius="6px" />
    </div>
  );
}
