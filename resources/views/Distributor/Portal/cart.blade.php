@extends('layouts.Member.master')

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Keranjang Permintaan Quotation</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
            <li class="breadcrumb-item active text-primary">Keranjang Permintaan Quotation</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<div class="container py-5">
    <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Keranjang Permintaan Quotation</h2>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Button to Add More Products -->
    <div class="text-end mb-4">
        <a href="{{ url('/en/products') }}" class="btn btn-primary btn-lg shadow-sm" style="border-radius: 10px;">
            <i class="fas fa-plus-circle me-2"></i>Tambah Produk
        </a>
    </div>

    <!-- Cart Table -->
    <div class="card shadow-sm border-0 rounded">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead style="background: linear-gradient(135deg, #00796b, #004d40); color: #fff;">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Produk</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cartItems as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td class="text-center">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" 
                                       class="form-control d-inline-block update-quantity" 
                                       style="width: 80px;" 
                                       data-produk-id="{{ $item['produk_id'] }}">
                            </td>
                            <td class="text-center">
                                <form action="{{ route('quotations.cart.remove') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="produk_id" value="{{ $item['produk_id'] }}">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Keranjang kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Submit Quotation Button -->
    @if(count($cartItems) > 0)
    <form action="{{ route('quotations.submit') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="topik" class="form-label">Topik</label>
            <input type="text" name="topik" id="topik" class="form-control" placeholder="Masukkan topik permintaan">
        </div>
        <button type="submit" class="btn btn-primary btn-lg shadow-sm">
            <i class="fas fa-paper-plane me-2"></i>Ajukan Permintaan Quotation
        </button>
    </form>
    
    @endif
</div>

<!-- JavaScript for AJAX -->
<script>
    document.querySelectorAll('.update-quantity').forEach(input => {
        input.addEventListener('change', function () {
            const produkId = this.getAttribute('data-produk-id');
            const quantity = this.value;

            fetch('{{ route('quotations.cart.update') }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ produk_id: produkId, quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Optional: Reload or update part of the page
                    console.log('Quantity updated successfully');
                } else {
                    alert(data.message || 'Error updating quantity.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
@endsection
