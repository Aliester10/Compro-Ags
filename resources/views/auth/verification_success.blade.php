@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h3>Verifikasi Berhasil</h3>
                </div>
                <div class="card-body text-center">
                    <i class="fas fa-check-circle text-success fa-4x mb-3"></i>
                    <h4>Distributor berhasil diverifikasi</h4>
                    <p class="lead">Email konfirmasi telah dikirim kepada distributor.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection