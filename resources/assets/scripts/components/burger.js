const $body = $('body'),
  $burgerMenu = $('#burger-menu'),
  $burgerBtn = $('#burger-btn');

export default () => {
  let isActive = false;

  function activate() {
    $burgerBtn.addClass('active');
    $burgerMenu.addClass('active');
    $body.addClass('hidden-scroll');
    isActive = true;
  }

  function deactivate() {
    $burgerBtn.removeClass('active');
    $burgerMenu.removeClass('active');
    $body.removeClass('hidden-scroll');
    isActive = false;
  }

  $burgerBtn.on('click', () => {
    if (isActive) {
      deactivate();
    } else {
      activate();
    }

    return false;
  });

  $burgerMenu.on('click', 'a[href^="#"]', () => {
    deactivate();
  });
};
