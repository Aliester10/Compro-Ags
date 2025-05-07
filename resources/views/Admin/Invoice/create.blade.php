@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded-3">
        <div class="card-body">
            <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">
                Buat Invoice untuk Proforma Invoice #{{ $proformaInvoice->pi_number }}
            </h2>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Form Buat Invoice -->
            <form action="{{ route('invoices.store', $proformaInvoice->id) }}" method="POST">
                @csrf
    <!-- Hidden Input untuk Tipe -->
    <input type="hidden" name="type" value="{{ $type }}">

                @if ($type === 'dp')
                <!-- Input untuk Down Payment -->
                <div class="mb-3">
                    <label for="dp" class="form-label">Down Payment (DP) (%)</label>
                    <input 
                        type="number" 
                        class="form-control shadow-sm" 
                        id="dp" 
                        name="dp" 
                        value="{{ old('dp', $percentage) }}" 
                        readonly>
                    <small class="text-muted">Persentase DP untuk pembayaran pertama.</small>
                </div>
            @elseif ($type === 'next_payment')
                <!-- Input untuk Next Payment -->
                <div class="mb-3">
                    <label for="percentage" class="form-label">Next Payment (%)</label>
                    <input 
                        type="number" 
                        class="form-control shadow-sm" 
                        id="percentage" 
                        name="percentage" 
                        value="{{ old('percentage', $percentage) }}" 
                        readonly>
                    <small class="text-muted">Persentase pembayaran berikutnya berdasarkan next_payment_amount.</small>
                </div>
            @endif
            
            




<!-- Informasi Subtotal, PPN, dan Grand Total -->
<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Subtotal</label>
            <input type="number" class="form-control shadow-sm" value="{{ $subtotal }}" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">PPN (%)</label>
            <input type="number" class="form-control shadow-sm" value="{{ $ppn }}" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Grand Total (Include PPN)</label>
            <input type="number" class="form-control shadow-sm" value="{{ $grandTotalIncludePPN }}" readonly>
        </div>
    </div>
</div>

                <!-- Informasi Vendor -->
                <h4 class="mt-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Vendor Information</h4>
                <div class="mb-3">
                    <label for="vendor_name" class="form-label">Vendor Name</label>
                    <input type="text" class="form-control shadow-sm" id="vendor_name" name="vendor_name" value="{{ $user->name }}" readonly>
                </div>
                
                <div class="mb-3">
                    <label for="vendor_address" class="form-label">Vendor Address</label>
                    <textarea class="form-control shadow-sm" id="vendor_address" name="vendor_address" rows="2" readonly>{{ $user->alamat }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="vendor_phone" class="form-label">Vendor Phone</label>
                    <input type="text" class="form-control shadow-sm" id="vendor_phone" name="vendor_phone" value="{{ $user->no_telp }}" readonly>
                </div>

                <button type="submit" class="btn btn-primary rounded-pill shadow-sm w-100">
                    <i class="fas fa-save"></i> Simpan Invoice
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
