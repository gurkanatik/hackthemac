@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')
    <x-admin.content-heading title="Dashboard" />
    <div class="row g-4">
        <div class="col-md-3">
            <x-admin.stat-card title="Tags" count="{{ $tagCount }}" icon="bi-tags-fill" route="{{ route('admin.tags.index') }}" />
        </div>
        <div class="col-md-3">
            <x-admin.stat-card title="Pages" count="{{ $pageCount }}" icon="bi-card-text" route="{{ route('admin.pages.index') }}" />
        </div>
        <div class="col-md-3">
            <x-admin.stat-card title="Blog Posts" count="{{ $blogPostCount }}" icon="bi-substack" route="{{ route('admin.blog-posts.index') }}" />
        </div>
        <div class="col-md-3">
            <x-admin.stat-card title="News" count="{{ $newsCount }}" icon="bi-newspaper" route="{{ route('admin.news.index') }}" />
        </div>
        <div class="col-md-3">
            <x-admin.stat-card title="Publishers" count="{{ $publisherCount }}" icon="bi-buildings" route="{{ route('admin.publishers.index') }}" />
        </div>
        <div class="col-md-3">
            <x-admin.stat-card title="Genres" count="{{ $genreCount }}" icon="bi-puzzle" route="{{ route('admin.game-genres.index') }}" />
        </div>
        <div class="col-md-3">
            <x-admin.stat-card title="Platforms" count="{{ $platformCount }}" icon="bi-laptop" route="{{ route('admin.platforms.index') }}" />
        </div>
        <div class="col-md-3">
            <x-admin.stat-card title="Games" count="{{ $gameCount }}" icon="bi-controller" route="{{ route('admin.games.index') }}" />
        </div>
        <div class="col-md-3">
            <x-admin.stat-card title="Apps" count="{{ $appCount }}" icon="bi-app-indicator" route="{{ route('admin.apps.index') }}" />
        </div>
    </div>
@endsection
