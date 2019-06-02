@extends('layouts.app')

@section('content')
  <div class="primary-section primary-section--medium">
    @include('partials.page-header')

    @if (!have_posts())
      <div class="alert alert-warning alert--medium my-2">
        {{ __('Sorry, no results were found.', 'sage') }}
      </div>
      {!! get_search_form(false) !!}
    @endif

    @while(have_posts()) @php the_post() @endphp
      @include('partials.content-search')
    @endwhile
    @include('partials.primary-contact-form')

    {!! get_the_posts_navigation() !!}
  </div>
@endsection