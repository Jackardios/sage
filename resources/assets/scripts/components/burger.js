const $body = $('body'),
  $burgerMenu = $('#burger-menu'),
  $burgerBtn = $('#burger-btn');

export default () => {
  let isActive = false;

  function activate() {
    $burgerBtn.addClass('active');
    $burgerMenu.addClass('active');
    $body.addClass('overflow-hidden');
    isActive = true;
  }

  function deactivate() {
    $burgerBtn.removeClass('active');
    $burgerMenu.removeClass('active');
    $body.removeClass('overflow-hidden');
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

  $burgerMenu.on('click', 'a', () => {
    deactivate();
  });
};
