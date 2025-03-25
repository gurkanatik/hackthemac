@extends('admin.layouts.app')
@section('title', 'Blog Posts')

@section('content')
    <x-admin.content-heading
        title="Blog Posts"
        :buttons="[
            ['route' => route('admin.blog-posts.create'), 'class' => 'btn btn-sm btn-success', 'text' => 'Create']
        ]"
    />

    <x-admin.alert/>

    <div class="table-responsive">
        <table class="table table-hover align-middle custom-table">
            <thead class="table-light">
            <tr>
                <td>#</td>
                <td>Title</td>
                <td>Tags</td>
                <td>Status</td>
                <td>Published</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @forelse ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                        @foreach($post->tags->take(3) as $tag)
                            <span class="badge bg-secondary">{{ $tag->title }}</span>
                        @endforeach
                        @if($post->tags->count() > 3)
                            <span class="badge bg-light text-muted">+{{ $post->tags->count() - 3 }}</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $post->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $post->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ optional($post->published_at)->format('Y-m-d H:i') }}</td>
                    <td>
                        <div class="d-none">
                            <div id="preview-{{ $post->id }}">
                                {!! $post->content ?: '<p class="text-muted">No content available</p>' !!}
                            </div>
                        </div>
                        <a href="{{ route('admin.blog-posts.edit', $post) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button type="button"
                                class="btn btn-sm btn-secondary preview-button"
                                data-bs-toggle="modal"
                                data-bs-target="#previewModal"
                                data-title="{{ $post->title }}"
                                data-id="{{ $post->id }}"
                                data-preview-id="preview-{{ $post->id }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="POST"
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
                    <td colspan="6" class="text-center text-muted">No blog posts found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $posts->links() }}

    <x-admin.preview-modal />

@endsection
