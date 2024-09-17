<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Combo;
use App\Models\Food;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function checkout()
    {
        $data = Combo::query()->where('is_active', '1')->with('comboFood')->latest('id')->get();
        $foods = Food::query()->select('id', 'name', 'type')->get();

        // dd($food->toArray());

        return view('client.checkout', compact('data', 'foods'));
    }
}
