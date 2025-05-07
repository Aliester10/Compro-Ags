@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded-3">
        <div class="card-body">
            <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">
                Detail Purchase Order #{{ $purchaseOrder->po_number }}
            </h2>

            <!-- Informasi Purchase Order -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">
                        Purchase Order Information
                    </h5>
                    <p><strong>PO Number:</strong> {{ $purchaseOrder->po_number }}</p>
                    <p><strong>PO Date:</strong> {{ \Carbon\Carbon::parse($purchaseOrder->po_date)->format('d M Y') }}</p>
                    <p><strong>Distributor:</strong> {{ $purchaseOrder->user->name }}</p>

                    @if($purchaseOrder->file_path)
                        <p><strong>Attached File:</strong> 
                            <a href="{{ asset($purchaseOrder->file_path) }}" target="_blank" class="btn btn-primary btn-sm rounded-pill shadow-sm">
                                <i class="fas fa-file-alt"></i> View File
                            </a>
                        </p>
                    @else
                        <p><strong>Attached File:</strong> <span class="text-muted">No file uploaded</span></p>
                    @endif
                </div>
            </div>

            <!-- Back to PO List Button -->
            <div class="text-end">
                <a href="{{ route('admin.purchase-orders.index') }}" class="btn btn-secondary rounded-pill shadow-sm">
                    <i class="fas fa-arrow-left"></i> Back to PO List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
