<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @php wp_head() @endphp
  
  <script>
    window.wordpress = {
      baseUrl: "{{ site_url() }}",
      ajaxUrl: "{{ admin_url('admin-ajax.php') }}",
      privacyUrl: "{{ get_privacy_policy_url() }}"
    };
  </script>

  {{-- 
  <link rel="preconnect" href="//api-maps.yandex.ru">
  <link rel="dns-prefetch" href="//api-maps.yandex.ru">
  --}}
</head>
