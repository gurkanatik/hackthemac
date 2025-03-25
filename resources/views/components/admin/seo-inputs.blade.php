<div class="mb-3">
    <label for="meta_title" class="form-label">Meta Title</label>
    <input
        type="text"
        name="meta_title"
        id="meta_title"
        class="form-control @error('meta_title') is-invalid @enderror"
        value="{{ $metaTitle }}"
        required
    >
    @error('meta_title')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="meta_description" class="form-label">Meta Description</label>
    <input
        type="text"
        name="meta_description"
        id="meta_description"
        class="form-control @error('meta_description') is-invalid @enderror"
        value="{{ $metaDescription }}"
        required
    >
    @error('meta_description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="meta_keywords" class="form-label">Meta Keywords</label>
    <input
        type="text"
        name="meta_keywords"
        id="meta_keywords"
        class="form-control @error('meta_keywords') is-invalid @enderror"
        value="{{ $metaKeywords }}"
        required
    >
    @error('meta_keywords')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
