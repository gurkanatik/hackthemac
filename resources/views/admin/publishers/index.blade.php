@extends('admin.layouts.app')
@section('title', 'Publishers')

@section('content')
    <x-admin.content-heading
        title="Publishers"
        :buttons="[
            ['route' => route('admin.publishers.create'), 'class' => 'btn btn-sm btn-success', 'text' => 'Create']
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
                <td>Type</td>
                <td>Status</td>
                <td>Published</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @forelse ($publishers as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td><code>{{ $item->slug }}</code></td>
                    <td>
                        <span class="badge bg-dark text-capitalize">
                            {{ $item->publisher_type }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $item->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ optional($item->published_at)->format('Y-m-d H:i') }}</td>
                    <td>
                        <div class="d-none">
                            <div id="preview-{{ $item->id }}">
                                {!! $item->content ?: '<p class="text-muted">No content available</p>' !!}
                            </div>
                        </div>
                        <a href="{{ route('admin.publishers.edit', $item) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button type="button"
                                class="btn btn-sm btn-secondary preview-button"
                                data-bs-toggle="modal"
                                data-bs-target="#previewModal"
                                data-title="{{ $item->title }}"
                                data-id="{{ $item->id }}"
                                data-preview-id="preview-{{ $item->id }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <form action="{{ route('admin.publishers.destroy', $item) }}" method="POST"
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
                    <td colspan="7" class="text-center text-muted">No publishers found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $publishers->links() }}

    <x-admin.preview-modal />
@endsection
