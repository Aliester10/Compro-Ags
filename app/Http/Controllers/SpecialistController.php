<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SpecialistContactMail;

class SpecialistController extends Controller
{
    public function message(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Kirim email tanpa menyimpan ke database
            Mail::to('fabertjodymanuel@gmail.com') // Ganti dengan alamat email spesialis produk
                ->send(new SpecialistContactMail($validated));
                
            return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim! Spesialis produk kami akan segera menghubungi Anda.');
        } catch (\Exception $e) {
            // Log error jika diperlukan
            \Log::error('Error sending email: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Maaf, terjadi kesalahan saat mengirim pesan Anda. Silakan coba lagi nanti: ' . $e->getMessage())
                ->withInput();
        }
    }
}