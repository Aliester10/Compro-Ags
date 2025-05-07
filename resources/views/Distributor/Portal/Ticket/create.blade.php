@extends('layouts.Member.master')

@section('content')
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Buat Tiket Layanan Baru</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
            <li class="breadcrumb-item active text-primary">Buat Tiket Layanan Baru</li>
        </ol>
    </div>
</div>

<div class="container py-5">
    <div class="card shadow-sm border-0 rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Formulir Pengajuan Tiket Layanan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('distribution.tickets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="jenis_layanan" class="form-label"><i class="fas fa-cogs me-2"></i>Jenis Layanan</label>
                    <select name="jenis_layanan" id="jenis_layanan" class="form-control">
                        <option value="Permintaan Data">Permintaan Data</option>
                        <option value="Maintanance">Maintanance</option>
                        <option value="Visit">Visit</option>
                        <option value="Installasi">Installasi</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="keterangan_layanan" class="form-label"><i class="fas fa-info-circle me-2"></i>Keterangan Pengajuan</label>
                    <textarea name="keterangan_layanan" id="keterangan_layanan" class="form-control" rows="4" placeholder="Deskripsikan layanan yang Anda butuhkan..."></textarea>
                </div>

                <div class="form-group mb-4">
                    <label for="file_pendukung_layanan" class="form-label"><i class="fas fa-paperclip me-2"></i>Dokumen Pendukung (Opsional)</label>
                    <input type="file" name="file_pendukung_layanan" id="file_pendukung_layanan" class="form-control">
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('distribution.tickets.index') }}" class="btn btn-danger me-md-2">
                        <i class="fas fa-times-circle me-2"></i>Batal
                    </a>
                    
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-2"></i>Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
