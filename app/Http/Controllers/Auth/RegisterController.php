<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    public function showDistributorRegistrationForm()
    {
        return view('auth.distributor_register');
    }

    public function registerDistributor(Request $request)
    {
        // Validate the request fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'pic' => 'required|string|max:255',
            'nomor_telp_pic' => 'required|string|max:15',
            'akta' => 'required|file|mimes:pdf,jpg,png',
            'nib' => 'required|file|mimes:pdf,jpg,png',
        ]);
    
        // Custom filename for 'akta' document
        if ($request->hasFile('akta')) {
            $aktaFile = $request->file('akta');
            $aktaFilename = time() . '_' . Str::slug(pathinfo($aktaFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $aktaFile->getClientOriginalExtension();
            $aktaPath = $aktaFile->move(public_path('akta_documents'), $aktaFilename);
        }
    
        // Custom filename for 'nib' document
        if ($request->hasFile('nib')) {
            $nibFile = $request->file('nib');
            $nibFilename = time() . '_' . Str::slug(pathinfo($nibFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $nibFile->getClientOriginalExtension();
            $nibPath = $nibFile->move(public_path('nib_documents'), $nibFilename);
        }
    
        // Store the paths relative to the public directory
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'nama_perusahaan' => $request->nama_perusahaan,
            'type' => 2, // Distributor type
            'pic' => $request->pic,
            'nomor_telp_pic' => $request->nomor_telp_pic,
            'akta' => 'akta_documents/' . $aktaFilename,
            'nib' => 'nib_documents/' . $nibFilename,
            'verified' => false, // Set to false initially
        ]);
    
        return redirect()->route('distributors.waiting')->with('success', 'Registration successful. Please wait for admin approval.');
    }
}

