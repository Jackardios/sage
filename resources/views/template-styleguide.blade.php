{{--
  Template Name: Styleguide
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="primary-section primary-section--medium">
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
        <div class="mt-12">
          <h2>Primary input</h2>
          <div class="flex flex-wrap -mx-3">
            <div class="w-full md:w-1/3 xl:w-1/4 py-1 px-3"><input type="text" name="user_name" id="user_name" placeholder="Your name" class="primary-input primary-input--fullwidth"></div>
            <div class="w-full md:w-1/3 xl:w-1/4 py-1 px-3"><input type="email" name="user_email" id="user_email" placeholder="Your email" class="primary-input primary-input--fullwidth"></div>
            <div class="w-full md:w-1/3 xl:w-1/4 py-1 px-3">
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
        <div class="mt-12">
          <h2>Secondary input</h2>
          <div class="flex flex-wrap -mx-3">
            <div class="w-full md:w-1/3 xl:w-1/4 py-1 px-3"><input type="text" name="user_name" id="user_name" placeholder="Your name" class="secondary-input secondary-input--fullwidth"></div>
            <div class="w-full md:w-1/3 xl:w-1/4 py-1 px-3"><input type="email" name="user_email" id="user_email" placeholder="Your email" class="secondary-input secondary-input--fullwidth"></div>
            <div class="w-full md:w-1/3 xl:w-1/4 py-1 px-3">
              <div class="primary-select-container">
                <select name="user_select" id="user_select" class="primary-select-container__select secondary-input secondary-input--fullwidth">
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
        <div class="mt-12">
          <h2>Primary numeric field</h2>
          <div class="primary-numeric-field max-w-xs" data-numeric-field>
            <button class="primary-numeric-field__button primary-numeric-field__minus-button" type="button" data-numeric-field-minus><i class="fas fa-minus fa-fw"></i></button>
            <div class="primary-numeric-field__input-container">
              <input type="number" name="months" step="1" min="1" value="1" class="primary-numeric-field__input" required data-numeric-field-input>
              <div class="primary-numeric-field__postfix">мес.</div>
            </div>
            <button class="primary-numeric-field__button primary-numeric-field__plus-button" type="button" data-numeric-field-plus><i class="fas fa-plus fa-fw"></i></button>
          </div>
        </div>
        <div class="mt-12">
          <h2>Primary file field</h2>
          <div class="primary-file-field mt-4 max-w-xs">
            <input type="file" id="user_files" name="user_files[]" class="primary-file-field__input" data-multiple-caption="Прикреплено {count} файла(ов)" multiple>
            <label for="user_files" class="primary-file-field__label flex flex-wrap items-center -mx-3">
              <div class="w-auto p-3"><div class="primary-file-field__icon"><i class="fas fa-paperclip fa-fw"></i></div></div>
              <div class="primary-file-field__text flex-1 p-3 text-sm">
                <div class="font-600">Прикрепить файлы</div>
                <div class="text-gray-700 mt-1">не более 100 Мб</div>
              </div>
            </label>
          </div>
        </div>
      </div>
    </section>
  @endwhile
@endsection