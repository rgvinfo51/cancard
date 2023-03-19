<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
class RegisterMail extends Mailable
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
        $subject='New Registration Request From '.$this->details['name'];
        if($this->details['sendtocustomer']==1){
            $subject='Thank you for registration';
        return $this->subject($subject)->markdown('emails.customerregistration')->with('data',$this->details);
        }
        else{
            return $this->subject($subject)->markdown('emails.newcustomer')->with('data',$this->details);
        }
    }
}
