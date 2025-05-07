<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('Admin.Location.index', compact('locations'));
    }

    public function create()
    {
        return view('Admin.Location.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'province' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        Location::create($request->all());

        return redirect()->route('admin.location.index')->with('success', 'Location added successfully.');
    }

    public function edit(Location $location)
    {
        return view('Admin.Location.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'province' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $location->update($request->all());

        return redirect()->route('admin.location.index')->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('admin.location.index')->with('success', 'Location deleted successfully.');
    }

    public function show(Location $location)
    {
        return view('Admin.Location.show', compact('location'));
    }
}
