<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    // public $id = Auth::user()->id ?? 1;
    const PATH_VIEW = 'admin.my-accounts.';
    const PATH_UPLOAD = 'users';
    public function show(){
        $user = User::findOrFail(1);
        
        return view(self::PATH_VIEW . __FUNCTION__, compact('user'));
    }
}
