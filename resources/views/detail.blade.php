@extends('layouts.nav')

@section('title', $movie->title . ' — FLIXLY')

@section('content')
    <div class="back-wrap" style="margin-bottom: 20px;">
      <a class="back-btn" href="{{ route('movie.index') }}" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
        <i class="ti ti-arrow-left"></i> Kembali
      </a>
    </div>

    <div class="detail-box">
      
      <div class="detail-poster-wrap">
        <img src="{{ asset($movie->poster_url) }}" alt="{{ $movie->title }}">
      </div>

      <div class="detail-info">
        <h1 class="detail-title">{{ $movie->title }}</h1>
        
        <div class="detail-meta">
          <span class="meta-rating">
            <i class="ti ti-star-filled"></i> {{ number_format($movie->rating, 1) }}
          </span>
          <span class="meta-year">
            <i class="ti ti-calendar"></i> {{ $movie->release_date ?? 'N/A' }}
          </span>
    <span>
    <i class="ti ti-user"></i> {{ $movie->director ?? 'N/A' }}
  </span>
  <span>
    <i class="ti ti-clock"></i> {{ $movie->duration ?? 'N/A' }}
  </span>
        </div>

        <div class="detail-genres">
          <span class="genre-badge">{{ $movie->genre }}</span>
        </div>

        <div class="detail-synopsis">
          <h3>Sinopsis</h3>
          <p class="synopsis-text" style="line-height: 1.6; color: var(--muted); margin-top: 8px;">
            {{ $movie->overview }}
          </p>
        </div>

       <div class="detail-actions" style="margin-top: 24px;">
  <form action="{{ route('watchlist.store', $movie->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary" style="cursor: pointer;">
      <i class="ti ti-bookmark"></i> Tambah ke Watchlist
    </button>
  </form>
</div>

      </div>
    </div>
@endsection