<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePostRequest;
use App\Http\Requests\Admin\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.posts.';
    const PATH_UPLOAD = 'posts';
    public function index()
    {
        //
        $posts = Post::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // dd('Đã đi vào create @');
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // 
        // dd('Đã vào store add');
        try {
            $dataPost = [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'content' => $request->content,
                'is_active' => isset($request->is_active) ? 1 : 0,
            ];


            if ($request->img_post) {
                $dataPost['img_post'] = Storage::put(self::PATH_UPLOAD, $request->img_post);
            }
            // dd($dataPost);
            Post::query()->create($dataPost);

            return redirect()->route('admin.posts.index')->with('success', 'Thêm mới thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view(self::PATH_VIEW . __FUNCTION__, compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        return view(self::PATH_VIEW . __FUNCTION__, compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
        // dd('đã vafp update');
        try {
            $dataPost = [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'content' => $request->content,
                'is_active' => isset($request->is_active) ? 1 : 0,
            ];

            ///nếu ko cập nhật thì để nguyên ảnh, nếu cập nhật thì xóa ảnh cũ, thay ảnh mới
            if ($request->img_post) {
                if (Storage::exists($post->img_post)) {
                    Storage::delete($post->img_post);
                }
                $dataPost['img_post'] = Storage::put(self::PATH_UPLOAD, $request->img_post);
            } else {
                $dataPost['img_post'] = $post->img_post;
            }

            $post->update($dataPost);

            return redirect()->route('admin.posts.index')->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        try {

            if (Storage::exists($post->img_post)) {
                Storage::delete($post->img_post);
            }
            $post->delete();

            return back()
                ->with('success', 'Xóa thành công !');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
