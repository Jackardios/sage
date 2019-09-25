<div id="global-loading" class="primary-loading">
  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
    width="50px" height="50px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
    <path fill="#000" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
    <animateTransform attributeType="xml"
      attributeName="transform"
      type="rotate"
      from="0 25 25"
      to="360 25 25"
      dur="0.6s"
      repeatCount="indefinite"/>
    </path>
  </svg>
</div>
<header class="primary-header">
  <div class="primary-header-top">
    <div class="container">
      <div class="items-center justify-between hidden lg:flex -mx-4">
        <nav class="primary-header-top__nav flex-auto px-4">
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'primary-header-top__container']) !!}
          @endif
        </nav>
        <div class="px-4">
          <a href="mailto:{{ $one_of_emails }}" class="block font-700 text-primary-400 hover:text-primary-700 color-transition">{{ $one_of_emails }}</a>
        </div>
      </div>
      <div class="primary-header-top__container lg:hidden flex flex-no-wrap items-center justify-between -mx-3">
        <div class="p-3">
          <a href="mailto:{{ $one_of_emails }}" class="text-sm text-gray-dark">{{ $one_of_emails }}</a>
        </div>
        <div class="p-3">
          <a href="tel:{{ App\strip_phone($one_of_phones) }}" class="text-sm text-black font-700">{{ $one_of_phones }}</a>
        </div>
      </div>
    </div>
  </div>
  <div class="primary-header-bottom">
    <div class="container">
      <div class="primary-header-bottom__container flex flex-wrap items-center justify-between -mx-4">
        <div class="flex-none p-4 pr-0 lg:hidden">
          <button type="button" id="burger-btn" class="btn--square btn btn--default-alt">
            <div class="burger-btn-box">
              <div class="burger-btn-box__line"></div>
              <div class="burger-btn-box__line"></div>
              <div class="burger-btn-box__line"></div>
              <div class="burger-btn-box__line"></div>
            </div>
          </button>
        </div>
        <div class="flex-none p-4">
          <a class="primary-header-logo border-none" href="{{ home_url('/') }}">{!! wp_get_attachment_image( $logo, 'medium', false, ['class' => 'primary-header-logo__image', 'data-no-lazy' => '1', 'alt' => get_bloginfo('name', 'display')] ) !!}</a>
        </div>
        <div class="flex-auto p-4 hidden lg:block">
          <div class="flex flex-wrap justify-end items-center">
            <div class="w-auto" style="max-width: 270px;">
              @if(isset($one_of_phones) && !empty($one_of_phones))
                <a href="tel:{{ App\strip_phone($one_of_phones) }}" class="primary-icon-link flex flex-no-wrap items-center -mx-1 text-black color-transition">
                  <div class="primary-icon-link__icon px-1 text-gray-500"><i class="icon-phone"></i></div>
                  <div class="primary-icon-link__text px-1 font-700 text-2xl leading-none">{{ $one_of_phones }}</div>
                </a>
              @endif
              @if(!empty($one_of_addresses))
                <a href="/контакты#map" class="w-auto mt-2 primary-icon-link flex flex-no-wrap items-center -mx-1">
                  <div class="primary-icon-link__icon px-1 text-gray-500"><i class="icon-map-marker"></i></div>
                  <div class="primary-icon-link__text px-1 font-500 text-black text-sm">{{ $one_of_addresses }}</div>
                </a>
              @endif
            </div>
          </div>
        </div>
        <div class="flex-none p-4 pl-0 lg:pl-4">
          <button type="button" class="callrequest-btn btn--square btn btn--accent xl:hidden"><i class="icon-phone"></i></button>
          <div class="hidden xl:inline-block"><button type="button" class="callrequest-btn btn btn--primary-alt btn--medium">Обратный звонок</button></div>
        </div>
      </div>
    </div>
  </div>
</header>

<div id="burger-menu" class="burger-content primary-header-padding-offset lg:hidden">
  <div class="burger-content__container container">
    <div class="burger-content-menu mt-1">
      @if(!empty($phones))
        @foreach($phones as $p)
          <a href="tel:{{ App\strip_phone($p['phone']) }}" class="primary-icon-link flex flex-no-wrap items-start -mx-1 mb-4 text-white color-transition">
            <div class="primary-icon-link__icon px-1 text-gray-500"><i class="icon-phone"></i></div>
            <div class="primary-icon-link__text px-1 font-700 text-2xl leading-none">{{ $p['phone'] }}</div>
          </a>
        @endforeach
      @endif
      @if(!empty($one_of_addresses))
        <a href="/contacts#map" class="w-auto mr-8 primary-icon-link flex flex-no-wrap items-start -mx-1 my-4 text-gray-400 hover:text-white color-transition">
          <div class="primary-icon-link__icon px-1 text-gray-500"><i class="icon-map-marker"></i></div>
          <div class="primary-icon-link__text px-1 font-500">{{ $one_of_addresses }}</div>
        </a>
      @endif
      @if(!empty($emails))
        @foreach($emails as $e)
          <a href="mailto:{{ $e['email'] }}" class="burger-content-menu__email">{{ $e['email'] }}</a>
        @endforeach
      @endif
      @if(!empty($socials))
        <div class="socials-list">
          @foreach($socials as $social)
            <a href="{{ $social['link'] }}" target="_blank" rel="noopener" class="socials-list__item socials-list__item--white" title="{{ $social['text'] }}">{!! $social['icon'] !!}</a>
          @endforeach
        </div>
      @endif
    </div>
    @if (has_nav_menu('primary_navigation'))
      <div class="burger-content-menu">
        {!! wp_nav_menu(['theme_location' => 'primary_navigation']) !!}
      </div>
    @endif
  </div>
</div>