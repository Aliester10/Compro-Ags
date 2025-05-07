@extends('layouts.Member.master')

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Detail Permintaan Quotation</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
            <li class="breadcrumb-item active text-primary">Detail Permintaan Quotation</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded-3">
        <div class="card-body">
            <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Detail Permintaan Quotation</h2>

            <!-- Informasi Umum Quotation -->
            <div class="mb-4">
                <p><strong>Status:</strong> 
                    <span class="badge 
                        @if($quotation->status === 'cancelled') bg-danger
                        @elseif($quotation->status === 'quotation') bg-success
                        @else bg-warning @endif">
                        {{ ucfirst($quotation->status) }}
                    </span>
                </p>
                <p><strong>Tanggal Permintaan:</strong> {{ $quotation->created_at->format('d M Y') }}</p>
            </div>
<!-- Menampilkan Daftar Quotation -->
<h4 style="color: #004d40;">Detail Quotation:</h4>
<div class="table-responsive">
    <table class="table table-striped table-hover shadow-sm rounded">
        <thead style="background: linear-gradient(135deg, #00796b, #004d40); color: #fff;">
            <tr>
                <th>No</th>
                <th>No Pengajuan</th>
                <th>Tanggal</th>
                <th>Nomor Quotation</th>
            </tr>
        </thead>
        <tbody style="background-color: #f9f9f9;">
            <tr>
                <td>1</td>
                <td>{{ $quotation->nomor_pengajuan ?? 'Nomor pengajuan tidak tersedia' }}</td>
                <td>{{ $quotation->created_at->format('d M Y') ?? 'Tanggal tidak tersedia' }}</td>
                <td>
                    @if ($quotation->status === 'quotation')
                        {{ $quotation->quotation_number ?? 'Nomor quotation tidak tersedia' }}
                    @else
                        <span class="text-muted">Nomor quotation tidak tersedia</span>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Menampilkan file PDF jika ada -->
<div class="mt-4">
    <h5 style="color: #00796b;">Dokumen PDF:</h5>
    @if($quotation->pdf_path)
        <p>
            <a href="{{ asset($quotation->pdf_path) }}" target="_blank" class="btn btn-primary btn-sm rounded-pill">
                <i class="fas fa-file-alt me-2"></i>Lihat Dokumen PDF
            </a>
        </p>
        <p>
            <a href="{{ asset($quotation->pdf_path) }}" download class="btn btn-secondary btn-sm rounded-pill">
                <i class="fas fa-download me-2"></i>Download PDF
            </a>
        </p>
    @else
        <p class="text-muted">Tidak ada dokumen tersedia.</p>
    @endif
</div>

<!-- Tombol Kembali -->
<div class="text-end mt-4">
    <a href="{{ route('distribution.request-quotation') }}" class="btn btn-secondary btn-lg rounded-pill shadow-sm">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

        </div>
    </div>
</div>
@endsection
