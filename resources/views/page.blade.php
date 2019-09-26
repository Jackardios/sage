@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="container primary-section primary-section--medium">
      @include('partials.page-breadcrumbs')
      @include('partials.page-header')
      @include('partials.content-page')
    </div>
    @include('sections.contact-form')
  @endwhile
@endsection
