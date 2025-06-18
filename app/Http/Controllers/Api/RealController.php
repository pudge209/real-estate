<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Real;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRealRequest;
use App\Http\Requests\UpdateRealRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $real = Real::all();
        return response()->json($real);
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

        return response()->json(['message' => 'Real estate added successfully.', 'data' => $real], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Real $real)
    {
        return response()->json($real);
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

            // Save new image on disk
            $image->storeAs('real-image/', $fileName, 'public');

            // Update its name in validated data
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

        $real->update($validated); // Mass assignment

        return response()->json(['message' => 'Real estate updated successfully.', 'data' => $real]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Real $real)
    {
        Storage::disk('public')->delete('real-image/' . $real->image);
        $real->delete();

        return response()->json(['message' => 'Real estate deleted successfully.']);
    }

    /**
     * Handle payment for the specified resource.
     */
    public function handlePay(Request $request, Real $real)
    {
        if ($request->isMethod('patch')) {
            $request->validate([
                'pay' => 'required|boolean',
            ]);

            $real->pay = $request->pay;
            $real->save();

            return response()->json(['message' => 'Real estate payment status updated successfully!', 'data' => $real]);
        }

        return response()->json(['message' => 'Method not supported'], 405);
    }
}
