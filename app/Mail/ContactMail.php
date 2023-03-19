<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details; 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // print_r($this->details);exit;
        $subject='Contact Request From '.$this->details['fullname'];
        return $this->subject($subject)->markdown('emails.contactrequest')->with('data',$this->details);
    }
}
