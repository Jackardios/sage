// import initHeader from '../components/header';
import initBurger from '../components/burger';
import initPhoneMask from '../components/phoneMask';
import initSmoothScrollToAnchor from '../components/smoothScrollToAnchor';
import initAlertModal from '../components/alertModal';
import initCallrequestModal from '../components/callrequestModal';
import initDetectTabbing from '../components/detectTabbing';
import initDetectInView from '../components/detectInView';
import initAjaxForm from '../components/ajaxForm';
import initNumericField from '../components/numericField';
import initFileField from '../components/fileField';
// import initContentModal from '../components/contentModal';
// import initOrderModal from '../components/orderModal';
// import initFastOrderModal from '../components/fastOrderModal';
// import initDiacart from '../components/diacart';
import Lightbox from '../components/Lightbox';

// blocks
import initContactMap from '../blocks/contactMap';
import initDefaultCarousel from '../blocks/defaultCarousel';
import initHeroSlider from '../blocks/heroSlider';

export default {
  init() {
    // JavaScript to be fired on all pages

    // base scripts
    // initHeader();
    initBurger();
    initPhoneMask();
    initSmoothScrollToAnchor();
    initNumericField();
    initFileField();
    initDetectTabbing();
    initDetectInView();

    // modals
    initAlertModal();
    window.__callrequestModal = initCallrequestModal();
    // window.__orderModal = initOrderModal();
    // window.__fastOrderModal = initFastOrderModal();
    // initContentModal();
    new Lightbox();

    // block scripts
    initContactMap();
    initHeroSlider();
    initDefaultCarousel();
    initAjaxForm('[data-ajax-form]');
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
