<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController2 extends Controller {

// GitHub の認証ページへ遷移 
public function redirectToProvider()
{
    return Socialite::driver('github')->redirect();
}

  public function handleProviderCallback()
  {
   $socialUser = Socialite::driver('github')->stateless()->user();
   $user = User::where([ 'email' => $socialUser->getEmail() ])->first();

   if ($user) {
       Auth::login($user);
       return redirect('/home');
   } else {
       $user = User::create([
           'name' => $socialUser->getNickname(),
           'email' => $socialUser->getEmail(),
           'password' => Hash::make($socialUser->getNickname()),  // 例としての記述なので、マネしないように
       ]);
       Auth::login($user);
       return redirect('/home');
   }
 }


}
