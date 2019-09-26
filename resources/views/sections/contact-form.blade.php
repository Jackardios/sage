<section class="primary-section primary-section--large bg-dim overflow-hidden" id="contact-form">
  <div class="container">
    <h2 class="lg:mb-8 text-center">{{ __('Остались вопросы? Оставьте заявку и мы перезвоним вам!', 'sage') }}</h2>
      <form class="flex flex-wrap justify-center items-stretch -mx-2" data-callrequest-form>
        <input type="hidden" name="action" value="send_callrequest">
        <div class="w-full md:w-auto flex-auto p-2"><input type="text" name="user_name" class="secondary-input secondary-input--fullwidth" placeholder="{{ __('Как к вам обращаться?', 'sage') }}"></div>
        <div class="w-full md:w-auto flex-auto p-2"><input type="tel" name="user_phone" class="secondary-input secondary-input--fullwidth phone-mask" required placeholder="{{ __('Номер телефона', 'sage') }}"></div>
        <div class="w-full md:w-auto p-2 text-center"><button type="submit" class="btn btn--accent btn--medium block h-full">{{ __('Отправить', 'sage') }}</button></div>
        <div class="w-full my-4 p-2"><p class="inline-block text-sm text-gray-700 mb-3 max-w-lg">{{ __('Нажимая на кнопку “Отправить”, вы даете согласие на обработку персональных данных и соглашаетесь с', 'sage') }} <a href="/privacy-policy">{{ __('политикой конфиденциальности', 'sage') }}</a></p></div>
      </form>
    </div>
  </div>
</section>