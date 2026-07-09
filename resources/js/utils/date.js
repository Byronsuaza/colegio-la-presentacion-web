export const formatDate = (value) => {
  const date = new Date(value);
  if (Number.isNaN(date.getTime())) return '';
  return date.toLocaleDateString('es-ES', {
    day: 'numeric',
    month: 'short',
    year: 'numeric',
  });
};

export const parseDate = (dateStr) => {
  if (!dateStr) return { day: '', month: '' };
  const months = ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'];
  const parts = dateStr.split('T')[0].split('-');
  if (parts.length === 3) {
    const monthIndex = parseInt(parts[1], 10) - 1;
    const day = parseInt(parts[2], 10);
    return { day: day.toString().padStart(2, '0'), month: months[monthIndex] || '' };
  }
  const d = new Date(dateStr);
  if (Number.isNaN(d.getTime())) return { day: '', month: '' };
  return { day: d.getDate().toString().padStart(2, '0'), month: months[d.getMonth()] || '' };
};