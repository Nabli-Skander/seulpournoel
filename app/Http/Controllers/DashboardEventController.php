<?php

namespace App\Http\Controllers;

use App\Event;
use App\Helpers\AppHelpers;
use App\Mail\EventNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Musonza\Chat\Chat;


class DashboardEventController extends Controller
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
     * @param $request
     * @return mixed
     */
    private function validator($request)
    {
        return Validator::make($request->all(), [
          'title' => 'required|max:255',
          'price' => 'required|integer|min:0|max:1000',
          'day' => 'required|integer|min:1|max:31',
          'month' => 'required|integer|min:1|max:12',
          'year' => 'required|integer|min:' . date("Y") . '|max:' . (date("Y") + 5) . '',
          'time' => 'required|date_format:H:i',
          'location' => 'required|max:100',
          'address' => 'required|max:100',
          'postal_code' => 'required|max:10',
          'city' => 'required|max:30',
          'state' => 'required|max:30',
          'country' => 'required|max:30',
          'boost' => 'nullable|integer|between:0,120',
          'longitude' => ['required', 'regex:/^(\-?[\.|\d]+)$/u'],
          'latitude' => ['required', 'regex:/^(\-?[\.|\d]+)$/u'],
          'description' => 'required|max:1000',
          'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = \Auth::user()->events;
        return view('dashboard.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->phone == "") {
            redirect(route('profile.edit'))->with('error', __('Merci de compléter votre numéro de téléphone'));
        }
        return view('dashboard.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return redirect(route('dashboard.events.create'))
              ->withErrors($validator)
              ->withInput();
        }


        if (env('STRIPE_ENABLED') != false) {
            try {
                AppHelpers::charge($request, '200');
            } catch (\Exception $ex) {
                return redirect(route('dashboard.events.index'))->with('error', __('Une erreur est survenue.'));
            }
        }

        $event = new Event();

        $event->title = $request->get('title');
        $event->user_id = $request->user()->id;
        $event->price = $request->get('price');


        $event->date = Carbon::create($request->get('year'),
          $request->get('month'),
          $request->get('day'),
          $request->get('hour'),
          $request->get('minute'))
          ->setTimeFromTimeString($request->get('time'));

        $event->description = $request->get('description');

        $event->location = $request->get('location');
        $event->address = $request->get('address');
        $event->city = $request->get('city');
        $event->postal_code = $request->get('postal_code');
        $event->country = $request->get('country');
        $event->state = $request->get('state');
        $event->latitude = $request->get('latitude');
        $event->longitude = $request->get('longitude');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . ' . ' . $file->getClientOriginalExtension();

            \Image::make($file)->resize(null, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/events/' . $filename));


            $event->image = $filename;
        }


        $event->save();




        if ($event->boostRemaining() > 0) {
            if ($request->get('boost') > 0) {
                $event->boostAround($request->get('boost'));
            }
        }
        $event->notifyHost(new EventNotification($event, __("L'événement a bien été créé.")));

        return redirect(route('dashboard.events.index'))->with('success', __("L'événement a bien été créé."));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        if (!$event->mine()) {
            return back();
        }

        return view('dashboard.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return redirect(route('dashboard.events.edit', $event->id))
              ->withErrors($validator)
              ->withInput();
        }
        if ($request->get('submit_invit')) {
            if ($event->boostRemaining() > 0) {
                if ($request->get('boost') > 0) {
                    $event->boostAround($request->get('boost'));
                }
                return redirect(route('dashboard.events.edit', $event->id))->with('success', __("Invitations envoyées"));
            }
        }

        $event->title = $request->get('title');
        $event->user_id = $request->user()->id;
        $event->price = $request->get('price');


        $event->date = Carbon::create($request->get('year'),
          $request->get('month'),
          $request->get('day'),
          $request->get('hour'),
          $request->get('minute'))
          ->setTimeFromTimeString($request->get('time'));

        $event->description = $request->get('description');

        $event->location = $request->get('location');
        $event->address = $request->get('address');
        $event->city = $request->get('city');
        $event->postal_code = $request->get('postal_code');
        $event->country = $request->get('country');
        $event->state = $request->get('state');
        $event->latitude = $request->get('latitude');
        $event->longitude = $request->get('longitude');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . ' . ' . $file->getClientOriginalExtension();

            \Image::make($file)->resize(null, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/events/' . $filename));

            if ($event->image) {
                $old = public_path('/uploads/events/' . $event->image);
                \File::delete($old);
            }

            $event->image = $filename;
        }

        $event->save();
        $event->notifyAll(new EventNotification($event, __("L'événement a été mis à jour.")));

        return redirect(route('dashboard.events.edit', $event->id))->with('success', __("L'événement a été mis à jour."));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event->mine()) {
            return redirect(route('dashboard.events.index'));
        }
        $event->deleteEvent();
        return redirect(route('dashboard.events.index'))->with('success', __("L'événement a été supprimé."));
    }

}
