<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $userFacebook = Socialite::driver('facebook')->user();

        $user = User::where('email', $userFacebook->getEmail())->first();

        if(!$user)
        {
            $user = User::create([
                'name' => $userFacebook->getName(),
                'email' => $userFacebook->getEmail(),
                'password' => '',
                'facebook_id' => $userFacebook->getId(),
                'avatar'=> $userFacebook->getAvatar(),
                'nickname' => $userFacebook->getNickname()
            ]);
        }

        // $user->getId();
        // $user->getNickname();
        // $user->getName();
        // $user->getEmail();
        // $user->getAvatar();

        // auth -> login user after facebook login
        Auth::login($user);

        return redirect()->route('home');
    }

    public function redirectToTwitterProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterProviderCallback()
    {
        $userTwitter = Socialite::driver('twitter')->user();

        if($userTwitter->getEmail()){
            $user = User::where('email', $userTwitter->getEmail())->first();
        }else{
            $user = User::where('twitter_id', $userTwitter->getId())->first();
        }

        

        if($user)
        {
            //update user information
            $user->update([
                'name' => $userTwitter->getName(),
                'twitter_id' => $userTwitter->getId(),
                'avatar'=> $userTwitter->getAvatar(),
                'nickname' => $userTwitter->getNickname()
            ]);

        }else{
            // create new user based on the received data
            $user = User::create([
                'name' => $userTwitter->getName(),
                'email' => $userTwitter->getEmail(),
                'password' => '',
                'twitter_id' => $userTwitter->getId(),
                'avatar'=> $userTwitter->getAvatar(),
                'nickname' => $userTwitter->getNickname()
            ]);
        }

        // $user->getId();
        // $user->getNickname();
        // $user->getName();
        // $user->getEmail();
        // $user->getAvatar();

        // auth -> login user after facebook login
        Auth::login($user);

        return redirect()->route('home');
    }

    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleProviderCallback()
    {
        $userGoogle = Socialite::driver('google')->user();

        $user = User::where('email', $userGoogle->getEmail())->first();

        if(!$user)
        {
            $user = User::create([
                'name' => $userGoogle->getName(),
                'email' => $userGoogle->getEmail(),
                'password' => '',
                'google_plus_id' => $userGoogle->getId(),
                'avatar'=> $userGoogle->getAvatar(),
                'nickname' => $userGoogle->getNickname()
            ]);
        }

        // auth -> login user after facebook login
        Auth::login($user);

        return redirect()->route('home');
    }
}
