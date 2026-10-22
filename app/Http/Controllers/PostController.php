<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a paginated listing of blog posts with multi-parameter filtering.
     */
    public function index(Request $request): View
    {
        $posts = Post::latest()
            ->filter($request->only(['search', 'category', 'author']))
            ->paginate(9)
            ->withQueryString();

        $categories = Category::withCount('posts')->orderBy('name')->get();

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'currentCategory' => $request->filled('category')
                ? Category::firstWhere('slug', $request->input('category'))
                : null,
            'currentAuthor' => $request->input('author'),
        ]);
    }

    /**
     * Display the specified blog post using Route Model Binding.
     */
    public function show(Post $post): View
    {
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();

        return view('posts.show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }
}
