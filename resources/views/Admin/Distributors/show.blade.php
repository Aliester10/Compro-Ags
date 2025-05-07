@extends('layouts.Admin.master')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Distributor Details</h4>
        </div>
        <div class="card-body">
            <p><strong><i class="fas fa-user me-2"></i>Name:</strong> {{ $distributor->name }}</p>
            <p><strong><i class="fas fa-envelope me-2"></i>Email:</strong> {{ $distributor->email }}</p>
            <p><strong><i class="fas fa-phone me-2"></i>Phone:</strong> {{ $distributor->no_telp }}</p>
            <p><strong><i class="fas fa-map-marker-alt me-2"></i>Address:</strong> {{ $distributor->alamat }}</p>
            <p><strong><i class="fas fa-building me-2"></i>Company:</strong> {{ $distributor->nama_perusahaan }}</p>
            <p><strong><i class="fas fa-user-tie me-2"></i>Contact PIC:</strong> {{ $distributor->pic }}</p>
            <p><strong><i class="fas fa-phone-square-alt me-2"></i>PIC Phone:</strong> {{ $distributor->nomor_telp_pic }}</p>

            <p>
                <strong><i class="fas fa-file-alt me-2"></i>Akta Document:</strong> 
                <a href="{{ asset($distributor->akta) }}" target="_blank" class="text-primary">
                    <i class="fas fa-eye me-2"></i>View Document
                </a>
            </p>
            <p>
                <strong><i class="fas fa-file-alt me-2"></i>NIB Document:</strong> 
                <a href="{{ asset($distributor->nib) }}" target="_blank" class="text-primary">
                    <i class="fas fa-eye me-2"></i>View Document
                </a>
            </p>

            <p><strong><i class="fas fa-check-circle me-2"></i>Status:</strong> 
                <span class="badge {{ $distributor->verified ? 'bg-success' : 'bg-warning' }}">
                    {{ $distributor->verified ? 'Approved' : 'Pending' }}
                </span>
            </p>

            @if(!$distributor->verified)
                <form action="{{ route('admin.distributors.approve', $distributor->id) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-2"></i>Approve Distributor
                    </button>
                </form>
            @endif

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('admin.distributors.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
