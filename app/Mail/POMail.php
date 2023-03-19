<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
class POMail extends Mailable
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
        $subject = 'You uploaded the wrong PO';
        if($this->details['sendtocustomer']==1){
            return $this->subject($subject)->markdown('emails.po')->with('data',$this->details);
        }
        else{
            $subject = 'New PO Request From '.$this->details['name'];
            return $this->subject($subject)->markdown('emails.po')->with('data',$this->details);
        }
    }
}
