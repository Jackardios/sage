{{--
  Title: Форма обратного звонка
  Description: Форма обратного звонка
  Category: sage
  Mode: edit
  Icon: 
  Keywords: обратный звонок
  SupportsMultiple: false
--}}

@php
  $title = (isset($title) && !empty($title)) ? $title : get_field('title');
@endphp

<section class="primary-section primary-section--large bg-dim overflow-hidden" id="contact-form">
  <div class="container">
    <h2 class="lg:mb-8 text-center">{{ $title }}</h2>
    <form action="/" class="flex flex-wrap justify-center items-stretch -mx-2" data-ajax-form>
      <input type="hidden" name="action" value="send_callrequest">
      <div class="w-full md:w-auto flex-auto p-2"><input type="text" name="user_name" class="secondary-input secondary-input--fullwidth" placeholder="{{ __('Как к вам обращаться?', 'sage') }}"></div>
      <div class="w-full md:w-auto flex-auto p-2"><input type="tel" name="user_phone" class="secondary-input secondary-input--fullwidth phone-mask" required placeholder="{{ __('Номер телефона', 'sage') }}"></div>
      <div class="w-full md:w-auto p-2 text-center"><button type="submit" class="btn btn--accent btn--medium block h-full">{{ __('Отправить', 'sage') }}</button></div>
      <div class="w-full my-4 p-2"><p class="inline-block text-sm text-gray-700 mb-3 max-w-lg">{{ __('Нажимая на кнопку “Отправить”, вы даете согласие на обработку персональных данных и соглашаетесь с', 'sage') }} <a href="{{ get_privacy_policy_url() }}">{{ __('политикой конфиденциальности', 'sage') }}</a></p></div>
    </form>
  </div>
</section>