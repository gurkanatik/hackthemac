<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogPostRequest;
use App\Models\BlogPost;
use App\Models\Tag;
use App\Services\MetaService;
use App\Services\TagService;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('tags')->paginate(20);
        return view('admin.blog-posts.index', compact('posts'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.blog-posts.create', compact('tags'));
    }

    public function store(BlogPostRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post = BlogPost::create($validated);

        MetaService::save($post, $validated);

        TagService::sync($post, $validated['tags'] ?? []);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Post created.');
    }

    public function edit(BlogPost $blogPost)
    {
        $tags = Tag::all();
        $blogPost->load('tags', 'meta');

        return view('admin.blog-posts.edit', compact('blogPost', 'tags'));
    }

    public function update(BlogPostRequest $request, BlogPost $blogPost)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $blogPost->update($validated);

        MetaService::save($blogPost, $validated);

        TagService::sync($blogPost, $validated['tags'] ?? []);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Post updated.');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')->with('success', 'Post deleted.');
    }
}
