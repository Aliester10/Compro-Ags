<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EndUserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.enduser_register'); // Sesuaikan dengan nama file blade kamu
    }

    public function register(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            // tambahkan field lain jika perlu
        ]);

        // Buat user baru (disarankan menggunakan model User atau EndUser sesuai strukturmu)
        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'enduser', // atau sesuaikan dengan struktur rolenya
        ]);

        // Redirect ke halaman tunggu atau dashboard
        return redirect()->route('enduser.waiting', ['id' => $user->id]);
    }

    public function showWaitingPage($id = null)
    {
        // Jika kamu ingin menampilkan informasi berdasarkan ID
        return view('auth.enduser_waiting', compact('id'));
    }
}
