<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Musonza\Chat\Chat;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = \Request::get('location');

        if (!$address || strlen($address) == 0) {
            $events = Event::paginate(env('PAGINATE_LIMIT'));
        } else {
            $events = Event::near($address)->paginate(env('PAGINATE_LIMIT'));
        }

        return View('event.index', compact('events'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {


        return View('event.show', compact('event'));
    }

    /**
     * Participate to an event
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function participate(Request $request, $id)
    {
        $event = Event::find($id);
        if ($event->host->id != \Auth::user()->id) {
            $event->addParticipant(Auth::user(), $request->input('message'));
            return redirect(route('events.show', $id))->with('success', __('Votre demande a été soumise.'));
        } else {
            return redirect(route(' events.show', $id));
        }
    }

    public function part()
    {



    }


    /**
     * @param Request $request
     * @param $eventId
     * @param $requestId
     * @param $action
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function requestAction(Request $request, $eventId, $requestId, $action)
    {
        $redirect = redirect(route('events.show', $eventId));

        $event = Event::find($eventId);

        if (!$event->mine()) {
            return redirect(route(' events.show', $eventId));
        }

        if ($event->host->id != \Auth::user()->id)
            return $redirect;

        $req = \DB::table('events_users')
          ->where('id', $requestId)->first();


        if ($req->status == 'new' && ($action == 'accept' || $action == 'decline')) {

            $user = User::find($req->user_id);

            if ($action == 'accept') {
                $event->acceptParticipant($user);
                return $redirect->with('success', __('Demande acceptée'));
            }

            $event->refuseParticipant($user);
            return $redirect->with('success', __('Demande refusée'));
        }

        return $redirect;
    }
}
