@extends('admin.layouts.app')
@section('title', 'Tags')

@section('content')
    <x-admin.content-heading
        title="Tags"
        :buttons="[
            ['route' => route('admin.tags.create'), 'class' => 'btn btn-sm btn-success', 'text' => 'Create']
        ]"
    />

    <x-admin.alert />

    <div class="table-responsive">
        <table class="table table-hover align-middle custom-table">
            <thead class="table-light">
            <tr>
                <td></td>
                <td>Title</td>
                <td>Slug</td>
                <td>Order</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @forelse ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->title }}</td>
                    <td><code>{{ $tag->slug }}</code></td>
                    <td>{{ $tag->order_num }}</td>
                    <td>
                        <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this tag?');">
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
                    <td colspan="5" class="text-center text-muted">No tags found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $tags->links() }}
@endsection
