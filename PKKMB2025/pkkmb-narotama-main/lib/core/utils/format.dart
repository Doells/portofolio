String ensureHttps(String url) {
  if (url.startsWith('http://')) {
    return url.replaceFirst('http://', 'https://');
  } else if (!url.startsWith('https://')) {
    return 'https://$url';
  }
  return url;
}