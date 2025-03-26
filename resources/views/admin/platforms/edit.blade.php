@extends('admin.layouts.app')

@section('title', $platform->title . ' edit')

@section('content')
    <x-admin.content-heading
        title="{{ $platform->title }} edit"
        :buttons="[
            ['route' => route('admin.platforms.index'), 'class' => 'btn btn-sm btn-info', 'text' => 'Go Back'],
        ]"
    />

    <form action="{{ route('admin.platforms.update', $platform) }}" method="POST">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="custom-card">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $platform->title) }}"
                            required
                        >
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input
                            type="text"
                            name="slug"
                            id="slug"
                            class="form-control @error('slug') is-invalid @enderror"
                            value="{{ old('slug', $platform->slug) }}"
                        >
                        @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <x-admin.editor
                            name="description"
                            label="Description"
                            :value="old('description', $platform->description ?? '')"
                        />
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="custom-card">
                    <x-admin.seo-inputs :meta="$platform->meta ?? null" />
                </div>
                <button type="submit" class="btn btn-sm btn-success mt-4 d-table ms-auto">Update</button>
            </div>
        </div>
    </form>
@endsection
