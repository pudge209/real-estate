<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectEstate extends Mailable
{
    use Queueable, SerializesModels;

    public $requester;
    public $loggedInUser;
    public $estateId;

    public function __construct($requester, $loggedInUser, $estateId)
    {
        $this->requester = $requester;
        $this->loggedInUser = $loggedInUser;
        $this->estateId = $estateId;
    }

    public function build()
    {
        return $this->view('email.reject')
                    ->subject('Estate Request Declined')
                    ->with([
                        'requester' => $this->requester,
                        'loggedInUser' => $this->loggedInUser,
                        'estateId' => $this->estateId
                    ]);
    }
}
