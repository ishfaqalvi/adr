<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $type;
    /**
     * Create a new message instance.
     */
    public function __construct($otp, $type)
    {
        $this->otp = $otp;
        $this->type = $type;
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function build()
    {
        if($this->type == 'Account Varification')
        {
            $subject = 'Varification Needed';
            $view = 'email.email_varification';
        }else{
            $subject = 'Reset Password OTP';
            $view = 'email.forgot_password';
        }
        return $this->subject($subject)->view($view)->with(['otp' => $this->otp]);
    }
}
