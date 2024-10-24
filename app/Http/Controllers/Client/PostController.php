<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // Lấy 6 bài viết mới nhất và phân trang
        $posts = Post::latest()->paginate(6); 
        // $data = Product::query()->with(['category'])->get();

        // Truyền biến $posts vào view
        return view('client.posts.index', compact('posts'));
    }

    public function show($slug)
    {
        // Tìm bài viết dựa trên slug thay vì id
        $post = Post::where('slug', $slug)->firstOrFail();

        // Tăng lượt xem
        $post->increment('view_count');

        // Hiển thị bài viết
        return view('client.posts.show', compact('post'));
    }
}
