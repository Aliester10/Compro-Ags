<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Models\Quotation;
use App\Models\PurchaseOrder;
use App\Models\ProformaInvoice;
use App\Models\QuotationNegotiation;
use App\Models\AfterSales;


class QuotationCountMiddleware
{
    public function handle($request, Closure $next)
    {
        // Hitung pending quotations
        $pendingQuotations = Quotation::where('status', 'pending')->count();

        // Hitung negosiasi pending
        $pendingNegotiations = QuotationNegotiation::where('status', 'pending')->orWhere('status', 'in_progress')->count();

        // Hitung PO yang belum selesai
        $pendingPOs = PurchaseOrder::whereNull('po_number')
        ->orDoesntHave('proformaInvoice')
        ->count();
    
        // Hitung Proforma Invoices berdasarkan status
        $pendingPIs = ProformaInvoice::whereIn('status', ['partially_paid', 'unpaid'])->count();
        $openTickets = AfterSales::whereIn('status', ['open', 'progress'])->count();

        // Hitung total untuk menu "Produk"
        $totalPending = $pendingQuotations + $pendingNegotiations + $pendingPOs + $pendingPIs + $openTickets;
        // Hitung tiket dengan status "open" atau "progress"

        // Bagikan ke semua view
        View::share('pendingCount', $pendingQuotations);
        View::share('pendingNegotiations', $pendingNegotiations);
        View::share('pendingPOs', $pendingPOs);
        View::share('pendingPIs', $pendingPIs);
        View::share('openTickets', $openTickets); // Share tiket terbuka atau dalam progress
        View::share('totalPendingProducts', $totalPending);

        return $next($request);
    }
}
