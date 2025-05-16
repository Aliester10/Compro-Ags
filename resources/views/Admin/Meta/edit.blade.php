@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h4 class="mb-0">Edit Meta</h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    
                    <form action="{{ route('admin.meta.update', $meta->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Metode PUT untuk meng-update data --}}

                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Judul</label>
                            <input type="text" name="title" class="form-control" value="{{ $meta->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="image" class="font-weight-bold">Gambar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                                <label class="custom-file-label" for="image">
                                    {{ $meta->image ? basename($meta->image) : 'Pilih gambar...' }}
                                </label>
                            </div>
                            <small class="form-text text-muted">Format gambar: JPG, JPEG, PNG, GIF. Maks 5MB.</small>
                            
                            @if($meta->image)
                            <div class="mt-3">
                                <p>Gambar Saat Ini:</p>
                                <img src="{{ asset($meta->image) }}" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="start_date" class="font-weight-bold">Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $meta->start_date }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="end_date" class="font-weight-bold">Tanggal Berakhir</label>
                                <input type="date" name="end_date" class="form-control" value="{{ $meta->end_date }}" required>
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

@push('scripts')
<script>
    // Script untuk menampilkan nama file saat dipilih
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endpush
@endsection