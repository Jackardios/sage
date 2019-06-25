import inView from 'in-view';

function addYmapScript() {
  const elem = document.createElement('script');
  elem.type = 'text/javascript';
  elem.src =
    '//api-maps.yandex.ru/2.1/?load=Map,Placemark,control.ZoomControl,GeoObject&lang=ru-RU&onload=initContactMap';
  document.getElementsByTagName('body')[0].appendChild(elem);
}

function initContactMap(contactMapId) {
  const contactMapSelector = `#${contactMapId}`;
  const zoomControl = new window.ymaps.control.ZoomControl({
    options: {
      position: {
        top: 24,
        right: 24,
      },
    },
  });

  let ymap = new window.ymaps.Map(contactMapId, {
    center: [59.911290518341055, 30.50183179869501],
    zoom: 15,
    controls: [zoomControl],
  });
  ymap.behaviors.disable('scrollZoom');

  const $contactMap = $(contactMapSelector);
  const mapData = $contactMap.data('map');

  if (mapData) {
    const geoObject = new window.ymaps.GeoObject({
      geometry: mapData,
    });

    ymap.geoObjects.add(geoObject);
    ymap.setCenter([mapData.coordinates[0], mapData.coordinates[1]]);
  }
}

export default (contactMapId = 'contact-map') => {
  const contactMapSelector = `#${contactMapId}`;
  window.initContactMap = () => initContactMap(contactMapId);
  inView(contactMapSelector).once('enter', () => {
    addYmapScript();
  });
};
