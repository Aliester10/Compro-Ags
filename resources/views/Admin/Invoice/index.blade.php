@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded-3">
        <div class="card-body">
            <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Daftar Invoices</h2>

            <!-- Flash Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Search Form -->
            <form action="{{ route('invoices.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nomor invoice, status, atau total..."
                           value="{{ request()->input('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>

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
                        @forelse ($invoices as $invoice)
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
                                        <a href="{{ asset($invoice->file_path) }}" target="_blank" class="btn btn-info btn-sm rounded-pill shadow-sm">
                                            <i class="fas fa-file-pdf"></i> View PDF
                                        </a>
                                        <a href="{{ asset($invoice->file_path) }}" download class="btn btn-secondary btn-sm rounded-pill shadow-sm">
                                            <i class="fas fa-download"></i> Download PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">
                                    @if(request()->has('search'))
                                        Data tidak ditemukan.
                                    @else
                                        Belum ada Invoice.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $invoices->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
