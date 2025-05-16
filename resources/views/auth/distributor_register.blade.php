@extends('layouts.Member.master2')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Distributor Registration</h4>
                </div>
                <div class="card-body px-5">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('distributors.register.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Name Field -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password Field with Toggle -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                                    <i class="fas fa-eye eye-icon"></i>
                                </button>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password Confirmation Field with Toggle -->
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password_confirmation">
                                    <i class="fas fa-eye eye-icon"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Phone Number Field -->
                        <div class="form-group mb-3">
                            <label for="no_telp" class="form-label">Phone Number</label>
                            <input type="text" id="no_telp" name="no_telp" class="form-control" required>
                            @error('no_telp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Address Field -->
                        <div class="form-group mb-3">
                            <label for="alamat" class="form-label">Address</label>
                            <input type="text" id="alamat" name="alamat" class="form-control" required>
                            @error('alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Company Name Field -->
                        <div class="form-group mb-3">
                            <label for="nama_perusahaan" class="form-label">Company Name</label>
                            <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control" required>
                            @error('nama_perusahaan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- PIC Field -->
                        <div class="form-group mb-3">
                            <label for="pic" class="form-label">PIC (Person in Charge)</label>
                            <input type="text" id="pic" name="pic" class="form-control" required>
                            @error('pic')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- PIC Phone Number Field -->
                        <div class="form-group mb-3">
                            <label for="nomor_telp_pic" class="form-label">PIC's Phone Number</label>
                            <input type="text" id="nomor_telp_pic" name="nomor_telp_pic" class="form-control" required>
                            @error('nomor_telp_pic')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Akta Document Upload Field -->
                        <div class="form-group mb-3">
                            <label for="akta" class="form-label">Upload Deed of Establishment (Akta)</label>
                            <input type="file" id="akta" name="akta" class="form-control" required>
                            @error('akta')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- NIB Document Upload Field -->
                        <div class="form-group mb-3">
                            <label for="nib" class="form-label">Upload NIB Document</label>
                            <input type="file" id="nib" name="nib" class="form-control" required>
                            @error('nib')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-4">Register as Distributor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Style untuk ikon mata berwarna hitam -->
<style>
    .eye-icon {
        color: #000 !important;
    }
    .toggle-password {
        background-color: #fff;
        border-color: #ced4da;
    }
    .toggle-password:hover {
        background-color: #f8f9fa;
    }
</style>

<!-- JavaScript untuk toggle password -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-password');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            // Toggle type antara password dan text
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
});
</script>
@endsection