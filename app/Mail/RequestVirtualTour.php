<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestVirtualTour extends Mailable
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
        return $this->view('email.request_virtual_tour')
                    ->subject('Request for Virtual Tour')
                    ->with([
                        'loggedInUser' => $this->loggedInUser,
                        'publisher' => $this->publisher,
                        'estateId' => $this->estateId,
                    ]);
    }
}
