const UriTransformer = {
  getDefaultUri: function (uri)
  {
    if (uri === '' || uri === null || uri === undefined) {
      uri = window.location.href.split(window.location.host)[1];
    }
    return uri;
  },
  transform: function (uri = '')
  {
    uri = UriTransformer.getDefaultUri(uri);
    let locationPort = (window.location.port != '' ? ':' + window.location.port : '');
    // eslint-disable-next-line no-undef
    let urlPrefix = appUrlProtocole + '://' + window.location.host;
    if (locationPort != '' && !urlPrefix.endsWith(locationPort)) {
      //urlPrefix += ':' + locationPort;
    }
    // eslint-disable-next-line no-undef
    if (appUrlProtocole === 'https') {
      // eslint-disable-next-line no-undef
      uri = uri.replace('http://', appUrlProtocole + '://');
    }
    if (!uri.startsWith(urlPrefix)) {
      uri = urlPrefix + uri;
    }

    return uri;
  },
}

export default UriTransformer
