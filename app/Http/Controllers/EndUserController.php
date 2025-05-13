<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Use the User model instead of EndUser
use Illuminate\Support\Facades\Hash;

class EndUserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.enduser_register');
    }

    public function register(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'institution_name' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255', // Check 'users' table
            'mobile_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validated['institution_name'], // Map to name field
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'no_telp' => $validated['mobile_number'], // Map to no_telp
            'alamat' => $validated['address'], // Map to alamat
            'nama_perusahaan' => $validated['institution_name'], // Map to nama_perusahaan
            'type' => 0, // Default user type
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Registration successful! Your account has been created.');
    }

    public function showWaitingPage($id = null)
    {
        return view('auth.enduser_waiting', compact('id'));
    }
}