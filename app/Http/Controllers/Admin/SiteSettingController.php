<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;

class SiteSettingController extends Controller
{
    // 1. Quản lý Trang chủ
    public function index()
    {
        $settings = SiteSetting::firstOrCreate([], SiteSetting::defaultSettings());
        return view('admin.site-settings.index', compact('settings'));
    }

}
