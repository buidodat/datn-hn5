<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TypeSeatController extends Controller
{
    public function index(){
        return view('admin.typeseats.index');
    }
    public function create(){
        return view('admin.typeseats.create');
    }
}
