<?php
namespace App\Http\Controllers;

use App\Models\Real;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class RatingController extends Controller
{


    // Other methods (store, destroy) if applicable


    // Store and destroy methods remain unchanged



    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
        ]);

        $real = Real::findOrFail($id);
        $real->ratings()->updateOrCreate(
            ['user_id' => Auth::id()],
            ['rating' => $request->rating]
        );

        return redirect()->route('real.show', $id)->with('success', 'Rating submitted successfully.');
    }

    public function destroy($id)
    {
        $real = Real::findOrFail($id);
        $real->ratings()->where('user_id', Auth::id())->delete();

        return redirect()->route('real.show', $id)->with('success', 'Rating deleted successfully.');
    }
}
