import initBurger from '../components/burger';
import initHeader from '../components/header';
import initAlertModal from '../components/alertModal';
import initCallrequestModal from '../components/callrequestModal';
import initSmoothScrollToAnchor from '../components/smoothScrollToAnchor';
import Lightbox from '../components/Lightbox';

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

    const callrequestModal = initCallrequestModal();

    new Lightbox();
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
