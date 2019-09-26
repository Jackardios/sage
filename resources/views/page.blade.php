@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="container primary-section primary-section--medium">
      @include('partials.page-breadcrumbs')
      @include('partials.page-header')
    </div>
    @include('partials.content-page')
  @endwhile
@endsection
