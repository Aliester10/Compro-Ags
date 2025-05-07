@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h2>Edit Member</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('members.update', $member->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nama :</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $member->name) }}" required>
                        @if ($errors->has('name'))
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email :</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $member->email) }}" required>
                        @if ($errors->has('email'))
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan :</label>
                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan', $member->nama_perusahaan) }}">
                        @if ($errors->has('nama_perusahaan'))
                            <small class="text-danger">{{ $errors->first('nama_perusahaan') }}</small>
                        @endif
                    </div>


                    <div class="form-group mb-3">
                        <label for="no_telp" class="form-label">Nomor Telepon :</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp', $member->no_telp) }}">
                        @if ($errors->has('no_telp'))
                            <small class="text-danger">{{ $errors->first('no_telp') }}</small>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="alamat" class="form-label">Alamat :</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $member->alamat) }}">
                        @if ($errors->has('alamat'))
                            <small class="text-danger">{{ $errors->first('alamat') }}</small>
                        @endif
                    </div>

                    <!-- Password Fields -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password Baru :</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="text-danger" id="password_error"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru :</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        <small class="text-danger" id="password_confirmation_error"></small>
                    </div>

                    <button type="submit" class="btn btn-success">Perbaharui</button>
                    <a href="{{ route('members.index') }}" class="btn btn-secondary">Kembali</a>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        // Ensure jQuery is properly loaded
        if (typeof $ === 'undefined') {
            console.error('jQuery is not loaded');
            return;
        }

        // Handle form submission
        $('form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var newPassword = $('#password').val();
            var confirmPassword = $('#password_confirmation').val();

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {
                        alert('Member berhasil diperbarui');
                        window.location.href = "{{ route('members.index') }}";
                    } else {
                        // Handle validation errors
                        $('#password_error').text(response.errors.password || '');
                        $('#password_confirmation_error').text(response.errors.password_confirmation || '');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
