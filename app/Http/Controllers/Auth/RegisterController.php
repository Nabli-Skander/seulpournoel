<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected function redirectTo()
    {
        return route('home');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'lat' => ['regex:/^(\-?[\.|\d]+)$/u'],
            'lng' => ['regex:/^(\-?[\.|\d]+)$/u'],
            'sex' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'lat' => $data['lat'],
            'lng' => $data['lng'],
            'location' => $data['location'],
            'city' => $data['country'],
            'state' => $data['state'],
            'country' => $data['country'],
            'email' => $data['email'],
            'sex' => $data['sex'],
            'image' => $this->selectImage($data['sex']),
            'password' => bcrypt($data['password']),
            'lang' => \LaravelLocalization::getCurrentLocale(),
            'email_token' => str_random(10),
        ]);
    }

    protected function redirectPath()
    {
        return route('profile.edit');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        $email = new EmailVerification($user);
        Mail::to($user->email)->send($email);
        return redirect(route('home'))->with('success', __('Merci de consulter vos emails pour valider votre compte.'));

    }

    public function selectImage(string $sex)
    {

        $cataloguef = ['author-01.jpg', 'author-02.jpg', 'author-04.jpg', 'author-08.jpg', 'author-09.jpg'];
        $catalogueh = ['author-03.jpg', 'author-05.jpg', 'author-06.jpg', 'author-07.jpg'];

        if ($sex === 'f') {
            return $cataloguef[array_rand($cataloguef, 1)];
        } else {
            return $catalogueh[array_rand($catalogueh, 1)];
        }

    }


    public function verify($token)
    {
        // The verified method has been added to the user model and chained here
        // for better readability
        $user = User::where('email_token', $token)->firstOrFail();

        $user->verified();
        $this->guard()->login($user);
        return redirect($this->redirectPath())->with('success', __('Votre compte a bien été validé.'));
    }
}
