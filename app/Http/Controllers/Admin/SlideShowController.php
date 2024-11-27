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

    public function __construct()
    {
        $this->middleware('can:Danh sách slideshows')->only('index');
        $this->middleware('can:Thêm slideshows')->only(['create', 'store']);
        $this->middleware('can:Sửa slideshows')->only(['edit', 'update']);
        $this->middleware('can:Xóa slideshows')->only('destroy');
    }

    public function index()
    {
        $slideshows = Slideshow::latest()->get();

        foreach ($slideshows as $slideshow) {
            $slideshow->img_thumbnail = json_decode($slideshow->img_thumbnail);
        }
        return view(self::PATH_VIEW . __FUNCTION__, compact('slideshows'));
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
        $validatedData = $request->validated();

        $validatedData['is_active'] = 0;

        $imagePaths = [];
        if ($request->hasFile('img_thumbnail')) {
            foreach ($request->file('img_thumbnail') as $file) {
                $path = $file->store(self::PATH_UPLOAD);
                $imagePaths[] = $path;
            }
        }

        // Lưu đường dẫn ảnh dưới dạng JSON
        $validatedData['img_thumbnail'] = json_encode($imagePaths);

        Slideshow::create($validatedData);

        return redirect()
            ->route('admin.slideshows.index')
            ->with('success', 'Thêm thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slide = Slideshow::query()->findOrFail($id);
        $slide->img_thumbnail = json_decode($slide->img_thumbnail, true);
        return view(self::PATH_VIEW . __FUNCTION__, compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSlideShowRequest $request, string $id)
    {
        try {
            $validatedData = $request->validated();

            $validatedData['is_active'] = $request->has('is_active') ? 1 : 0;
            $slide = Slideshow::findOrFail($id);

            $existingImages = $request->input('existing_images', []);
            $updatedImages = $existingImages;

            if ($request->hasFile('img_thumbnail')) {
                foreach ($request->file('img_thumbnail') as $key => $file) {
                    if (isset($existingImages[$key])) {
                        $oldPath = $existingImages[$key];
                        if (Storage::exists($oldPath)) {
                            Storage::delete($oldPath);
                        }
                    }
                    $updatedImages[$key] = $file->store('uploads/slides');
                }
            }

            $slide->update([
                'img_thumbnail' => json_encode(array_values($updatedImages)),
                'description' => $validatedData['description'],
                'is_active' => $validatedData['is_active'],
            ]);

            return redirect()->back()->with('success', 'Cập nhật thành công!');
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
        // Giải mã mảng JSON và kiểm tra từng ảnh
        if ($slide->img_thumbnail) {
            $imagePaths = json_decode($slide->img_thumbnail, true);

            if (is_array($imagePaths)) {
                foreach ($imagePaths as $path) {
                    if (Storage::exists($path)) {
                        Storage::delete($path);
                    }
                }
            }
        }
        $slide->delete();
        return redirect()
            ->route('admin.slideshows.index')
            ->with('success', 'Xóa thành công!');
    }
}
