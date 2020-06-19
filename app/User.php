<?php

namespace App;

use App\Notifications\ResetPassword;
use Laravel\Passport\HasApiTokens;
use Illuminate\Bill;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'location',
        'city',
        'state',
        'country',
        'lng',
        'lat',
        'email',
        'password',
        'image',
        'lang',
        'email_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'last_name',
        'location',
        'city',
        'state',
        'country',
        'lng',
        'lat',
        'email',
        'password',
        'lang',
        'email_token',
        'about',
        'admin',
        'age',
        'phone',
        'sexe',
        'verified',
        'updated_at',
        'sex',
        'created_at'
    ];

    static function closestTo($latitude, $longitude, $distance = 50)
    {
        return self::whereRaw("6371 * acos(
                      cos(radians($latitude))
                    * cos(radians(lat))
                    * cos(radians(lng) - radians($longitude))
                    + sin(radians($latitude))
                    * sin(radians(lat))) <= $distance")->get();
    }

    public function events()
    {
        return $this->hasMany('\App\Event');
    }

    public function participations()
    {
        return $this->belongsToMany('\App\Event', 'events_users')->withPivot('id', 'message', 'status');
    }

    public function invitations()
    {
        return $this->hasMany('\App\Invitation');
    }

    public function location()
    {
        return $this->city . ', ' . $this->country;
    }

    public function isRelatedTo($otherUser)
    {
        if ($otherUser->id == $this->id) {
            return true;
        }

        foreach ($this->participations as $event) {
            if ($event->pivot->status == 'accepted' && $event->host->id == $otherUser->id) {
                return true;
            }
        }

        foreach ($otherUser->participations as $event) {
            if ($event->pivot->status == 'accepted' && $event->host->id == $this->id) {
                return true;
            }
        }

        return false;
    }

    public function imageURL()
    {
        if (!$this->image) {
            return '/theme/img/author-09.jpg';
        }
        return '/uploads/users/' . $this->image;
    }

    public function aboutShort($limit = 100)
    {
        return str_limit($this->about, $limit, $end = '...');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function verified()
    {
        $this->verified = 1;
        $this->email_token = null;
        $this->save();
    }

    function sexAndAge()
    {
        $ret = '';
        if ($this->sex && ($this->sex == 'm' || $this->sex == 'f')) {
            $ret .= $this->sex == 'm' ? __('Homme') : __('Femme');
        }
        if ($this->age) {
            $ret .= ($this->sex ? ', ' : '') . $this->age . ' ' . __('ans');
        }
        return $ret;
    }

    function isAdmin()
    {
        return $this->admin == true;
    }
}
