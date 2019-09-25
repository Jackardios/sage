// import initHeader from '../components/header';
import initBurger from '../components/burger';
import initPhoneMask from '../components/phoneMask';
import initSmoothScrollToAnchor from '../components/smoothScrollToAnchor';
import initAlertModal from '../components/alertModal';
import initCallrequestModal from '../components/callrequestModal';
import initDetectTabbing from '../components/detectTabbing';

// import initContentModal from '../components/contentModal';
// import initOrderModal from '../components/orderModal';
// import initFastOrderModal from '../components/fastOrderModal';
// import initDiacart from '../components/diacart';
// import Lightbox from '../components/Lightbox';

export default {
  init() {
    // JavaScript to be fired on all pages
    // initHeader();
    initBurger();
    initPhoneMask();
    initSmoothScrollToAnchor();
    initDetectTabbing();

    initAlertModal();
    window.__callrequestModal = initCallrequestModal();
    // window.__orderModal = initOrderModal();
    // window.__fastOrderModal = initFastOrderModal();

    // initContentModal();
    // new Lightbox();
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
