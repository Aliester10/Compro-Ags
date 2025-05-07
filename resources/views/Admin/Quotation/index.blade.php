@extends('layouts.Admin.master')

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Daftar Permintaan Quotation
        </h2>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Search Form -->
        <form action="{{ route('admin.quotations.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control"
                    placeholder="Cari berdasarkan nomor pengajuan, distributor, produk, atau status..."
                    value="{{ request()->input('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        <!-- Quotation Table -->
        <div class="card shadow-lg border-0 rounded">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead style="background: linear-gradient(135deg, #00796b, #004d40); color: #fff;">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nomor Pengajuan</th>
                            <th class="text-center">Topik</th>
                            <th class="text-center">Distributor</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #f9f9f9;">
                        @forelse($quotations as $key => $quotation)
                            <tr>
                                <td class="text-center">{{ $quotations->firstItem() + $key }}</td>
                                <td class="text-center">{{ $quotation->nomor_pengajuan ?? 'Nomor tidak tersedia' }}</td>
                                <td class="text-center">{{ $quotation->topik ?? 'Topik tidak tersedia' }}</td> 
                                <td class="text-center">{{ $quotation->user->name ?? 'Tidak ada pengguna' }}</td>
                            
                                <td class="text-center">
                                    <span
                                        class="badge 
                                @if ($quotation->status === 'cancelled') bg-danger
                                @elseif($quotation->status === 'quotation') bg-success
                                @else bg-warning @endif">
                                        {{ ucfirst($quotation->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.quotations.show', $quotation->id) }}"
                                            class="btn btn-primary btn-sm rounded-pill shadow-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        @if ($quotation->status !== 'cancelled')
                                            <a href="{{ route('admin.quotations.edit', $quotation->id) }}"
                                                class="btn btn-secondary btn-sm rounded-pill shadow-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada permintaan quotation.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination Links -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $quotations->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
