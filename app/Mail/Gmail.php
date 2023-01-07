<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Gmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $details;

     public function __construct($details)
    {
        $this->details = $details;
    }
    public function build()
    {
        return $this->subject('Welcome to TypeSkip!')
        ->view('emails.gmail')
        ->from('basil@typeskip.ai');
    }
}
