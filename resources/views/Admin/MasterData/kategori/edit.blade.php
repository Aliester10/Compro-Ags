@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Kategori</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama Kategori</label>
                            <input type="text" name="nama" class="form-control" value="{{ $kategori->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="icon_default">Icon Default</label>
                            <input type="file" name="icon_default" class="form-control" accept="image/*">
                            @if($kategori->icon_default)
                                <img src="{{ asset($kategori->icon_default) }}" alt="Icon Default" class="img-thumbnail mt-2" width="100">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="icon_hover">Icon Hover</label>
                            <input type="file" name="icon_hover" class="form-control" accept="image/*">
                            @if($kategori->icon_hover)
                                <img src="{{ asset($kategori->icon_hover) }}" alt="Icon Hover" class="img-thumbnail mt-2" width="100">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="url" name="url" class="form-control" value="{{ $kategori->url }}">
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