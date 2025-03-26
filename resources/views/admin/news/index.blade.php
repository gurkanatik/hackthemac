@extends('admin.layouts.app')
@section('title', 'News')

@section('content')
    <x-admin.content-heading
        title="News"
        :buttons="[
            ['route' => route('admin.news.create'), 'class' => 'btn btn-sm btn-success', 'text' => 'Create']
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
                <td>Tags</td>
                <td>Status</td>
                <td>Published</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @forelse ($news as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td><code>{{ $item->slug }}</code></td>
                    <td>
                        @foreach($item->tags->take(3) as $tag)
                            <span class="badge bg-secondary">{{ $tag->title }}</span>
                        @endforeach
                        @if($item->tags->count() > 3)
                            <span class="badge bg-light text-muted">+{{ $item->tags->count() - 3 }}</span>
                        @endif
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
                        <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-info">
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
                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST"
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
                    <td colspan="7" class="text-center text-muted">No news found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $news->links() }}

    <x-admin.preview-modal />
@endsection
