<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const PATH_VIEW = 'admin.users.';
    const PATH_UPLOAD = 'users';
    public function index()
    {
        $users = User::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__ ,compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeAdmin = User::TYPE_ADMIN;
        $typeMember = User::TYPE_MEMBER;
        $genders = User::GENDERS;
        return view(self::PATH_VIEW . __FUNCTION__,compact(['typeAdmin','typeMember','genders']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $dataUser = $request->all();
            if ($request->img_thumbnail) {
                $dataUser['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->img_thumbnail);
            }

            User::create($dataUser);

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Thêm mới thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $typeAdmin = User::TYPE_ADMIN;
        $typeMember = User::TYPE_MEMBER;
        $genders = User::GENDERS;
        return view(self::PATH_VIEW . __FUNCTION__,compact(['typeAdmin','typeMember','genders','user']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $typeAdmin = User::TYPE_ADMIN;
        $typeMember = User::TYPE_MEMBER;
        $genders = User::GENDERS;
        return view(self::PATH_VIEW . __FUNCTION__,compact(['typeAdmin','typeMember','genders','user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
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
    public function resetPassword(Request $request, User $user){

        //validate
        $request->validate([
            'password' => 'required|min:8|max:30|confirmed',
        ],[
            'password.required' =>'Vui lòng nhập mật khẩu.',
            'password.min' =>'Mật khẩu tối thiểu phải 8 ký tự.',
            'password.max' =>'Mật khẩu không được quá 30 ký tự.',
            'password.confirmed' =>'Mật khẩu và xác nhận mật khẩu không trùng khớp.',
        ]);

        try {
            $user->update([
                'password'=>$request->password
            ]);
            return redirect()
                ->back()
                ->with('success', 'Đổi mật khẩu thành công!');

        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {

            $user->delete();

            if ($user->img_thumbnail && Storage::exists($user->img_thumbnail)) {
                Storage::delete($user->img_thumbnail);
            }

            return back()
                ->with('success', 'Thao tác thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
