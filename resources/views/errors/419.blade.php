@extends('layouts.nav')

@section('title', 'Sesi kedaluwarsa — FLIXLY')

@section('content')
    <section class="movie-section" style="text-align: center; padding: 4rem 0;">
        <h1 style="font-size: 48px; margin-bottom: 8px;">419</h1>
        <p style="color: var(--muted); margin-bottom: 24px;">
            Sesi kamu sudah kedaluwarsa. Muat ulang halaman lalu coba lagi.
        </p>
        <a class="btn btn-primary" href="{{ route('movie.index') }}" style="text-decoration: none;">
            <i class="ti ti-arrow-left"></i> Kembali ke Beranda
        </a>
    </section>
@endsection
