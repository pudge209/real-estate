<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class AcceptEstate extends Mailable
{
    use Queueable, SerializesModels;

    public $requester;
    public $loggedInUser;
    public $estateId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($requester, $loggedInUser, $estateId)
    {
        $this->requester = $requester;
        $this->loggedInUser = $loggedInUser;
        $this->estateId = $estateId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.accept')
                    ->subject('Estate Request accpeted')
                    ->with([
                        'requester' => $this->requester,
                        'loggedInUser' => $this->loggedInUser,
                        'estateId' => $this->estateId
                    ]);
    }
}


