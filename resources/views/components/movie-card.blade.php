@props(['movie'])

<div {{ $attributes->merge(['class' => 'movie-card']) }}>
    <a href="{{ route('movie.show', $movie->id) }}" style="text-decoration: none; color: inherit;">
        <div class="card-poster">
            <img src="{{ asset($movie->poster_url) }}" alt="{{ $movie->title }}">
            <div class="poster-rating">★ {{ number_format($movie->rating, 1) }}</div>
        </div>

        <div class="card-title">{{ $movie->title }}</div>
        <div class="card-year">{{ $movie->release_date }}</div>
    </a>

    {{ $slot }}
</div>
