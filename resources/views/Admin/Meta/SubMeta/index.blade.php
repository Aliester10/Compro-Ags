@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Sub Meta untuk: {{ $meta->title }}</h4>
                    <div>
                        <a href="{{ route('admin.meta.index') }}" class="btn btn-secondary shadow-sm mr-2">
                            <i class="fas fa-arrow-left fa-sm"></i> Kembali
                        </a>
                        <a href="{{ route('admin.meta.submeta.create', $meta->id) }}" class="btn btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm"></i> Tambah Sub Meta
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul</th>
                                    <th>Gambar</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subMetas as $subMeta)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subMeta->title }}</td>
                                    <td>
                                        @if($subMeta->image)
                                            <img src="{{ asset($subMeta->image) }}" alt="{{ $subMeta->title }}" class="img-thumbnail" style="max-height: 50px;">
                                        @else
                                            <span class="badge badge-secondary">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.meta.submeta.edit', [$meta->id, $subMeta->id]) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.meta.submeta.destroy', [$meta->id, $subMeta->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sub meta ini?')">
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
                                    <td colspan="4" class="text-center">Tidak ada data sub meta.</td>
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