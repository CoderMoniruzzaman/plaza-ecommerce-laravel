<?php

namespace App\Http\Controllers;

use Socialite;
use Auth;
use Carbon\Carbon;
use App\User;


class GoogleController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        if(User::where('email',$user->getEmail())->exists()){
          $user_info = User::where('email',$user->getEmail())->first();
          Auth::guard()->login($user_info);
          return redirect('login');
        }
        else{
          $user_id = User::insertGetId([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => 'SocialAccount',
            'role' => 2,
            'created_at' => Carbon::now()
          ]);
        $user_info = User::find($user_id);
        Auth::guard()->login($user_info);
        return redirect('login');
      }
    }
}
