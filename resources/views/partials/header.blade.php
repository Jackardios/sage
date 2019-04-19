<header class="primary-header">
  <div class="primary-container">
    <div class="flex -mx-3">
      <div class="px-3 flex-none"><a class="brand" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a></div>
      <nav class="px-3 flex-1 hidden md:block">
        @if (has_nav_menu('primary_navigation'))
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
        @endif
      </nav>
      <div class="px-3 flex-none">third column</div>
    </div>
  </div>
</header>