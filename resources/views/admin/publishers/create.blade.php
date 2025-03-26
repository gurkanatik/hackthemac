@extends('admin.layouts.app')
@section('title', 'Create Publisher')

@section('content')
    <x-admin.content-heading
        title="Publishers"
        :buttons="[
            ['route' => route('admin.publishers.index'), 'class' => 'btn btn-sm btn-info', 'text' => 'Go Back'],
        ]"
    />

    <form action="{{ route('admin.publishers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="custom-card">
                    <div class="mb-3">
                        <x-admin.image-input
                            name="cover_image"
                            label="Cover Image"
                        />
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug"
                               class="form-control @error('slug') is-invalid @enderror"
                               value="{{ old('slug') }}">
                        @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" rows="3"
                                  class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <x-admin.editor
                            name="content"
                            label="Content"
                            :value="old('content')"
                        />
                    </div>

                    <div class="mb-3">
                        <label for="publisher_type" class="form-label">Publisher Type</label>
                        <select name="publisher_type" id="publisher_type" class="form-select @error('publisher_type') is-invalid @enderror">
                            <option value="game" {{ old('publisher_type') === 'game' ? 'selected' : '' }}>Game</option>
                            <option value="app" {{ old('publisher_type') === 'app' ? 'selected' : '' }}>App</option>
                            <option value="both" {{ old('publisher_type') === 'both' ? 'selected' : '' }}>Both</option>
                        </select>
                        @error('publisher_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check form-switch">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="published_at" class="form-label">Publish Date</label>
                        <input
                            type="datetime-local"
                            name="published_at"
                            id="published_at"
                            class="form-control @error('published_at') is-invalid @enderror"
                            value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                        >
                        @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="custom-card">
                    <x-admin.seo-inputs :meta="null"/>
                </div>
                <button type="submit" class="btn btn-sm btn-success mt-4 d-table ms-auto">Save</button>
            </div>
        </div>
    </form>
@endsection
