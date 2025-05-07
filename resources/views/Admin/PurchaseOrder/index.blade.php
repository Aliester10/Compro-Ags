@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded-3">
        <div class="card-body">
            <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Daftar Purchase Orders</h2>

            <!-- Flash Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Search Form -->
            <form action="{{ route('admin.purchase-orders.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nomor PO atau distributor..."
                           value="{{ request()->input('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>

            <!-- Tabel Purchase Orders -->
            <div class="table-responsive">
                <table class="table table-hover shadow-sm rounded">
                    <thead style="background: linear-gradient(135deg, #00796b, #004d40); color: #fff;">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Quotation Number</th>
                            <th class="text-center">PO Number</th>
                            <th class="text-center">PO Date</th>
                            <th class="text-center">Distributor</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #f9f9f9;">
                        @forelse($purchaseOrders as $po)
                            <tr>
                                <td class="text-center">{{ $po->id }}</td>
                                <td class="text-center">{{ $po->quotation->quotation_number ?? 'N/A' }}</td>
                                <td class="text-center">{{ $po->po_number }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($po->po_date)->format('d M Y') }}</td>
                                <td class="text-center">{{ $po->user->name }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.purchase-orders.show', $po->id) }}" class="btn btn-info btn-sm rounded-pill shadow-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                
                                
                                            <!-- Create Proforma Invoice Button -->
                                            @if (!$po->proformaInvoice)
                                                <a href="{{ route('admin.proforma-invoices.create', $po->id) }}" class="btn btn-primary btn-sm rounded-pill shadow-sm">
                                                    <i class="fas fa-file-invoice"></i> Create Proforma Invoice
                                                </a>
                                            @else
                                                <span class="text-muted">Proforma Invoice Created</span>
                                            @endif
                                        
                                    </div>
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    @if(request()->has('search'))
                                        Data tidak ditemukan.
                                    @else
                                        Belum ada Purchase Order.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $purchaseOrders->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
