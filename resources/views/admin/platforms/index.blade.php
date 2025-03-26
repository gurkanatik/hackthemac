@extends('admin.layouts.app')
@section('title', 'Platforms')

@section('content')
    <x-admin.content-heading
        title="Platforms"
        :buttons="[
            ['route' => route('admin.platforms.create'), 'class' => 'btn btn-sm btn-success', 'text' => 'Create']
        ]"
    />

    <x-admin.alert />

    <div class="table-responsive">
        <table class="table table-hover align-middle custom-table">
            <thead class="table-light">
            <tr>
                <td>#</td>
                <td>Title</td>
                <td>Slug</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @forelse ($platforms as $platform)
                <tr>
                    <td>{{ $platform->id }}</td>
                    <td>{{ $platform->title }}</td>
                    <td><code>{{ $platform->slug }}</code></td>
                    <td>
                        <div class="d-none">
                            <div id="preview-{{ $platform->id }}">
                                {!! $platform->description ?: '<p class="text-muted">No content available</p>' !!}
                            </div>
                        </div>
                        <a href="{{ route('admin.platforms.edit', $platform) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button type="button"
                                class="btn btn-sm btn-secondary preview-button"
                                data-bs-toggle="modal"
                                data-bs-target="#previewModal"
                                data-title="{{ $platform->title }}"
                                data-id="{{ $platform->id }}"
                                data-preview-id="preview-{{ $platform->id }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <form action="{{ route('admin.platforms.destroy', $platform) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this platform?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No platforms found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $platforms->links() }}

    <x-admin.preview-modal />
@endsection
