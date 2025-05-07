<?php

namespace App\Http\Controllers\Distribution\Portal;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\QuotationProduct; // Tambahkan ini


class QuotationController extends Controller
{
    /**
     * Show the details of a specific quotation.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $quotation = Quotation::with('produk')->findOrFail($id);
     

          // Periksa apakah file PDF sudah tersedia dan status masih "Pending"
    if ($quotation->pdf_path && $quotation->status === 'pending') {
        // Perbarui status menjadi "Quotation"
        $quotation->update(['status' => 'quotation']);
    }
        
        return view('Distributor.Portal.show', compact('quotation'));
    }

    /**
     * Cancel a specific quotation.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel($id)
    {
        $quotation = Quotation::findOrFail($id);

        // Update the status to "canceled"
        $quotation->update(['status' => 'canceled']);

        return redirect()->route('distribution.request-quotation')->with('success', 'Permintaan quotation berhasil dibatalkan.');
    }
    public function cart()
{
    // Ambil data produk yang sudah ditambahkan ke keranjang (dari sesi)
    $cartItems = session()->get('quotation_cart', []);
    return view('Distributor.Portal.cart', compact('cartItems'));
}

public function addToCart(Request $request)
{
    $productId = $request->input('produk_id');
    $quantity = $request->input('quantity');

    // Ambil data produk
    $produk = Produk::find($productId);

    if ($produk) {
        // Ambil data keranjang dari sesi
        $cartItems = session()->get('quotation_cart', []);

        // Periksa apakah produk sudah ada di keranjang
        $found = false;
        foreach ($cartItems as &$item) {
            if ($item['produk_id'] == $productId) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        // Jika produk belum ada, tambahkan
        if (!$found) {
            $cartItems[] = [
                'produk_id' => $produk->id,
                'nama' => $produk->nama,
                'quantity' => $quantity,
            ];
        }

        session()->put('quotation_cart', $cartItems);

        // Respons JSON untuk permintaan AJAX
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan ke keranjang.']);
        }

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    if ($request->ajax()) {
        return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan.']);
    }

    return redirect()->route('product.index')->with('error', 'Produk tidak ditemukan.');
}


public function submitCart(Request $request)
{
    // Validasi input termasuk kolom topik
    $request->validate([
        'topik' => 'required|string|max:255', // Tambahkan validasi untuk kolom topik
    ]);

    // Ambil nilai topik dari input
    $topik = $request->input('topik');
    $cartItems = session()->get('quotation_cart', []);
    if (empty($cartItems)) {
        return redirect()->route('quotations.cart')->with('error', 'Keranjang kosong.');
    }

    // Konversi bulan ke angka Romawi
    $romanMonths = [
        1 => 'I',
        2 => 'II',
        3 => 'III',
        4 => 'IV',
        5 => 'V',
        6 => 'VI',
        7 => 'VII',
        8 => 'VIII',
        9 => 'IX',
        10 => 'X',
        11 => 'XI',
        12 => 'XII',
    ];
    
    $currentMonthNumeric = now()->format('n'); // Ambil angka bulan (1-12)
    $currentMonthRoman = $romanMonths[$currentMonthNumeric]; // Konversi ke Romawi
    $currentYear = now()->format('Y'); // Tahun saat ini

    // Hitung nomor pengajuan berdasarkan bulan dan tahun ini
    $lastQuotation = Quotation::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonthNumeric)
        ->orderBy('id', 'desc')
        ->first();

    // Tentukan nomor pengajuan berikutnya
    $nextNumber = $lastQuotation ? intval(explode('/', $lastQuotation->nomor_pengajuan)[0]) + 1 : 1;
    $nomorPengajuan = str_pad($nextNumber, 3, '0', STR_PAD_LEFT) . '/' . $currentMonthRoman . '/' . $currentYear;

    // Buat quotation baru dengan nomor pengajuan
    $quotation = Quotation::create([
        'user_id' => auth()->id(),
        'status' => 'pending',
        'nomor_pengajuan' => $nomorPengajuan,
        'topik' => $topik, // Simpan topik ke database
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Simpan setiap produk di quotation_product
    foreach ($cartItems as $item) {
        $produk = Produk::find($item['produk_id']);

        if (!$produk) {
            continue;
        }

        $unitPrice = $item['unit_price'] ?? 0;
        $totalPrice = $item['quantity'] * $unitPrice;

        QuotationProduct::create([
            'quotation_id' => $quotation->id,
            'produk_id' => $item['produk_id'],
            'quantity' => $item['quantity'],
            'created_at' => now(),
            'updated_at' => now(),
            'equipment_name' => $produk->nama,
            'merk_type' => $produk->merk,
            'unit_price' => $unitPrice,
            'total_price' => $totalPrice,
        ]);
    }

    // Kosongkan keranjang setelah submit
    session()->forget('quotation_cart');

    return redirect()->route('distribution.request-quotation')->with('success', 'Permintaan quotation berhasil diajukan dengan nomor pengajuan: ' . $nomorPengajuan);
}




public function updateCart(Request $request)
{
    $cartItems = session()->get('quotation_cart', []);
    $produkId = $request->input('produk_id');
    $quantity = $request->input('quantity');

    // Validasi kuantitas minimal
    if ($quantity < 1) {
        return response()->json(['success' => false, 'message' => 'Quantity tidak boleh kurang dari 1.']);
    }

    // Perbarui kuantitas di sesi
    foreach ($cartItems as &$item) {
        if ($item['produk_id'] == $produkId) {
            $item['quantity'] = $quantity;
            break;
        }
    }
    session()->put('quotation_cart', $cartItems);

    return response()->json(['success' => true, 'message' => 'Kuantitas berhasil diperbarui.']);
}


public function removeFromCart(Request $request)
{
    $productId = $request->input('produk_id');

    $cartItems = session()->get('quotation_cart', []);
    $cartItems = array_filter($cartItems, function ($item) use ($productId) {
        return $item['produk_id'] != $productId;
    });

    session()->put('quotation_cart', $cartItems);

    return redirect()->route('quotations.cart')->with('success', 'Produk berhasil dihapus dari keranjang.');
}



}
