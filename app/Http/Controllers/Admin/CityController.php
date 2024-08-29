<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return view('admin.cities.index');
    }


    public function create()
    {
        return view('admin.cities.create');
    }
}
