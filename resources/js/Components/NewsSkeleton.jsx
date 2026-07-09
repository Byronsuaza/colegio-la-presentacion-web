import React from 'react';
import './NewsSkeleton.css';

export default function NewsSkeleton({ count = 5 }) {
  const items = Array.from({ length: count });
  return (
    <div className="noticias__bento">
      {items.map((_, i) => (
        <div key={i} className="skeleton-card">
          <div className="skeleton-img" />
          <div className="skeleton-line short" />
          <div className="skeleton-line" />
          <div className="skeleton-line" />
        </div>
      ))}
    </div>
  );
}
