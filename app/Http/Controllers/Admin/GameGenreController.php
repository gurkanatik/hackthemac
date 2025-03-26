<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GameGenreRequest;
use App\Models\GameGenre;
use App\Services\MetaService;
use Illuminate\Support\Str;

class GameGenreController extends Controller
{
    public function index()
    {
        $genres = GameGenre::paginate(20);
        return view('admin.game-genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.game-genres.create');
    }

    public function store(GameGenreRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $genre = GameGenre::create($validated);

        MetaService::save($genre, $request->only([
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]));

        return redirect()->route('admin.game-genres.index')->with('success', 'Genre created successfully.');
    }

    public function edit(GameGenre $gameGenre)
    {
        return view('admin.game-genres.edit', ['genre' => $gameGenre]);
    }

    public function update(GameGenreRequest $request, GameGenre $gameGenre)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $gameGenre->update($validated);

        MetaService::save($gameGenre, $request->only([
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]));

        return redirect()->route('admin.game-genres.index')->with('success', 'Genre updated successfully.');
    }

    public function destroy(GameGenre $gameGenre)
    {
        $gameGenre->delete();
        return redirect()->route('admin.game-genres.index')->with('success', 'Genre deleted successfully.');
    }
}
