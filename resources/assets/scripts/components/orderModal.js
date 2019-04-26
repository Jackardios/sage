import { DiaModalForm } from 'diamodal';
import { normalizeSerializedArray } from '../util/helpers';

export default () => {
  const $globalLoading = $('#global-loading');
  const orderModal = new DiaModalForm({
    title: 'Заказ услуг из корзины',
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
        name: 'user_email',
        type: 'email',
        placeholder: 'Ваш email',
        required: false,
      },
      {
        name: 'user_message',
        type: 'textarea',
        placeholder: 'Ваше сообщение',
        required: false,
      },
      {
        name: 'user_agreement',
        type: 'checkbox',
        placeholder: `Я соглашаюсь на передачу персональных данных согласно <a href="${
          window.wordpress.baseUrl
        }/privacy-policy/">политике конфиденциальности</a>.`,
        required: true,
      },
      {
        name: 'order',
        type: 'hidden',
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
          action: 'send_order',
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
            if (window.__diacart) {
              window.__diacart.clear();
            }
            orderModal.close();
            setTimeout(
              () => window.__diamodalAlertModal.open(),
              orderModal._transitionDuration
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

  return orderModal;
};
