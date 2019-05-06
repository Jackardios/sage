import initBurger from '../components/burger';
import initHeader from '../components/header';
import initSmoothScrollToAnchor from '../components/smoothScrollToAnchor';
import initAlertModal from '../components/alertModal';
import initCallrequestModal from '../components/callrequestModal';
// import initOrderModal from '../components/orderModal';
// import initFastOrderModal from '../components/fastOrderModal';
// import initDiacart from '../components/diacart';
// import Lightbox from '../components/Lightbox';

export default {
  init() {
    // JavaScript to be fired on all pages
    initBurger();
    initHeader();
    initSmoothScrollToAnchor();

    initAlertModal();
    window.__callrequestModal = initCallrequestModal();
    // window.__orderModal = initOrderModal();
    // window.__fastOrderModal = initFastOrderModal();

    // new Lightbox();
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
