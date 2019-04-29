import initBurger from '../components/burger';
import initHeader from '../components/header';
import initAlertModal from '../components/alertModal';
import initCallrequestModal from '../components/callrequestModal';
// import initOrderModal from '../components/orderModal';
// import initFastOrderModal from '../components/fastOrderModal';
import initSmoothScrollToAnchor from '../components/smoothScrollToAnchor';
// import Lightbox from '../components/Lightbox';

export default {
  init() {
    // JavaScript to be fired on all pages
    initBurger();
    initHeader();
    initSmoothScrollToAnchor();

    const alertModal = initAlertModal();
    $(alertModal.contentContainer).on('click', '[data-diamodal-close]', e => {
      alertModal.close();
    });

    window.__callrequestModal = initCallrequestModal();
    // window.__orderModal = initOrderModal();
    // window.__fastOrderModal = initFastOrderModal();

    // new Lightbox();
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
