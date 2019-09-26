export default (initFuncName = '') => {
  if (!window.ymapScriptAdded) {
    const elem = document.createElement('script');
    elem.type = 'text/javascript';
    elem.src = `//api-maps.yandex.ru/2.1/?lang=ru-RU&onload=${initFuncName}`;
    document.getElementsByTagName('body')[0].appendChild(elem);
    window.ymapScriptAdded = true;
  } else {
    window[initFuncName]();
  }
};
