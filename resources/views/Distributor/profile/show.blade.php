@extends('layouts.Member.master')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card Wrapper for User Profile -->
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h2 class="mb-0">Profil Pengguna</h2>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama :</label>
                            <p class="text-muted">{{ $user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email :</label>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Perusahaan :</label>
                            <p class="text-muted">{{ $user->nama_perusahaan ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Bidang Perusahaan :</label>
                            <p class="text-muted">{{ $user->bidangPerusahaan->name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nomor Telepon :</label>
                            <p class="text-muted">{{ $user->no_telp ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Alamat :</label>
                            <p class="text-muted">{{ $user->alamat ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center bg-light py-3">
                    @if (auth()->check())
                    <a href="{{ auth()->user()->type === 'member' ? route('profile.edit') : route('distributor.profile.edit') }}" 
                       class="btn btn-primary px-4 py-2">Edit Profil</a>
                @endif
                
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
