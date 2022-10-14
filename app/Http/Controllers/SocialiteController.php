<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{

    private $availableDrivers = [
        'facebook',
        'twitter',
        'google'
    ];

    public function redirectToProvider($provider)
    {
        // check if the driver exists
        if(!in_array($provider, $this->availableDrivers)){
            return redirect()->route('login');
        }
        
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        // check if the driver exists
        if(!in_array($provider, $this->availableDrivers)){
            return redirect()->route('login');
        }
        
        $userOAuth = Socialite::driver($provider)->user();

        if($userOAuth->getEmail()){
            $user = User::where('email', $userOAuth->getEmail())->first();
        }else{
            $user = User::where($provider.'_id', $userOAuth->getId())->first();
        }

        // $provider.'_id' = facebook_id or twitter_id or google_id

        if($user)
        {
            //update user information
            $user->update([
                'name' => $userOAuth->getName(),
                $provider.'_id' => $userOAuth->getId(),
                'avatar'=> $userOAuth->getAvatar(),
                'nickname' => $userOAuth->getNickname()
            ]);

        }else{
            // create new user based on the received data
            $user = User::create([
                'name' => $userOAuth->getName(),
                'email' => $userOAuth->getEmail(),
                'password' => '',
                $provider.'_id' => $userOAuth->getId(),
                'avatar'=> $userOAuth->getAvatar(),
                'nickname' => $userOAuth->getNickname()
            ]);
        }

        // auth -> login user after facebook login
        Auth::login($user);

        return redirect()->route('home');
    }

}
