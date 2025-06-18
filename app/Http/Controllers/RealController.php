<?php

namespace App\Http\Controllers;

use App\Models\Real;
use App\Models\RealImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreRealRequest;
use App\Http\Requests\UpdateRealRequest;
use Illuminate\Support\Facades\Storage;

class RealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function publish()
    {
        $real = Real::all();
        return view('real.publish', compact('real'));
    }

    public function index()
    {
        $userId = Auth::id();
        $real = Real::where('user_id', $userId)->get();
        return view('real.index', compact('real'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('real.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRealRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = uniqid() . "." . $image->extension(); // Generate a unique file name
            $image->storeAs('real-image/', $fileName, 'public');
            $validated['image'] = $fileName;
        }

        $validated['user_id'] = Auth::id();
        $real = Real::create($validated);

        if ($request->hasFile('real_image')) {
            foreach ($request->file('real_image') as $real_image) {
                $real_imageName = uniqid() . "." . $real_image->extension(); // Generate a unique file name
                $real_image->storeAs('real-image/', $real_imageName, 'public');
                RealImage::create([
                    'real_id' => $real->id,
                    'real_image' => $real_imageName
                ]);
            }
        }

        switch ($request->real_type) {
            case 1:
                $request->validate([
                    'rooms' => 'nullable|numeric|min:0|max:999999.99',
                    'bedrooms' => 'nullable|numeric|min:0|max:999999.99',
                    'bathrooms' => 'nullable|numeric|min:0|max:999999.99',
                    'garage' => 'nullable|numeric|min:0|max:999999.99',
                ]);
                $real->house()->create([
                    'rooms' => $request->rooms,
                    'bedrooms' => $request->bedrooms,
                    'bathrooms' => $request->bathrooms,
                    'garage' => $request->garage,
                ]);
                break;
            case 2:
                $request->validate([
                    'commercial_kind' => 'nullable|string|max:75',
                    'parking_spot' => 'nullable|numeric|max:75',
                ]);
                $real->commercial()->create([
                    'commercial_kind' => $request->commercial_kind,
                    'parking_spot' => $request->parking_spot,
                ]);
                break;
            case 3:
                $request->validate([
                    'type_of_use' => 'nullable|string|max:75',
                ]);
                $real->other()->create([
                    'type_of_use' => $request->type_of_use,
                ]);
                break;
        }

        return redirect()->route('real.index')->with('success', 'Real estate added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Real $real)
    {
        // Load the ratings with the Real model
        $ratings = $real->ratings;

        // Calculate the average rating
        $averageRating = $ratings->avg('rating');

        // Get the rating by the current user, if logged in
        $userRating = Auth::check() ? $ratings->where('user_id', Auth::id())->first() : null;

        return view('real.show', [
            'real' => $real,
            'averageRating' => $averageRating,
            'userRating' => $userRating ? $userRating->rating : null
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Real $real)
    {
        return view('real.edit', compact('real'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRealRequest $request, Real $real)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Delete previous file (extension may differ)
            if ($real->image) {
                Storage::disk('public')->delete('real-image/' . $real->image);
            }

            $image = $request->file('image');
            $fileName = $real->id . "." . $image->extension();
            $image->storeAs('real-image/', $fileName, 'public');
            $validated['image'] = $fileName;
        }

        switch ($validated['real_type']) {
            case 1: // Residential
                $request->validate([
                    'rooms' => 'nullable|numeric|min:0|max:999999.99',
                    'bedrooms' => 'nullable|numeric|min:0|max:999999.99',
                    'bathrooms' => 'nullable|numeric|min:0|max:999999.99',
                    'garage' => 'nullable|numeric|min:0|max:999999.99',
                ]);
                $real->house()->updateOrCreate([], [
                    'rooms' => $request->rooms,
                    'bedrooms' => $request->bedrooms,
                    'bathrooms' => $request->bathrooms,
                    'garage' => $request->garage,
                ]);
                break;
            case 2: // Commercial
                $request->validate([
                    'commercial_kind' => 'nullable|string|max:75',
                    'parking_spot' => 'nullable|numeric|max:75',
                ]);
                $real->commercial()->updateOrCreate([], [
                    'commercial_kind' => $request->commercial_kind,
                    'parking_spot' => $request->parking_spot,
                ]);
                break;
            case 3: // Other
                $request->validate([
                    'type_of_use' => 'nullable|string|max:75',
                ]);
                $real->other()->updateOrCreate([], [
                    'type_of_use' => $request->type_of_use,
                ]);
                break;
        }

        $real->update($validated);
        return redirect()->route('real.index')->with('success', 'Real estate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Real $real)
    {
        $real->delete();
        return back()->with('error', 'Real estate deleted successfully.');
    }

    public function handlePay(Request $request, Real $real)
    {
        if ($request->isMethod('patch')) {
            $request->validate([
                'pay' => 'required|boolean',
            ]);

            $real->pay = $request->pay;
            $real->save();

            return redirect()->route('real.index')->with('success', 'Real estate updated successfully!');
        }
    }
}
