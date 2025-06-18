<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Real;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PublishedController extends Controller
    {
        public function published(){
            $userId = Auth::id();

            $real = Real::where('pay', 1)->where('user_id', $userId)->get();

            return view('real.card', compact('real'));
        }
        public function publish()
        {
            $userId = Auth::id();

            $real = Real::where('pay', 1)->where('user_id', $userId)->get();

            return view('real.publish', compact('real'));
        }

        public function display()
        {
            $real = Real::where('pay', 1)->get();

            return view('welcome', compact('real'));
        }


        public function displayDashboard()
        {
            $userRole = Auth::user()->role;
            $real = Real::where('pay', 1)->get(); // Define $real here

            switch ($userRole) {
                case 1:
                    $view = 'admin.dashboard';
                    break;
                case 2:
                    $view = 'client.dashboard';
                    break;
                case 3:
                    $view = 'dashboard';
                    break;
                case 4:
                    $view = 'vendor.dashboard';
                    break;
                default:
                    abort(403, 'Unauthorized action.');
            }


            return view($view, compact('real'));
        }

        public function search(Request $request)
        {
            $city = $request->input('search');

            $reals = Real::where('city', 'like', '%' . $city . '%')->where('pay', 1)->get();

            return view('search-results', compact('reals', 'city'));
        }


public function handlePay(Request $request, Real $real)
{
    // Calculate the payment fee (e.g., 1% of the price)
    $fee = $real->price * 0.01;

    // Update the real estate record with the new pay status
    $real->pay = $request->input('pay');
    $real->save();

    // Recalculate the total amount collected
    $totalAmount = Real::where('pay', 1)->sum('price') * 0.01;

    // Redirect with success message and total amount
    return redirect()->route('real.index')->with([
        'success' => $request->input('pay') == 1 ? 'Real estate published successfully.' : 'Real estate unpublished successfully.',
        'totalAmount' => $totalAmount
    ]);
}
    }
