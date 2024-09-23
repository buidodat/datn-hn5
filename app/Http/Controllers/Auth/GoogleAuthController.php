<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callBackGoogle()
    {
        try {
            $userGoogle = Socialite::driver('google')->user();
            $user = User::where('service_id', $userGoogle->id)->first();

            if ($user) {
                Auth::login($user);
                return redirect()->intended('/');
            } else {
                $existUser = User::where('email', $userGoogle->email)->first();
                if ($existUser) {
                    $existUser->update([
                        'name' => $userGoogle->name,
                        'service_id' => $userGoogle->id,
                        'service_name' => 'google',
                    ]);
                    Auth::login($existUser);
                } else {
                    $newUser = User::updateOrCreate(['email' => $userGoogle->email],[
                        'name' => $userGoogle->name,
                        'service_id'=> $userGoogle->id,
                        'service_name' => 'google',
                    ]);
                    Auth::login($newUser);
                }

                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            // return redirect()->intended('http://datn-hn5.test');
        }
    }
}
