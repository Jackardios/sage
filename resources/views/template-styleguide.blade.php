{{--
  Template Name: Styleguide
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="primary-container container">
      <button class="btn btn--large btn--primary">Primary button</button>
      <button class="btn btn--large btn--secondary">Secondary button</button>
    </div>
  @endwhile
@endsection