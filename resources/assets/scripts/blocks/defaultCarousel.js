import Swiper from '../components/swiper';

export default (containerSelector = '[data-default-carousel]') => {
  $(containerSelector).each(function() {
    const slidesPerView = $(this).data('slidesPerView') || 4;
    const autoplay = $(this).data('autoplay');
    const swiperContainer = $(this).find('.swiper-container')[0];
    const prevBtn = $(this).find('.primary-slider__prev-btn')[0];
    const nextBtn = $(this).find('.primary-slider__next-btn')[0];

    let baseSlidesPerView = 1;

    if (slidesPerView > 2) {
      baseSlidesPerView = 2;
    }

    const breakpointsWidths = [500, 768, 1024, 1200, 1440];
    const breakpoints = {};
    for (let i = 2; i < slidesPerView; i++) {
      const width = breakpointsWidths[i - 2];
      if (width) {
        breakpoints[width] = {
          slidesPerView: i + 1,
        };
      }
    }

    const options = {
      slidesPerView: baseSlidesPerView,
      spaceBetween: 24,
      loop: false,
      autoplay: autoplay && {
        delay: autoplay,
      },
      threshold: 2,
      breakpoints: breakpoints,

      navigation: {
        nextEl: nextBtn,
        prevEl: prevBtn,
      },
      // pagination: {
      //   el: containerSelector + ' .clients-section__pagination',
      //   dynamicBullets: true,
      //   dynamicMainBullets: 2,
      //   bulletClass: 'clients-section__pagination-item',
      //   bulletActiveClass: 'clients-section__pagination-item--active',
      //   clickable: true,
      // },
    };

    new Swiper(swiperContainer, options);
  });
};
