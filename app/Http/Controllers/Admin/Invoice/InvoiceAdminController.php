<?php

namespace App\Http\Controllers\Admin\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\ProformaInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class InvoiceAdminController extends Controller
{
    public function show($id)
{
    $invoice = Invoice::with('proformaInvoice.purchaseOrder')->findOrFail($id);
    return view('Admin.Invoice.show', compact('invoice'));
}

public function index(Request $request)
{
    // Ambil keyword pencarian dari input pengguna
    $keyword = $request->input('search');

    // Query Invoices dengan pencarian dan pagination
    $invoices = Invoice::with('proformaInvoice')
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('invoice_number', 'like', "%{$keyword}%")
                ->orWhere('status', 'like', "%{$keyword}%")
                ->orWhere('grand_total_include_ppn', 'like', "%{$keyword}%");
        })
        ->paginate(10); // Menampilkan 10 item per halaman

    return view('Admin.Invoice.index', compact('invoices', 'keyword'));
}


public function create($proformaInvoiceId, Request $request)
{
    $proformaInvoice = ProformaInvoice::with('purchaseOrder.quotation')->findOrFail($proformaInvoiceId);

    $subtotal = $proformaInvoice->subtotal;
    $ppn = $proformaInvoice->ppn;

    // Ambil tipe dari query parameter
    $type = $request->query('type', 'dp'); // Default ke DP jika tidak ada type
    $percentage = 0;

    if ($type === 'dp') {
        // Hitung persentase DP
        $percentage = round(($proformaInvoice->dp / $proformaInvoice->grand_total_include_ppn) * 100, 2);
    } elseif ($type === 'next_payment') {
        // Hitung persentase Next Payment
        $percentage = round(($proformaInvoice->next_payment_amount / $proformaInvoice->purchaseOrder->quotation->subtotal_price) * 100, 2);
    }


    $subtotal = $proformaInvoice->subtotal;
    $adjustedSubtotal = ($subtotal * $percentage) / 100;
    $ppnAmount = $adjustedSubtotal * ($proformaInvoice->ppn / 100);
    $grandTotalIncludePPN = $adjustedSubtotal + $ppnAmount;

    $user = $proformaInvoice->purchaseOrder->user;

    return view('Admin.Invoice.create', compact('proformaInvoice', 'subtotal', 'ppn', 'grandTotalIncludePPN', 'user', 'percentage', 'type'));
}






    

    public function store(Request $request, $proformaInvoiceId)
{
    // Validasi input
    $request->validate([
        'vendor_name' => 'required|string',
        'vendor_address' => 'required|string',
        'vendor_phone' => 'required|string',
        'type' => 'required|in:dp,next_payment', // Pastikan type valid


    ]);

    // Ambil Proforma Invoice terkait
    $proformaInvoice = ProformaInvoice::with('purchaseOrder.user')->findOrFail($proformaInvoiceId);
    // Dapatkan nama perusahaan dan buat singkatan nama
    $namaPerusahaan = $proformaInvoice->purchaseOrder->user->nama_perusahaan ?? 'Perusahaan';
    $singkatanNamaPerusahaan = strtoupper(implode('', array_filter(array_map(function ($kata) {
        return $kata !== 'PT' ? $kata[0] : ''; // Hindari "PT" dari singkatan
    }, explode(' ', $namaPerusahaan)))));

    // Konversi tanggal menjadi Romawi dan ambil tahun
    $tanggalRomawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII', 'XIII', 'XIV', 'XV', 'XVI', 'XVII', 'XVIII', 'XIX', 'XX', 'XXI', 'XXII', 'XXIII', 'XXIV', 'XXV', 'XXVI', 'XXVII', 'XXVIII', 'XXIX', 'XXX', 'XXXI'];
    $hariIni = \Carbon\Carbon::now();
    $dayRoman = $tanggalRomawi[$hariIni->day - 1];
    $tahun = $hariIni->year;
  // Tentukan nomor invoice otomatis
  $lastInvoice = Invoice::orderBy('id', 'desc')->first();
  $nextInvoiceNumber = str_pad($lastInvoice ? $lastInvoice->id + 1 : 1, 3, '0', STR_PAD_LEFT);

    // Format nomor PO dan nomor Invoice
    $poNumberFormatted = sprintf("%s/SPO/%s/%s/%s", $proformaInvoice->purchaseOrder->po_number, $singkatanNamaPerusahaan, $dayRoman, $tahun);
    $piNumberFormatted = sprintf("%s/INV-AGS-%s/%s/%s",  $nextInvoiceNumber, $singkatanNamaPerusahaan, $dayRoman, $tahun);
    // Ambil tipe dari input form
    $type = $request->input('type');
    $percentage = 0;
    $adjustedSubtotal = 0;

    // Logika berdasarkan tipe invoice
    if ($type === 'dp') {
        // Logika untuk Down Payment
        $percentage = round(($proformaInvoice->dp / $proformaInvoice->grand_total_include_ppn) * 100, 2);
        $adjustedSubtotal = $proformaInvoice->dp;
        $proformaInvoice->dp_invoice_created = true; // Tandai invoice DP telah dibuat
    } elseif ($type === 'next_payment') {
        // Logika untuk Next Payment
        $percentage = round(($proformaInvoice->next_payment_amount / $proformaInvoice->purchaseOrder->quotation->subtotal_price) * 100, 2);
        $adjustedSubtotal = $proformaInvoice->next_payment_amount;
    } else {
        throw new \Exception("Invalid invoice type.");
    }

    // Hitung PPN dan Grand Total
    $ppnAmount = $adjustedSubtotal * ($proformaInvoice->ppn / 100);
    $grandTotalIncludePPN = $adjustedSubtotal + $ppnAmount;

    // Simpan data invoice
    $invoice = Invoice::create([
        'proforma_invoice_id' => $proformaInvoice->id,
        'invoice_number' => $nextInvoiceNumber,
        'invoice_date' => \Carbon\Carbon::now()->format('Y-m-d'),
        'percentage' => $percentage,
        'subtotal' => $adjustedSubtotal,
        'ppn' => $proformaInvoice->ppn,
        'grand_total_include_ppn' => $grandTotalIncludePPN,
        'type' => $type, // Simpan tipe invoice
    ]);

    // Simpan perubahan pada Proforma Invoice
    $proformaInvoice->save();

    // Generate PDF dengan data invoice yang baru saja dibuat
    $pdf = PDF::loadView('Admin.Invoice.pdf', [
        'invoice' => $invoice,
        'proformaInvoice' => $proformaInvoice,
        'vendor_name' => $request->vendor_name,
        'vendor_address' => $request->vendor_address,
        'vendor_phone' => $request->vendor_phone,
        'poNumberFormatted' => $poNumberFormatted,  // Kirim format nomor PO ke view
        'piNumberFormatted' => $piNumberFormatted,  // Kirim format nomor Invoice ke view
    ]);

    // Buat nama file unik dan simpan PDF ke direktori publik
    $filename = time() . '_' . Str::slug('Invoice_' . $invoice->invoice_number) . '.pdf';
    $path = 'pdfs/invoices/' . $filename;

    // Pastikan direktori `pdfs/invoices` tersedia
    if (!File::exists(public_path('pdfs/invoices'))) {
        File::makeDirectory(public_path('pdfs/invoices'), 0755, true, true);
    }

    // Simpan PDF ke path yang ditentukan
    $pdf->save(public_path($path));

    // Update path file di record invoice
    $invoice->update(['file_path' => $path]);

    return redirect()->route('invoices.index')->with('success', 'Invoice created and PDF generated successfully.');
}


    

    
}
