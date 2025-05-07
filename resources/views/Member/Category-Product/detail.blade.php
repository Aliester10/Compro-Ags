@extends('layouts.Member.master')

@section('content')
<div class="container mt-4" style="background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
    <!-- Banner Section -->
    <div class="text-dark p-4 rounded" style="background-color: #f5f5dc;">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="display-6">{{ $produk->nama }}</h3> <!-- Dynamic product name -->
                <p class="lead" style="font-size: 0.9rem;">
                    {{ $produk->kegunaan }} <!-- Dynamic product usage (kegunaan) -->
                </p>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}" alt="Product Image" class="img-fluid" style="max-height: 350px;">
            </div>
        </div>
    </div>

    <br>

    <!-- Similar Products Section -->
    <h2 class="mt-4">Produk Serupa</h2>
    <div class="row">
        <div class="col-md-3 mb-4" style="overflow: hidden; transition: transform 0.3s ease; margin-bottom: 10px;">
            <a href="{{url('/detail')}}" target="">
                <img src="{{ asset('assets/img/product/product-1.jpeg')}}" class="img-fluid w-100" alt="Product 1" style="transition: transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.1)'"
                onmouseout="this.style.transform='scale(1)'">
            </a>
        </div>
        <div class="col-md-3 mb-4" style="overflow: hidden; transition: transform 0.3s ease; margin-bottom: 10px;">
            <a href="{{url('/detail')}}" target="">
                <img src="{{ asset('assets/img/product/product-1.jpeg')}}" class="img-fluid w-100" alt="Product 1" style="transition: transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.1)'"
                onmouseout="this.style.transform='scale(1)'">
            </a>
        </div>
        <div class="col-md-3 mb-4" style="overflow: hidden; transition: transform 0.3s ease; margin-bottom: 10px;">
            <a href="{{url('/detail')}}" target="">
                <img src="{{ asset('assets/img/product/product-1.jpeg')}}" class="img-fluid w-100" alt="Product 1" style="transition: transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.1)'"
                onmouseout="this.style.transform='scale(1)'">
            </a>
        </div>
        <div class="col-md-3 mb-4" style="overflow: hidden; transition: transform 0.3s ease; margin-bottom: 10px;">
            <a href="{{url('/detail')}}" target="">
                <img src="{{ asset('assets/img/product/product-1.jpeg')}}" class="img-fluid w-100" alt="Product 1" style="transition: transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.1)'"
                onmouseout="this.style.transform='scale(1)'">
            </a>
        </div>
    </div>
</div>
@endsection
