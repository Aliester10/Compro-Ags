<?php

namespace App\Http\Controllers\Admin\Quotation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\QuotationNegotiation;

class QuotationNegotiationController extends Controller
{
   // Menampilkan daftar negosiasi yang masuk
   public function index(Request $request)
   {
       // Ambil keyword pencarian dari input pengguna
       $keyword = $request->input('search');
   
       // Query negotiations dengan pencarian dan pagination
       $negotiations = QuotationNegotiation::with('quotation')
           ->when($keyword, function ($query) use ($keyword) {
               $query->whereHas('quotation', function ($q) use ($keyword) {
                   $q->where('quotation_number', 'like', "%{$keyword}%");
               })
               ->orWhere('status', 'like', "%{$keyword}%");
           })
           ->paginate(10); // Menampilkan 10 item per halaman
   
       return view('Admin.Quotation.Negotiation.index', compact('negotiations', 'keyword'));
   }
   
   public function process($id, Request $request)
   {
       $request->validate([
           'notes' => 'required|string|max:255',
       ]);
   
       $negotiation = QuotationNegotiation::findOrFail($id);
       $negotiation->update([
           'status' => 'in_progress', // Status tetap in_progress
           'admin_notes' => $request->input('notes'), // Simpan catatan admin
       ]);
   
       return redirect()->route('admin.quotations.negotiations.index')->with('success', 'Negotiation updated and is still in progress.');
   }
   
   
   public function accept($id, Request $request)
   {
       $request->validate([
           'notes' => 'nullable|string|max:255',
       ]);
   
       $negotiation = QuotationNegotiation::findOrFail($id);
       $negotiation->update([
           'status' => 'accepted',
           'admin_notes' => $request->input('notes'), // Simpan catatan admin jika ada
       ]);
   
       // Redirect ke halaman edit quotation
       return redirect()->route('admin.quotations.edit', $negotiation->quotation_id)
           ->with('success', 'Negotiation accepted. Proceed to edit the quotation.');
   }
   
   
   public function reject($id, Request $request)
   {
       $request->validate([
           'notes' => 'required|string|max:255',
       ]);
   
       $negotiation = QuotationNegotiation::findOrFail($id);
       $negotiation->update([
           'status' => 'rejected',
           'admin_notes' => $request->input('notes'), // Simpan catatan admin
       ]);
   
       return redirect()->route('admin.quotations.negotiations.index')->with('success', 'Negotiation rejected with notes.');
   }
   
   

}
