@extends('admin.layouts.app')
@section('title', 'Apps')
@section('containerClass', 'container-fluid')

@section('content')
    <x-admin.content-heading
        title="Apps"
        :buttons="[
            ['route' => route('admin.apps.create'), 'class' => 'btn btn-sm btn-success', 'text' => 'Create']
        ]"
    />

    <x-admin.alert/>

    <div class="table-responsive">
        <table class="table table-hover align-middle custom-table">
            <thead class="table-light">
            <tr>
                <td>#</td>
                <td>Title</td>
                <td>Slug</td>
                <td>Publisher</td>
                <td>Tags</td>
                <td>Platforms</td>
                <td>Price</td>
                <td>Status</td>
                <td>Release</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @forelse ($apps as $app)
                <tr>
                    <td>{{ $app->id }}</td>
                    <td>{{ $app->title }}</td>
                    <td><code>{{ $app->slug }}</code></td>
                    <td>{{ $app->publisher?->title ?? '—' }}</td>
                    <td>
                        @foreach($app->tags->take(2) as $tag)
                            <span class="badge bg-secondary">{{ $tag->title }}</span>
                        @endforeach
                        @if($app->tags->count() > 2)
                            <span class="badge bg-light text-muted">+{{ $app->tags->count() - 2 }}</span>
                        @endif
                    </td>
                    <td>
                        @foreach($app->platforms->take(2) as $platform)
                            <span class="badge bg-primary">{{ $platform->title }}</span>
                        @endforeach
                        @if($app->platforms->count() > 2)
                            <span class="badge bg-light text-muted">+{{ $app->platforms->count() - 2 }}</span>
                        @endif
                    </td>
                    <td>${{ number_format($app->price, 2) }}</td>
                    <td>
                        <span class="badge {{ $app->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $app->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ optional($app->release_date)->format('Y-m-d') }}</td>
                    <td>
                        <div class="d-none">
                            <div id="preview-{{ $app->id }}">
                                {!! $app->content ?: '<p class="text-muted">No content available</p>' !!}
                            </div>
                        </div>
                        <a href="{{ route('admin.apps.edit', $app) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button type="button"
                                class="btn btn-sm btn-secondary preview-button"
                                data-bs-toggle="modal"
                                data-bs-target="#previewModal"
                                data-title="{{ $app->title }}"
                                data-id="{{ $app->id }}"
                                data-preview-id="preview-{{ $app->id }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <form action="{{ route('admin.apps.destroy', $app) }}" method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Are you sure?');">
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
                    <td colspan="10" class="text-center text-muted">No apps found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $apps->links() }}

    <x-admin.preview-modal />
@endsection
