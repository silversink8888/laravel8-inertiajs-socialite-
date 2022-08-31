<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    // SNSのOAuth側へリダイレクト
    public function redirectToProvider(Request $request) {
        $provider = $request->provider;
     //   dd($provider);

        return Socialite::driver($provider)->redirect();
    }

    // SNS側からcallbackされるユーザー情報
    public function handleProviderCallback(Request $request) {
        try {
            $provider = $request->provider;
            $sns_user = Socialite::driver($provider)->user();
        //    dd($sns_user);

            $sns_email = '';
            $sns_name = '';
            $sns_nickname = '';

            //各SNSのID
            $line_id = '';
            $google_id = '';
            $facebook_id = '';
            $yahoo_id = '';
            $twitter_id = '';
            $github_id = '';

            $sns_email = $sns_user->getEmail();
            $sns_name  = $sns_user->getName();
            $sns_nickname  = $sns_user->getNickname();
            if(!$sns_name){ $sns_name = $sns_nickname;} // github用の処理 (nicknameしかないので)
        //    dd($provider);
        //    dd($sns_email);


            if($provider == 'line'){
                $line_id = $sns_user->getId();
            }elseif($provider == 'google'){
                $google_id = $sns_user->getId();
            }elseif($provider == 'twitter'){
                $twitter_id = $sns_user->getId();
            }elseif($provider == 'github'){
                $github_id = $sns_user->getId();
            }elseif($provider == 'facebook'){
                $facebook_id = $sns_user->getId();
            }elseif($provider == 'yahoo'){
                $yahoo_id = $sns_user->getId();
            }

            $provider_culmn='';
            $provider_culmn = $provider . "_id";


            //  $user = Socialite::driver("google")->user();
                $finduser = User::where($provider_culmn, $sns_user->getId())->first();

                if ($finduser) {
                    Auth::login($finduser);
                    return redirect()->intended("dashboard");
                } else {
                    $newUser = User::create([
                        'email'    => $sns_email, 
                        'name'     => $sns_name, 
                        'provider' => $provider, 
                        'line_id'  => $line_id,
                        'google_id'  => $google_id,
                        'yahoo_id'  => $yahoo_id,
                        'twitter_id'  => $twitter_id,
                        'github_id'  => $github_id,
                        'facebook_id'  => $facebook_id,
                        'password' => Hash::make(Str::random())
                    ]);

                    Auth::login($newUser);

                    return redirect()->intended("dashboard");
                }
            } catch (Exception $e) {
                \Log::error($e);
                throw $e->getMessage();
            }
    //    dd($finduser);

        // 登録済ならログイン。未登録ならアカウント登録してログイン
     //   if(!is_null($sns_email)) {
        /*

        if(!is_null($sns_email) or !is_null($twitter_id)) {

            $user = User::firstOrCreate(
                [ 'email' => $sns_email ],
                [ 
                    'email'    => $sns_email, 
                    'name'     => $sns_name, 
                    'provider' => $provider, 
                    'line_id'  => $line_id,
                    'google_id'  => $google_id,
                    'yahoo_id'  => $yahoo_id,
                    'twitter_id'  => $twitter_id,
                    'github_id'  => $github_id,
                    'facebook_id'  => $facebook_id,
                    'password' => Hash::make(Str::random())
            ]);
            auth()->login($user);
            session()->flash('oauth_login', $provider.'でログインしました。');
            return redirect('/dashboard');
        }

        return '情報が取得できませんでした。';
        */
    }
}
