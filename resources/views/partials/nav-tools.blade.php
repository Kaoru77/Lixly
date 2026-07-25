<select id="navGenre" onchange="window.location.href='/?genre=' + this.value">
  <option value="">Semua Genre</option>
  @foreach($genres as $genre)
    <option value="{{ $genre }}" @selected(request('genre') === $genre)>{{ $genre }}</option>
  @endforeach
</select>

<form action="{{ route('movie.index') }}" method="GET" class="nav-search" style="display: flex; flex: 1;">
  <i class="ti ti-search"></i>
  <input type="text" name="search" id="navSearch" placeholder="Cari film..." value="{{ request('search') }}" />
</form>
