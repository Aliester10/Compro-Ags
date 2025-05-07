<?php

namespace App\Http\Controllers\Distribution\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Quotation;

class DistributionController extends Controller
{
    // Halaman utama portal distributor
    public function index()
    {
        return view('Distributor.Portal.portal'); // Pastikan view ini ada di resources/views/Distributor/portal/portal.blade.php
    }

    // Menampilkan halaman untuk memilih produk dan meminta quotation
   
   
    public function requestQuotation(Request $request)
    {
        // Ambil ID pengguna yang sedang login
        $userId = auth()->id();
    
        // Ambil keyword pencarian dari input pengguna
        $keyword = $request->input('search');
    
        // Query quotations dengan filter user_id, pencarian, dan pagination
        $quotations = Quotation::with(['quotationProducts', 'negotiation']) // Tambahkan relasi 'negotiation'
        ->where('user_id', $userId)
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nomor_pengajuan', 'like', "%{$keyword}%")
                    ->orWhere('status', 'like', "%{$keyword}%");
            })
            ->paginate(10); // Menampilkan 10 item per halaman
    
        // Perbarui status jika diperlukan
        foreach ($quotations as $quotation) {
            if ($quotation->pdf_path && $quotation->status === 'pe  nding') {
                $quotation->update(['status' => 'quotation']);
            }
        }
    
        // Kirim data quotations ke view
        return view('Distributor.Portal.request-quotation', compact('quotations', 'keyword'));
    }
    
    
    // Menampilkan halaman untuk membuat dan mengirim Purchase Order (PO)
    public function createPO()
    {
        return view('Distributor.portal.create-po'); // Pastikan view ini ada
    }

    // Menampilkan halaman untuk melihat dan mengelola invoice
    public function invoices()
    {
        return view('Distributor.portal.invoices'); // Pastikan view ini ada
    }
}
