<?php

namespace App\TrusCRUD\Core\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\Login;
use Validator, Redirect, Response, File;
use App\User;
use App\UserProvider;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect(Request $req,$provider)
    {
        session(['socialite-page' => $req->page]);
        return Socialite::driver($provider)->redirect();
    }
    
    public function callback(Request $request, $provider)
    {
        //Get data from provider
        $getInfo = Socialite::driver($provider)->stateless()->user();

        //Check account was related with users.
        $user    = $this->checkUser($getInfo, $provider);

        if(session('socialite-page') == 'profile') {
            $this->add_account(auth()->user()->id, $provider, $getInfo->id, $getInfo->token);
            return redirect()->route('profile');
        } else {
            if(!$user) {
                
                $data = [
                    'name'  => $getInfo->name,
                    'email' => $getInfo->email,
                ];
    
                return redirect()->to('/register')->with('status', 'error')->with('message', "The account is not registred.")->with('data', $data);
            } else {
                auth()->login($user);
                $user->notify(new Login('Login with '.ucwords($provider).' from '.$request->ip()));
                return redirect()->to('/profile');
            }
        }
        
    }


    function checkUser($getInfo, $provider) {
        $provider = UserProvider::where('provider', $provider)->where('provider_id', $getInfo->id)->first();
        
        if($provider != null) {
            UserProvider::where('id', $provider->user_id)->update([
                "token" => $getInfo->token
            ]);

            return User::where("id", $provider->user_id)->first();
        } else {
            return false;
        }
    }

    function add_account($user_id, $provider, $provider_id, $token) {
        $provider_model = new UserProvider();
        $provider_model->user_id     = $user_id;
        $provider_model->provider    = $provider;
        $provider_model->provider_id = $provider_id;
        $provider_model->token       = $token;

        $provider_model->save();
    }
}
