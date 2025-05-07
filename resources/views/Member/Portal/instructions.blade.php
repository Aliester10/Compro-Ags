@extends('layouts.Member.master')

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">User Manual</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/portal')}}">Portal Member</a></li>
            <li class="breadcrumb-item active text-primary">User Manual</li>
        </ol>
    </div>
</div>
<!-- Header End --><br><br>

<!-- Instructions Start -->
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            @forelse($uniqueProduks as $produk)
                <div class="col-md-4 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-img rounded-top border border-secondary" style="border-radius: 10px;">
                        <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}" class="img-fluid rounded-top w-100" alt="{{ $produk->nama }}">
                        <div class="service-content-inner p-4" style="border-radius: 0 0 10px 10px;">
                            <h5>{{ $produk->nama }}</h5>
                            <p class="mb-4">{{ Str::limit($produk->kegunaan, 100) }}</p>
                            @if($produk->user_manual)
                                <a href="{{ asset($produk->user_manual) }}" download="{{ $produk->nama }}_manual.pdf" class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Download Manual</a>
                                <a href="{{ asset($produk->user_manual) }}" class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2" target="_blank">View Manual</a>
                            @else
                                <p class="text-muted">No manual available</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">You don't have any products associated with your account.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
<!-- Instructions End -->
@endsection
