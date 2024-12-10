<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user', 'comments')->latest()->get();
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // 保存博客并存储到变量
        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        // 重定向到博客详情页
        return redirect()->route('blogs.show', $blog->id)->with('success', 'Blog created successfully!');
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog')); // 将单篇博客数据传递到视图
    }
}
