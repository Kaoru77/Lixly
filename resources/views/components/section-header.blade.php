@props(['icon', 'title'])

<div class="section-header">
    <h2><i class="ti {{ $icon }}"></i> {{ $title }}</h2>
    {{ $slot }}
</div>
