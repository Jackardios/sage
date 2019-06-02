@extends('layouts.app')

@section('content')
  <div class="container primary-section primary-section--medium">
    @include('partials.page-header')
    @if (!have_posts())
      <div class="alert alert--warning alert--medium my-2 text-lg">
        {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
      </div>
    @endif
  </div>
@endsection
