@extends('layouts.nav')

@section('title', 'Watchlist Saya — FLIXLY')

@section('content')
    <section class="movie-section" style="margin-top: 20px;">
      <div class="section-header">
        <h2><i class="ti ti-bookmark"></i> Film Watchlist Kamu</h2>
        <a href="{{ route('movie.index') }}" class="clear-btn" style="text-decoration: none;"><i class="ti ti-arrow-left"></i> Kembali Cari Film</a>
      </div>
      
      <div class="movie-grid">
         @forelse($movies as $movie)
             <div class="movie-card" style="position: relative;">
                 <a href="{{ route('movie.show', $movie->id) }}" style="text-decoration: none; color: inherit;">
                     <div class="card-poster">
                         <img src="{{ asset($movie->poster_url) }}" alt="{{ $movie->title }}">
                         <div class="poster-rating">★ {{ number_format($movie->rating, 1) }}</div>
                     </div>
                     <div class="card-title">{{ $movie->title }}</div>
                     <div class="card-year">{{ $movie->release_date }}</div>
                 </a>

                 <form action="{{ route('watchlist.destroy', $movie->id) }}" method="POST" style="margin-top: 10px;">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn-delete" style="width: 100%; background: rgba(231, 76, 60, 0.2); color: #e74c3c; border: 1px solid #e74c3c; padding: 6px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 4px; font-size: 12px; transition: 0.2s;" onmouseover="this.style.background='#e74c3c'; this.style.color='white';" onmouseout="this.style.background='rgba(231, 76, 60, 0.2)'; this.style.color='#e74c3c';">
                         <i class="ti ti-trash"></i> Hapus
                     </button>
                 </form>
             </div>
         @empty
             <p style="grid-column: 1/-1; text-align: center; color: var(--muted); padding: 5rem 0;">
                 Belum ada film yang kamu tambahkan ke daftar watchlist.
             </p>
         @endforelse
      </div>
    </section>
@endsection