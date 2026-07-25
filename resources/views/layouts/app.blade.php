<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'FLIXLY')</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>

  @include('partials.navbar')

  <main class="main-content">
      @yield('content')
  </main>

  @include('partials.footer')

</body>
</html>
