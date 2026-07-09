export const makeExcerpt = (content) => {
  const cleanContent = content ? content.replace(/<[^>]+>/g, '') : '';
  return cleanContent.length > 100 ? `${cleanContent.substring(0, 100)}...` : cleanContent;
};