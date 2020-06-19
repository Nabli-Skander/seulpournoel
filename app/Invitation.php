<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
      'created_at',
      'event_id',
      'updated_at',
      'user_id'
    ];

    protected $dispatchesEvents = [
      'created' => InvitationWasCreated::class,
    ];

    public static function mine()
    {
        return self::where('user_id', \Auth::user()->id)->orderBy('created_at');
    }

    public function from()
    {
        return $this->event->host();
    }

    public function event()
    {
        return $this->belongsTo('\App\Event', 'event_id');
    }
}
