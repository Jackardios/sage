import { normalizeSerializedArray } from '../util/helpers';

export default (formSelector = '#contact-form') => {
  const $globalLoading = $('#global-loading');
  $(formSelector).on('submit', function(e) {
    e.preventDefault();
    const data = normalizeSerializedArray($(this).serializeArray());

    $.ajax({
      url: window.wordpress.ajaxUrl,
      type: 'POST',
      dataType: 'JSON',
      data: {
        action: 'send_message',
        ...data,
      },
      beforeSend() {
        $globalLoading.addClass('active');
      },
      complete() {
        $globalLoading.removeClass('active');
      },
      success(data) {
        const title = data.status === 'error' ? 'Ошибка' : 'Успешно';

        window.__diamodalAlertModal.title = title;
        window.__diamodalAlertModal.content = data.message || data.statusText;
        window.__diamodalAlertModal.open();
      },
      error(data) {
        window.__diamodalAlertModal.title = 'Ошибка';
        window.__diamodalAlertModal.content = data.message || data.statusText;
        window.__diamodalAlertModal.open();
      },
    });
  });
};
