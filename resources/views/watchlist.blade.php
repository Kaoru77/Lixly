@extends('layouts.app')

@section('title', 'Watchlist Saya — FLIXLY')

@section('content')
    <section class="movie-section" style="margin-top: 20px;">
      <x-section-header icon="ti-bookmark" title="Film Watchlist Kamu">
          <x-clear-link icon="ti-arrow-left">Kembali Cari Film</x-clear-link>
      </x-section-header>

      <x-flash />

      <div class="movie-grid">
         @forelse($movies as $movie)
             <x-movie-card :movie="$movie" style="position: relative;">
                 <form action="{{ route('watchlist.destroy', $movie->id) }}" method="POST" style="margin-top: 10px;">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn-delete" style="width: 100%; background: rgba(231, 76, 60, 0.2); color: #e74c3c; border: 1px solid #e74c3c; padding: 6px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 4px; font-size: 12px; transition: 0.2s;" onmouseover="this.style.background='#e74c3c'; this.style.color='white';" onmouseout="this.style.background='rgba(231, 76, 60, 0.2)'; this.style.color='#e74c3c';">
                         <i class="ti ti-trash"></i> Hapus
                     </button>
                 </form>
             </x-movie-card>
         @empty
             <p style="grid-column: 1/-1; text-align: center; color: var(--muted); padding: 5rem 0;">
                 Belum ada film yang kamu tambahkan ke daftar watchlist.
             </p>
         @endforelse
      </div>
    </section>
@endsection
