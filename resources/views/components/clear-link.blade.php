@props(['href' => null, 'icon' => 'ti-x'])

<a href="{{ $href ?? route('movie.index') }}" class="clear-btn" style="text-decoration: none;">
    <i class="ti {{ $icon }}"></i> {{ $slot }}
</a>
