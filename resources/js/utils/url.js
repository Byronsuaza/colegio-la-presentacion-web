export const storageUrl = (path) => {
  if (!path) return null;

  const trimmed = String(path).trim().replace(/\\/g, '/');
  if (!trimmed) return null;

  if (trimmed.startsWith('http://') || trimmed.startsWith('https://') || trimmed.startsWith('data:')) {
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