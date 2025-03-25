@extends('admin.layouts.app')
@section('title', 'Create Tag')

@section('content')
    <x-admin.content-heading
        title="Tags"
        :buttons="[
            ['route' => route('admin.tags.index'), 'class' => 'btn btn-sm btn-info', 'text' => 'Go Back'],
        ]"
    />

    <form action="{{ route('admin.tags.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="custom-card">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}"
                            required
                        >
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input
                            type="text"
                            name="slug"
                            id="slug"
                            class="form-control @error('slug') is-invalid @enderror"
                            value="{{ old('slug') }}"
                            required
                        >
                        @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="order_num" class="form-label">Order Num</label>
                        <input
                            type="number"
                            name="order_num"
                            id="order_num"
                            class="form-control @error('order_num') is-invalid @enderror"
                            value="{{ old('order_num', 0) }}"
                        >
                        @error('order_num')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <x-admin.editor
                            name="description"
                            label="Description"
                            :value="old('description', '')"
                        />
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-success mt-4">Save</button>
    </form>

@endsection
