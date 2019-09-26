import { DiaModalForm } from 'diamodal';
import { normalizeSerializedArray } from '../util/helpers';

export default (selector = '.callrequest-btn') => {
  const $globalLoading = $('#global-loading');
  const callrequestModal = new DiaModalForm({
    title: 'Заявка на обратный звонок',
    inputs: [
      {
        name: 'user_phone',
        type: 'tel',
        placeholder: 'Ваш номер телефона',
        required: true,
      },
      {
        name: 'user_name',
        placeholder: 'Ваше имя',
        required: true,
      },
      {
        name: 'user_agreement',
        type: 'checkbox',
        placeholder: `Я соглашаюсь на передачу персональных данных согласно <a href="${window.wordpress.baseUrl}/privacy-policy/">политике конфиденциальности</a>.`,
        required: true,
      },
    ],
    submitButtomClass: 'mt-4 btn btn--primary btn--large btn--fullwidth',
    onSubmit: e => {
      e.preventDefault();
      e.stopPropagation();
      const data = normalizeSerializedArray($(e.target).serializeArray());

      $.ajax({
        url: window.wordpress.ajaxUrl,
        type: 'POST',
        dataType: 'JSON',
        data: {
          action: 'send_callrequest',
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

          if (data.status === 'error') {
            window.__diamodalAlertModal.open();
          } else {
            callrequestModal.close();
            setTimeout(
              () => window.__diamodalAlertModal.open(),
              callrequestModal._transitionDuration
            );
          }
        },
        error(data) {
          window.__diamodalAlertModal.title = 'Ошибка';
          window.__diamodalAlertModal.content = data.message || data.statusText;
          window.__diamodalAlertModal.open();
        },
      });
    },
  });

  $(document).on('click', selector, function() {
    callrequestModal.open();
    return false;
  });

  return callrequestModal;
};
