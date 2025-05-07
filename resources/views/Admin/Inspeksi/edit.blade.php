@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h4 class="mb-0">Edit Teknisi untuk {{ $inspeksi->userProduk->produk->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.inspeksi.update', ['id' => $inspeksi->id, 'userProdukId' => $inspeksi->userProduk->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="pic" class="font-weight-bold">Penanggung Jawab</label>
                            <input type="text" name="pic" class="form-control" placeholder="Enter PIC" value="{{ old('pic', $inspeksi->pic) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="waktu" class="font-weight-bold">Waktu</label>
                            <input type="datetime-local" name="waktu" class="form-control" value="{{ old('waktu', date('Y-m-d\TH:i', strtotime($inspeksi->waktu))) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="judul" class="font-weight-bold">Judul</label>
                            <input type="text" name="judul" class="form-control" placeholder="Enter title" value="{{ old('judul', $inspeksi->judul) }}" required>
                        </div>

                        <textarea id="froala-editor" name="deskripsi">{{ old('deskripsi', $inspeksi->deskripsi) }}</textarea>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                new FroalaEditor('#froala-editor', {
                                    toolbarButtons: [
                                        'bold', 'italic', 'underline', 'strikeThrough', 'align', 'formatOL', 'formatUL',
                                        'insertLink', 'insertImage', 'insertVideo', 'insertTable', 'html', 'undo', 'redo',
                                        'paragraphFormat', 'paragraphStyle', 'quote', 'fontFamily', 'fontSize',
                                        'textColor', 'backgroundColor', 'inlineStyle', 'subscript', 'superscript',
                                        'outdent', 'indent', 'clearFormatting', 'insertHR', 'fullscreen'
                                    ],
                                    heightMin: 300,
                                    heightMax: 500,
                                    imageUpload: true,
                                    videoUpload: true,
                                    quickInsertButtons: ['image', 'video', 'table', 'ul', 'ol', 'hr'],
                                    videoUploadURL: '/upload_video',  // Video upload URL (you should set this on your backend)
                                    events: {
                                        'image.beforeUpload': function (images) {
                                            // Custom image upload handler
                                        },
                                        'video.beforeUpload': function (video) {
                                            // Custom video upload handler
                                        }
                                    }
                                });
                            });
                        </script>

                        <div class="form-group">
                            <label for="status" class="font-weight-bold">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Inspeksi" {{ $inspeksi->status == 'Inspeksi' ? 'selected' : '' }}>Teknisi</option>
                                <option value="Maintenance" {{ $inspeksi->status == 'Maintenance' ? 'selected' : '' }}>Kerusakan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="gambar" class="font-weight-bold">Gambar atau PDF (opsional)</label>
                        
                            @if ($inspeksi->gambar)
                                <div class="mb-3">
                                    @php
                                        $fileExtension = pathinfo($inspeksi->gambar, PATHINFO_EXTENSION);
                                    @endphp
                        
                                    @if (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                        <!-- Display image -->
                                        <img src="{{ asset('storage/' . $inspeksi->gambar) }}" alt="Inspection Image" class="img-fluid" width="150">
                                    @elseif ($fileExtension === 'pdf')
                                        <!-- Display PDF with download and view option -->
                                        <a href="{{ asset('storage/' . $inspeksi->gambar) }}" target="_blank" class="btn btn-info">Lihat PDF</a>
                                        <embed src="{{ asset('storage/' . $inspeksi->gambar) }}" type="application/pdf" width="100%" height="500px">
                                    @endif
                                </div>
                            @endif
                        
                            <input type="file" name="gambar" class="form-control-file">
                        </div>
                        
                        

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">Perbaharui Teknisi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.12/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.12/js/froala_editor.pkgd.min.js"></script>
