@extends('layouts.Member.master')

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Monitoring</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/portal')}}">Portal member</a></li>
            <li class="breadcrumb-item active text-primary">Monitoring</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<!-- Services Start -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Monitoring Produk dan Inspeksi Maintenance</h2>

    @if($userProduks->isEmpty())
        <div class="alert alert-warning text-center">
            Anda belum memiliki produk untuk dimonitor.
        </div>
    @else
        <div class="row">
            @foreach($userProduks as $userProduk)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset($userProduk->produk->images->first()->gambar ?? 'assets/img/default.jpg') }}" class="card-img-top img-fluid" alt="{{ $userProduk->produk->nama }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $userProduk->produk->nama }}</h5>
                        <p class="card-text">{{ Str::limit($userProduk->produk->deskripsi, 100) }}</p>
                        
                        <!-- Display Monitoring Info -->
                        @if($userProduk->monitoring)
                            <h6>Monitoring</h6>
                            <p>Status Barang: {{ $userProduk->monitoring->status_barang }}</p>
                            <p>Kondisi Terakhir: {{ $userProduk->monitoring->kondisi_terakhir_produk }}</p>
                        @else
                            <p>No monitoring data available.</p>
                        @endif
                    <a href="{{ route('portal.monitoring.detail', $userProduk->id) }}" class="btn btn-primary mt-2">Detail Produk</a>
                </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
<!-- Services End -->
@endsection
