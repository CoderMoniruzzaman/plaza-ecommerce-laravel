<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $first_name_to_send = "";
    public $last_name_to_send = "";
    public $subject_to_send = "";
    public $message_to_send = "";
    public function __construct($first_name,$last_name,$subject,$message)
    {
        $this->first_name_to_send = $first_name;
        $this->last_name_to_send = $last_name;
        $this->subject_to_send = $subject;
        $this->message_to_send = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email/contactmessageemail');
    }
}
