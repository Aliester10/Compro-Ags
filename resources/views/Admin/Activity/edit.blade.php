@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header">
            <h1 class="h4">Edit Aktivitas</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.activity.update', $activity) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="year" class="form-label">Tahun</label>
                    <input type="number" class="form-control" id="year" name="year" value="{{ $activity->year }}" min="1900" max="2100" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai (Opsional)</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ $activity->tanggal_mulai ? $activity->tanggal_mulai->format('Y-m-d') : '' }}">
                        <small class="text-muted">Isi jika ingin menentukan tanggal mulai kegiatan</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai (Opsional)</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ $activity->tanggal_selesai ? $activity->tanggal_selesai->format('Y-m-d') : '' }}">
                        <small class="text-muted">Isi jika kegiatan berlangsung lebih dari satu hari</small>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $activity->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ $activity->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ $activity->location }}" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="akan datang" {{ $activity->status == 'akan datang' ? 'selected' : '' }}>Akan datang</option>
                        <option value="sudah terlaksana" {{ $activity->status == 'sudah terlaksana' ? 'selected' : '' }}>Sudah Terlaksana</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="images" class="form-label">Tambah Gambar Baru</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                    <small class="text-muted">Pilih beberapa file untuk upload multiple gambar</small>
                </div>

                <div class="mb-4">
                    <label class="form-label">Gambar Saat Ini</label>
                    <div class="row">
                        @foreach($activity->images as $image)
                        <div class="col-md-3 mb-3" id="image-container-{{ $image->id }}">
                            <div class="card">
                                <img src="{{ asset('assets/img/about/'.$image->image) }}" alt="{{ $activity->title }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                <div class="card-body p-2 text-center">
                                    <button type="button" class="btn btn-sm btn-danger delete-image" data-id="{{ $image->id }}">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.activity.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.delete-image').on('click', function() {
            const imageId = $(this).data('id');
            
            if(confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                $.ajax({
                    url: '{{ url("admin/activity/destroy-image") }}/' + imageId,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if(response.success) {
                            $('#image-container-' + imageId).remove();
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menghapus gambar.');
                    }
                });
            }
        });
    });
</script>
@endpush
@endsection