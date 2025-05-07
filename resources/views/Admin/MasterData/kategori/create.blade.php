@extends('layouts.Admin.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Tambah Kategori Baru</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama Kategori</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="icon_default">Icon Default</label>
                                <input type="file" name="icon_default" class="form-control" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="icon_hover">Icon Hover</label>
                                <input type="file" name="icon_hover" class="form-control" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="url" name="url" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Simpan</button>
                            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection