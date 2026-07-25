<nav class="navbar">
  <div class="nav-inner">
    <a class="nav-logo" href="{{ route('movie.index') }}">
      <i class="ti ti-movie"></i> FLIXLY
    </a>

    @hasSection('nav-tools')
      @yield('nav-tools')
    @endif

    <a class="nav-watchlist-btn" href="{{ route('watchlist.index') }}">
      <i class="ti ti-bookmark"></i>
      <span class="wl-text">Watchlist</span>
      @if($watchlistCount > 0)
          <span class="wl-badge">{{ $watchlistCount }}</span>
      @endif
    </a>
  </div>
</nav>
