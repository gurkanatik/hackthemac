<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlatformRequest;
use App\Models\Platform;
use App\Services\MetaService;
use Illuminate\Support\Str;

class PlatformController extends Controller
{
    public function index()
    {
        $platforms = Platform::paginate(20);
        return view('admin.platforms.index', compact('platforms'));
    }

    public function create()
    {
        return view('admin.platforms.create');
    }

    public function store(PlatformRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $platform = Platform::create($validated);

        MetaService::save($platform, $request->only([
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]));

        return redirect()->route('admin.platforms.index')->with('success', 'Platform created successfully.');
    }

    public function edit(Platform $platform)
    {
        return view('admin.platforms.edit', compact('platform'));
    }

    public function update(PlatformRequest $request, Platform $platform)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $platform->update($validated);

        MetaService::save($platform, $request->only([
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]));

        return redirect()->route('admin.platforms.index')->with('success', 'Platform updated successfully.');
    }

    public function destroy(Platform $platform)
    {
        $platform->delete();

        return redirect()->route('admin.platforms.index')->with('success', 'Platform deleted successfully.');
    }
}
