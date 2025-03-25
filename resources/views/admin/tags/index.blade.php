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

                        <div class="d-none">
                            <div id="tag-preview-{{ $tag->id }}">
                                @if($tag->description)
                                    {!! $tag->description !!}
                                @else
                                    No description available!
                                @endif
                            </div>
                        </div>

                        <button type="button"
                                class="btn btn-sm btn-secondary preview-button"
                                data-bs-toggle="modal"
                                data-bs-target="#previewModal"
                                data-title="{{ $tag->title }}"
                                data-id="{{ $tag->id }}"
                                data-description="{{ htmlspecialchars($tag->description) }}">
                            <i class="bi bi-eye"></i>
                        </button>

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

    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="previewModalBody">
                    <p class="text-muted">Loading...</p>
                </div>
            </div>
        </div>
    </div>

    {{ $tags->links() }}

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modalTitle = document.getElementById('previewModalLabel');
                const modalBody = document.getElementById('previewModalBody');

                document.querySelectorAll('.preview-button').forEach(button => {
                    button.addEventListener('click', () => {
                        const title = button.getAttribute('data-title') || 'Preview';
                        const id = button.getAttribute('data-id');
                        const content = document.getElementById(`tag-preview-${id}`).innerHTML;

                        modalTitle.textContent = `Preview: ${title}`;
                        modalBody.innerHTML = content;
                    });
                });
            });
        </script>
    @endpush
@endsection
