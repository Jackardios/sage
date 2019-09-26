<footer class="primary-footer overflow-hidden">
  <div class="primary-footer-top bg-dark text-white">
    <div class="container">
      <div class="primary-footer-bottom__container flex flex-wrap lg:flex-no-wrap items-start justify-start -mx-6 py-4">
        <div class="w-auto p-6">
          <h3>Страницы</h3>
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'primary-footer-list']) !!}
          @endif
        </div>
        <div class="flex-auto p-6">
          <h3>Связаться с нами</h3>
          <div class="flex flex-wrap -m-4">
            <div class="p-4">
              <div class="flex items-center -mx-1">
                <div class="w-auto p-1 text-xl"><i class="fas fa-phone fa-fw"></i></div>
                <div class="flex-auto p-1">
                  @if(!empty($phones))
                    @foreach($phones as $phone)
                      <a class="block mb-1 text-white hover:text-primary-300 color-transition text-lg" href="tel:{{ App\strip_phone($phone['phone']) }}">{{ $phone['phone'] }}</a>
                    @endforeach
                  @endif
                </div>
              </div>
              <div class="flex items-center -mx-1">
                <div class="w-auto p-1 text-xl"><i class="fas fa-envelope fa-fw"></i></div>
                <div class="flex-auto p-1">
                  @if(!empty($emails))
                    @foreach($emails as $email)
                      <a class="block mb-1 text-white hover:text-primary-300 color-transition text-lg" href="mailto:{{ $email['email'] }}">{{ $email['email'] }}</a>
                    @endforeach
                  @endif
                </div>
              </div>
              @if(!empty($addresses))
                @foreach($addresses as $address)
                  <div class="flex items-center -mx-1">
                    <div class="w-auto p-1 text-xl"><i class="fas fa-map-marker-alt fa-fw"></i></div>
                    <div class="flex-auto p-1">
                      <a href="{{ get_the_permalink($contacts_page) }}#map" class="w-auto mr-8 text-gray-400 hover:text-white color-transition">{{ $address['address'] }}</a>
                    </div>
                  </div>
                @endforeach
              @endif
            </div>
          </div>
        </div>
        <div class="w-full lg:w-auto p-6 lg:text-right">
          @if($logo_inversed)
            <a class="primary-footer-logo border-none" href="{{ home_url('/') }}">{!! wp_get_attachment_image( $logo_inversed, 'medium', false, ['class' => 'primary-footer-logo__image', 'data-no-lazy' => '1', 'alt' => get_bloginfo('name', 'display')] ) !!}</a>
          @endif
          {{-- <button type="button" class="callrequest-btn btn btn--accent btn--medium shadow-md">Обратный звонок</button> --}}
          @if(!empty($socials))
            <div class="socials-list mt-2">
              @foreach($socials as $social)
                <a href="{{ $social['link'] }}" target="_blank" rel="noopener" class="socials-list__item socials-list__item--white socials-list__item--large" title="{{ $social['text'] }}">{!! $social['icon'] !!}</a>
              @endforeach
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="primary-footer-bottom bg-dim text-gray-700 text-sm font-400 overflow-hidden">
    <div class="container">
      <div class="flex flex-wrap items-center -mx-4 py-1">
        <div class="w-full lg:w-auto py-2 px-4 md:flex-1 -mb-4">{!! $footer_text !!}</div>
        <div class="w-full lg:w-auto py-2 px-4">
          <a class="font-primary underline text-gray-700 hover:no-underline hover:text-primary-500 mr-4" href="{{ get_privacy_policy_url() }}">Политика конфиденциальности</a>
        </div>
        <div class="w-full lg:w-auto py-2 px-4">
          <a href="https://web.media/" target="_blank" rel="noopener" class="webmedia-created-by">
            <img src="@asset('images/webmedia-logo.svg')" alt="WEB.MEDIA" class="webmedia-created-by__logo">
            <div class="webmedia-created-by__text">Создано в<br>WEB.MEDIA</div>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>
<script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=CustomEvent,Array.prototype.some,Intl,Object.assign,Object.values,Element.prototype.classList,Element.prototype.matches,Element.prototype.closest,requestAnimationFrame"></script>