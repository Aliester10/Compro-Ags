<?php

namespace App\Http\Controllers\Distribution\Portal;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        // Ambil invoice berdasarkan distributor yang sedang login
        $invoices = Invoice::whereHas('proformaInvoice.purchaseOrder', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('proformaInvoice.purchaseOrder')->get();

        return view('Distributor.Portal.Invoices.index', compact('invoices'));
    }
}
