@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4">Buat Produk Baru</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Tabs Navigation -->
                        <ul class="nav nav-tabs mb-4" id="productTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Umum</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="user-manual-tab" data-toggle="tab" href="#user-manual" role="tab" aria-controls="user-manual" aria-selected="false">Panduan Penggunaan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Dokumen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="brosur-tab" data-toggle="tab" href="#brosur" role="tab" aria-controls="brosur" aria-selected="false">Brosur</a>
                            </li>
                        </ul>

                        <!-- Tabs Content -->
                        <div class="tab-content">
                            <!-- General Tab -->
                            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                                <div class="card p-3 mb-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama Produk :</label>
                                                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="merk">Merek Produk :</label>
                                                <input type="text" name="merk" class="form-control" value="{{ old('merk') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tipe">Tipe Produk :</label>
                                                <input type="text" name="tipe" class="form-control" value="{{ old('tipe') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="link">Link E-Katalog Produk :</label>
                                                <input type="text" name="link" class="form-control" value="{{ old('link') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="kegunaan">Kegunaan Produk :</label>
                                        <textarea name="kegunaan" class="form-control" required>{{ old('kegunaan') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Produk :</label>
                                        <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="spesifikasi">Spesifikasi Produk :</label>
                                        <textarea name="spesifikasi" class="form-control" required>{{ old('spesifikasi') }}</textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="via">Via:</label>
                                                <select name="via" class="form-control" required>
                                                    <option value="labtek" {{ old('via') == 'labtek' ? 'selected' : '' }}>Labtek</option>
                                                    <option value="labverse" {{ old('via') == 'labverse' ? 'selected' : '' }}>Labverse</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sub_kategori_id">Sub Kategori :</label>
                                                <select name="sub_kategori_id" class="form-control" required>
                                                    <option value="">-- Pilih Sub Kategori --</option>
                                                    @foreach ($subKategori as $subKategoris)
                                                        <option value="{{ $subKategoris->id }}" {{ old('sub_kategori_id') == $subKategoris->id ? 'selected' : '' }}>
                                                            {{ $subKategoris->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar">Gambar Produk :</label>
                                        <input type="file" name="gambar[]" class="form-control" multiple required>
                                        <small class="form-text text-muted">Unggah beberapa gambar produk jika diperlukan.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- User Manual Tab -->
                            <div class="tab-pane fade" id="user-manual" role="tabpanel" aria-labelledby="user-manual-tab">
                                <div class="card p-3 mb-4">
                                    <div class="form-group">
                                        <label for="video">Video Tutorial (MP4, AVI, MKV)</label>
                                        <input type="file" class="form-control" name="video[]" id="video" accept="video/*" multiple>
                                        <small class="form-text text-muted">Unggah beberapa video tutorial produk jika diperlukan.</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="user_manual">Panduan Penggunaan (PDF/DOC)</label>
                                        <input type="file" class="form-control" name="user_manual" id="user_manual">
                                        @if(isset($produk) && $produk->user_manual)
                                            <a href="{{ asset($produk->user_manual) }}" target="_blank">Lihat Panduan Penggunaan</a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Documents Tab -->
                            <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                                <div class="card p-3 mb-4">
                                    <div class="form-group">
                                        <label for="document_certification_pdf">Sertifikasi Dokumen PDF:</label>
                                        <input type="file" class="form-control" name="document_certification_pdf[]" id="document_certification_pdf" accept=".pdf" multiple>
                                        <small class="form-text text-muted">Unggah beberapa Sertifikasi Dokumen PDF jika diperlukan.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Brosur Tab -->
                            <div class="tab-pane fade" id="brosur" role="tabpanel" aria-labelledby="brosur-tab">
                                <div class="card p-3 mb-4">
                                    <div class="form-group">
                                        <label for="file">Brosur (PDF/Image)</label>
                                        <input type="file" class="form-control" id="file" name="file[]" multiple>
                                        <small class="form-text text-muted">Unggah beberapa file brosur (PDF atau gambar).</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success mt-3">Simpan Produk</button>
                        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection