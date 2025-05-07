@extends('layouts.Admin.master')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Tiket Layanan</h4>
        </div>
        <div class="card-body">
            <p><strong><i class="fas fa-cogs me-2"></i>Jenis Layanan:</strong> {{ $ticket->jenis_layanan }}</p>
            <p><strong><i class="fas fa-info-circle me-2"></i>Keterangan Pengajuan:</strong> {{ $ticket->keterangan_layanan }}</p>
            <p><strong><i class="fas fa-calendar-alt me-2"></i>Tanggal Pengajuan:</strong> {{ $ticket->tgl_pengajuan }}</p>
            <p><strong><i class="fas fa-clipboard-check me-2"></i>Status:</strong> 
                <span class="badge 
                    @if($ticket->status == 'open') bg-success 
                    @elseif($ticket->status == 'progress') bg-warning 
                    @else bg-secondary @endif">
                    {{ ucfirst($ticket->status) }}
                </span>
            </p>

            @if ($ticket->file_pendukung_layanan)
                <p><strong><i class="fas fa-paperclip me-2"></i>Dokumen Pendukung:</strong> 
                    <a href="{{ asset($ticket->file_pendukung_layanan) }}" target="_blank" class="text-primary">Lihat Dokumen</a>
                </p>
            @endif

            <h5 class="mt-4">Dokumen Pendukung Tindakan</h5>
            @if ($ticket->dok_pendukung_tindakan)
                <p><a href="{{ asset($ticket->dok_pendukung_tindakan) }}" target="_blank" class="text-primary"><i class="fas fa-file-alt me-2"></i>Lihat Dokumen Tindakan</a></p>
            @else
                <p class="text-muted">Belum ada dokumen pendukung tindakan.</p>
            @endif

            @if($ticket->status == 'open' && $ticket->jenis_layanan == 'Permintaan Data')
                <!-- Form untuk proses tiket Permintaan Data -->
                <form action="{{ route('admin.tickets.process', $ticket->id_after_sales) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="file_pendukung_layanan"><i class="fas fa-upload me-2"></i>Unggah Data Pendukung (Opsional)</label>
                        <input type="file" name="file_pendukung_layanan" id="file_pendukung_layanan" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle me-2"></i>Proses dan Selesaikan Tiket</button>
                </form>

            @elseif($ticket->status == 'open' && in_array($ticket->jenis_layanan, ['Visit', 'Maintanance', 'Installasi']))
                <!-- Form untuk menjadwalkan Visit, Maintenance, atau Installasi -->
                <form action="{{ route('admin.tickets.process', $ticket->id_after_sales) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="keterangan_tindakan"><i class="fas fa-clipboard-list me-2"></i>Keterangan Penjadwalan {{ $ticket->jenis_layanan }}</label>
                        <textarea name="keterangan_tindakan" id="keterangan_tindakan" class="form-control" rows="4" placeholder="Deskripsikan penjadwalan..."></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tim_teknis"><i class="fas fa-users me-2"></i>Tim Teknis</label>
                        <input type="text" name="tim_teknis" id="tim_teknis" class="form-control" placeholder="Masukkan nama tim teknis">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-calendar-check me-2"></i>Proses dan Jadwalkan {{ $ticket->jenis_layanan }}</button>
                </form>

            @elseif($ticket->status == 'progress' && in_array($ticket->jenis_layanan, ['Visit', 'Maintanance', 'Installasi']))
                <!-- Form untuk menyelesaikan Visit, Maintenance, atau Installasi -->
                <form action="{{ route('admin.tickets.complete', $ticket->id_after_sales) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="file_pendukung_layanan"><i class="fas fa-upload me-2"></i>Unggah Arsip Data Pendukung (Opsional)</label>
                        <input type="file" name="file_pendukung_layanan" id="file_pendukung_layanan" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check-double me-2"></i>Selesaikan {{ $ticket->jenis_layanan }} dan Arsipkan</button>
                </form>
            @endif

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
