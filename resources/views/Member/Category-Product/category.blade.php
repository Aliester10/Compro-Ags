@extends('layouts.Member.master')

@section('content')
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Product</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/product') }}">Product</a></li>
            <li class="breadcrumb-item active text-primary" style="font-weight: bold;">{{ $kategori->nama }}</li>
        </ol>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-3">
            <h1 class="mb-4">{{ $kategori->nama }}</h1>
            <h5>Brand</h5>
            <ul class="list-group mb-4">
                <li class="list-group-item border rounded text-center py-2 mb-3" style="cursor: pointer;">
                    LABTEK
                </li>
                <li class="list-group-item border rounded text-center py-2 mb-3" style="cursor: pointer;">
                    LABVERSE
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9" style="font-weight: bold"><br>
            <div class="d-flex justify-content-end mb-3">
                <select class="form-select w-25">
                    <option selected>Sort by</option>
                    <option value="1">Best Seller</option>
                    <option value="2">Newest</option>
                    <option value="3">Latest</option>
                </select>
            </div>

            <div class="row">
                @foreach ($produks as $produk)
                    <div class="col-md-4 mb-4" style="overflow: hidden; transition: transform 0.3s ease; margin-bottom: 10px;">
                        <a href="{{ route('product.show', $produk->id) }}">
                            <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}"
                                 class="img-fluid w-100" alt="{{ $produk->nama }}"
                                 style="transition: transform 0.3s ease;"
                                 onmouseover="this.style.transform='scale(1.1)'"
                                 onmouseout="this.style.transform='scale(1)'">
                        </a>
                        <h5>{{ $produk->nama }}
                            <span class="arrow"
                                  style="display: inline-block; transition: transform 0.3s ease;"
                                  onmouseover="this.textContent='—>'"
                                  onmouseout="this.textContent='→'">→</span>
                        </h5>
                    </div>
                @endforeach
            </div>
        </div>
    </div><br>
</div>
@endsection
