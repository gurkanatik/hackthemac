@extends('admin.layouts.app')
@section('title', 'Create App')

@section('content')
    <x-admin.content-heading
        title="Apps"
        :buttons="[
            ['route' => route('admin.apps.index'), 'class' => 'btn btn-sm btn-info', 'text' => 'Go Back'],
        ]"
    />

    <form action="{{ route('admin.apps.store') }}" method="POST" enctype="multipart/form-data">
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
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug"
                               class="form-control @error('slug') is-invalid @enderror"
                               value="{{ old('slug') }}">
                        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" rows="3"
                                  class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt') }}</textarea>
                        @error('excerpt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <x-admin.editor
                            name="content"
                            label="Content"
                            :value="old('content')"
                        />
                    </div>

                    <div class="mb-3">
                        <label for="publisher_id" class="form-label">Publisher</label>
                        <select name="publisher_id" id="publisher_id" class="form-select">
                            <option value="">Select Publisher</option>
                            @foreach($publishers as $publisher)
                                <option value="{{ $publisher->id }}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                                    {{ $publisher->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('publisher_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price (USD)</label>
                        <input type="number" name="price" id="price"
                               class="form-control @error('price') is-invalid @enderror"
                               value="{{ old('price') }}" step="0.01">
                        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="release_date" class="form-label">Release Date</label>
                        <input type="date" name="release_date" id="release_date"
                               class="form-control @error('release_date') is-invalid @enderror"
                               value="{{ old('release_date') }}">
                        @error('release_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="mac_support" class="form-label">Mac Support</label>
                        <select name="mac_support" id="mac_support" class="form-select">
                            <option value="0" {{ old('mac_support') == 0 ? 'selected' : '' }}>Not Supported</option>
                            <option value="1" {{ old('mac_support') == 1 ? 'selected' : '' }}>Native</option>
                            <option value="2" {{ old('mac_support') == 2 ? 'selected' : '' }}>Unknown</option>
                            <option value="3" {{ old('mac_support') == 3 ? 'selected' : '' }}>Coming Soon</option>
                            <option value="4" {{ old('mac_support') == 4 ? 'selected' : '' }}>Rosetta 2</option>
                            <option value="5" {{ old('mac_support') == 5 ? 'selected' : '' }}>Wine/Proton</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <select name="tags[]" id="tags" multiple class="form-select">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                    {{ $tag->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="platforms" class="form-label">Platforms</label>
                        <select name="platforms[]" id="platforms" multiple class="form-select">
                            @foreach($platforms as $platform)
                                <option value="{{ $platform->id }}" {{ in_array($platform->id, old('platforms', [])) ? 'selected' : '' }}>
                                    {{ $platform->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check form-switch">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="published_at" class="form-label">Published At</label>
                        <input type="datetime-local" name="published_at" id="published_at"
                               class="form-control @error('published_at') is-invalid @enderror"
                               value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                        @error('published_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
