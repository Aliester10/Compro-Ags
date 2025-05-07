@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
      <!-- Tampilkan pesan error jika ada -->
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
    <h2>Buat Proforma Invoice untuk PO #{{ $purchaseOrder->po_number }}</h2>

      <!-- Form Proforma Invoice -->
      <form action="{{ route('admin.proforma-invoices.store', $purchaseOrder->id) }}" method="POST">
        @csrf
        <!-- Vendor Information -->
        <h4 class="mt-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Vendor Information</h4>
        <div class="mb-3">
            <label for="vendor_name" class="form-label">Vendor Name</label>
            <input type="text" class="form-control shadow-sm @error('vendor_name') is-invalid @enderror" id="vendor_name" name="vendor_name" value="{{ old('vendor_name', $user->name) }}" readonly>
        </div>
        <div class="mb-3">
            <label for="vendor_address" class="form-label">Vendor Address</label>
            <textarea class="form-control shadow-sm @error('vendor_address') is-invalid @enderror" id="vendor_address" name="vendor_address" rows="2" readonly>{{ old('vendor_address', $user->alamat) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="vendor_phone" class="form-label">Vendor Phone</label>
            <input type="text" class="form-control shadow-sm @error('vendor_phone') is-invalid @enderror" id="vendor_phone" name="vendor_phone" value="{{ old('vendor_phone', $user->no_telp) }}" readonly>
        </div>

        <!-- Product List -->
        <h4 class="mt-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Product List</h4>
        <div id="product-list">
            @foreach($products as $index => $product)
                <div class="row mb-3">
                    <div class="col-md-1">
                        <label>No</label>
                        <input type="number" class="form-control shadow-sm" name="products[{{ $index }}][no]" value="{{ $index + 1 }}" readonly>
                    </div>
                    <div class="col-md-5">
                        <label>Description</label>
                        <input type="text" class="form-control shadow-sm" name="products[{{ $index }}][description]" value="{{ $product['description'] }}" readonly>
                    </div>
                    <div class="col-md-2">
                        <label>QTY</label>
                        <input type="number" class="form-control shadow-sm" name="products[{{ $index }}][qty]" value="{{ $product['qty'] }}" readonly>
                    </div>
                    <div class="col-md-2">
                        <label>Satuan</label>
                        <input type="text" class="form-control shadow-sm" name="products[{{ $index }}][unit]" value="{{ $product['unit'] }}" readonly>
                    </div>
                    <div class="col-md-2">
                        <label>Unit Price</label>
                        <input type="number" class="form-control shadow-sm" name="products[{{ $index }}][unit_price]" value="{{ $product['unit_price'] }}" readonly>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Financial Information -->
        <h4 class="mt-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Financial Information</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="subtotal" class="form-label">Subtotal</label>
                    <input type="number" class="form-control shadow-sm" id="subtotal" name="subtotal" value="{{ $subtotal }}" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="ppn" class="form-label">PPN (%)</label>
                    <input type="number" class="form-control shadow-sm" id="ppn" name="ppn" value="{{ $ppn }}" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="grand_total_include_ppn" class="form-label">Grand Total (Include PPN)</label>
                    <input type="number" class="form-control shadow-sm" id="grand_total_include_ppn" name="grand_total_include_ppn" value="{{ $grandTotalIncludePPN }}" readonly>
                </div>
            </div>
        </div>

        <!-- DP Input -->
        <div class="mb-3">
            <label for="dp" class="form-label">DP (%)</label>
            <input type="number" class="form-control shadow-sm @error('dp') is-invalid @enderror" id="dp" name="dp" step="0.01" max="100" placeholder="Masukkan persentase DP (0-100)">
            @error('dp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
         <!-- Installments Input -->
         <div class="mb-3">
            <label for="installments" class="form-label">Jumlah Pembayaran (Installments)</label>
            <input type="number" class="form-control shadow-sm @error('installments') is-invalid @enderror" id="installments" name="installments" min="1" placeholder="Masukkan jumlah pembayaran setelah DP" required>
            @error('installments')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary rounded-pill shadow-sm w-100 mt-3">
            <i class="fas fa-save"></i> Simpan Proforma Invoice
        </button>
    </form>
</div>
<script>
    // Script to add additional product rows
    document.getElementById('add-product').addEventListener('click', function () {
        const productList = document.getElementById('product-list');
        const index = productList.getElementsByClassName('row').length;
        
        const productRow = `
            <div class="row mb-3">
                <div class="col-md-1">
                    <label>No</label>
                    <input type="number" class="form-control" name="products[${index}][no]" value="${index + 1}" readonly>
                </div>
                <div class="col-md-5">
                    <label>Description</label>
                    <input type="text" class="form-control" name="products[${index}][description]" required>
                </div>
                <div class="col-md-2">
                    <label>QTY</label>
                    <input type="number" class="form-control" name="products[${index}][qty]" required>
                </div>
                <div class="col-md-2">
                    <label>Satuan</label>
                    <input type="text" class="form-control" name="products[${index}][unit]" required>
                </div>
                <div class="col-md-2">
                    <label>Unit Price</label>
                    <input type="number" class="form-control" name="products[${index}][unit_price]" required>
                </div>
            </div>
        `;

        productList.insertAdjacentHTML('beforeend', productRow);
    });
</script>
@endsection
