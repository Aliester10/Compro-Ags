@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2>Edit Produk untuk {{ $member->name }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('members.update-products', $member->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            @foreach($member->userProduk as $userProduk)
                                <div class="col-md-4 mb-4">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-body d-flex flex-column">
                                            <!-- Display the first product image if available -->
                                            @if($userProduk->produk->images->isNotEmpty())
                                                <div class="mb-3 text-center">
                                                    @php
                                                        $firstImage = $userProduk->produk->images->first();
                                                    @endphp
                                                    <img src="{{ asset($firstImage->gambar) }}" class="img-fluid mb-3" alt="{{ $userProduk->produk->nama }}" style="max-height: 150px; object-fit: cover;">
                                                </div>
                                            @else
                                                <div class="mb-3 text-center">
                                                    <img src="{{ asset('assets/img/default.jpg') }}" class="img-fluid mb-3" alt="Default Image" style="max-height: 150px; object-fit: cover;">
                                                </div>
                                            @endif

                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="produk_id[]" value="{{ $userProduk->produk->id }}" id="produk_{{ $userProduk->produk->id }}" checked>
                                                <label class="form-check-label" for="produk_{{ $userProduk->produk->id }}">
                                                    {{ $userProduk->produk->nama }}
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label for="pembelian_{{ $userProduk->produk->id }}">Tanggal Pembelian</label>
                                                <input type="date" name="pembelian[]" id="pembelian_{{ $userProduk->produk->id }}" class="form-control" value="{{ $userProduk->pembelian }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                            <button type="submit" class="btn btn-primary btn-sm">Perbaharui Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
