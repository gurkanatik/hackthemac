@extends('admin.layouts.app')
@section('title', 'Game Genres')

@section('content')
    <x-admin.content-heading
        title="Game Genres"
        :buttons="[
            ['route' => route('admin.game-genres.create'), 'class' => 'btn btn-sm btn-success', 'text' => 'Create']
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
            @forelse ($genres as $genre)
                <tr>
                    <td>{{ $genre->id }}</td>
                    <td>{{ $genre->title }}</td>
                    <td><code>{{ $genre->slug }}</code></td>
                    <td>
                        <div class="d-none">
                            <div id="preview-{{ $genre->id }}">
                                {!! $genre->description ?: '<p class="text-muted">No content available</p>' !!}
                            </div>
                        </div>
                        <a href="{{ route('admin.game-genres.edit', $genre) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button type="button"
                                class="btn btn-sm btn-secondary preview-button"
                                data-bs-toggle="modal"
                                data-bs-target="#previewModal"
                                data-title="{{ $genre->title }}"
                                data-id="{{ $genre->id }}"
                                data-preview-id="preview-{{ $genre->id }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <form action="{{ route('admin.game-genres.destroy', $genre) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this genre?');">
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
                    <td colspan="4" class="text-center text-muted">No game genres found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $genres->links() }}

    <x-admin.preview-modal />
@endsection
