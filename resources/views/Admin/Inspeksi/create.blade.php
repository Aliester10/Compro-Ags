@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h4 class="mb-0">Tambahkan Teknisi Baru untuk {{ $userProduk->produk->name }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.inspeksi.store', $userProduk->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="pic" class="font-weight-bold">Penanggung Jawab</label>
                                <input type="text" name="pic" class="form-control" placeholder="Enter PIC" required>
                            </div>

                            <div class="form-group">
                                <label for="waktu" class="font-weight-bold">Waktu</label>
                                <input type="datetime-local" name="waktu" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="judul" class="font-weight-bold">Judul</label>
                                <input type="text" name="judul" class="form-control" placeholder="Enter title" required>
                            </div>

                            <textarea id="froala-editor" name="deskripsi"></textarea>

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
                                    <option value="Inspeksi">Inspeksi</option>
                                    <option value="Maintenance">Maintenance</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="gambar" class="font-weight-bold">Gambar atau PDF (opsional)</label>
                                <input type="file" name="gambar" class="form-control-file">
                                <br>
                                <small class="form-text text-muted">Unggah gambar (jpeg, jpg, png) atau PDF. Maksimal ukuran file 2MB.</small>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">Simpan Teknisi</button>
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
