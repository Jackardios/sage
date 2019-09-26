{{--
  Title: Форма отправки сообщения
  Description: Форма отправки сообщения
  Category: sage
  Mode: edit
  Icon: 
  Keywords: отправка сообщения
  SupportsMultiple: false
--}}

@php
  $title = (isset($title) && !empty($title)) ? $title : get_field('title');
@endphp

<section class="primary-section primary-section--large bg-dim overflow-hidden">
  <div class="container">
    <h2 class="lg:mb-8 text-center">{{ $title }}</h2>
    <div class="flex flex-wrap justify-center items-stretch -mx-4">
      <div class="py-2 px-4 w-full xl:w-3/4">
        <form action="/" enctype="multipart/form-data" data-ajax-form>
          @php wp_nonce_field( 'user_files', 'fileup_nonce' ); @endphp
          <input type="hidden" name="action" value="send_message">
          <div class="flex flex-wrap -mx-2">
            <div class="w-full md:w-1/2 px-2"><input type="text" name="user_name" class="secondary-input secondary-input--fullwidth mb-4" placeholder="{{ __('Как к вам обращаться?', 'sage') }}"></div>
            <div class="w-full md:w-1/2 px-2"><input type="text" name="user_contact" class="secondary-input secondary-input--fullwidth mb-4" placeholder="{{ __('Контактный телефон или e-mail для связи *', 'sage') }}" required></div>
          </div>
          <textarea name="user_message" class="secondary-input secondary-input--fullwidth" id="user_message" rows="5" placeholder="{{ __('Опишите задачу или пришлите нам ТЗ – и мы тут же свяжемся с вами и расскажем о всех возможных вариантах и условиях реализации', 'sage') }}"></textarea>
          <div class="primary-file-field mt-4">
            <input type="file" id="user_files" name="user_files[]" class="primary-file-field__input" data-multiple-caption="{{ __('Прикреплено {count} файла(ов)', 'sage') }}" multiple>
            <label for="user_files" class="primary-file-field__label flex flex-wrap items-center -mx-3">
              <div class="w-auto p-3"><div class="primary-file-field__icon"><i class="fas fa-paperclip fa-fw"></i></div></div>
              <div class="primary-file-field__text flex-1 p-3 text-sm">
                <div class="font-600">{{ __('Прикрепить файлы', 'sage') }}</div>
                <div class="text-gray-700 mt-1">{{ __('не более 100 Мб', 'sage') }}</div>
              </div>
            </label>
          </div>
          <div class="flex flex-wrap -mx-3">
            <div class="sm:flex-auto p-3 text-right"><p class="inline-block text-sm text-gray-700 mb-3 max-w-lg">{{ __('Нажимая на кнопку “Отправить”, вы даете согласие на обработку персональных данных и соглашаетесь с', 'sage') }} <a href="{{ get_privacy_policy_url() }}">{{ __('политикой конфиденциальности', 'sage') }}</a></p></div>
            <div class="sm:flex-none p-3 text-center"><button type="submit" class="btn btn--accent px-6 sm:px-12 py-3 sm:py-4">{{ __('Отправить', 'sage') }}</button></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>