@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Tambah Admin Baru</h4>
            <a href="{{ route('admin.index') }}" class="btn btn-light btn-sm shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <!-- Tampilkan Error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control shadow-sm @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                    <div class="invalid-feedback">
                        @error('name') {{ $message }} @else Nama lengkap wajib diisi. @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control shadow-sm @error('email') is-invalid @enderror" placeholder="Masukkan email" value="{{ old('email') }}" required>
                    <div class="invalid-feedback">
                        @error('email') {{ $message }} @else Email harus valid dengan domain @gmail.com. @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password (Opsional)</label>
                    <input type="password" id="password" name="password" class="form-control shadow-sm @error('password') is-invalid @enderror" placeholder="Masukkan password">
                    <small class="form-text text-muted">Kosongkan jika ingin menggunakan password otomatis.</small>
                    <div class="invalid-feedback">
                        @error('password') {{ $message }} @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success shadow-sm">
                        <i class="fas fa-save"></i> Simpan Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
