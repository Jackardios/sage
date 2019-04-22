{{--
  Template Name: Styleguide
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="primary-container container">
      <div class="alert alert--info my-3" role="alert">
        <p class="alert__title">Info</p>
        <p>Something happened that you should know about.</p>
      </div>
      <div class="alert alert--warning my-3" role="alert">
        <p class="alert__title">Be Warned</p>
        <p>Something not ideal might be happening.</p>
      </div>
      <div class="alert alert--error my-3" role="alert">
        <p class="alert__title">Danger</p>
        <p>Something not ideal might be happening.</p>
      </div>
      <div class="my-3">
        <button class="btn btn--small btn--primary">Small</button>
        <button class="btn btn--medium btn--primary">Medium</button>
        <button class="btn btn--large btn--primary">Large</button>
      </div>
      <div class="my-3">
        <button class="btn btn--small btn--secondary">Small</button>
        <button class="btn btn--medium btn--secondary">Medium</button>
        <button class="btn btn--large btn--secondary">Large</button>
      </div>
    </div>
  @endwhile
@endsection