<?php

namespace App\Http\Controllers;

use App\Models\Real;
use App\Models\User;
use App\Mail\RequestEstate;
use App\Mail\RejectEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEstateNotification($estateId)
    {
        // Get the logged-in user
        $loggedInUser = Auth::user();
        if (!$loggedInUser) {
            return redirect()->back()->with('error', 'You must be logged in to send an email.');
        }

        // Get the estate and its publisher
        $estate = Real::findOrFail($estateId);
        $publisher = $estate->user; // Assuming the Real model has a user() relationship

        if (!$publisher) {
            return redirect()->back()->with('error', 'The estate does not have a publisher.');
        }

        if (!$publisher->email) {
            return redirect()->back()->with('error', 'The publisher does not have an email address.');
        }

        // Send the email to the publisher, passing the real ID
        Mail::to($publisher->email)->send(new RequestEstate($loggedInUser, $publisher, $estateId));

        return redirect()->back()->with('success', 'Email sent successfully to ' . $publisher->email);
    }


    public function rejectEstateRequest($estateId)
    {
        // Get the logged-in user
        $loggedInUser = Auth::user();
        if (!$loggedInUser) {
            return redirect()->back()->with('error', 'You must be logged in to reject the estate request.');
        }

        // Get the estate and the requester (publisher)
        $estate = Real::findOrFail($estateId);
        $requester = $estate->user; // Assuming the Real model has a user() relationship

        if (!$requester) {
            return redirect()->back()->with('error', 'The estate does not have a requester.');
        }

        if (!$requester->email) {
            return redirect()->back()->with('error', 'The requester does not have an email address.');
        }

        // Send the rejection email to the requester
        Mail::to($requester->email)->send(new RejectEstate($requester, $loggedInUser, $estateId));

        return redirect()->back()->with('success', 'Estate request rejected and notification sent to the requester.');
    }
}
