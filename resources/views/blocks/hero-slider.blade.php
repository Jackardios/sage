{{--
  Title: Слайдер
  Description: Слайдер
  Category: sage
  Mode: edit
  Icon: 
  Keywords: слайдер изображений галерея
  SupportsMultiple: true
--}}

@php
  $slides = get_field('slides');
@endphp

@if($slides)
  <section class="hero-slider" data-hero-slider>
    @foreach($slides as $i => $slide)
      <div class="hero-slider__bg{{ $slide['dark_text'] ? '' : ' hero-slider__bg--dark' }}" data-slide-index="{{ $i }}">
        <div class="rocket-lazyload hero-slider__bg-image" data-bg="url({{ wp_get_attachment_image_url($slide['bg_image'], 'extra_large') }})"></div>
      </div>
    @endforeach
    <div class="container">
      <div class="hero-slider__container flex flex-wrap justify-between items-center -mx-4">
        <div class="hero-slider__slides flex-auto w-full max-w-xl">
          <div class="swiper-container py-3 px-4">
            <div class="swiper-wrapper swiper-no-swiping">
              @foreach($slides as $i => $slide)
                <div class="swiper-slide hero-slider-slide flex flex-col{{ $slide['dark_text'] ? ' hero-slider-slide--dark-text' : '' }}">
                  @if($slide['overtitle'])
                    <div class="hero-slider-slide__overtitle">{{ $slide['overtitle'] }}</div>
                  @endif
                  
                  @if($slide['title'])
                    <h2 class="hero-slider-slide__title mb-4">{!! $slide['title'] !!}</h2>
                  @endif
  
                  @if($slide['description'])
                    <div class="hero-slider-slide__description my-auto">{!! $slide['description'] !!}</div>
                  @endif
  
                  @if(!empty($slide['button']) && ($slide['button']['type'] !== 'none'))
                    <div class="hero-slider-slide__btn-container mt-4">
                      @if($slide['button']['type'] === 'callrequest')
                        <button type="button" class="callrequest-btn btn btn--accent btn--large shadow-md">{!! $slide['button']['text'] !!}</button>
                      @elseif($slide['button']['type'] === 'link')
                        <a href="{{ $slide['button']['link']['url'] }}" title="{{ $slide['button']['link']['title'] }}" target="{{ $slide['button']['link']['target'] }}" class="btn btn--accent btn--large shadow-md">{!! $slide['button']['text'] !!}</a>
                      @endif
                    </div>
                  @endif
                </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="hero-slider__controls w-full lg:w-auto p-2 mx-4">
          <div class="flex items-center -m-4">
            <div class="hero-slider__pagination primary-dots primary-dots--light flex-1 p-4"></div>
            <div class="hero-slider__buttons p-4">
              <button class="primary-slider__btn hero-slider__prev-btn btn btn--square btn--default-white-2 mr-2"><i class="fas fa-chevron-left fa-fw"></i></button>
              <button class="primary-slider__btn hero-slider__next-btn btn btn--square btn--default-white-2"><i class="fas fa-chevron-right fa-fw"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endif