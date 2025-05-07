@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1 class="card-title">Daftar Member</h1>
                    <a href="{{ route('members.create') }}" class="btn btn-primary">Tambah Member</a>
                </div>

                <div class="card-body">
                    <!-- Form Pencarian -->
                    <form action="{{ route('members.index') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama atau perusahaan..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">Cari</button>
                            </div>
                        </div>
                    </form>

                    <!-- Tabel Data -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Nomor Telepon</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($members as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->nama_perusahaan }}</td>
                                        <td>{{ $member->no_telp }}</td>
                                        <td>{{ $member->alamat }}</td>
                                        <td>
                                            <a href="{{ route('members.show', $member->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this member?');">Delete</button>
                                            </form>
                                            <a href="{{ route('members.add-products', $member->id) }}" class="btn btn-secondary btn-sm">Tambah Produk</a>
                                            <a href="{{ route('members.edit-products', $member->id) }}" class="btn btn-warning btn-sm">Edit Produk</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $members->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
