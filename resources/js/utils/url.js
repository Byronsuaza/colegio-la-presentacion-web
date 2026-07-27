export const storageUrl = (path) => {
  if (!path) return null;

  const trimmed = String(path).trim().replace(/\\/g, '/');
  if (!trimmed) return null;

  if (trimmed.startsWith('data:')) {
    return trimmed;
  }

  const localDevUrlPattern = /^https?:\/\/(127\.0\.0\.1|localhost)(:\d+)?\/(.*)$/;
  const localMatch = trimmed.match(localDevUrlPattern);
  if (localMatch) {
    return `/${localMatch[3]}`;
  }

  if (trimmed.startsWith('http://') || trimmed.startsWith('https://')) {
    return trimmed;
  }

  if (trimmed.startsWith('/storage/')) {
    return trimmed;
  }

  if (trimmed.startsWith('storage/')) {
    return `/${trimmed}`;
  }

  if (trimmed.startsWith('/')) {
    return trimmed;
  }

  return `/storage/${trimmed}`;
};