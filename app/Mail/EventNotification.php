<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $text;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, $text, $link = true)
    {
        $this->event = $event;
        $this->text = $text;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
          ->subject($this->event->title)
          ->markdown('emails.event-notification');
    }
}
