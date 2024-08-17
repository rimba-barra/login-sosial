<?php

namespace App\Http\Controllers;

use Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;

class OauthController extends Controller
{

    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGoogle()
    {
        try {

            $user = Socialite::driver('google')->user();
            $finduser = User::where('gauth_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect('/dashboard');

            }else{

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id'=> $user->id,
                    'gauth_type'=> 'google',
                    'password' => encrypt('admin@123')
                ]);

                Auth::login($newUser);

                return redirect('/dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function redirectToProviderGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallbackGithub()
    {
        try {

            $user = Socialite::driver('github')->user();
            $finduser = User::where('gauth_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect('/dashboard');

            }else{

                $newUser = User::create([
                    'name' => $user->nickname,
                    'email' => $user->email,
                    'gauth_id'=> $user->id,
                    'gauth_type'=> 'github',
                    'password' => encrypt('admin@123')
                ]);

                Auth::login($newUser);

                return redirect('/dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function redirectToProviderFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallbackFacebook()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('gauth_id', $user->id)->first();
            if($finduser){

                Auth::login($finduser);

                return redirect('/dashboard');

            }else{

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id'=> $user->id,
                    'gauth_type'=> 'facebook',
                    'password' => encrypt('admin@123')
                ]);

                Auth::login($newUser);

                return redirect('/dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
