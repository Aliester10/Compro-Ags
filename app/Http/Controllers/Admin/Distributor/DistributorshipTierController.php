<?php

namespace App\Http\Controllers\Admin\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DistributorshipTier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DistributorshipTierController extends Controller
{
    /**
     * Display a listing of the distributorship tiers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiers = DistributorshipTier::orderBy('tier_level', 'asc')->get();
        return view('Admin.Distributor.Tiers.index', compact('tiers'));
    }

    /**
     * Show the form for creating a new tier.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Distributor.Tiers.create');
    }

    /**
     * Store a newly created tier in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Add debug logging
        Log::info('DistributorshipTier store method called');
        Log::info('Request data:', $request->all());

        $validator = Validator::make($request->all(), [
            'tier_name' => 'required|string|max:100',
            'tier_level' => 'required|integer',
            'description' => 'nullable|string',
            'rights' => 'nullable|string',
            'obligations' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()->toArray()]);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $tier = new DistributorshipTier();
            $tier->tier_name = $request->tier_name;
            $tier->tier_level = $request->tier_level;
            $tier->description = $request->description;
            $tier->rights = $request->rights;
            $tier->obligations = $request->obligations;
            $tier->is_active = $request->has('is_active') ? 1 : 0;
            $tier->created_by = Auth::user()->name;
            $tier->save();

            Log::info('Tier created successfully', ['id' => $tier->id]);
            
            return redirect()->route('admin.distributor.tiers.index')
                    ->with('success', 'Tier created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating tier', ['error' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Failed to create tier: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified tier.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tier = DistributorshipTier::findOrFail($id);
        return view('Admin.Distributor.Tiers.show', compact('tier'));
    }

    /**
     * Show the form for editing the specified tier.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tier = DistributorshipTier::findOrFail($id);
        return view('Admin.Distributor.Tiers.edit', compact('tier'));
    }

    /**
     * Update the specified tier in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tier_name' => 'required|string|max:100',
            'tier_level' => 'required|integer',
            'description' => 'nullable|string',
            'rights' => 'nullable|string',
            'obligations' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $tier = DistributorshipTier::findOrFail($id);
            $tier->tier_name = $request->tier_name;
            $tier->tier_level = $request->tier_level;
            $tier->description = $request->description;
            $tier->rights = $request->rights;
            $tier->obligations = $request->obligations;
            $tier->is_active = $request->has('is_active') ? 1 : 0;
            $tier->updated_by = Auth::user()->name;
            $tier->save();

            return redirect()->route('admin.distributor.tiers.index')
                    ->with('success', 'Tier updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update tier: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified tier from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tier = DistributorshipTier::findOrFail($id);
            $tier->delete();
            return redirect()->route('admin.distributor.tiers.index')
                    ->with('success', 'Tier deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete tier: ' . $e->getMessage());
        }
    }
    
    /**
     * Toggle the active status of the tier.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleActive($id)
    {
        try {
            $tier = DistributorshipTier::findOrFail($id);
            $tier->is_active = !$tier->is_active;
            $tier->updated_by = Auth::user()->name;
            $tier->save();

            return redirect()->route('admin.distributor.tiers.index')
                    ->with('success', 'Tier status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update tier status: ' . $e->getMessage());
        }
    }
}