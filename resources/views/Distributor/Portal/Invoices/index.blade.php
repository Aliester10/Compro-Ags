@extends('layouts.Member.master')

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Daftar Invoice</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
            <li class="breadcrumb-item active text-primary">Daftar Invoice</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded-3">
        <div class="card-body">
            <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Daftar Invoice Anda</h2>

            <!-- Tombol Kembali ke Proforma -->
            <div class="mb-4 text-start">
                <a href="{{ route('distributor.proforma-invoices.index') }}" class="btn btn-secondary btn-lg shadow-sm rounded-pill">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Proforma
                </a>
            </div>

            @if ($invoices->isEmpty())
                <div class="alert alert-info text-center">
                    <p class="mb-3">Belum ada Invoice tersedia.</p>
                </div>
            @else
                <!-- Tabel Invoice -->
                <div class="table-responsive">
                    <table class="table table-hover shadow-sm rounded">
                        <thead style="background: linear-gradient(135deg, #00796b, #004d40); color: #fff;">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Invoice Number</th>
                                <th class="text-center">Invoice Date</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">PPN</th>
                                <th class="text-center">Grand Total</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #f9f9f9;">
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td class="text-center">{{ $invoice->id }}</td>
                                    <td class="text-center">{{ $invoice->invoice_number }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</td>
                                    <td class="text-center">Rp{{ number_format($invoice->subtotal, 2) }}</td>
                                    <td class="text-center">Rp{{ number_format($invoice->ppn, 2) }}</td>
                                    <td class="text-center">Rp{{ number_format($invoice->grand_total_include_ppn, 2) }}</td>
                                    <td class="text-center">
                                        <span class="badge 
                                            @if ($invoice->status === 'paid') bg-success
                                            @elseif ($invoice->status === 'unpaid') bg-warning
                                            @else bg-danger
                                            @endif">
                                            {{ ucfirst($invoice->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ asset($invoice->file_path) }}" target="_blank" class="btn btn-info btn-sm rounded-pill">
                                                <i class="fas fa-file-pdf"></i> View PDF
                                            </a>
                                            <a href="{{ asset($invoice->file_path) }}" download class="btn btn-secondary btn-sm rounded-pill">
                                                <i class="fas fa-download"></i> Download PDF
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
