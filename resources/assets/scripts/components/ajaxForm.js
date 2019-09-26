import { normalizeSerializedArray } from '../util/helpers';

const defaultOnSuccess = data => {
  const title = data.status === 'error' ? 'Ошибка' : 'Успешно';

  window.__diamodalAlertModal.title = title;
  window.__diamodalAlertModal.content = data.message || data.statusText;
  window.__diamodalAlertModal.open();
};

const defaultOnError = data => {
  window.__diamodalAlertModal.title = 'Ошибка';
  window.__diamodalAlertModal.content = data.message || data.statusText;
  window.__diamodalAlertModal.open();
};

export default (
  formSelector,
  action,
  onSuccess = defaultOnSuccess,
  onError = defaultOnError
) => {
  const $globalLoading = $('#global-loading');
  const $form = $(formSelector);
  $form.on('submit', function(e) {
    e.preventDefault();
    const dataArray = normalizeSerializedArray($(this).serializeArray());
    const formData = new FormData();
    $.each(dataArray, (name, value) => {
      formData.append(name, value);
    });

    $form.find('input[type="file"]').each(function() {
      $.each(this.files, (i, file) => {
        formData.append(this.name, file);
      });
    });

    if (!dataArray['action']) {
      formData.append('action', action);
    }

    $.ajax({
      url: window.wordpress.ajaxUrl,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      beforeSend() {
        $globalLoading.addClass('active');
      },
      complete() {
        $globalLoading.removeClass('active');
      },
      success: onSuccess,
      error: onError,
    });
  });
};
