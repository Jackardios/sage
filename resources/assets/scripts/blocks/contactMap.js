import addYmapScriptInView from '../components/addYmapScriptInView';
// import mapPointIcon from '../../images/icons/map-point.svg';

function initContactMap(contactMapId, $contactMap) {
  const $window = $(window);
  const $root = $('html, body');
  const $buttons = $('.contacts__address-btn');
  const $addresses = $('.contacts__address');
  let addresses = $contactMap.data('addresses');

  let ymap = new window.ymaps.Map(contactMapId, {
    center: [59.911290518341055, 30.50183179869501],
    zoom: 15,
    controls: ['zoomControl'],
  });
  ymap.behaviors.disable('scrollZoom');

  if (addresses) {
    addresses = addresses.map(address => {
      address.address_map = JSON.parse(address.address_map);
      return address;
    });

    addresses.forEach(address => {
      const geoObject = new window.ymaps.GeoObject(
        {
          geometry: address.address_map,
          properties: {
            balloonContent: address.title,
          },
        },
        {
          // Опции.
          // Необходимо указать данный тип макета.
          // iconLayout: 'default#image',
          // Своё изображение и`конки метки.
          // iconImageHref: mapPointIcon,
          // Размеры метки.
          // iconImageSize: [50, 67],
          // Смещение левого верхнего угла иконки относительно
          // её "ножки" (точки привязки).
          // iconImageOffset: [-25, -67],
          hasBalloon: true,
          openBalloonOnClick: true,
        }
      );

      ymap.geoObjects.add(geoObject);
    });
    ymap.setCenter([
      addresses[0].address_map.coordinates[0],
      addresses[0].address_map.coordinates[1],
    ]);
  }

  function activateLocation(index) {
    $buttons
      .removeClass('active')
      .filter(`[data-index=${index}]`)
      .addClass('active');

    $addresses
      .addClass('hidden')
      .filter(`[data-index=${index}]`)
      .removeClass('hidden');

    if ($window.width() < 1024) {
      $root.stop(true).animate({
        scrollTop: $contactMap.offset().top - 130,
      });
    }

    const address = addresses[index];
    ymap.setCenter(address.address_map.coordinates);
  }

  if ($buttons.length) {
    activateLocation($buttons.data('index'));

    $buttons.on('click', function(e) {
      e.preventDefault();
      activateLocation($(this).data('index'));
    });
  }
}

export default (contactMapId = 'contact-map') => {
  const contactMapSelector = '#' + contactMapId;
  const $contactMap = $(contactMapSelector);

  if ($contactMap && $contactMap.length) {
    window.initContactMap = () => initContactMap(contactMapId, $contactMap);
    addYmapScriptInView(contactMapSelector, 'initContactMap');
  }
};
