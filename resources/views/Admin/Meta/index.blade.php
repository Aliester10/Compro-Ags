@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Daftar Meta</h4>
                    <a href="{{ route('admin.meta.create') }}" class="btn btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm"></i> Tambah Meta
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul</th>
                                    <th>Gambar</th>
                                    <th width="15%">Tanggal Mulai</th>
                                    <th width="15%">Tanggal Berakhir</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($metas as $meta)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $meta->title }}</td>
                                    <td>
                                        @if($meta->image)
                                            <img src="{{ asset('assets/img/konten/' . $meta->image) }}" alt="{{ $meta->title }}" class="img-thumbnail" style="max-height: 50px;">
                                        @else
                                            <span class="badge badge-secondary">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($meta->start_date)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($meta->end_date)->format('d M Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.meta.show', $meta->slug) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.meta.edit', $meta->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.meta.destroy', $meta->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus meta ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data meta.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endpush