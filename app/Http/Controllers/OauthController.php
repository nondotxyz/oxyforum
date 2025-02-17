<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function index()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('google')->user();
        $existingUser = User::where("gauth_id", $user->id)->first();

        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = User::create([
                "name" => $user->name,
                "email" => $user->email,
                "avatar" => $user->avatar,
                "gauth_id" => $user->id,
                "password" => bcrypt(str()->random(16)), // Use a random password since OAuth users don't need it
            ]);

            Auth::login($newUser);
        }

        return redirect("/group");
    }
}
