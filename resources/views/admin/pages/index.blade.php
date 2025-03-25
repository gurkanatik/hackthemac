@extends('admin.layouts.app')
@section('title', 'Pages')

@section('content')
    <x-admin.content-heading
        title="Pages"
        :buttons="[
            ['route' => route('admin.pages.create'), 'class' => 'btn btn-sm btn-success', 'text' => 'Create']
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
                <td>Status</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @forelse ($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->title }}</td>
                    <td><code>{{ $page->slug }}</code></td>
                    <td>
                        @if ($page->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline"
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
                    <td colspan="5" class="text-center text-muted">No pages found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $pages->links() }}
@endsection
