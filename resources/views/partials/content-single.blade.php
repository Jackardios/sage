<article @php post_class() @endphp>
  <header class="primary-section primary-section--medium container">
    @include('partials.page-breadcrumbs')
    <h1 class="primary-section__title">{!! get_the_title() !!}</h1>
  </header>
  <div class="entry-content">
    @php the_content() @endphp
  </div>
  <footer class="primary-section primary-section--medium container">
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>
  <div class="container">
    @php comments_template('/partials/comments.blade.php') @endphp
  </div>
</article>
