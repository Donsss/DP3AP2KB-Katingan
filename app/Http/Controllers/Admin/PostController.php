<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('author')->latest();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                ->orWhere('body', 'LIKE', "%{$search}%");
            });
        }

        $posts = $query->paginate(10); 
        
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:posts,title',
            'body' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:published,draft,private',
        ]);

        $imagePath = $request->file('image')->store('posts', 'public');

        $slug = Str::slug($request->title);
        $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug = "{$slug}-" . ($count + 1);
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => $slug,
            'image' => $imagePath,
            'body' => $request->body,
            'excerpt' => Str::limit(strip_tags($request->body), 150, '...'),
            'status' => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:posts,title,' . $post->id,
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:published,draft,private',
        ]);

        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($post->image);
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $slug = $post->slug;
        if ($post->title !== $request->title) {
            $slug = Str::slug($request->title);
            $count = Post::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $post->id)->count();
            if ($count > 0) {
                $slug = "{$slug}-" . ($count + 1);
            }
        }

        $post->update([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $imagePath,
            'body' => $request->body,
            'excerpt' => Str::limit(strip_tags($request->body), 150, '...'),
            'status' => $request->status,
            'published_at' => ($post->status !== 'published' && $request->status === 'published') ? now() : $post->published_at,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        Storage::disk('public')->delete($post->image);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}