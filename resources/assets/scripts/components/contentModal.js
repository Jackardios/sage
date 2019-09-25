import { DiaModal } from 'diamodal';
import modalTemplate from '../templates/content-modal.art';
import modalContentTemplate from '../templates/content-modal-content.art';

export default (selector = '.content-modal-item') => {
  const $items = $(selector);
  const itemLastIndex = $items.length - 1;
  const contentModal = new DiaModal({
    template: modalTemplate,
  });

  let currentItemIndex;

  function moveToItem(index) {
    if (itemLastIndex) {
      if (index > itemLastIndex) {
        index = 0;
      } else if (index < 0) {
        index = itemLastIndex;
      }
      const item = $items[index];

      if (item) {
        const data = $(item).data('json');

        contentModal.content = modalContentTemplate(data);
        contentModal.open();
        currentItemIndex = index;
      }
    }
  }

  if ($items && $items.length) {
    $items.on('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      const data = $(this).data('json');

      contentModal.content = modalContentTemplate(data);
      contentModal.open();
      currentItemIndex = $items.index(this);
    });

    $(contentModal.contentContainer).on('click', '.callrequest-btn', () => {
      contentModal.close();
      window.__callrequestModal.open();
    });

    $(document).on('click', '.content-modal__prev-btn', function(e) {
      e.preventDefault();
      e.stopPropagation();
      moveToItem(currentItemIndex - 1);
    });

    $(document).on('click', '.content-modal__next-btn', function(e) {
      e.preventDefault();
      moveToItem(currentItemIndex + 1);
    });
  }
};
