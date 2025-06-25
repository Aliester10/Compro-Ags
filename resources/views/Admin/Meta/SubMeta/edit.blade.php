@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h4 class="mb-0">Edit Sub Meta untuk: {{ $meta->title }}</h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    
                    <form action="{{ route('admin.meta.submeta.update', [$meta->id, $subMeta->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Judul</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $subMeta->title) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="image" class="font-weight-bold">Gambar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                                <label class="custom-file-label" for="image">
                                    {{ $subMeta->image ? basename($subMeta->image) : 'Pilih gambar...' }}
                                </label>
                            </div>
                            <small class="form-text text-muted">Format gambar: JPG, JPEG, PNG, GIF. Maks 5MB.</small>
                            
                            @if($subMeta->image)
                            <div class="mt-3">
                                <p>Gambar Saat Ini:</p>
                                <img src="{{ asset($subMeta->image) }}" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                            @endif
                        </div>
                        
                        <div class="form-group text-right">
                            <a href="{{ route('admin.meta.submeta.index', $meta->id) }}" class="btn btn-secondary px-4 py-2 shadow-sm mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">Simpan Perubahan</button>
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