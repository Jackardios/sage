{{--
  Template Name: Styleguide
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="container">
      <div class="alert alert--info my-3" role="alert">
        <p class="alert__title">Info</p>
        <p>Something happened that you should know about.</p>
      </div>
      <div class="alert alert--warning my-3" role="alert">
        <p class="alert__title">Be Warned</p>
        <p>Something not ideal might be happening.</p>
      </div>
      <div class="alert alert--error my-3" role="alert">
        <p class="alert__title">Danger</p>
        <p>Something not ideal might be happening.</p>
      </div>
      <div class="mt-6">
        <button class="btn btn--small btn--primary">Small</button>
        <button class="btn btn--medium btn--primary">Medium</button>
        <button class="btn btn--large btn--primary">Large</button>
      </div>
      <div class="mt-3">
        <button class="btn btn--small btn--secondary">Small</button>
        <button class="btn btn--medium btn--secondary">Medium</button>
        <button class="btn btn--large btn--secondary">Large</button>
      </div>
      <div class="mt-6">
        <div class="flex flex-wrap -mx-3">
          <div class="w-full md:w-1/2 xl:w-1/4 py-1 px-3"><input type="text" name="user_name" id="user_name" placeholder="Your name" class="primary-input primary-input--fullwidth"></div>
          <div class="w-full md:w-1/2 xl:w-1/4 py-1 px-3"><input type="email" name="user_email" id="user_email" placeholder="Your email" class="primary-input primary-input--fullwidth"></div>
          <div class="w-full md:w-1/2 xl:w-1/4 py-1 px-3">
            <div class="primary-select-container">
              <select name="user_select" id="user_select" class="primary-select-container__select primary-input primary-input--fullwidth">
                <option value="" disabled selected>placeholder</option>
                <option value="1">value 1</option>
                <option value="2">value 1</option>
                <option value="3">value 1</option>
              </select>
              <i class="primary-select-container__icon fas fa-angle-down"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endwhile
@endsection