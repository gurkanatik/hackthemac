<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use App\Models\News;
use App\Models\Tag;
use App\Services\MetaService;
use App\Services\TagService;
use App\Services\ImageService;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::paginate(20);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.news.create', compact('tags'));
    }

    public function store(NewsRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = ImageService::upload(
                $request->file('cover_image'),
                'news'
            );
        }

        $news = News::create($validated);

        MetaService::save($news, $request->only([
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]));

        TagService::sync($news, $request->input('tags', []));

        return redirect()->route('admin.news.index')->with('success', 'News created successfully.');
    }

    public function edit(News $news)
    {
        $tags = Tag::all();
        return view('admin.news.edit', compact('news', 'tags'));
    }

    public function update(NewsRequest $request, News $news)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = ImageService::upload(
                $request->file('cover_image'),
                'news'
            );
        }

        $news->update($validated);

        MetaService::save($news, $request->only([
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]));

        TagService::sync($news, $request->input('tags', []));

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }
}
