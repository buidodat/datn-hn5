<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    // 1. Quản lý Trang chủ
    public function index()
    {
        return view('admin.site-settings.index');
    }

}
