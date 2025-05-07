@extends('layouts.Admin.master')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded-3">
        <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">
            Edit Quotation for: {{ $quotations->first()->user->name ?? 'N/A' }}
        </h2>
        
        <!-- Mengambil satu instance model untuk menghindari error -->
        @php
            $quotation = $quotations->first();
        @endphp

<form action="{{ route('admin.quotations.update', $quotation->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Recipient Information -->
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="recipient_company" class="form-label">To: Company Name (Distributor)</label>
                <input type="text" class="form-control shadow-sm" id="recipient_company" name="recipient_company"
                       value="{{ old('recipient_company', $quotation->user->nama_perusahaan ?? 'N/A') }}" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="client_contact" class="form-label">Dear (Contact Person)</label>
                <input type="text" class="form-control shadow-sm" id="client_contact" name="recipient_contact_person"
                       value="{{ old('recipient_contact_person', $quotation->user->name ?? 'N/A') }}" readonly>
            </div>
        </div>
    </div>

    <!-- Quotation Details -->
    <div class="row">
       
        <div class="col-md-6">
            <div class="mb-3">
                <label for="quotation_date" class="form-label">Quotation Date</label>
                <input type="date" class="form-control shadow-sm" id="quotation_date" name="quotation_date"
                       value="{{ old('quotation_date', $quotation->quotation_date ?? \Carbon\Carbon::now()->format('Y-m-d')) }}">
            </div>
        </div>
    </div>

    <!-- Equipment Details -->
    <h5 class="mt-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Equipment Details</h5>
    <div class="table-responsive">
        <table class="table table-hover shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Name of Equipment</th>
                    <th>Merk Type</th>
                    <th>QTY</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotation->quotationProducts as $key => $product)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $product->equipment_name ?? 'Produk tidak tersedia' }}</td>
                        <td>{{ $product->merk_type ?? 'Merk tidak tersedia' }}</td>
                        <td>
                            <input type="number" class="form-control shadow-sm" name="products[{{ $key }}][quantity]"
                                   value="{{ old("products.$key.quantity", $product->quantity ?? 0) }}" readonly>
                        </td>
                        <td>
                            <input type="number" class="form-control shadow-sm unit-price" name="products[{{ $key }}][unit_price]"
                                   value="{{ old("products.$key.unit_price", $product->unit_price ?? 0) }}"
                                   data-qty="{{ $product->quantity }}">
                        </td>
                        <td>
                            <input type="number" class="form-control shadow-sm total-price" name="products[{{ $key }}][total_price]"
                                   value="{{ old("products.$key.total_price", $product->total_price ?? 0) }}" readonly>
                        </td>
                        <input type="hidden" name="products[{{ $key }}][produk_id]"
                               value="{{ $product->produk_id ?? '' }}">
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Price Calculation -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="subtotal_price" class="form-label">Sub Total Price</label>
                <input type="number" class="form-control shadow-sm" id="subtotal_price" name="subtotal_price"
                       value="{{ old('subtotal_price', $quotation->subtotal_price) }}" readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="discount" class="form-label">Discount (%)</label>
                <input type="number" class="form-control shadow-sm" id="discount" name="discount"
                       value="{{ old('discount', $quotation->discount ?? 0) }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="total_after_discount" class="form-label">Sub Total II (After Discount)</label>
                <input type="number" class="form-control shadow-sm" id="total_after_discount" name="total_after_discount"
                       value="{{ old('total_after_discount', $quotation->total_after_discount) }}" readonly>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="ppn" class="form-label">PPN (%)</label>
                <input type="number" class="form-control shadow-sm" id="ppn" name="ppn"
                       value="{{ old('ppn', $quotation->ppn ?? 10) }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="grand_total" class="form-label">Grand Total Price</label>
                <input type="number" class="form-control shadow-sm" id="grand_total" name="grand_total"
                       value="{{ old('grand_total', $quotation->grand_total) }}" readonly>
            </div>
        </div>
    </div>

    <!-- Additional Notes -->
    <div class="mb-3">
        <label for="notes" class="form-label">Note</label>
        <textarea class="form-control shadow-sm" id="notes" name="notes" rows="4">{{ old('notes', $quotation->notes) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="terms_conditions" class="form-label">Terms and Conditions</label>
        <textarea class="form-control shadow-sm" id="terms_conditions" name="terms_conditions" rows="4">{{ old('terms_conditions', $quotation->terms_conditions) }}</textarea>
    </div>

    <!-- Signature Information -->
    <h5 class="mt-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Signature Information</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="signer_name" class="form-label">Signer Name</label>
                <input type="text" class="form-control shadow-sm" id="signer_name" name="signer_name"
                       value="{{ old('signer_name', $quotation->authorized_person_name) }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="signer_position" class="form-label">Signer Position</label>
                <input type="text" class="form-control shadow-sm" id="signer_position" name="signer_position"
                       value="{{ old('signer_position', $quotation->authorized_person_position) }}">
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-success rounded-pill shadow-sm w-100 mt-3">
        <i class="fas fa-save"></i> Update Quotation
    </button>
</form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateTotals() {
            let subtotal = 0;

            document.querySelectorAll('.unit-price').forEach((input, index) => {
                const qty = parseFloat(input.getAttribute('data-qty')) || 0;
                const unitPrice = parseFloat(input.value) || 0;
                const totalPrice = qty * unitPrice;

                document.querySelectorAll('.total-price')[index].value = totalPrice.toFixed(2);
                subtotal += totalPrice;
            });

            document.getElementById('subtotal_price').value = subtotal.toFixed(2);

            // Apply discount and calculate Sub Total II
            const discountPercent = parseFloat(document.getElementById('discount').value) || 0;
            const subTotalII = subtotal - (subtotal * (discountPercent / 100));
            document.getElementById('total_after_discount').value = subTotalII.toFixed(2);

            // Apply PPN and calculate Grand Total
            const ppnPercent = parseFloat(document.getElementById('ppn').value) || 0;
            const grandTotal = subTotalII + (subTotalII * (ppnPercent / 100));
            document.getElementById('grand_total').value = grandTotal.toFixed(2);
        }

        // Event listeners for calculation
        document.querySelectorAll('.unit-price, #discount, #ppn').forEach(input => {
            input.addEventListener('input', calculateTotals);
        });

        // Initial calculation on page load
        calculateTotals();
    });
</script>
@endsection
