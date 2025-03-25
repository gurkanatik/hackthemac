@props([
    'name' => 'image',
    'label' => 'Image',
    'value' => null,
    'preview' => true,
])
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <input
        type="file"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror"
        accept="image/*"
    >

    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @php
        $hasImage = is_object($value) && method_exists($value, 'getThumbnailUrl');
        $thumbSrc = $hasImage ? $value->getThumbnailUrl() : '';
        $srcSet = $hasImage && method_exists($value, 'getSrcSet')
            ? $value->getSrcSet()
            : null;
    @endphp

    <div class="mt-2 {{ $thumbSrc ? '' : 'd-none' }}" id="wrapper-{{ $name }}">
        <img
            id="preview-{{ $name }}"
            src="{{ $thumbSrc }}"
            @if($srcSet) srcset="{{ $srcSet }}" sizes="(max-width: 600px) 400px, (max-width: 1200px) 800px, 1200px"
            @endif
            class="img-thumbnail"
            style="max-height: 150px; border-radius: 0"
        >
    </div>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const input = document.getElementById('{{ $name }}');
                const preview = document.getElementById('preview-{{ $name }}');
                const wrapper = document.getElementById('wrapper-{{ $name }}');

                input.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        wrapper.classList.remove('d-none');

                        preview.removeAttribute('srcset');
                        preview.removeAttribute('sizes');
                    };
                    reader.readAsDataURL(file);
                });
            });
        </script>
    @endpush
@endonce
