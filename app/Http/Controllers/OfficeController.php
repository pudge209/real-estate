<?php

namespace App\Http\Controllers;

use App\Models\Real;
use App\Models\Office;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;
use Illuminate\Http\Request;


class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $offices = Office::where('user_id', $userId)->get();
        return view('office.index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('office.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfficeRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = uniqid() . '.' . $image->extension(); // Generate a unique file name
            $image->storeAs('office-image/', $fileName, 'public');
            $validated['image'] = $fileName;
        }

        $validated['user_id'] = Auth::id();
        Office::create($validated);

        return redirect()->route('office.index')->with('success', 'Office added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {

        return view('office.show', compact('office'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        return view('office.edit', compact('office'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfficeRequest $request, Office $office)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($office->image) {
                Storage::disk('public')->delete('office-image/' . $office->image);
            }

            $image = $request->file('image');
            $fileName = uniqid() . '.' . $image->extension(); // Generate a unique file name
            $image->storeAs('office-image/', $fileName, 'public');
            $validated['image'] = $fileName;
        }

        $office->update($validated);

        return redirect()->route('office.index')->with('success', 'Office updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        // Delete the image if it exists
        if ($office->image) {
            Storage::disk('public')->delete('office-image/' . $office->image);
        }

        $office->delete();

        return redirect()->route('office.index')->with('success', 'Office deleted successfully.');
    }
    public function mo(Request $request, $officeId)
    {
        // Fetch the office by ID
        $office = Office::findOrFail($officeId);

        // Fetch real estate offers related to this office's user
        $reals = Real::where('user_id', $office->user_id)
                     ->where('pay', 1)
                     ->get();

        // Pass the office and reals to the view
        return view('mo', compact('reals', 'office'));
    }


    public function list()
    {
        $offices = Office::all();
        return view('office.list', compact('offices'));
    }



public function officeStats()
{
    $totalOffices = Office::count();

    $officesWithHouseCount = Office::select('offices.id', 'offices.office_name')
        ->leftJoin('reals', 'offices.user_id', '=', 'reals.user_id') // Assuming the indirect relation through user_id
        ->selectRaw('offices.id, offices.office_name, COUNT(reals.id) as house_count')
        ->groupBy('offices.id', 'offices.office_name')
        ->get();

    return view('admin.offices', compact('totalOffices', 'officesWithHouseCount'));
}

/**
 * Show houses related to the specified office.
 */
public function viewHouses($id)
{
    $office = Office::findOrFail($id);
    $houses = Real::where('user_id', $office->user_id)->get(); // Fetch houses related to the office's user

    return view('admin.view-houses', compact('office', 'houses'));
}

/**
 * Remove the specified office from storage.
 */
public function destroys($id)
{
    $office = Office::findOrFail($id);

    // Delete the image if it exists
    if ($office->image) {
        Storage::disk('public')->delete('office-image/' . $office->image);
    }

    $office->delete();

    return redirect()->route('admin.offices')->with('success', 'Office deleted successfully.');
}

public function showHouses(Office $office)
{
    // Fetch houses associated with the office
    $houses = Real::where('user_id', $office->user_id)->get();
    return view('admin.offices.houses', compact('houses', 'office'));
}

public function destroyHouse(Office $office, Real $house)
{
    // Delete the house
    $house->delete();

    return redirect()->route('admin.offices.viewHouses', $office->id)->with('success', 'House deleted successfully.');
}
}
