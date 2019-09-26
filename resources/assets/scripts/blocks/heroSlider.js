import Swiper from '../components/swiper';

export default (selector = '[data-hero-slider]') => {
  $(selector).each(function() {
    const $slider = $(this);
    const $bg = $slider.find('.main-slider__bg');
    $bg.first().addClass('active');

    const swiper = new Swiper(selector + ' .swiper-container', {
      loop: true,
      autoplay: {
        delay: 8000,
      },
      effect: 'fade',
      fadeEffect: {
        crossFade: true,
      },
      pagination: {
        el: selector + ' .main-slider__pagination',
        bulletClass: 'primary-dots-item',
        bulletActiveClass: 'primary-dots-item--active',
        clickable: true,
      },

      navigation: {
        nextEl: selector + ' .main-slider__next-btn',
        prevEl: selector + ' .main-slider__prev-btn',
      },
    });
    swiper.on('slideChange', () => {
      $bg
        .removeClass('active')
        .filter(`[data-slide-index="${swiper.realIndex}"]`)
        .addClass('active');
    });
  });
};
