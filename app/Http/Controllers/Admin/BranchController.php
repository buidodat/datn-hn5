<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        return view('admin.branches.index');
    }


    public function create()
    {
        return view('admin.branches.create');
    }
}
