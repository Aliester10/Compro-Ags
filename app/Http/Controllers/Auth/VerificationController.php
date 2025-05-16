<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class VerificationController extends Controller
{
    public function verifyDistributor($id, $token)
    {
        // Tambahkan log untuk debugging
        Log::info('Verifikasi distributor dipanggil untuk ID: ' . $id . ' dengan token: ' . $token);
        
        // Cari user berdasarkan ID dan token
        $user = User::where('id', $id)
                    ->where('verification_token', $token)
                    ->first();
        
        if (!$user) {
            Log::error('User tidak ditemukan atau token tidak valid. ID: ' . $id . ', Token: ' . $token);
            return redirect()->route('home')->with('error', 'Link verifikasi tidak valid.');
        }
        
        // Update status verified menjadi 1 (angka, bukan boolean)
        $user->verified = 1;
        $user->verification_token = null; // Hapus token
        $user->save();
        
        Log::info('User berhasil diverifikasi: ' . $user->name);
        
        // Kirim email notifikasi ke distributor
        try {
            $mail_data = [
                'recipient' => $user->email,
                'subject' => 'Pendaftaran Distributor Anda Telah Disetujui',
                'name' => $user->name,
                'companyName' => $user->nama_perusahaan,
                'loginUrl' => url('/login'),
            ];
            
            Mail::send('auth.approved-email-template', $mail_data, function($message) use ($mail_data) {
                $message->to($mail_data['recipient'])
                        ->subject($mail_data['subject']);
            });
            
            Log::info('Email persetujuan berhasil dikirim ke: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email persetujuan: ' . $e->getMessage());
        }
        
        return view('auth.verification_success');
    }
    
    public function rejectDistributor($id, $token)
    {
        // Tambahkan log untuk debugging
        Log::info('Penolakan distributor dipanggil untuk ID: ' . $id . ' dengan token: ' . $token);
        
        // Cari user berdasarkan ID dan token
        $user = User::where('id', $id)
                    ->where('verification_token', $token)
                    ->first();
        
        if (!$user) {
            Log::error('User tidak ditemukan atau token tidak valid. ID: ' . $id . ', Token: ' . $token);
            return redirect()->route('home')->with('error', 'Link penolakan tidak valid.');
        }
        
        // Kirim email notifikasi penolakan
        try {
            $mail_data = [
                'recipient' => $user->email,
                'subject' => 'Pendaftaran Distributor Anda Ditolak',
                'name' => $user->name,
                'companyName' => $user->nama_perusahaan,
                'contactEmail' => 'support@example.com',
            ];
            
            Mail::send('auth.rejected-email-template', $mail_data, function($message) use ($mail_data) {
                $message->to($mail_data['recipient'])
                        ->subject($mail_data['subject']);
            });
            
            Log::info('Email penolakan berhasil dikirim ke: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email penolakan: ' . $e->getMessage());
        }
        
        // Tandai sebagai ditolak dan hapus token
        $user->verified = 0;
        $user->status = 'rejected';
        $user->verification_token = null;
        $user->save();
        
        Log::info('Pendaftaran user berhasil ditolak: ' . $user->name);
        
        return view('auth.rejection_success');
    }
}