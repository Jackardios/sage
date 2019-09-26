{{--
  Title: Контент секция
  Description: Контент секция
  Category: sage
  Mode: edit
  Icon: 
  Keywords: контент секция
  SupportsMultiple: false
--}}

@php
  $size = get_field('size') ?? 'large';
  $bg_image = get_field('bg_image');
  $bg_image = wp_get_attachment_image_url( $bg_image, 'extra_large' );
  $vertical_align = get_field('vertical_align') ?? 'start';
  $side_image = get_field('side_image');
  $side_image_size = get_field('side_image_size');
  $side_image_position = get_field('side_image_position');
  $text_color = get_field('text_color');
@endphp

<section class="primary-section primary-section--{{ $size }}" style="{{ $bg_image ? "background-image: url('$bg_image');" :  ''}}{{ $text_color ? "color: $text_color;" : '' }}">
  <div class="container">
    <div class="flex flex-wrap items-{{ $vertical_align }} -mx-6 my-4">
      @if($side_image)
        <div class="w-full px-6 py-4 lg:w-{{ $side_image_size }}{{ ($side_image_position === 'right') ? ' lg:order-1' : '' }}">{!! wp_get_attachment_image( $side_image, 'large', false, ['class' => 'max-w-full h-auto rounded'] ) !!}</div>
      @endif
      <div class="flex-1 px-6 py-4">{!! get_field('content') !!}</div>
    </div>
  </div>
</section>