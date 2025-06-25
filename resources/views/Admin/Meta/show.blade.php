@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-lg mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Detail Meta</h6>
            <a href="{{ route('admin.meta.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="font-weight-bold">{{ $meta->title }}</h3>
                    <div class="mt-3 row">
                        <div class="col-md-6">
                            <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($meta->start_date)->format('d M Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Tanggal Berakhir:</strong> {{ \Carbon\Carbon::parse($meta->end_date)->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="mt-2">
                        @if($meta->content)
                            <div class="card bg-light">
                                <div class="card-body">
                                    {!! $meta->content !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    @if($meta->image)
                        <div class="text-center">
                            <img src="{{ asset($meta->image) }}" alt="{{ $meta->title }}" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Sub Meta Section -->
    @if(isset($subMetas) && count($subMetas) > 0)
    <div class="card shadow-lg mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Sub Meta List</h6>
            <a href="{{ route('admin.meta.submeta.create', $meta->id) }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Sub Meta
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($subMetas as $subMeta)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-left-primary">
                        @if($subMeta->image)
                        <img src="{{ asset($subMeta->image) }}" class="card-img-top" alt="{{ $subMeta->title }}" style="height: 180px; object-fit: cover;">
                        @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                            <span class="text-muted"><i class="fas fa-image fa-2x"></i></span>
                        </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">{{ $subMeta->title }}</h5>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.meta.submeta.edit', [$meta->id, $subMeta->id]) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.meta.submeta.destroy', [$meta->id, $subMeta->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sub meta ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @else
    <div class="card shadow-lg mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Sub Meta</h6>
            <a href="{{ route('admin.meta.submeta.create', $meta->id) }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Sub Meta
            </a>
        </div>
        <div class="card-body">
            <div class="text-center py-5">
                <i class="fas fa-folder-open fa-3x text-gray-300 mb-3"></i>
                <p class="text-muted mb-0">Belum ada Sub Meta untuk konten ini.</p>
                <p class="text-muted">Silakan tambahkan Sub Meta baru menggunakan tombol di atas.</p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection