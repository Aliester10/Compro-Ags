@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Buat Akun Member</h2>
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

                    <form action="{{ route('members.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama :</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="gender" class="form-label">Gender :</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="" disabled selected>Pilih Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @if ($errors->has('gender'))
                                <small class="text-danger">{{ $errors->first('gender') }}</small>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="no_telp" class="form-label">Nomor Telepon :</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" required>
                            @if ($errors->has('no_telp'))
                                <small class="text-danger">{{ $errors->first('no_telp') }}</small>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="date_of_birth" class="form-label">Tanggal Lahir :</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                            @if ($errors->has('date_of_birth'))
                                <small class="text-danger">{{ $errors->first('date_of_birth') }}</small>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan :</label>
                            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}">
                            @if ($errors->has('nama_perusahaan'))
                                <small class="text-danger">{{ $errors->first('nama_perusahaan') }}</small>
                            @endif
                        </div>


                        <div class="form-group mb-3">
                            <label for="alamat" class="form-label">Alamat :</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}">
                            @if ($errors->has('alamat'))
                                <small class="text-danger">{{ $errors->first('alamat') }}</small>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="location_id" class="form-label">Lokasi :</label>
                            <select name="location_id" id="location_id" class="form-control" required>
                                <option value="" disabled selected>Pilih Lokasi</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->province }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('location_id'))
                                <small class="text-danger">{{ $errors->first('location_id') }}</small>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('members.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection