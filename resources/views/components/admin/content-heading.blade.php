<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">{{ $title }}</h1>

    @if (!empty($buttons))
        <div class="d-flex gap-2">
            @foreach($buttons as $button)
                <a href="{{ $button['route'] }}" class="{{ $button['class'] }}">
                    {{ $button['text'] }}
                </a>
            @endforeach
        </div>
    @endif
</div>
