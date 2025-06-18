<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RequestVirtualTour;
use App\Mail\VirtualTourResponse;
use Illuminate\Support\Facades\Mail;
use App\Models\Real;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VirtualTourRequestController extends Controller
{
    public function requestVirtualTour($estateId)
    {
        // Get the logged-in user
        $loggedInUser = Auth::user();

        // Get the estate and its publisher (user)
        $estate = Real::findOrFail($estateId);
        $publisher = $estate->user; // Using the user() relationship from the Real model

        if (!$publisher) {
            return redirect()->back()->with('error', 'Publisher not found for this estate.');
        }

        // Send the email to the publisher, passing the estate ID
        Mail::to($publisher->email)->send(new RequestVirtualTour($loggedInUser, $publisher, $estateId));

        // Return a response, such as a view or redirect
        return redirect()->back()->with('success', 'Virtual tour request sent successfully to ' . $publisher->email);
    }


    public function accept($estateId, $userId)
    {
        $estate = Real::findOrFail($estateId);
        $user = User::findOrFail($userId);

        // Logic to handle acceptance (e.g., updating a database record)

        // Send the response email to the user
        Mail::to($user->email)->send(new VirtualTourResponse($estate, 'accepted'));

        return view('response', ['status' => 'accepted']);
    }

    public function reject($estateId, $userId)
    {
        $estate = Real::findOrFail($estateId);
        $user = User::findOrFail($userId);

        // Logic to handle rejection (e.g., updating a database record)

        // Send the response email to the user
        Mail::to($user->email)->send(new VirtualTourResponse($estate, 'rejected'));

        return view('response', ['status' => 'rejected']);
    }
}
