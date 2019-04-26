{{--
  Template Name: Главная
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="container">

    </div>
  @endwhile
@endsection
