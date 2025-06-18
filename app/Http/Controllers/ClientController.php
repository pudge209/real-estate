<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\Real;
use App\Models\EstateTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\AcceptEstate;

class ClientController extends Controller
{
    public function deleteEstate($estateId)
    {
        $estate = Real::findOrFail($estateId);
        $loggedInUser = Auth::user();
        $transactionType = $estate->status; // Use the status directly as the transaction type
        $price = $estate->price; // Use the price directly from the Real model

        // Store the transaction details before deleting the estate
        EstateTransaction::create([
            'real_id' => $estate->id,
            'user_id' => $loggedInUser->id,
            'transaction_type' => $transactionType,
            'price' => $price,
            'details' => 'Estate was ' . strtolower($transactionType),
        ]);

        // Determine the action to be taken based on the status
        if ($transactionType == 'Sale') {
            // Delete the estate if the status is 'Sale'
            $estate->delete();
            $message = 'The estate has been successfully deleted.';
        } elseif ($transactionType == 'Rent') {
            // Unpublish the estate if the status is 'Rent'
            $estate->pay = 0; // Assuming 'pay' indicates publication status, where 0 = unpublished
            $estate->save();
            $message = 'The estate has been successfully unpublished.';
        }

        // Send an email notification to the logged-in user
        Mail::to($loggedInUser->email)->send(new AcceptEstate($estate->user, $loggedInUser, $estateId));

        return view('greate');
    }

}
