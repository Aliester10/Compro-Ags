<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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
        
        // Generate verification token
        $verificationToken = Str::random(64);
    
        // Store the paths relative to the public directory
        $user = User::create([
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
            'verification_token' => $verificationToken, // Add this token to your users table
        ]);

        // Kirim email notifikasi ke admin
        try {
            $mail_data = [
                'recipient' => 'fabertjodymanuel@gmail.com', // Email admin
                'fromEmail' => config('mail.from.address'), // Gunakan email sistem bukan email user
                'fromName'  => config('mail.from.name'), // Gunakan nama sistem bukan nama user
                'replyTo' => $user->email,
                'subject'   => 'Pendaftaran Distributor Baru - ' . $user->nama_perusahaan,
                'companyName' => $user->nama_perusahaan,
                'pic' => $user->pic,
                'picPhone' => $user->nomor_telp_pic,
                'address' => $user->alamat,
                'userEmail' => $user->email,
                'userName' => $user->name,
                'body' => 'Distributor baru telah mendaftar. Silakan verifikasi.',
                'verifyLink' => url('/verify-distributor/' . $user->id . '/' . $verificationToken),
                'rejectLink' => url('/reject-distributor/' . $user->id . '/' . $verificationToken),
                'akta_path' => asset('akta_documents/' . $aktaFilename),
                'nib_path' => asset('nib_documents/' . $nibFilename)
            ];
            
            Mail::send('auth.email-template', $mail_data, function($message) use ($mail_data) {
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->replyTo($mail_data['replyTo'])
                        ->subject($mail_data['subject']);
            });
            
            return redirect()->route('distributors.waiting')->with('success', 'Registration successful. Please wait for admin approval.');
        } catch (\Exception $e) {
            // Log error jika email gagal terkirim
            \Log::error('Gagal mengirim email: ' . $e->getMessage());
            
            return redirect()->route('distributors.waiting')->with('success', 'Registration successful. Please wait for admin approval.');
        }
    }
}