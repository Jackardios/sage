const queryString = require('query-string');

function generateUID() {
  return (
    '_' +
    Math.random()
      .toString(12)
      .substr(2, 6)
  );
}

function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function normalizeSerializedArray(serializedArray) {
  let normalizedData = new Object();
  $.each(serializedArray, (idx, obj) => {
    normalizedData[obj.name] = obj.value;
  });
  return normalizedData;
}

function getImageSrcSet(imageSizes) {
  const keys = Object.keys(imageSizes);
  const length = keys.length / 3;
  let srcSet = '';

  for (let i = 1; i <= length; i++) {
    let k = i * 3;
    const width = imageSizes[keys[k - 1]],
      url = imageSizes[keys[k - 3]];

    srcSet += `${url} ${width}w`;

    if (i < length) {
      srcSet += ', ';
    }
  }

  return srcSet;
}

function updateQueryStringParam(newParams = {}) {
  const baseUrl = [
    location.protocol,
    '//',
    location.host,
    location.pathname,
  ].join('');
  let parsed = queryString.parse(location.search);
  parsed = Object.assign(parsed, newParams);
  window.history.replaceState(
    {},
    '',
    baseUrl + '?' + queryString.stringify(parsed)
  );
}

export {
  generateUID,
  getParameterByName,
  getImageSrcSet,
  updateQueryStringParam,
  normalizeSerializedArray,
};
