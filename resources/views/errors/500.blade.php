@extends('layouts.nav')

@section('title', 'Terjadi kesalahan — FLIXLY')

@section('content')
    <section class="movie-section" style="text-align: center; padding: 4rem 0;">
        <h1 style="font-size: 48px; margin-bottom: 8px;">500</h1>
        <p style="color: var(--muted); margin-bottom: 24px;">
            Terjadi kesalahan di sisi server. Tim kami sudah dicatat lognya, coba lagi beberapa saat lagi.
        </p>
        <a class="btn btn-primary" href="{{ route('movie.index') }}" style="text-decoration: none;">
            <i class="ti ti-arrow-left"></i> Kembali ke Beranda
        </a>
    </section>
@endsection
