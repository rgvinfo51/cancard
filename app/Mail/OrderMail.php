<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
class OrderMail extends Mailable
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
        $orderno=$this->details['order']->orderno;
        $subject='Order '.$orderno.' Request From '.$this->details['order']->bfirstname.' '.$this->details['order']->blastname;
        if($this->details['sendtocustomer']==1){
            $subject='Your Cancard Store order '.$orderno.' has been received';
            return $this->subject($subject)->markdown('emails.customerorder')->with('data',$this->details);
        }
        else{
            return $this->subject($subject)->markdown('emails.adminorder')->with('data',$this->details);
        }
    }
}
