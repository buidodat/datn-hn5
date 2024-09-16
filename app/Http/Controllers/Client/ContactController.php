<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreContactRequest; 
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request)
    {
        try {
            $data = $request->all();

            // Lưu dữ liệu vào bảng Contact
            Contact::query()->create($data);

            // Trả về thông báo thành công
            return back()->with('success', 'Thông tin liên hệ của bạn đã được gửi thành công!');
        } catch (\Throwable $th) {
            // Trả về thông báo lỗi
            return back()->with('error', $th->getMessage());
        }
    }

}
