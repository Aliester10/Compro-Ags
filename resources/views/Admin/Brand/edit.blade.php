@extends('layouts.Admin.master')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header">
                <h1 class="h4">Edit Merek/Brand</h1>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.brand.update', $brandPartner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="gambar">Gambar</label>
                        @if($brandPartner->gambar)
                            <div class="mb-3">
                                <img src="{{ asset($brandPartner->gambar) }}" alt="Image" class="img-thumbnail" style="max-width: 150px;">
                            </div>
                        @endif
                        <input type="file" name="gambar" class="form-control">
                        @error('gambar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="type">Tipe</label>
                        <select name="type" class="form-control">
                            <option value="">Pilih Tipe</option>
                            <option value="brand" {{ old('type', $brandPartner->type) == 'brand' ? 'selected' : '' }}>Brand</option>
                            <option value="principal" {{ old('type', $brandPartner->type) == 'principal' ? 'selected' : '' }}>Principal</option>
                            <option value="ecommerce" {{ old('type', $brandPartner->type) == 'ecommerce' ? 'selected' : '' }}>Ecommerce</option>
                            <option value="distributor" {{ old('type', $brandPartner->type) == 'distributor' ? 'selected' : '' }}>Distributor</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="url">URL (Opsional)</label>
                        <input type="text" name="url" class="form-control" value="{{ old('url', $brandPartner->url) }}">
                        @error('url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nama">Nama (Opsional)</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $brandPartner->nama) }}">
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Perbaharui Merek/Mitra</button>
                </form>
            </div>
        </div>
    </div>
@endsection