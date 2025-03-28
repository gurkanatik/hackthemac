@props(['title', 'count', 'icon' => 'bi-box', 'route' => null])

<a href="{{ $route ?? '#' }}" class="text-decoration-none shadow-sm stat-card">
    <i class="bi {{ $icon }} fs-1 text-secondary"></i>
    <div class="text-end">
        <div class="fs-5 fw-bold">{{ $count }}</div>
        <div>{{ $title }}</div>
    </div>
</a>
