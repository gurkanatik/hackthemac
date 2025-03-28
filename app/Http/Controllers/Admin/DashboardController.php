<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\BlogPost;
use App\Models\Game;
use App\Models\GameGenre;
use App\Models\News;
use App\Models\Page;
use App\Models\Platform;
use App\Models\Publisher;
use App\Models\Tag;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'gameCount' => Game::count(),
            'appCount' => App::count(),
            'blogPostCount' => BlogPost::count(),
            'newsCount' => News::count(),
            'pageCount' => Page::count(),
            'tagCount' => Tag::count(),
            'platformCount' => Platform::count(),
            'publisherCount' => Publisher::count(),
            'genreCount' => GameGenre::count(),
        ]);
    }
}
