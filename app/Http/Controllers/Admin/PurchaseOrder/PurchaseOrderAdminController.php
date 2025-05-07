<?php

namespace App\Http\Controllers\Admin\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderAdminController extends Controller
{
    // Menampilkan daftar semua Purchase Orders
    public function index(Request $request)
    {
        // Ambil keyword pencarian dari input pengguna
        $keyword = $request->input('search');
    
        // Query Purchase Orders dengan pencarian dan pagination
        $purchaseOrders = PurchaseOrder::with('user', 'quotation')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('po_number', 'like', "%{$keyword}%")
                    ->orWhereHas('user', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
            })
            ->paginate(10); // Menampilkan 10 item per halaman
    
        return view('Admin.PurchaseOrder.index', compact('purchaseOrders', 'keyword'));
    }
    

    // Menampilkan detail Purchase Order tertentu
    public function show($id)
    {
        $purchaseOrder = PurchaseOrder::with('user', 'quotation')->findOrFail($id);
        return view('Admin.PurchaseOrder.show', compact('purchaseOrder'));
    }

    // Menyetujui Purchase Order
    public function approve($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $purchaseOrder->update(['status' => 'approved']);
        return redirect()->route('admin.purchase-orders.index')->with('success', 'Purchase Order approved.');
    }

    // Menolak Purchase Order
    public function reject($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $purchaseOrder->update(['status' => 'rejected']);
        return redirect()->route('admin.purchase-orders.index')->with('success', 'Purchase Order rejected.');
    }
    // Update PO Number
public function updatePoNumber(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'po_number' => 'required|string|unique:purchase_orders,po_number', // Nomor PO harus unik
    ]);

    // Temukan Purchase Order berdasarkan ID
    $purchaseOrder = PurchaseOrder::findOrFail($id);

    // Perbarui PO Number
    $purchaseOrder->update(['po_number' => $request->po_number]);

    return redirect()->route('admin.purchase-orders.index')->with('success', 'PO Number berhasil diperbarui.');
}

}
