{{--
  Template Name: Контакты
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="primary-section primary-section--medium border-t border-solid border-gray-200 overflow-hidden">
      <div class="container">
        @include('partials.page-breadcrumbs')
        <div class="flex flex-wrap items-stretch -mx-4 -mt-4 pb-4">
          <div class="w-full lg:w-1/2 p-4">
            <div class="page-header mb-6"><h1>Контакты</h1></div>
            @if(get_post()->post_content !== '')
              <div class="mb-6">{!! the_content() !!}</div>
            @endif
            @if(!empty($addresses) && count($addresses) > 1)
              <div class="mb-6">
                @foreach($addresses as $i => $address)
                  <button type="button" data-index="{{ $i }}" class="contacts__address-btn btn btn--default-alt btn--medium mr-3">{{ $address['title'] }}</button>
                @endforeach
              </div>
            @endif
            @if(!empty($phones))
              @foreach($phones as $phone)
                <div class="mt-2">
                  <a href="tel:{{ App\strip_phone($phone['phone']) }}" class="primary-icon-link inline-flex items-center -mx-1 font-700 text-2xl font-secondary">
                    <div class="primary-icon-link__icon p-1 text-gray-500"><i class="fas fa-phone text-xl fa-fw"></i></div>
                    <div class="primary-icon-link__text flex-1 p-1 text-black">{{ $phone['phone'] }}</div>
                  </a>
                </div>
              @endforeach
            @endif
            @if(!empty($emails))
              @foreach($emails as $email)
                <div class="mt-1">
                  <a href="mailto:{{ $email['email'] }}" class="primary-icon-link inline-flex items-center -mx-1 font-700 text-lg">
                    <div class="primary-icon-link__icon p-1 text-gray-500"><i class="fas fa-envelope fa-fw text-xl"></i></div>
                    <div class="primary-icon-link__text flex-1 p-1 text-primary-500">{{ $email['email'] }}</div>
                  </a>
                </div>
              @endforeach
            @endif
            @if(!empty($addresses))
              @foreach($addresses as $i => $address)
                <div class="mt-4">
                  <a href="#" data-index="{{ $i }}" class="contacts__address contacts__address-btn primary-icon-link inline-flex items-center -mx-1 text-lg">
                    <div class="primary-icon-link__icon p-1 text-gray-500"><i class="fas fa-map-marker-alt text-xl fa-fw"></i></div>
                    <div class="primary-icon-link__text flex-1 p-1 text-black">{{ $address['address'] }}</div>
                  </a>
                </div>
              @endforeach
            @endif
            @if(!empty($socials))
              <div class="mt-8">
                <div class="mb-2 text-gray-700">Или пишите нам в любой из соцсетей:</div>
                <div class="socials-list">
                  @foreach($socials as $social)
                    <a href="{{ $social['link'] }}" target="_blank" class="socials-list__item socials-list__item--dark socials-list__item--large" title="{{ $social['text'] }}">{!! $social['icon'] !!}</a>
                  @endforeach
                </div>
              </div>
            @endif
          </div>
          <div class="w-full lg:w-1/2 p-4">
            <div id="contact-map" class="primary-map-container" data-addresses="{{ json_encode($addresses) }}"></div>
          </div>
        </div>
      </div>
    </section>
    @include('blocks.callrequest-form', ['title' => __('Остались вопросы? Оставьте заявку и мы перезвоним вам!', 'sage')])
  @endwhile
@endsection
