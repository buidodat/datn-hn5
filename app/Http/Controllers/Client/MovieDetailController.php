<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieDetailController extends Controller
{
    public function show(string $slug){
        $movie = Movie::where('slug',$slug)->firstOrFail();
        return view('client.movie-detail' , compact('movie'));
    }
}
