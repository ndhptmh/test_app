<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User; 

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }
  
    public function handleProviderCallback($driver)
    {
        $date = date("Y:m:d H:i:s");
        try {
            $user = Socialite::driver($driver)->user();
            //dd($user->getEmail());
            $create = User::firstOrCreate([
                'email' => $user->getEmail()
            ], [
                'email'             => $user->getEmail(),
                'name'              => $user->getName(),
                'password'          => NULL,
                'email_verified_at' => $date,
            ]);
            
            auth()->login($create, true);
            return redirect('/home');

        } catch (\Exception $e) {
            //dd('error');
            return redirect()->route('login');
        }


    }
}
