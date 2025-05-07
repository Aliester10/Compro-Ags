@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title"><h1>Produk</h1></div>
                    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Tambah Produk Baru</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card-body">
                    <!-- Search Form -->
                    <form action="{{ route('admin.produk.index') }}" method="GET" class="mb-4">
                        <div class="row">
                            <!-- Search by Keyword -->
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari produk..." 
                                           value="{{ request()->input('search') }}">
                                </div>
                            </div>

                            <!-- Filter by Kategori -->
                            <div class="col-md-4">
                                <select name="sub_kategori" class="form-select">
                                    <option value="">Semua Sub Kategori</option>
                                    @foreach ($subKategori as $subKat)
                                        <option value="{{ $subKat->id }}" 
                                            {{ request()->input('sub_kategori') == $subKat->id ? 'selected' : '' }}>
                                            {{ $subKat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Produk</th>
                                        <th>Merk</th>
                                        <th>Via</th>
                                        <th>Sub Kategori</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produks as $produk)
                                        <tr>
                                            <td>{{ $produk->id }}</td>
                                            <td class="text-truncate" style="max-width: 150px;">{{ $produk->nama }}</td>
                                            <td class="text-truncate" style="max-width: 100px;">{{ $produk->merk }}</td>
                                            <td>{{ ucfirst($produk->via) }}</td>
                                            <td>{{ $produk->subKategori->name }}</td>
                                            <td>
                                                @foreach ($produk->images as $image)
                                                    <img src="{{ asset($image->gambar) }}" class="img-fluid w-100" alt="{{ $produk->nama }}" style="max-width: 250px; height: auto;">
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.produk.show', $produk->id) }}" class="btn btn-info btn-sm">Tampilkan</a>
                                                <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada produk ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $produks->links('pagination::bootstrap-4') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
