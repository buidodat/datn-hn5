<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\UpdateUserRequest;
use App\Models\Ticket;
use App\Models\TicketMovie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\PasswordChanged;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    // Thông tin tài khoản
    const PATH_UPLOAD = 'my-account';
    public function edit()
    {
        $userID = Auth::user()->id;
        $user = User::findOrFail($userID);
        $genders = User::GENDERS;

        $tickets = Ticket::query()->with('ticketMovie')->where('user_id', $userID)->paginate(5);
        // $tickets = TicketMovie::with('ticket', 'movie')->where('tickets.user_id', $userID)->paginate(5);
        return view('client.users.my-account', compact('user', 'genders', 'tickets'));
    }

    public function update(UpdateUserRequest $request)
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

    public function changePassword(Request $request)
    {
        // Validate input
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|max:30|confirmed',
        ], [
            'old_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu tối thiểu phải 8 ký tự.',
            'password.max' => 'Mật khẩu không được quá 30 ký tự.',
            'password.confirmed' => 'Mật khẩu và xác nhận mật khẩu không trùng khớp.',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Mật khẩu hiện tại không chính xác.']);
        }

        // Cập nhật mật khẩu mới
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Gửi thông báo qua email
        Notification::send($user, new PasswordChanged());

        return redirect()->back()->with('success', 'Đổi mật khẩu thành công!');
    }
    // Thẻ thành viên

    // ...

    // Hành trình điện ảnh

    public function showCinemaJourney()
    {
        return view('client.users.cinema-journey');
    }
}
