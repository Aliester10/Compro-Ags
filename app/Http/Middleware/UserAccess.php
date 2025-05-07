<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType)
    {
        if (auth()->check() && auth()->user()->type == $userType) {
            return $next($request);
        }

        // Tambahkan pesan yang disesuaikan untuk setiap role
        $message = match ($userType) {
            'admin' => 'Halaman ini hanya dapat diakses oleh Admin. Silakan hubungi admin untuk pendaftaran.',
            'member' => 'Halaman ini hanya dapat diakses oleh Member. Jika Anda belum menjadi member, silakan daftar melalui admin.',
            'distributor' => 'Halaman ini hanya dapat diakses oleh Distributor. Silakan lakukan registrasi sebagai distributor.',
            default => 'Anda tidak memiliki izin untuk mengakses halaman ini.',
        };

        return redirect()->back()->with('error', $message);
    }
}
