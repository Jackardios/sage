{{--
  Title: Блоки с иконками
  Description: Блоки с иконками
  Category: sage
  Mode: edit
  Icon: 
  Keywords: иконки
  SupportsMultiple: true
--}}

@php
  $title = get_field('title');
  $icon_blocks = get_field('items');
@endphp
<section class="primary-section primary-section--large">
  <div class="container">
    @if(!empty($title))
      <h2 class="mb-8">{{ $title }}</h2>
    @endif
    @if(!empty($icon_blocks))
      <div class="flex flex-wrap items-start justify-between -mx-4 detect-in-view">
        @foreach($icon_blocks as $i => $b)
          <div class="p-4 w-1/2 md:w-1/4 primary-appearance" style="transition-delay: {{($i + 1) * 100 }}ms;">
            <div class="primary-icon-block">
              <div class="primary-icon-block__icon">{!! wp_get_attachment_image($b['icon'], 'medium', false, ['class' => 'primary-icon-block__icon']) !!}</div>
              @if(!empty($b['title']))  
                <div class="primary-icon-block__text">{{ $b['title'] }}</div>
              @endif
              @if(!empty($b['description']))
                <div class="mt-4 text-gray-700">{!! $b['description'] !!}</div>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>