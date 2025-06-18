<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VirtualTourResponse extends Mailable
{
    use Queueable, SerializesModels;

    public $estate;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($estate, $status)
    {
        $this->estate = $estate;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.virtual_tour_response')
                    ->subject('Virtual Tour Request ' . ucfirst($this->status))
                    ->with([
                        'estate' => $this->estate,
                        'status' => $this->status,
                    ]);
    }
}
