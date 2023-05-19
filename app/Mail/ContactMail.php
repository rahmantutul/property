<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactMailData)
    {
        $this->contactMailData = $contactMailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Contact mail')
        ->view('emails.contact_mail')->with(['dataInfo' => $this->contactMailData]);
    }
}
