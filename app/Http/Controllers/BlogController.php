<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::all();

        return view('web.blog.index', compact('posts'));
    }

    public function show(BlogPost $post)
    {
        return view('web.blog.show', compact('post'));
    }

    public function category(BlogCategory $category)
    {
        $posts = $category->posts;

        return view('web.blog.category', compact('category', 'posts'));
    }
}
