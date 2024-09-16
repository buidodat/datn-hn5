<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSlideShowRequest;
use App\Http\Requests\Admin\UpdateSlideShowRequest;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.slideshows.';
    const PATH_UPLOAD = 'slideshows';
    public function index()
    {
        $data = Slideshow::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSlideShowRequest $request)
    {
        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active') ? 1 : 0;

            if ($data['img_thumbnail']) {
                $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $data['img_thumbnail']);
            }

            Slideshow::query()->create($data);

            return redirect()
                ->route('admin.slideshows.index')
                ->with('success', 'Thêm thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slide = Slideshow::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active') ? 1 : 0;
            $slide = Slideshow::query()->findOrFail($id);

            if ($request->hasFile('img_thumbnail')) {
                if ($slide->img_thumbnail && Storage::exists($slide->img_thumbnail)) {
                    Storage::delete($slide->img_thumbnail);
                }
                $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('img_thumbnail'));
            } else {
                $data['img_thumbnail'] = $slide->img_thumbnail;
            }

            $slide->update($data);

            return redirect()
                ->back()
                ->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slide = Slideshow::query()->findOrFail($id);
        if ($slide->img_thumbnail && Storage::exists($slide->img_thumbnail)) {
            Storage::delete($slide->img_thumbnail);
        }
        $slide->delete();
        return redirect()
            ->route('admin.slideshows.index')
            ->with('success', 'Xóa thành công!');
    }
}
