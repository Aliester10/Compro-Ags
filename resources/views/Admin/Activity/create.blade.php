@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header ">
            <h1 class="h4">Tambah Aktivitas Baru</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.activity.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="images" class="form-label">Gambar (Multiple)</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple required>
                    <small class="text-muted">Anda dapat memilih beberapa gambar sekaligus</small>
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Tahun</label>
                    <input type="number" class="form-control" id="year" name="year" min="1900" max="2100" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai (Opsional)</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                        <small class="text-muted">Isi jika ingin menentukan tanggal mulai kegiatan</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai (Opsional)</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
                        <small class="text-muted">Isi jika kegiatan berlangsung lebih dari satu hari</small>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="akan datang">Akan datang</option>
                        <option value="sudah terlaksana">Sudah Terlaksana</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('images').addEventListener('change', function(event) {
        const previewContainer = document.createElement('div');
        previewContainer.className = 'image-previews mt-2 d-flex flex-wrap';
        
        const oldPreview = document.querySelector('.image-previews');
        if (oldPreview) oldPreview.remove();
        
        this.parentNode.appendChild(previewContainer);
        
        for (const file of event.target.files) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const preview = document.createElement('div');
                preview.className = 'position-relative me-2 mb-2';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-thumbnail';
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                
                preview.appendChild(img);
                previewContainer.appendChild(preview);
            }
            
            reader.readAsDataURL(file);
        }
    });
    
    // Tambahan script untuk validasi tanggal mulai dan tanggal selesai
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalMulaiInput = document.getElementById('tanggal_mulai');
        const tanggalSelesaiInput = document.getElementById('tanggal_selesai');
        
        // Fungsi untuk memastikan tanggal selesai selalu >= tanggal mulai
        tanggalMulaiInput.addEventListener('change', function() {
            if (this.value) {
                // Set minimal tanggal selesai ke tanggal mulai
                tanggalSelesaiInput.min = this.value;
                
                // Jika tanggal selesai sudah diisi dan lebih awal dari tanggal mulai baru
                if (tanggalSelesaiInput.value && tanggalSelesaiInput.value < this.value) {
                    tanggalSelesaiInput.value = this.value;
                }
            } else {
                // Jika tanggal mulai dihapus, hapus batasan min
                tanggalSelesaiInput.min = '';
            }
        });
        
        // Secara opsional: Set tahun ke tahun saat ini
        const currentYear = new Date().getFullYear();
        document.getElementById('year').value = currentYear;
    });
</script>
@endsection