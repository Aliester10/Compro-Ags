@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-danger text-white text-center">
                    <h3>Penolakan Berhasil</h3>
                </div>
                <div class="card-body text-center">
                    <i class="fas fa-times-circle text-danger fa-4x mb-3"></i>
                    <h4>Pendaftaran distributor berhasil ditolak</h4>
                    <p class="lead">Email notifikasi telah dikirim kepada aplikant.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection