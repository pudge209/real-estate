<?php

// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Sending the email to sariarabah1995@gmail.com
        Mail::send('email.contact', [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'userMessage' => $request->message,  // Renamed variable
        ], function ($mail) use ($request) {
            $mail->to('sariarabah1995@gmail.com') // Target email address
                ->from($request->email, $request->name)
                ->subject($request->subject);
        });

        return redirect()->route('contact.form')->with('success', 'Your message has been sent successfully!');
    }
}
