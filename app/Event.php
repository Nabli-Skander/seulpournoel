<?php

namespace App;

use App\Mail\CancelNotification;
use App\Mail\EventNotification;
use App\Mail\Invitation;
use App\Mail\RequestNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Mail;
use Musonza\Chat\Chat;
use Musonza\Chat\Facades\ChatFacade;

class Event extends Model
{
    protected $guarded = [];
    public static $boostMax = 2;

    public static function near($address)
    {
        $address = urlencode(urldecode($address));
        $response = \Guzzle::get("https://maps.google.com/maps/api/geocode/json?sensor=false&address=$address&key=" . env('GOOGLE_MAPS_API_KEY') . "&components=country:FR");

        $json = $array = json_decode($response->getBody(), true);
        if (!$json['results']) {
            return self::selectRaw('*')
                ->orderBy('created_at');
        }
        $latitude = $json['results'][0]['geometry']['location']['lat'];
        $longitude = $json['results'][0]['geometry']['location']['lng'];

        return self::selectRaw('*, st_distance(POINT(latitude, longitude), POINT(?, ?)) as distance', [$latitude, $longitude])
            ->orderBy('distance');
    }

    public function host()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function locationShort()
    {
        return $this->city . ', ' . $this->country;
    }

    public function price()
    {
        if ($this->price == 0)
            return __('Gratuit');
        return $this->price . ' €';
    }

    public function shortDescription($limit = 100)
    {
        return str_limit($this->description, $limit, $end = '...');
    }

    public function users()
    {
        return $this->belongsToMany('\App\User', 'events_users')->withTimestamps()->withPivot('id', 'message', 'status');
    }

    public function invitations()
    {
        return $this->belongsToMany('App\Invitation', 'invitations', 'event_id', 'user_id')->withTimestamps();
    }

    public function mine()
    {
        if (\Auth::guest()) {
            return false;
        }

        return $this->user_id == \Auth::user()->id;
    }


    public function registered()
    {
        if (\Auth::guest()) {
            return false;
        }
        return \DB::table('events_users')
                ->where('user_id', \Auth::user()->id)
                ->where('event_id', $this->id)
                ->where('status', 'accepted')
                ->count() > 0;
    }

    public function participant()
    {
        return \DB::table('events_users')
                ->where('event_id', $this->id)
                ->where('status', 'accepted')
                ->count() > 0;
    }



    public function addParticipant($user, $message = '')
    {
        $this->users()->attach($user, ['message' => $message]);
        $this->notifyHost(new RequestNotification($this, $user, $message));
    }

    public function removeParticipant($user)
    {
        $this->users()->detach($user);
        $this->notifyHost(new CancelNotification($this, $user));
    }

    public function acceptParticipant($user)
    {
        DB::table('events_users')
            ->where('event_id', $this->id)
            ->where('user_id', $user->id)
            ->update([
                'status' => 'accepted',
                'updated_at' => \Carbon\Carbon::now()
            ]);

        $user->notify(new EventNotification($this, __('Votre demande de participation a été acceptée !')));
    }

    public function refuseParticipant($user)
    {
        DB::table('events_users')
            ->where('event_id', $this->id)
            ->where('user_id', $user->id)
            ->update([
                'status' => 'refused',
                'updated_at' => \Carbon\Carbon::now()
            ]);
    }

    public function invite($user)
    {
        $this->invitations()->attach($user);
        Mail::to($user->email)->queue(new EventNotification($this, $this->host->first_name . ' ' . __('souhaite vous inviter à son événement.')));
    }

    public function sendConfirmationEmail()
    {
    }

    public function notifyGuests($email)
    {
        foreach ($this->users as $user) {
            Mail::to($user->email)->queue($email);
        }
    }

    public function notifyHost($email)
    {
        Mail::to($this->host->email)->queue($email);
    }

    public function notifyAll($email)
    {
        $this->notifyGuests($email);
        $this->notifyHost($email);
    }

    public function deleteEvent()
    {
        $event = $this;
        $event->users()->detach();
        DB::table('invitations')->where('event_id', $event->id)->delete();
        $event->notifyAll(new EventNotification($event, __("L'événement a été supprimé."), false));
        $event->forceDelete();
    }

    public function requestPending()
    {
        return \DB::table('events_users')
                ->where('user_id', \Auth::user()->id)
                ->where('event_id', $this->id)
                ->where('status', 'new')
                ->count() > 0;
    }

    public function canRequest()
    {
        return \Auth::user() && !$this->mine() && !$this->registered() && !$this->requestPending();
    }

    public function boostRemaining()
    {
        return self::$boostMax - $this->boost;
    }

    public function boostAround($distance)
    {
        $users = User::closestTo($this->latitude, $this->longitude, $distance)->all();

        foreach ($users as $user) {
            if ($user->id != $this->host->id) {
                $this->invite($user);
            }
        }
        $this->boost = $this->boost + 1;
        $this->save();
    }

    public function imageURL($or = '/theme/img/author-01.jpg')
    {
        if (!$this->image) {
            return $or;
        }
        return '/uploads/events/' . $this->image;
    }
}
