<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppRequest;
use App\Models\App;
use App\Models\Tag;
use App\Models\Publisher;
use App\Models\Platform;
use App\Services\ImageService;
use App\Services\MetaService;
use App\Services\TagService;
use App\Services\PlatformService;
use Illuminate\Support\Str;

class AppController extends Controller
{
    public function index()
    {
        $apps = App::with('tags')->paginate(20);
        return view('admin.apps.index', compact('apps'));
    }

    public function create()
    {
        return view('admin.apps.create', [
            'tags' => Tag::all(),
            'publishers' => Publisher::all(),
            'platforms' => Platform::all(),
        ]);
    }

    public function store(AppRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = ImageService::upload($request->file('cover_image'), 'apps');
        }

        $app = App::create($validated);

        MetaService::save($app, $validated);
        TagService::sync($app, $validated['tags'] ?? []);
        PlatformService::sync($app, $validated['platforms'] ?? []);

        return redirect()->route('admin.apps.index')->with('success', 'App created successfully.');
    }

    public function edit(App $app)
    {
        return view('admin.apps.edit', [
            'app' => $app,
            'tags' => Tag::all(),
            'publishers' => Publisher::all(),
            'platforms' => Platform::all(),
        ]);
    }

    public function update(AppRequest $request, App $app)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = ImageService::upload($request->file('cover_image'), 'apps');
        }

        $app->update($validated);

        MetaService::save($app, $validated);
        TagService::sync($app, $validated['tags'] ?? []);
        PlatformService::sync($app, $validated['platforms'] ?? []);

        return redirect()->route('admin.apps.index')->with('success', 'App updated successfully.');
    }

    public function destroy(App $app)
    {
        $app->delete();

        return redirect()->route('admin.apps.index')->with('success', 'App deleted.');
    }
}
