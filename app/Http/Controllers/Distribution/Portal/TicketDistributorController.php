<?php

namespace App\Http\Controllers\Distribution\Portal;

use App\Http\Controllers\Controller;
use App\Models\AfterSales;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class TicketDistributorController extends Controller
{
    public function index()
    {
        $tickets = AfterSales::where('id_users', auth()->id())->get();
        return view('Distributor.Portal.Ticket.index', compact('tickets'));
    }

    public function create()
    {
        return view('Distributor.Portal.Ticket.create');
    }

    public function store(Request $request)
{
$request->validate([
    'jenis_layanan' => 'required|string',
    'keterangan_layanan' => 'required|string',
    'file_pendukung_layanan' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
]);

$ticket = new AfterSales();
$ticket->jenis_layanan = $request->jenis_layanan;
$ticket->keterangan_layanan = $request->keterangan_layanan;
$ticket->tgl_pengajuan = now();
$ticket->status = 'open';
$ticket->id_users = auth()->id();

if ($request->hasFile('file_pendukung_layanan')) {
    $fileName = time() . '_' . Str::slug(pathinfo($request->file('file_pendukung_layanan')->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $request->file('file_pendukung_layanan')->getClientOriginalExtension();
    $request->file('file_pendukung_layanan')->move(public_path('uploads/pendukunglayanan'), $fileName);
    $ticket->file_pendukung_layanan = 'uploads/pendukunglayanan/' . $fileName;
}

$ticket->save();

return redirect()->route('distribution.tickets.index')->with('success', 'Tiket layanan berhasil diajukan.');
}
    public function show($id)
    {
        $ticket = AfterSales::where('id_after_sales', $id)->where('id_users', auth()->id())->firstOrFail();
        return view('Distributor.Portal.Ticket.show', compact('ticket'));
    }
    
    public function edit($id)
    {
        $ticket = AfterSales::where('id_after_sales', $id)->where('id_users', auth()->id())->firstOrFail();
        return view('Distributor.Portal.Ticket.edit', compact('ticket'));
    }
    
    public function cancel($id)
    {
        $ticket = AfterSales::where('id_after_sales', $id)->where('id_users', auth()->id())->firstOrFail();
        $ticket->status = 'batal';
        $ticket->save();
    
        return redirect()->route('distribution.tickets.index')->with('success', 'Tiket berhasil dibatalkan.');
    }
    public function update(Request $request, $id)
{
$request->validate([
    'jenis_layanan' => 'required|string',
    'keterangan_layanan' => 'required|string',
    'file_pendukung_layanan' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
]);

$ticket = AfterSales::where('id_after_sales', $id)->where('id_users', auth()->id())->firstOrFail();
$ticket->jenis_layanan = $request->jenis_layanan;
$ticket->keterangan_layanan = $request->keterangan_layanan;

if ($request->hasFile('file_pendukung_layanan')) {
    $fileName = time() . '_' . Str::slug(pathinfo($request->file('file_pendukung_layanan')->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $request->file('file_pendukung_layanan')->getClientOriginalExtension();
    $request->file('file_pendukung_layanan')->move(public_path('uploads/pendukunglayanan'), $fileName);
    $ticket->file_pendukung_layanan = 'uploads/pendukunglayanan/' . $fileName;
}

$ticket->save();

return redirect()->route('distribution.tickets.index')->with('success', 'Tiket berhasil diperbarui.');
}
            
}

