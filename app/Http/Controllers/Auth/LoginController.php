<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\Login;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();

        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view($this->template.'auth.login');
    }

    public function authenticated(Request $request) {
        $user = Auth::user();
        $user->notify(new Login($request,"Login from ". $request->getClientIp()));
    }

    public function logout() {
        $user = Auth::user();
        Log::channel('all')->error('Logout Successful', [
            "id" => $user->id,
            "name" => $user->name
        ]);

        Cache::forget('menu-'.$user->permissions_role_id);

        Auth::logout();
        return redirect('/login');
    }

    protected function validateLogin(Request $request)
    {
        $validate[$this->username()] = 'required|string';
        $validate['password'] = 'required|string';
        
        if(config('recaptcha.status')) {
            $validate['g-recaptcha-response'] = 'required|recaptcha';
        }

        $request->validate($validate);
    }
}
