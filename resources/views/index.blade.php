@extends('layouts.app')

@section('content')
  <div class="container primary-section primary-section--medium">
    @include('partials.page-header')
    @if (!have_posts())
      <div class="alert alert--warning alert--medium my-2">
        {{ __('Sorry, no results were found.', 'sage') }}
      </div>
    @endif

    @while (have_posts()) @php the_post() @endphp
      @include('partials.content-'.get_post_type())
    @endwhile

    {!! get_the_posts_navigation() !!}
  </div>
@endsection
