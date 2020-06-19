<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected function redirectTo()
    {
        return route('dashboard.events');
    }

    public function credentials(Request $request)
    {
        return [
          'email' => $request->email,
          'password' => $request->password,
          'verified' => 1,
        ];
    }

    protected function authenticated(Request $request, $user)
    {

        return redirect(\LaravelLocalization::getLocalizedURL($user->lang, route('home')))
          ->with('success', "Bienvenue " . $user->first_name);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $lang = $request->session()->get('locale');
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect(\LaravelLocalization::getLocalizedURL($lang, route('home')))
          ->with('success', __('Vous êtes désormais déconnecté'));
    }
}
