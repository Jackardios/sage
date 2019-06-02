@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="container primary-section primary-section--medium">
      <div class="max-w-4xl">
        @include('partials.page-header')
        @include('partials.content-page')
      </div>
    </div>
  @endwhile
@endsection
