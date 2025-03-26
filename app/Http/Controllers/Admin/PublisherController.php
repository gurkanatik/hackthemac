<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PublisherRequest;
use App\Models\Publisher;
use App\Services\MetaService;
use App\Services\ImageService;
use Illuminate\Support\Str;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::paginate(20);
        return view('admin.publishers.index', compact('publishers'));
    }

    public function create()
    {
        return view('admin.publishers.create');
    }

    public function store(PublisherRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = ImageService::upload(
                $request->file('cover_image'),
                'publishers'
            );
        }

        $publisher = Publisher::create($validated);

        MetaService::save($publisher, $request->only([
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]));

        return redirect()->route('admin.publishers.index')->with('success', 'Publisher created successfully.');
    }

    public function edit(Publisher $publisher)
    {
        return view('admin.publishers.edit', compact('publisher'));
    }

    public function update(PublisherRequest $request, Publisher $publisher)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = ImageService::upload(
                $request->file('cover_image'),
                'publishers'
            );
        }

        $publisher->update($validated);

        MetaService::save($publisher, $request->only([
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]));

        return redirect()->route('admin.publishers.index')->with('success', 'Publisher updated successfully.');
    }

    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return redirect()->route('admin.publishers.index')->with('success', 'Publisher deleted successfully.');
    }
}
