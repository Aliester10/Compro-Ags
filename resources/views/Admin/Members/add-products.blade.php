@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2>Tambah Produk untuk {{ $member->name }}</h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('members.store-products', $member->id) }}" method="POST">
                        @csrf

                        <div class="row">
                            @foreach($produks as $produk)
                                <div class="col-md-4 mb-4">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-body d-flex flex-column">
                                            <!-- Display the first product image if available -->
                                            @if($produk->images->isNotEmpty())
                                                <div class="mb-3 text-center">
                                                    @php
                                                        $firstImage = $produk->images->first();
                                                    @endphp
                                                    <img src="{{ asset($firstImage->gambar) }}" class="img-fluid mb-3" alt="{{ $produk->nama }}" style="max-height: 150px; object-fit: cover;">
                                                </div>
                                            @else
                                                <div class="mb-3 text-center">
                                                    <img src="{{ asset('assets/img/default.jpg') }}" class="img-fluid mb-3" alt="Default Image" style="max-height: 150px; object-fit: cover;">
                                                </div>
                                            @endif

                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="produk_id[{{ $produk->id }}]" value="{{ $produk->id }}" id="produk_{{ $produk->id }}">
                                                <label class="form-check-label" for="produk_{{ $produk->id }}">
                                                    {{ $produk->nama }}
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label for="pembelian_{{ $produk->id }}">Tanggal Pembelian</label>
                                                <input type="date" name="pembelian[{{ $produk->id }}]" id="pembelian_{{ $produk->id }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                            <button type="submit" class="btn btn-primary btn-sm">Tambah Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
