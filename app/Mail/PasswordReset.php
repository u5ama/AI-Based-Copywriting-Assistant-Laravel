<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordReset extends Mailable implements ShouldQueue
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
        return $this->subject('Password Reset')
        ->view('emails.password_reset')
        ->with([
            'details' => $this->details
        ])
        ->from(env('MAIL_FROM_ADDRESS'));
    }
}
