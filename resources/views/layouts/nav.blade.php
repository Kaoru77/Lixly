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

  <nav class="navbar">
    <div class="nav-inner">
      <a class="nav-logo" href="{{ route('movie.index') }}">
        <i class="ti ti-movie"></i> FLIXLY
      </a>
      <a class="nav-watchlist-btn" href="{{route('watchlist.index')}}">
    <i class="ti ti-bookmark"></i>
    <span class="wl-text">Watchlist</span>
    @if($wlCount > 0)
        <span class="wl-badge">{{ $wlCount }}</span>
    @endif
       </a>
    </div>
  </nav>

  <main class="main-content">
      @include('partials.flash')
      @yield('content')
  </main>

  <footer class="footer">
    <div class="footer-inner">
      <span class="footer-logo"><i class="ti ti-movie"></i> FLIXLY</span>
      <span class="footer-copy">| © 2026 Flixly |</span>
      <span class="footer-text">Project Pribadi by <strong>Taufiq</strong> | Data film dari Local Database</span>
    </div>
  </footer>

</body>
</html>