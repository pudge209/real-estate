<?php

namespace App\Http\Controllers;

use App\Models\Real;
use App\Models\Office;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Get the dashboard statistics.
     */
    public function dashboard()
    {
        // Existing statistics
        $totalCreated = Real::count();
        $totalPublished = Real::where('pay', 1)->count();
        $totalNotPublished = Real::where('pay', 0)->count();
        $totalOffices = Office::count();

        // New statistics
        $totalAmount = Real::where('pay', 1)->sum('price') * 0.01;

        // Aggregate rating and review data
        $averageRating = Rating::count('rating');
        $totalReviews = Review::count();

        return view('admin.dashboard', compact(
            'totalCreated',
            'totalPublished',
            'totalNotPublished',
            'totalOffices',
            'totalAmount',
            'averageRating',
            'totalReviews'
        ));
    }
}
