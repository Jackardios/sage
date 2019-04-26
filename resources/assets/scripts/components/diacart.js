import 'diacart/src/polyfills/matches';
import 'diacart/src/polyfills/closest';
import Diacart from 'diacart/src/components/Diacart';

export default () => {
  window.__diacart = new Diacart({
    title: 'Корзина',
    currency: '₽',
    groupBy: null,
    itemHasPrice: true,
    itemHasQuantity: true,
    // template: template,
    // itemTemplate: itemTemplate,
  });

  window.__diacart.on('order', items => {
    const $input = $(window.__orderModal.contentContainer).find(
      'input[name="order"]'
    );
    if ($input) {
      $input.val(JSON.stringify(items));
    }

    window.__orderModal.open();
  });

  window.__diacart.on('add', items => {
    window.__diamodalAlertModal.title = `Услуга добавлена в <a href="${
      window.wordpress.cartUrl
    }">Корзину</a>`;
    window.__diamodalAlertModal.content = `
      <div class="flex flex-wrap -m-2">
        <div class="flex-1 p-2">
          <a class="btn btn--medium btn--primary btn--fullwidth whitespace-no-wrap" data-diamodal-close>Продолжить</a>
        </div>
        <div class="flex-1 p-2">
          <a href="${
            window.wordpress.cartUrl
          }" class="btn btn--medium btn--secondary btn--fullwidth whitespace-no-wrap">Оформить заказ</a>
        </div>
      </div>
    `;
    window.__diamodalAlertModal.open();
  });

  // window.__diacart.on('add', function(itemId) {
  //   console.log(window.__diacart.storage.get(itemId));
  // });
};
