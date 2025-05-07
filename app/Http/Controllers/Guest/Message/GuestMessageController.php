<?php

namespace App\Http\Controllers\Guest\Message;

use App\Http\Controllers\Controller;
use App\Models\GuestMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuestMessageController extends Controller
{
    public function store(Request $request)
{
    // Ambil alamat IP pengunjung
    $ipAddress = $request->ip();

    // Validasi data yang dikirim dari form
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'perusahaan' => 'nullable|string|max:255',
        'no_wa' => 'required|string|min:10|max:12',
        'pesan' => 'required|string',
    ]);

    // Periksa apakah IP yang sama sudah mengirim pesan dalam 12 jam terakhir
    $existingMessage = GuestMessage::where('ip_address', $ipAddress)
        ->where('created_at', '>=', now()->subHours(12)) // Membatasi waktu 12 jam
        ->first();

    if ($existingMessage) {
        // Hitung sisa waktu hingga pengguna bisa mengirim pesan lagi
        $timeRemaining = now()->diffInMinutes($existingMessage->created_at->addHours(12));

        // Konversi menit ke jam dan menit
        $hoursRemaining = floor($timeRemaining / 60);
        $minutesRemaining = $timeRemaining % 60;

        // Buat pesan error dengan waktu sisa
        return redirect()->back()->withErrors([
            'error' => "Anda hanya dapat mengirim satu pesan setiap 12 jam. Silakan coba lagi dalam $hoursRemaining jam $minutesRemaining menit."
        ]);
    }

    // Simpan data ke database, termasuk alamat IP
    GuestMessage::create([
        'nama' => $request->input('nama'),
        'email' => $request->input('email'),
        'perusahaan' => $request->input('perusahaan'),
        'no_wa' => $request->input('no_wa'),
        'pesan' => $request->input('pesan'),
        'ip_address' => $ipAddress, // Simpan IP address
    ]);

    // Redirect kembali ke halaman dengan pesan sukses
    return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim.');
}




    public function index()
    {
        // Ambil semua pesan dari database
        $messages = GuestMessage::all();

        // Return ke view admin
        return view('Admin.Guest.index', compact('messages'));
    }

}
