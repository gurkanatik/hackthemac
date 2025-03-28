<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GameRequest;
use App\Models\Game;
use App\Models\Tag;
use App\Models\Publisher;
use App\Models\GameGenre;
use App\Models\Platform;
use App\Services\ImageService;
use App\Services\MetaService;
use App\Services\TagService;
use App\Services\GameGenreService;
use App\Services\PlatformService;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with('tags')->paginate(20);
        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        return view('admin.games.create', [
            'tags' => Tag::all(),
            'publishers' => Publisher::all(),
            'genres' => GameGenre::all(),
            'platforms' => Platform::all(),
        ]);
    }

    public function store(GameRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = ImageService::upload($request->file('cover_image'), 'games');
        }

        $game = Game::create($validated);

        MetaService::save($game, $validated);
        TagService::sync($game, $validated['tags'] ?? []);
        GameGenreService::sync($game, $validated['genres'] ?? []);
        PlatformService::sync($game, $validated['platforms'] ?? []);

        return redirect()->route('admin.games.index')->with('success', 'Game created successfully.');
    }

    public function edit(Game $game)
    {
        return view('admin.games.edit', [
            'game' => $game,
            'tags' => Tag::all(),
            'publishers' => Publisher::all(),
            'genres' => GameGenre::all(),
            'platforms' => Platform::all(),
        ]);
    }

    public function update(GameRequest $request, Game $game)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = ImageService::upload($request->file('cover_image'), 'games');
        }

        $game->update($validated);

        MetaService::save($game, $validated);
        TagService::sync($game, $validated['tags'] ?? []);
        GameGenreService::sync($game, $validated['genres'] ?? []);
        PlatformService::sync($game, $validated['platforms'] ?? []);

        return redirect()->route('admin.games.index')->with('success', 'Game updated successfully.');
    }

    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('admin.games.index')->with('success', 'Game deleted.');
    }
}
