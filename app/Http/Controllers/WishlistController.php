<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Real;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', auth()->id())->pluck('real_id')->toArray();
        $real = Real::whereIn('id', $wishlist)->get();

        return view('Wishlist', compact('real', 'wishlist'));
    }
    public function add($real_id)
    {
        $exists = Wishlist::where('user_id', Auth::id())->where('real_id', $real_id)->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'real_id' => $real_id,
            ]);
        }

        return back()->with('success', 'Added to wishlist!');
    }

    public function remove($real_id)
    {
        Wishlist::where('user_id', Auth::id())->where('real_id', $real_id)->delete();

        return back()->with('success', 'Removed from wishlist!');
    }

    public function destroy($real_id)
    {
        Wishlist::where('user_id', Auth::id())
            ->where('real_id', $real_id)
            ->delete();

        return back()->with('success', 'Removed from wishlist!');
    }
}
