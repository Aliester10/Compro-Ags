@extends('layouts.Admin.master')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg p-4 rounded-3">
            <div class="card-body">
                <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Daftar Proforma
                    Invoices</h2>

                <!-- Flash Message -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Search Form -->
                <form action="{{ route('admin.proforma-invoices.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari berdasarkan nomor PI, PO, atau distributor..."
                            value="{{ request()->input('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>

                <!-- Jika tidak ada Proforma Invoices -->
                @if ($proformaInvoices->isEmpty() && !request()->has('search'))
                    <!-- Jika tidak ada Proforma Invoices sama sekali -->
                    <div class="alert alert-info text-center">
                        <p class="mb-3">Belum ada Proforma Invoice yang tersedia saat ini.</p>
                    </div>
                @else
                    <!-- Tabel Proforma Invoices -->
                    <div class="table-responsive">
                        <table class="table table-hover shadow-sm rounded">
                            <thead style="background: linear-gradient(135deg, #00796b, #004d40); color: #fff;">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">PI Number</th>
                                    <th class="text-center">PI Date</th>
                                    <th class="text-center">PO Number</th>
                                    <th class="text-center">Quotation Number</th> 

                                    <th class="text-center">Distributor</th>
                                    <th class="text-center">Subtotal</th>

                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody style="background-color: #f9f9f9;">
                                @forelse($proformaInvoices as $invoice)
                                    <tr>
                                        <td class="text-center">{{ $invoice->id }}</td>
                                        <td class="text-center">{{ $invoice->pi_number }}</td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($invoice->pi_date)->format('d M Y') }}</td>
                                        <td class="text-center">{{ $invoice->purchaseOrder->po_number }}</td>
                                        <td class="text-center">{{ $invoice->purchaseOrder->quotation->quotation_number ?? 'N/A' }}</td>
                                        <td class="text-center">{{ $invoice->purchaseOrder->user->name }}</td>
                                        <td class="text-center">Rp{{ number_format($invoice->subtotal, 2) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.proforma-invoices.show', $invoice->id) }}" class="btn btn-info btn-sm rounded-pill shadow-sm">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">Data tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $proformaInvoices->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
