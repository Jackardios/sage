{{--
  Title: Карусель изображений
  Description: Карусель изображений
  Category: sage
  Mode: edit
  Icon: 
  Keywords: изображения карусель изображений галерея
  SupportsMultiple: true
--}}

@php
  $title = get_field('title');
  $images = get_field('images');
  $image_size = get_field('image_size');
  $slides_per_view = get_field('slides_per_view');
  $has_lightbox = get_field('has_lightbox');
  $autoplay = get_field('autoplay');
  $padding = get_field('padding');
@endphp
@if(!empty($images))
  <section class="primary-section primary-section--large overflow-hidden border-t border-solid border-gray-200">
    <div class="container">
      <h2 class="mb-8">{{ $title }}</h2>
      <div class="relative" data-default-carousel data-slides-per-view="{{ $slides_per_view }}" data-autoplay="{{ $autoplay }}">
        <div class="swiper-container primary-slider">
          <div class="swiper-wrapper">
            @foreach($images as $image)
              @if($has_lightbox)
                <a href="{{ wp_get_attachment_image_url($image, 'extra_large') }}" style="padding: {{ $padding }}px;" class="primary-slider__item swiper-slide lightbox" data-lightbox-group="gallery">
                  {!! wp_get_attachment_image($image, $image_size) !!}
                </a>
              @else
                <div style="padding: {{ $padding }}px;" class="primary-slider__item swiper-slide">
                  {!! wp_get_attachment_image($image, $image_size) !!}
                </div>
              @endif
            @endforeach
          </div>
        </div>
        <button class="primary-slider__prev-btn btn btn--square btn--rounded-full btn--white shadow"><i class="fas fa-chevron-left fa-fw"></i></button>
        <button class="primary-slider__next-btn btn btn--square btn--rounded-full btn--white shadow"><i class="fas fa-chevron-right fa-fw"></i></button>
      </div>
    </div>
  </section>
@endif