<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable {
    use Queueable, SerializesModels;
    public $otp;
    public $user;
    public $message;
    /**
     * Create a new message instance.
     */
    public function __construct( $otp,$user,$message) {
        $this->otp = $otp;
        $this->user = $user;
        $this->message= $message;
    }

     /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your OTP Key')
                    ->view('mail.otpmail'); // This refers to the email view
    }
}
