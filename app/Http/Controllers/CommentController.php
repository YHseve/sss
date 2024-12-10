<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Blog $blog)
    {
        // 验证评论输入
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        // 创建评论
        Comment::create([
            'content' => $request->content,
            'blog_id' => $blog->id,
            'user_id' => auth()->id(),
        ]);

        // 重定向回博客详情页
        return redirect()->route('blogs.show', $blog->id)->with('success', 'Comment added successfully!');
    }
}
