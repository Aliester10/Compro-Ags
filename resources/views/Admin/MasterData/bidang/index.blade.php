@extends('layouts.Admin.master')

@section('content')

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="h4">Daftar Sub Kategori</h2>
            <a href="{{ route('bidangperusahaan.create') }}" class="btn btn-primary">Tambah Sub Kategori</a>
        </div>

        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bidangPerusahaans as $bidangPerusahaan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bidangPerusahaan->name }}</td>
                            <td>{{ $bidangPerusahaan->kategori->nama ?? 'Tidak ada kategori' }}</td>
                            <td>
                                <a href="{{ route('bidangperusahaan.edit', $bidangPerusahaan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('bidangperusahaan.destroy', $bidangPerusahaan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus bidang ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection