@extends('layouts.app')
@section('title', 'FLIXLY - Katalog Film Lokal')

@section('nav-tools')
    @include('partials.nav-tools')
@endsection

@section('content')
    <section class="movie-section">
      @if(request('search'))
          @php $searchTitle = 'Hasil Pencarian: "'.request('search').'"'; @endphp
          <x-section-header icon="ti-search" :title="$searchTitle">
              <x-clear-link>Hapus Pencarian</x-clear-link>
          </x-section-header>
      @elseif(request('genre'))
          <x-section-header icon="ti-filter" :title="'Genre: ' . request('genre')">
              <x-clear-link>Hapus Filter</x-clear-link>
          </x-section-header>
      @else
          <x-section-header icon="ti-flame" title="Daftar-Daftar Movies" />
      @endif

      <div class="movie-grid">
         @forelse($movies as $movie)
             <x-movie-card :movie="$movie" />
         @empty
             <p style="grid-column: 1/-1; text-align: center; color: var(--muted); padding: 3rem 0;">
                 Film tidak ditemukan di database lokal.
             </p>
         @endforelse
      </div>
    </section>
@endsection
