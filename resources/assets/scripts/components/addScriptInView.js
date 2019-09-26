import inView from 'in-view';

export default (selector = '[data-add-script-on-view]') => {
  const $element = $(selector);

  if ($element && $element.length) {
    const scriptElem = document.createElement('script');
    scriptElem.type = 'text/javascript';
    scriptElem.src = $element.data('addScriptOnView');

    inView(selector).once('enter', () => {
      $element.append(scriptElem);
    });
  }
};
