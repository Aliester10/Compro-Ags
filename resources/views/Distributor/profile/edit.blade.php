@extends('layouts.Member.master')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white text-center py-4">
            <h2 class="mb-0">Edit Profil</h2>
        </div>
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ auth()->user()->type === 'member' ? route('profile.update') : route('distributor.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama_perusahaan" class="form-label fw-bold">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan', $user->nama_perusahaan) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="bidang_perusahaan" class="form-label fw-bold">Bidang Perusahaan</label>
                        <select class="form-control" id="bidang_perusahaan" name="bidang_perusahaan" required>
                            <option value="" disabled selected>-- Select Company Field --</option>
                            @foreach ($bidangPerusahaan as $bidang)
                                <option value="{{ $bidang->id }}" {{ $user->bidang_id == $bidang->id ? 'selected' : '' }}>
                                    {{ $bidang->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="no_telp" class="form-label fw-bold">Nomor Telepon</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $user->no_telp) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="alamat" class="form-label fw-bold">Alamat</label>
                        <textarea name="alamat" class="form-control">{{ old('alamat', $user->alamat) }}</textarea>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4 py-2">Perbaharui Profil</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
