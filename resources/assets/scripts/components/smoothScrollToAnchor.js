function setHash(hash) {
  if (history.pushState) {
    history.pushState(null, null, hash);
  } else {
    location.hash = hash;
  }
}

const defaultOptions = {
  offsetTop: $(window).width() >= 992 ? 90 : 70,
  duration: 640,
};

export default options => {
  const $root = $('html, body'),
    readyOptions = $.extend({}, defaultOptions, options);

  $('[href^="#"]').on('click', function(event) {
    let hash = $(this).attr('href');

    if (hash !== '#') {
      let $elem = $(hash);
      if ($elem && $elem.length) {
        $root.stop(true).animate(
          {
            scrollTop: $elem.offset().top - readyOptions.offsetTop,
          },
          readyOptions.duration,
          function() {
            setHash(hash);
          }
        );

        event.preventDefault();
      }
    }
  });
};
