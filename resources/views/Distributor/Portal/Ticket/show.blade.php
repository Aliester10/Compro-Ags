@extends('layouts.Member.master')

@section('content')
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Detail Tiket Layanan</h3>
            <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
                <li class="breadcrumb-item active text-primary">Detail Tiket Layanan</li>
            </ol>
        </div>
    </div>

    <div class="container py-5">
        <div class="card shadow-sm border-0 rounded">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Informasi Tiket Layanan</h4>
            </div>
            <div class="card-body">
                <p><strong><i class="fas fa-cogs me-2"></i>Jenis Layanan:</strong> {{ $ticket->jenis_layanan }}</p>
                <p><strong><i class="fas fa-info-circle me-2"></i>Keterangan Pengajuan:</strong>
                    {{ $ticket->keterangan_layanan }}</p>
                <p><strong><i class="fas fa-calendar-alt me-2"></i>Tanggal Pengajuan:</strong> {{ $ticket->tgl_pengajuan }}
                </p>
                <p><strong><i class="fas fa-clipboard-check me-2"></i>Status:</strong> {{ $ticket->status }}</p>

                @if ($ticket->file_pendukung_layanan)
                    <p><strong><i class="fas fa-paperclip me-2"></i>Dokumen Pendukung:</strong>
                        <a href="{{ asset($ticket->file_pendukung_layanan) }}" target="_blank" class="text-primary">Lihat
                            Dokumen</a>
                    </p>
                @endif
                <!-- Tampilkan Tim Teknis -->
                @if ($ticket->tim_teknis)
                    <p><strong><i class="fas fa-users me-2"></i>Tim Teknis:</strong>
                        <span class="badge bg-success">{{ $ticket->tim_teknis }}</span>
                    </p>
                @else
                    <p><strong><i class="fas fa-users me-2"></i>Tim Teknis:</strong>
                        <span class="badge bg-secondary">Belum ditentukan</span>
                    </p>
                @endif
                <!-- Tampilkan Keterangan Tindakan -->
                @if ($ticket->keterangan_tindakan)
                    <p><strong><i class="fas fa-clipboard-list me-2"></i>Keterangan Tindakan:</strong>
                        {{ $ticket->keterangan_tindakan }}</p>
                @else
                    <p><strong><i class="fas fa-clipboard-list me-2"></i>Keterangan Tindakan:</strong> Belum ada keterangan
                        tindakan</p>
                @endif


                <h5 class="mt-4">Dokumen Pendukung Tindakan</h5>
                @if ($ticket->dok_pendukung_tindakan)
                    <p><a href="{{ asset($ticket->dok_pendukung_tindakan) }}" target="_blank" class="text-primary"><i
                                class="fas fa-file-alt me-2"></i>Lihat Dokumen Tindakan</a></p>
                @else
                    <p class="text-muted">Belum ada dokumen pendukung tindakan.</p>
                @endif

                <div class="d-flex justify-content-end">
                    <a href="{{ route('distribution.tickets.index') }}" class="btn btn-secondary"><i
                            class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
