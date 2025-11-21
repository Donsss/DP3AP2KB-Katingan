<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/posts",
     * tags={"Posts"},
     * summary="Get list of posts",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $posts = Post::with('author')->latest()->get();
        return $this->sendResponse($posts, 'Posts retrieved successfully.');
    }

    /**
     * @OA\Post(
     * path="/api/posts",
     * tags={"Posts"},
     * summary="Create new post",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"title", "body", "image", "status"},
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="body", type="string"),
     * @OA\Property(property="status", type="string", enum={"published", "draft", "private"}),
     * @OA\Property(property="image", type="string", format="binary")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Post created successfully"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|string|max:255|unique:posts,title',
            'body' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:published,draft,private',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

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

        return $this->sendResponse($post, 'Post created successfully.');
    }

    /**
     * @OA\Get(
     * path="/api/posts/{id}",
     * tags={"Posts"},
     * summary="Get specific post",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Successful operation"),
     * @OA\Response(response=404, description="Post not found")
     * )
     */
    public function show($id)
    {
        $post = Post::with('author')->find($id);
        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }
        return $this->sendResponse($post, 'Post retrieved successfully.');
    }

    /**
     * @OA\Post(
     * path="/api/posts/{id}",
     * tags={"Posts"},
     * summary="Update post (use _method=PUT for FormData)",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"title", "body", "status", "_method"},
     * @OA\Property(property="_method", type="string", example="PUT"),
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="body", type="string"),
     * @OA\Property(property="status", type="string", enum={"published", "draft", "private"}),
     * @OA\Property(property="image", type="string", format="binary")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Post updated successfully")
     * )
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:posts,title,' . $post->id,
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:published,draft,private',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

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

        return $this->sendResponse($post, 'Post updated successfully.');
    }

    /**
     * @OA\Delete(
     * path="/api/posts/{id}",
     * tags={"Posts"},
     * summary="Delete post",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Post deleted successfully")
     * )
     */
    public function destroy(Post $post)
    {
        Storage::disk('public')->delete($post->image);
        $post->delete();
        return $this->sendResponse([], 'Post deleted successfully.');
    }
}