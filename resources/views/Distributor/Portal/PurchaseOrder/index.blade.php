@extends('layouts.Member.master')
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Purchase Orders</h3>
            <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
                <li class="breadcrumb-item active text-primary">Purchase Orders</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <div class="container mt-5">
        <div class="card shadow-lg p-4 rounded-3">
            <div class="card-body">
                <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Your Purchase Orders</h2>

                @if ($purchaseOrders->isEmpty())
                    <!-- Pesan Jika Tidak Ada Purchase Order -->
                    <div class="alert alert-info text-center">
                        <p class="mb-3">Anda belum memiliki Purchase Order. Silakan lihat Quotation Anda dan ajukan quotation untuk memulai proses.</p>
                        <a href="{{ route('distribution.request-quotation') }}" class="btn btn-primary btn-lg shadow-sm">
                            <i class="fas fa-file-alt me-2"></i>Lihat Quotation
                        </a>
                    </div>
                @else
                    <!-- Tombol Lihat Quotation -->
                    <div class="mb-4 text-end">
                        <a href="{{ route('distribution.request-quotation') }}" class="btn btn-primary btn-lg shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Lihat Quotation
                        </a>
                    </div>

                    <!-- Tabel Purchase Orders -->
                    <div class="table-responsive">
                        <table class="table table-hover shadow-sm rounded">
                            <thead style="background: linear-gradient(135deg, #00796b, #004d40); color: #fff;">
                                <tr>
                                    <th>ID</th>
                                    <th>PO Number</th>
                                    <th>PO Date</th>
                                    <th>Quotation Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody style="background-color: #f9f9f9;">
                                @foreach ($purchaseOrders as $po)
                                    <tr>
                                        <td>{{ $po->id }}</td>
                                        <td>{{ $po->po_number }}</td>
                                        <td>{{ \Carbon\Carbon::parse($po->po_date)->format('d M Y') }}</td>
                                        <td>{{ $po->quotation->quotation_number ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('quotations.show', $po->quotation_id) }}" class="btn btn-info btn-sm rounded-pill shadow-sm">
                                                <i class="fas fa-eye"></i> View Quotation
                                            </a>
                                            @if ($po->proformaInvoice)
                                            <!-- View Proforma Invoice -->
                                            <a href="{{ route('distributor.proforma-invoices.index', $po->proformaInvoice->id) }}"
                                                class="btn btn-primary btn-sm rounded-pill shadow-sm">
                                                <i class="fas fa-file-invoice"></i> View Proforma Invoice
                                            </a>
                                        @else
                                            <!-- Proforma Invoice Pending -->
                                            <span class="text-muted">Proforma Invoice akan segera dikirim</span>
                                        @endif
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
