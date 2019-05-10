<header class="primary-header">
  <div class="container">
    <div class="primary-header__container flex items-center -mx-3">
      <div class="px-3 flex-none">
        <a href="#" id="burger-btn" class="primary-header__burger-btn burger-btn burger-btn--dark lg:hidden">
          <div class="burger-btn__box">
            <div class="burger-btn__line"></div>
            <div class="burger-btn__line"></div>
            <div class="burger-btn__line"></div>
          </div>
        </a>
        <a class="primary-header-logo border-none" href="{{ home_url('/') }}">{!! wp_get_attachment_image( $logo, 'medium', false, ['class' => 'primary-header-logo__image', 'alt' => get_bloginfo('name', 'display')] ) !!}</a>
      </div>
      <nav class="px-3 flex-1 hidden md:block">
        @if (has_nav_menu('primary_navigation'))
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
        @endif
      </nav>
      <div class="px-3 flex-none">
        
      </div>
    </div>
  </div>
</header>

<div id="burger-menu" class="burger-content primary-header-padding-offset hidden-xl">
  <div class="burger-content__container container">
    <div class="burger-content-menu">
      @if(!empty($phones))
        @foreach($phones as $p)
          <a href="tel:{{ $p['phone'] }}" class="burger-content-menu__phone">{{ $p['phone'] }}</a>
        @endforeach
      @endif
      @if(!empty($emails))
        @foreach($emails as $e)
          <a href="mailto:{{ $e['email'] }}" class="burger-content-menu__email">{{ $e['email'] }}</a>
        @endforeach
      @endif
      <div class="burger-content-menu__address">{!! $address !!}</div>
      @if(!empty($socials))
        <div class="socials-list">
          @foreach($socials as $social)
            <a href="{{ $social['link'] }}" target="_blank" class="socials-list__item socials-list__item--white" title="{{ $social['text'] }}">{!! $social['icon'] !!}</a>
          @endforeach
        </div>
      @endif
    </div>
    @if (has_nav_menu('primary_navigation'))
      <div class="burger-content-menu">
        {!! wp_nav_menu(['theme_location' => 'primary_navigation']) !!}
      </div>
    @endif
    @if (has_nav_menu('secondary_navigation'))
      <div class="burger-content-menu">
        {!! wp_nav_menu(['theme_location' => 'secondary_navigation']) !!}
      </div>
    @endif
  </div>
</div>