<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\AfterSales;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PermintaanData;


class TicketController extends Controller
{
    public function index(Request $request)
    {
        // Ambil keyword pencarian dari input pengguna
        $keyword = $request->input('search');
    
        // Query tiket dengan pencarian dan pagination
        $tickets = AfterSales::when($keyword, function ($query) use ($keyword) {
            $query->where('jenis_layanan', 'like', "%{$keyword}%")
                  ->orWhere('keterangan_layanan', 'like', "%{$keyword}%")
                  ->orWhere('tgl_pengajuan', 'like', "%{$keyword}%")
                  ->orWhere('status', 'like', "%{$keyword}%");
        })->paginate(10); // Menampilkan 10 item per halaman
    
        return view('Admin.Ticket.index', compact('tickets', 'keyword'));
    }
    
    public function show($id)
    {
        $ticket = AfterSales::findOrFail($id);
        return view('Admin.Ticket.show', compact('ticket'));
    }

    public function process($id, Request $request)
    {
        $ticket = AfterSales::findOrFail($id);

        if ($ticket->jenis_layanan == 'Permintaan Data') {
            if ($request->hasFile('file_pendukung_layanan')) {
                $file = $request->file('file_pendukung_layanan');
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/pendukunglayanan'), $filename);

                $ticket->dok_pendukung_tindakan = 'uploads/pendukunglayanan/' . $filename;
                  // Simpan path ke tabel permintaan data
                  PermintaanData::create([
                    'id_after_sales' => $ticket->id_after_sales,
                    'nama_dokumen' => $file->getClientOriginalName(),
                    'path_dokumen' => 'uploads/permintaandata/' . $filename,
                    'tgl_create' => now()
                ]);
            }

            $ticket->status = 'close';
            $ticket->tgl_mulai_tindakan = now();
            $ticket->tgl_selesai_tindakan = now();
            $ticket->save();

            return redirect()->route('admin.tickets.index')->with('success', 'Tiket permintaan data berhasil diselesaikan.');

        } elseif (in_array($ticket->jenis_layanan, ['Visit', 'Maintanance', 'Installasi'])) {
            $ticket->status = 'progress';
            $ticket->tgl_mulai_tindakan = now();
             

            if ($request->has('keterangan_tindakan')) {
                $ticket->keterangan_tindakan = $request->keterangan_tindakan;
            }

        // Simpan tim teknis jika ada input
        if ($request->has('tim_teknis')) {
            $ticket->tim_teknis = $request->input('tim_teknis');
        }

            $ticket->save();

            return redirect()->route('admin.tickets.index')->with('success', 'Tiket ' . strtolower($ticket->jenis_layanan) . ' berhasil dijadwalkan dan dikordinasikan.');
        } else {
            return redirect()->route('admin.tickets.index')->with('error', 'Tiket tidak valid untuk diproses.');
        }
    }

    public function complete($id, Request $request)
    {
        $ticket = AfterSales::findOrFail($id);

        if (in_array($ticket->jenis_layanan, ['Visit', 'Maintanance', 'Installasi']) && $ticket->status == 'progress') {
            $ticket->status = 'close';
            $ticket->tgl_selesai_tindakan = now();

            if ($request->hasFile('file_pendukung_layanan')) {
                $file = $request->file('file_pendukung_layanan');
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/pendukunglayanan'), $filename);

                $ticket->dok_pendukung_tindakan = 'uploads/pendukunglayanan/' . $filename;
            }

            $ticket->save();

            return redirect()->route('admin.tickets.index')->with('success', ucfirst($ticket->jenis_layanan) . ' berhasil diselesaikan dan diarsipkan.');
        }

        return redirect()->route('admin.tickets.index')->with('error', 'Tiket tidak valid untuk penyelesaian.');
    }
}
