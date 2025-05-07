@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="h4">Aktivitas</h1>
            <a href="{{ route('admin.activity.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Tambah Aktivitas Baru
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover" id="activityTable">
                    <thead class="thead-dark">
                    <tr>
                        <th width="15%">Gambar</th>
                        <th width="8%">Tahun</th>
                        <th width="12%">Tanggal Mulai</th>
                        <th width="12%">Tanggal Selesai</th>
                        <th width="15%">Judul</th>
                        <th width="13%">Deskripsi</th>
                        <th width="10%">Lokasi</th>
                        <th width="8%" class="text-center">Status</th>
                        <th width="7%" class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($activities as $activity)
                            <tr>
                                <td>
                                    @if($activity->images->count() > 0)
                                        <div class="position-relative">
                                            <img src="{{ asset('assets/img/about/'.$activity->images->first()->image) }}" 
                                                alt="{{ $activity->title }}" 
                                                class="img-thumbnail" 
                                                style="max-width: 100px; height: auto;">
                                            
                                            @if($activity->images->count() > 1)
                                                <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-primary">
                                                    +{{ $activity->images->count() - 1 }}
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="badge bg-secondary">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td>{{ $activity->year }}</td>
                                <td>
                                    @if($activity->tanggal_mulai)
                                        @if(is_string($activity->tanggal_mulai))
                                            {{ \Carbon\Carbon::parse($activity->tanggal_mulai)->format('d/m/Y') }}
                                        @else
                                            {{ $activity->tanggal_mulai->format('d/m/Y') }}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($activity->tanggal_selesai)
                                        @if(is_string($activity->tanggal_selesai))
                                            {{ \Carbon\Carbon::parse($activity->tanggal_selesai)->format('d/m/Y') }}
                                        @else
                                            {{ $activity->tanggal_selesai->format('d/m/Y') }}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $activity->title }}</td>
                                <td>{{ Str::limit($activity->description, 50) }}</td>
                                <td>{{ $activity->location }}</td>
                                <td class="text-center">
                                    @php
                                        $badgeClass = 'secondary'; // Default status
                                        if ($activity->status == 'akan datang') {
                                            $badgeClass = 'warning'; // Kuning untuk 'Akan Datang'
                                        } elseif ($activity->status == 'sudah terlaksana') {
                                            $badgeClass = 'success'; // Hijau untuk 'Sudah Terlaksana'
                                        }
                                    @endphp
                                    <span class="badge bg-{{ $badgeClass }}">
                                        {{ ucfirst($activity->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.activity.edit', $activity) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.activity.show', $activity) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger delete-activity" 
                                                data-id="{{ $activity->id }}" 
                                                data-title="{{ $activity->title }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                            <td colspan="9" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada aktivitas</h5>
                                        <p class="text-muted">Silahkan tambahkan aktivitas baru</p>
                                        <a href="{{ route('admin.activity.create') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-plus-circle me-1"></i> Tambah Aktivitas Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus aktivitas ini?</p>
                <p class="fw-bold" id="deleteItemTitle"></p>
                <p class="small text-danger">Semua gambar yang terkait dengan aktivitas ini juga akan dihapus.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable if available
        if ($.fn.DataTable) {
            $('#activityTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                },
                responsive: true,
                order: [[1, 'desc']] // Sort by year column descending
            });
        }

        // Delete confirmation with modal
        $('.delete-activity').on('click', function() {
            const id = $(this).data('id');
            const title = $(this).data('title');
            
            $('#deleteItemTitle').text(title);
            $('#deleteForm').attr('action', `{{ url('admin/activity') }}/${id}`);
            
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        });

        // Auto close alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    });
</script>
@endpush
@endsection