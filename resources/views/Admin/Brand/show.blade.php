@extends('layouts.Admin.master')

@section('content')
    <div class="container">
        <h1>Detail Brand/Mitra/Induk Perusahaan</h1>

        <div class="card">
            <div class="card-header">
                <h3>Detail</h3>
            </div>
            <div class="card-body">
                <p><strong>Tipe : </strong>{{ ucfirst($brandPartner->type) }}</p>

                <p><strong>URL : </strong>
                    @if($brandPartner->url)
                        <a href="{{ $brandPartner->url }}" target="_blank">{{ $brandPartner->url }}</a>
                    @else
                        N/A
                    @endif
                </p>

                <p><strong>Gambar : </strong></p>
                @if($brandPartner->gambar)
                    <img src="{{ asset($brandPartner->gambar) }}" alt="Image" width="200">
                @else
                    <p>Tidak ada gambar tersedia</p>
                @endif
            </div>
        </div>

        <a href="{{ route('admin.brand.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar</a>
    </div>
@endsection