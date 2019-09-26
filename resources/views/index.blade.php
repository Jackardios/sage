@extends('layouts.app')

@section('content')
  @while (have_posts()) @php the_post() @endphp
    <div class="container pt-6">
      @include('partials.page-breadcrumbs')
      @include('partials.page-header')
      @if (!have_posts())
        <div class="alert alert--warning alert--medium my-2">
          {{ __('Sorry, no results were found.', 'sage') }}
        </div>
      @endif
    </div>
    @include('partials.content-'.get_post_type())
    {{-- {!! get_the_posts_navigation() !!} --}}
  @endwhile
@endsection
