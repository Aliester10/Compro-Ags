@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 shadow">
                <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">
                    Detail Quotation #{{ $quotation->id }}
                </h2>
                <!-- Daftar Produk di Quotation -->
                <div class="card mt-4 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Produk dalam Quotation</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Merek</th>
                                    <th>Tipe</th>
                                    <th>Quantity</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($quotation->quotationProducts as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->equipment_name ?? 'Produk tidak tersedia' }}</td>
                                        <td>{{ $product->merk_type ?? 'Tidak tersedia' }}</td>
                                        <td>{{ $product->tipe ?? 'Tidak tersedia' }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ number_format($product->unit_price, 2) }}</td>
                                        <td>{{ number_format($product->total_price, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Tidak ada produk dalam quotation ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Dokumen PDF dan Media Lain -->
                <div class="card mt-4 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Dokumen Pendukung</h5>
                        
                        <!-- Dokumentasi PDF -->
                        @if($quotation->pdf_path)
                            <p>
                                <a href="{{ asset($quotation->pdf_path) }}" target="_blank" class="text-primary">
                                    <i class="fas fa-file-alt me-2"></i>Lihat Dokumen PDF
                                </a>
                            </p>
                            <p>
                                <a href="{{ asset($quotation->pdf_path) }}" download class="text-secondary">
                                    <i class="fas fa-download me-2"></i>Download PDF
                                </a>
                            </p>
                        @else
                            <p class="text-muted">Tidak ada file PDF untuk quotation ini.</p>
                        @endif
                    </div>
                </div>

                 <!-- Tombol Kembali -->
                 <div class="mt-4 text-end">
                    <a href="{{ route('admin.quotations.index') }}" class="btn btn-secondary rounded-pill shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Quotation
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
