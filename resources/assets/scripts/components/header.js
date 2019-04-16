export default () => {
  const $header = $('#main-header'),
    $window = $(window),
    $document = $(document);

  function handleHeaderShadow() {
    let scrollPoint = $document.scrollTop();

    if (scrollPoint > 10) {
      $header.addClass('primary-header--shadowed');
    } else {
      $header.removeClass('primary-header--shadowed');
    }
  }

  $window.on('scroll', handleHeaderShadow);
  handleHeaderShadow();
};
