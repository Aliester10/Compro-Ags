<?php

namespace App\Http\Controllers\Member\Location;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationMemberController extends Controller
{
    public function index()
{
    // Fetch only locations with users
    $locations = Location::has('users')->with('users')->get();  // Make sure it only fetches locations that have users

    $data = $locations->map(function ($location) {
        $userData = $location->users->map(function ($user) {
            return [
                'nama_perusahaan' => $user->nama_perusahaan,
                'created_at' => $user->created_at->format('d-m-Y')
            ];
        });

        return [
            'latitude' => $location->latitude,
            'longitude' => $location->longitude,
            'province' => $location->province,
            'user_count' => $location->users->count(),
            'user_data' => $userData
        ];
    });

    return response()->json($data);
}

    
    
    
    
}
