@extends('layouts.Admin.master')

@section('content')
    <div class="container">
        <h1>Teknisi untuk {{ $userProduk->produk->name }}</h1>
        <a href="{{ route('admin.inspeksi.create', $userProduk->id) }}" class="btn btn-primary mb-3">Tambah Teknisi Baru</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>PIC</th>
                    <th>Waktu</th>
                    <th>Judul</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inspeksi as $item)
                    <tr>
                        <td>{{ $item->pic }}</td>
                        <td>{{ $item->waktu }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>
                            <a href="{{ route('admin.inspeksi.show', $item->id) }}" class="btn btn-info">Lihat</a>
                            <a href="{{ route('admin.inspeksi.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.inspeksi.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
