<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use Illuminate\Support\Str;
use App\Models\Tag;
use App\Services\MetaService;


class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(20);

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(TagRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $tag = Tag::create($validated);

        MetaService::save($tag, $request->only([
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]));

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $tag->update($validated);

        MetaService::save($tag, $request->only([
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]));

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag deleted successfully.');
    }
}
