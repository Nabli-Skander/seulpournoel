<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('password.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->validate($request, [
          'password_old' => 'required',
          'password_new' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($request->password_old, $user->password)) {
            //Change the password
            $user->fill([
              'password' => Hash::make($request->password_new)
            ])->save();

            return redirect(route('password.edit'))->with('success', __('Votre mot de passe a été changé'));

        }

        return redirect(route('password.edit'))->with('error', __('Ancien mot de passe incorrect'));

    }


}
