<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('author')
                    ->where('status', 'published')
                    ->where('published_at', '<=', now());

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $allPosts = $query->latest('published_at')->get();
        
        $featuredPost = $allPosts->shift();

        $perPage = 9;
        $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage('page');
        $currentPageItems = $allPosts->slice(($currentPage - 1) * $perPage, $perPage)->all();
        
        $posts = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageItems,
            count($allPosts),
            $perPage,
            $currentPage,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        return view('user-views.berita', compact('posts', 'featuredPost'));
    }

    public function show(Post $post)
    {
        if ($post->status !== 'published' || $post->published_at > now()) {
            abort(404);
        }

        $post->increment('view_count');

        return view('user-views.lihat-berita', compact('post'));
    }
}