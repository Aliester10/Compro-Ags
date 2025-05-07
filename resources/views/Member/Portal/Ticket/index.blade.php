@extends('layouts.Member.master')

@section('content')
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Daftar Tiket Layanan</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/portal') }}">Portal Member</a></li>
            <li class="breadcrumb-item active text-primary">Daftar Tiket Layanan</li>
        </ol>
    </div>
</div>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Tiket Layanan Anda</h4>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle me-2"></i>Buat Tiket Baru</a>
    </div>

    <div class="card shadow-sm border-0 rounded">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Jenis Layanan</th>
                        <th>Keterangan Pengajuan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Tanggal Tindakan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $key => $ticket)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $ticket->jenis_layanan }}</td>
                            <td>{{ Str::limit($ticket->keterangan_layanan, 30) }}</td>
                            <td>{{ $ticket->tgl_pengajuan }}</td>
                            <td>
                                <span class="badge 
                                    @if($ticket->status == 'open') bg-success 
                                    @elseif($ticket->status == 'progress') bg-warning 
                                    @else bg-secondary @endif">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                            <td>
                                @if($ticket->status == 'open')
                                    <span class="text-muted">Belum di Proses</span>
                                @elseif($ticket->status == 'progress' && $ticket->tgl_mulai_tindakan)
                                    Mulai: {{ $ticket->tgl_mulai_tindakan }}
                                @elseif($ticket->status == 'close' && $ticket->tgl_mulai_tindakan && $ticket->tgl_selesai_tindakan)
                                    Mulai: {{ $ticket->tgl_mulai_tindakan }}<br>
                                    Selesai: {{ $ticket->tgl_selesai_tindakan }}
                                @endif
                            </td>
                            
                            <td>
                                <a href="{{ route('tickets.show', $ticket->id_after_sales) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                @if($ticket->status == 'open')
                                    <a href="{{ route('tickets.edit', $ticket->id_after_sales) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <form action="{{ route('tickets.cancel', $ticket->id_after_sales) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times-circle"></i> Batal</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada tiket layanan yang tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
