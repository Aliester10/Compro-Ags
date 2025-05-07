@extends('layouts.Admin.master')

@section('content')
    <div class="container">
        <h1>Detail Teknisi untuk {{ $inspeksi->userProduk->produk->name }}</h1>

        <p><strong>PIC:</strong> {{ $inspeksi->pic }}</p>
        <p><strong>Waktu:</strong> {{ $inspeksi->waktu }}</p>
        <p><strong>Judul:</strong> {{ $inspeksi->judul }}</p>
        <p><strong>Deskripsi :</strong> {!! $inspeksi->deskripsi !!}</p>
        @if($inspeksi->gambar)
        @php
            // Get the file extension to check if it's an image or a PDF
            $fileExtension = pathinfo($inspeksi->gambar, PATHINFO_EXTENSION);
        @endphp
    
        @if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
            <!-- Display image -->
            <p><strong>Image:</strong></p>
            <img src="{{ asset('storage/' . $inspeksi->gambar) }}" alt="Inspeksi Image" width="200">
        @elseif($fileExtension === 'pdf')
            <!-- Display PDF with a preview and download option -->
            <p><strong>PDF:</strong></p>
            <!-- PDF Download/View Link -->
            <a href="{{ asset('storage/' . $inspeksi->gambar) }}" target="_blank" class="btn btn-primary">View PDF</a>
    
            <!-- Optional PDF Embed -->
            <embed src="{{ asset('storage/' . $inspeksi->gambar) }}" type="application/pdf" width="100%" height="500px" />
        @endif
    @endif
    

        <a href="{{ route('admin.inspeksi.index', $inspeksi->user_produk_id) }}" class="btn btn-primary">Kembali ke Teknisi</a>
    </div>
@endsection
