<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateMyAcountRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyAccountController extends Controller
{
    public
    const PATH_VIEW = 'admin.my-accounts.';
    const PATH_UPLOAD = 'users';
    public function show(){
        $userID = Auth::user()->id;
        $user = User::findOrFail($userID);
        return view(self::PATH_VIEW . __FUNCTION__, compact('user'));
    }
    public function edit(){
        $userID = Auth::user()->id;
        $user = User::findOrFail($userID);
        $genders = User::GENDERS;
        return view(self::PATH_VIEW . __FUNCTION__, compact('user','genders'));
    }

    public function update(UpdateMyAcountRequest $request)
    {
        $userID = Auth::user()->id;
        $user = User::findOrFail($userID);
        try {
            $dataUser = $request->all();


            if ($request->img_thumbnail) {
                $dataUser['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->img_thumbnail);
                // Lưu lại đường dẫn của ảnh hiện tại để so sánh sau
                $ImgThumbnailCurrent = $user->img_thumbnail;
            }

            $user->update($dataUser);

            // Nếu có ảnh mới và ảnh mới khác với ảnh cũ, xóa ảnh cũ khỏi hệ thống
            if (!empty($ImgThumbnailCurrent) && ($dataMovie['img_thumbnail'] ?? null) != $ImgThumbnailCurrent && Storage::exists($ImgThumbnailCurrent)) {
                Storage::delete($ImgThumbnailCurrent);
            }

            return redirect()
                ->back()
                ->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
