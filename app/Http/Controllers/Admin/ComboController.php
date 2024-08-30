<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreComboRequest;
use App\Http\Requests\Admin\UpdateComboRequest;
use App\Models\Combo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ComboController extends Controller
{

    const PATH_VIEW = 'admin.combos.';
    const PATH_UPLOAD = 'combos';


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Combo::query()->latest('id')->get();


        // dd($data->toArray());
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
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['is_active'] ??= 0;

            if ($data['img_thumbnail']) {
                $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $data['img_thumbnail']);
            }

            Combo::query()->create($data);

            return redirect()
                ->route('admin.combos.index')
                ->with('success', 'Thêm thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Combo $combo)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('combo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Combo $combo)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('combo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComboRequest $request, Combo $combo)
    {
        try {
            $data = $request->all();
            $data['is_active'] ??= 0;

            // Kiểm tra nếu người dùng có tải lên ảnh mới
            if (!empty($data['img_thumbnail'])) {
                // Lưu ảnh mới và lấy đường dẫn
                $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $data['img_thumbnail']);

                // Lưu lại đường dẫn của ảnh hiện tại để so sánh sau
                $ImgThumbnailCurrent = $combo->img_thumbnail;
            } else {
                // Nếu không có ảnh mới, giữ nguyên ảnh cũ
                unset($data['img_thumbnail']);
            }

            // Cập nhật model với dữ liệu mới
            $combo->update($data);

            // Nếu có ảnh mới và ảnh mới khác với ảnh cũ, xóa ảnh cũ khỏi hệ thống
            if (!empty($ImgThumbnailCurrent) && ($data['img_thumbnail'] ?? null) != $ImgThumbnailCurrent && Storage::exists($ImgThumbnailCurrent)) {
                Storage::delete($ImgThumbnailCurrent);
            }

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
    public function destroy(Combo $combo)
    {
        try {

            $combo->delete();

            if ($combo->img_thumbnail && Storage::exists($combo->img_thumbnail)) {
                Storage::delete($combo->img_thumbnail);
            }

            return back()
                ->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
