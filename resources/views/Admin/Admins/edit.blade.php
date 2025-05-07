@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Admin</h4>
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

            <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control shadow-sm @error('name') is-invalid @enderror" value="{{ $admin->name }}" required>
                    <div class="invalid-feedback">
                        @error('name') {{ $message }} @else Nama lengkap wajib diisi. @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control shadow-sm @error('email') is-invalid @enderror" value="{{ $admin->email }}" required>
                    <div class="invalid-feedback">
                        @error('email') {{ $message }} @else Email harus valid dengan domain @gmail.com. @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru (Opsional)</label>
                    <input type="password" id="password" name="password" class="form-control shadow-sm">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
