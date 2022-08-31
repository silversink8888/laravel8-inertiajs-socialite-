<?php

namespace App\Http\Controllers\socialite;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function getGoogleAuth()
    {
        return Socialite::driver('google')->redirect();
    }

    public function authGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
    //    dd($googleUser);
    //    dd($googleUser->user['id']);
        $google_id = $googleUser->getID();
        $provider = 'google2';

        $user = User::firstOrCreate([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'provider' => $provider,
            'google_id' => $google_id

        ], [
            'email_verified_at' => now(),
    //    'google_id' => $googleUser->user['id']

        ]);
        Auth::login($user, true);
        return redirect('/dashboard');
    }
}
