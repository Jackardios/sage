import PhotoSwipe from 'photoswipe';
import PhotoSwipeUI_Default from 'photoswipe/dist/photoswipe-ui-default';

const defaultOptions = {
  autoInit: true,
  pswpElementSelector: '#pswp',
  galleryAttribute: 'data-lightbox-group',
  sizeAttribute: 'data-lightbox-size',
  photoSwipeOptions: {
    showAnimationDuration: 0,
    hideAnimationDuration: 0,
  },
};

// <a href="..." data-lightbox-size=""
export default class Lightbox {
  constructor(selector = '.lightbox', options = {}) {
    this._selector = selector;
    this.options = Object.assign({}, defaultOptions, options);
    if (this.options.autoInit) {
      this.init();
    }
  }

  init() {
    const self = this;
    this._pswpElement = $(this.options.pswpElementSelector)[0];
    $(document).on('click', this._selector, function(e) {
      e.preventDefault();
      self.open(this);
    });
  }

  initPhotoSwipe(items, options) {
    const self = this;
    this.photoSwipe = new PhotoSwipe(
      this._pswpElement,
      PhotoSwipeUI_Default,
      items,
      options
    );
    this.photoSwipe.listen('gettingData', (index, item) => {
      if (!item.w || !item.h) {
        const innerImgEl = item.el.getElementsByTagName('img')[0];
        if (innerImgEl) {
          item.w = innerImgEl.width;
          item.h = innerImgEl.height;
        }

        const img = new Image();
        img.onload = function() {
          item.w = this.width;
          item.h = this.height;
          self.photoSwipe.updateSize(true);
        };
        img.src = item.src;
      }
    });
    this.photoSwipe.init();
  }

  open(elem) {
    const $elem = $(elem),
      group = $elem.attr(this.options.galleryAttribute);

    const { index, items } = this._getIndexAndGroupItems(elem, group);
    const photoSwipeOptions = Object.assign(
      {},
      this.options.photoSwipeOptions,
      {
        index,
      }
    );

    if (items && items.length) {
      this.initPhotoSwipe(items, photoSwipeOptions);
    }
  }

  _getIndexAndGroupItems(elem, group) {
    let items = [],
      index = 0;
    if (group) {
      const $groupElements = $(`[${this.options.galleryAttribute}=${group}]`);
      $groupElements.each((i, groupElem) => {
        items.push(this._getItemDataFromElem(groupElem));
        if (groupElem.isEqualNode(elem)) {
          index = i;
        }
      });
    } else {
      items.push(this._getItemDataFromElem(elem));
    }
    return {
      index,
      items,
    };
  }

  _getItemDataFromElem(elem) {
    const $elem = $(elem);
    let sizeValue = $elem.attr(this.options.sizeAttribute);
    let size;

    if (sizeValue) {
      try {
        size = JSON.parse(sizeValue);
      } catch (e) {
        size = null;
      }
    }

    if (!size) {
      return {
        src: $elem.attr('href'),
        title: $elem.attr('title'),
        el: elem,
      };
    }
    return {
      src: $elem.attr('href'),
      title: $elem.attr('title'),
      el: elem,
      w: parseInt(size[0], 10),
      h: parseInt(size[1], 10),
    };
  }
}
