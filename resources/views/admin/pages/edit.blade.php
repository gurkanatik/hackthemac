@extends('admin.layouts.app')

@section('title', $page->title . ' edit')

@section('content')
    <x-admin.content-heading
        title="{{ $page->title }} edit"
        :buttons="[
            ['route' => route('admin.pages.index'), 'class' => 'btn btn-sm btn-info', 'text' => 'Go Back'],
        ]"
    />

    <form action="{{ route('admin.pages.update', $page) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="custom-card">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $page->title) }}"
                            required
                        >
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input
                            type="text"
                            name="slug"
                            id="slug"
                            class="form-control @error('slug') is-invalid @enderror"
                            value="{{ old('slug', $page->slug) }}"
                            required
                        >
                        @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <x-admin.editor
                            name="content"
                            label="Content"
                            :value="old('content', $page->content)"
                        />
                    </div>
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                            {{ old('is_active', $page->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="custom-card">
                    <x-admin.seo-inputs :meta="$page->meta ?? null"/>
                </div>
                <button type="submit" class="btn btn-sm btn-success mt-4 d-table ms-auto">Save</button>
            </div>
        </div>
    </form>
@endsection
