<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
class QuoteMail extends Mailable
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
        $quoteno=$this->details['quoteno'];
        $subject='Quote '.$quoteno.' Request From '.$this->details['firstname'].' '.$this->details['lastname'];
        if($this->details['sendtocustomer']==1){
            $subject=$quoteno.' Recieved Your Quote Request';
        return $this->subject($subject)->markdown('emails.customerquoterequest')->with('data',$this->details);
        }
        else{
            return $this->subject($subject)->markdown('emails.quoterequest')->with('data',$this->details);
        }
    }
}
