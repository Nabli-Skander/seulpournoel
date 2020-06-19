<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $user;
    public $mess;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, $user, $message)
    {
        $this->event = $event;
        $this->user = $user;
        $this->mess = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
          ->subject($this->user->first_name . ' souhaite participer à votre événement')
          ->markdown('emails.request');
    }
}
