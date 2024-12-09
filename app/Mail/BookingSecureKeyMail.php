<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

// class BookingSecureKeyMail extends Mailable implements ShouldQueue
class BookingSecureKeyMail extends Mailable 
{
    use Queueable, SerializesModels;

    public $secureKey;
    public $guestName;
    public $startDate;
    public $endDate;
    public $hotelName;
    public $hotelAddress;
    public $hotelPhone;

    public function __construct($secureKey, $guestName, $startDate, $endDate, $hotelName, $hotelAddress,$hotelPhone)
    {
        $this->secureKey = $secureKey;
        $this->guestName = $guestName;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->hotelName = $hotelName;
        $this->hotelAddress = $hotelAddress;
        $this->hotelPhone = $hotelPhone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Booking Details and Secure Key')
                    ->view('backend.layout.booking.email'); // This refers to the email view
    }
}


