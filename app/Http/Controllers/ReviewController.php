<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Real;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'review' => 'required|string|max:500',
        ]);

        $real = Real::findOrFail($id);
        $real->reviews()->create([
            'user_id' => Auth::id(),
            'review' => $request->review,
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }

    public function update(Request $request, $realId, $reviewId)
    {
        $request->validate([
            'review' => 'required|string|max:500',
        ]);

        $review = Review::where('id', $reviewId)
            ->where('user_id', Auth::id())
            ->where('real_id', $realId)
            ->firstOrFail();

        $review->update([
            'review' => $request->review,
        ]);

        return redirect()->back()->with('success', 'Review updated successfully.');
    }

    public function destroy($realId, $reviewId)
    {
        $review = Review::where('id', $reviewId)
            ->where('user_id', Auth::id())
            ->where('real_id', $realId)
            ->firstOrFail();

        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}
