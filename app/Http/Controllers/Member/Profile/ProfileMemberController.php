<?php

namespace App\Http\Controllers\Member\Profile;

use App\Http\Controllers\Controller;
use App\Models\BidangPerusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileMemberController extends Controller
{
    public function show()
    {
        $user = User::findOrFail(Auth::id());  // Get the logged-in user by ID
        $bidangPerusahaan = BidangPerusahaan::all();

        // Ensure the user is a member (type 0)
        return view('Member.profile.show', compact('user','bidangPerusahaan'));  // Pass the user data to the view
    }

    public function edit()
    {
        $user = User::findOrFail(Auth::id());  // Get the logged-in user by ID

        $bidangPerusahaan = BidangPerusahaan::all();

        // Ensure the user is a member (type 0)

        return view('Member.profile.edit', compact('user','bidangPerusahaan'));  // Pass the user data to the view
    }

    /**
     * Update the profile.
     */
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());  // Get the authenticated user by ID

        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'nullable|string|max:10',
            'no_telp' => 'nullable|string|max:15',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'date_of_birth' => 'nullable|date',
        ]);

        // Update user attributes and save the user
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');  // Added gender update
        $user->nama_perusahaan = $request->input('nama_perusahaan');
        $user->bidang_id = $request->input('bidang_perusahaan');  // Use bidang_id instead of bidang_perusahaan
        $user->no_telp = $request->input('no_telp');
        $user->alamat = $request->input('alamat');
        $user->date_of_birth = $request->input('date_of_birth');  // Added date_of_birth update

        $user->save();  // Save the changes

        // Redirect back with a success message
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}