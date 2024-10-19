<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    public function index()
    {
        // Lấy 6 bài viết mới nhất
        $posts = Post::latest()->paginate(6); 

        // Chia bài viết thành hai phần: 3 bài cho cột trái và 3 bài cho cột phải
        $leftPosts = $posts->forPage(1, 3); // Lấy 3 bài đầu tiên
        $rightPosts = $posts->forPage(2, 3); // Lấy 3 bài tiếp theo

        // Truyền cả 2 biến vào view
        return view('client.posts.index', compact('leftPosts', 'rightPosts', 'posts'));
    }
    public function show($id)
    {
        // Tăng lượt xem mỗi lần người dùng nhấn vào bài viết
        $post = Post::findOrFail($id);
        $post->increment('view_count');

        // Hiển thị bài viết
        return view('client.posts.show', compact('post'));
    }
}