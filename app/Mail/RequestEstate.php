<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestEstate extends Mailable
{
    use Queueable, SerializesModels;

    public $loggedInUser;
    public $publisher;
    public $estateId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($loggedInUser, $publisher, $estateId)
    {
        $this->loggedInUser = $loggedInUser;
        $this->publisher = $publisher;
        $this->estateId = $estateId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.request')
                    ->subject('New Inquiry about Your Estate')
                    ->with([
                        'loggedInUser' => $this->loggedInUser,
                        'publisher' => $this->publisher,
                        'estateId' => $this->estateId
                    ]);
    }
}
