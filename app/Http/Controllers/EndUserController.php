<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Use the User model instead of EndUser
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Import Auth facade for login

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

        try {
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

            // Auto login user setelah registrasi berhasil
            Auth::login($user);

            // Redirect ke dashboard atau halaman home
            // Ganti 'home' dengan rute dashboard Anda yang sesuai (misalnya: 'dashboard', 'enduser.dashboard', dll)
            return redirect()->route('home')->with('success', 'Registration successful! You are now logged in.');
            
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan
            return redirect()->back()
                ->with('error', 'Registration failed: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function showWaitingPage($id = null)
    {
        return view('auth.enduser_waiting', compact('id'));
    }
}