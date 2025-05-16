@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h4 class="mb-0">Tambah Meta Baru</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.meta.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title" class="font-weight-bold">Judul</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter title" required>
                            </div>

                            <div class="form-group">
                                <label for="image" class="font-weight-bold">Gambar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Pilih gambar...</label>
                                </div>
                                <small class="form-text text-muted">Format yang diizinkan: JPG, JPEG, PNG. Maksimal 2MB.</small>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="start_date" class="font-weight-bold">Tanggal Mulai</label>
                                    <input type="date" name="start_date" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="end_date" class="font-weight-bold">Tanggal Berakhir</label>
                                    <input type="date" name="end_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">Simpan Meta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Script untuk menampilkan nama file yang dipilih pada label
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endsection