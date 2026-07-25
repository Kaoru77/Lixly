@props(['inline' => false])

@php
    $styles = [
        'success' => ['color' => '#2ecc71', 'bg' => 'rgba(46, 204, 113, 0.2)', 'icon' => 'ti-check'],
        'info' => ['color' => '#f1c40f', 'bg' => 'rgba(241, 196, 15, 0.2)', 'icon' => 'ti-info-circle'],
    ];
@endphp

@foreach($styles as $key => $style)
    @if(session($key))
        @if($inline)
            <p style="color: {{ $style['color'] }}; font-size: 14px; margin-top: 10px;">
                <i class="ti {{ $style['icon'] }}"></i> {{ session($key) }}
            </p>
        @else
            <div style="background: {{ $style['bg'] }}; color: {{ $style['color'] }}; padding: 10px; border-radius: var(--radius); margin-bottom: 20px;">
                <i class="ti {{ $style['icon'] }}"></i> {{ session($key) }}
            </div>
        @endif
    @endif
@endforeach
