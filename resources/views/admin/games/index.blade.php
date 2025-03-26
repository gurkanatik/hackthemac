@extends('admin.layouts.app')
@section('title', 'Games')
@section('containerClass', 'container-fluid')

@section('content')
    <x-admin.content-heading
        title="Games"
        :buttons="[
            ['route' => route('admin.games.create'), 'class' => 'btn btn-sm btn-success', 'text' => 'Create']
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
                <td>Genres</td>
                <td>Platforms</td>
                <td>Price</td>
                <td>Metacritic</td>
                <td>Status</td>
                <td>Release</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @forelse ($games as $game)
                <tr>
                    <td>{{ $game->id }}</td>
                    <td>{{ $game->title }}</td>
                    <td><code>{{ $game->slug }}</code></td>
                    <td>{{ $game->publisher?->title ?? '—' }}</td>
                    <td>
                        @foreach($game->tags->take(2) as $tag)
                            <span class="badge bg-secondary">{{ $tag->title }}</span>
                        @endforeach
                        @if($game->tags->count() > 2)
                            <span class="badge bg-light text-muted">+{{ $game->tags->count() - 2 }}</span>
                        @endif
                    </td>
                    <td>
                        @foreach($game->genres->take(2) as $genre)
                            <span class="badge bg-info">{{ $genre->title }}</span>
                        @endforeach
                        @if($game->genres->count() > 2)
                            <span class="badge bg-light text-muted">+{{ $game->genres->count() - 2 }}</span>
                        @endif
                    </td>
                    <td>
                        @foreach($game->platforms->take(2) as $platform)
                            <span class="badge bg-primary">{{ $platform->title }}</span>
                        @endforeach
                        @if($game->platforms->count() > 2)
                            <span class="badge bg-light text-muted">+{{ $game->platforms->count() - 2 }}</span>
                        @endif
                    </td>
                    <td>${{ number_format($game->price, 2) }}</td>
                    <td>
                        @if($game->metacritic_rate)
                            <span class="badge bg-dark">{{ $game->metacritic_rate }}/100</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $game->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $game->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ optional($game->release_date)->format('Y-m-d') }}</td>
                    <td>
                        <div class="d-none">
                            <div id="preview-{{ $game->id }}">
                                {!! $game->content ?: '<p class="text-muted">No content available</p>' !!}
                            </div>
                        </div>
                        <a href="{{ route('admin.games.edit', $game) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button type="button"
                                class="btn btn-sm btn-secondary preview-button"
                                data-bs-toggle="modal"
                                data-bs-target="#previewModal"
                                data-title="{{ $game->title }}"
                                data-id="{{ $game->id }}"
                                data-preview-id="preview-{{ $game->id }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <form action="{{ route('admin.games.destroy', $game) }}" method="POST"
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
                    <td colspan="12" class="text-center text-muted">No games found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $games->links() }}

    <x-admin.preview-modal />
@endsection
