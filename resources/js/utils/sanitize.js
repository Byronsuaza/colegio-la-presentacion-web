import DOMPurify from 'dompurify';

export function sanitizeHtml(html) {
  if (!html) return '';
  return DOMPurify.sanitize(html, {
    ALLOWED_TAGS: [
      'p', 'br', 'b', 'i', 'u', 'em', 'strong', 'span',
      'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
      'ul', 'ol', 'li',
      'a', 'img', 'table', 'thead', 'tbody', 'tr', 'th', 'td',
      'blockquote', 'pre', 'code', 'hr', 'div',
      'iframe', 'video', 'source',
    ],
    ALLOWED_ATTR: [
      'href', 'target', 'rel', 'src', 'alt', 'title',
      'width', 'height', 'class', 'id', 'style',
      'frameborder', 'allow', 'allowfullscreen',
      'controls', 'autoplay', 'loop', 'muted', 'playsinline',
    ],
  });
}