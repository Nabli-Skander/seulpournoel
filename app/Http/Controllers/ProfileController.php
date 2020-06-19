<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Image;

class ProfileController extends Controller
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
        $user = \Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\User::where('id', $id)->first();
        return view('profile.show', compact('user'));
    }


    public function delete()
    {
        $user = Auth::user();

        foreach ($user->participations as $event) {
            $event->removeParticipant($user);
        }

        foreach ($user->events as $event) {
            $event->deleteEvent();
        }

        Auth::logout();
        $user->delete();
        return redirect(route('home'))->with('success', 'Votre compte a été supprimé');
    }


    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
          'first_name' => 'required|string|max:255',
          'last_name' => 'required|string|max:255',
          'city' => 'required|string|max:255',
          'state' => 'required|string|max:255',
          'country' => 'required|string|max:255',
          'lat' => ['required', 'regex:/^(\-?[\.|\d]+)$/u'],
          'lng' => ['required', 'regex:/^(\-?[\.|\d]+)$/u'],
          'email' => [
            'required',
            'string',
            'email',
            Rule::unique('users')->ignore(\Auth::user()->id),
          ],
          'phone' => [
            'nullable',
            'string',
            Rule::unique('users')->ignore(\Auth::user()->id),
          ],
          'about' => 'nullable',
          'image' => 'nullable|image|max:4096',
          'age' => 'nullable|integer|max:120',
          'sex' => 'in:m,f',
        ]);

        if ($validator->fails()) {
            return redirect(route('profile.edit'))
              ->withErrors($validator)
              ->withInput();
        }

        $user = \Auth::user();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $old = public_path('/uploads/users/' . $user->image);

            \Image::make($file)->resize(null, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/users/' . $filename));

            \File::delete($old);
            $user->image = $filename;
        }


        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->location = $request->get('location');
        $user->city = $request->get('city');
        $user->state = $request->get('state');
        $user->country = $request->get('country');
        $user->lat = $request->get('lat');
        $user->lng = $request->get('lng');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->about = $request->get('about');
        $user->age = $request->get('age');
        $user->sex = $request->get('sex');

        $user->save();
        return redirect(route('profile.edit'))->with('success', __('Votre profil a été mis à jour.'));
    }


}
