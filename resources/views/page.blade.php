@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="container pt-6">
      @include('partials.page-breadcrumbs')
      @include('partials.page-header')
    </div>
    @include('partials.content-page')
  @endwhile
@endsection
