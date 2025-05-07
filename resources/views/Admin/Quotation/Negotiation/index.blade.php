@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded-3">
        <div class="card-body">
            <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Negotiations</h2>

            <!-- Flash Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Search Form -->
            <form action="{{ route('admin.quotations.negotiations.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nomor quotation,  status..."
                           value="{{ request()->input('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>

            <!-- Tabel Negotiations -->
            <div class="table-responsive">
                <table class="table table-hover shadow-sm rounded">
                    <thead style="background: linear-gradient(135deg, #00796b, #004d40); color: #fff;">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Quotation Number</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Notes</th>
                            <th class="text-center">Notes Admin</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #f9f9f9;">
                        @forelse($negotiations as $negotiation)
                            <tr>
                                <td class="text-center">{{ $negotiation->id }}</td>
                                <td class="text-center">{{ $negotiation->quotation->quotation_number }}</td>
                                <td class="text-center">
                                    <span class="badge 
                                        @if ($negotiation->status === 'pending') bg-warning
                                        @elseif ($negotiation->status === 'accepted') bg-success
                                        @else bg-danger
                                        @endif">
                                        {{ ucfirst($negotiation->status) }}
                                    </span>
                                </td>
                            <td class="text-center">{{ $negotiation->notes ?? '-' }}</td>
                            <td class="text-center">{{ $negotiation->admin_notes ?? '-' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if ($negotiation->status === 'pending' || $negotiation->status === 'in_progress')
                                        <!-- Button Proses -->
                                        <button class="btn btn-primary btn-sm rounded-pill shadow-sm" onclick="openModal({{ $negotiation->id }}, 'process')">
                                            <i class="fas fa-spinner"></i> Proses
                                        </button>
                                        <!-- Button Accept -->
                                        @if ($negotiation->status === 'in_progress')
                                            <button class="btn btn-success btn-sm rounded-pill shadow-sm" onclick="openModal({{ $negotiation->id }}, 'accept')">
                                                <i class="fas fa-check"></i> Accept
                                            </button>
                                        @endif
                                        <!-- Button Reject -->
                                        <button class="btn btn-danger btn-sm rounded-pill shadow-sm" onclick="openModal({{ $negotiation->id }}, 'reject')">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    @else
                                        <span class="text-muted">No Actions Available</span>
                                    @endif
                                </div>
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada negosiasi.</td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $negotiations->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<!-- Modal for Accept/Reject -->
<div class="modal fade" id="notesModal" tabindex="-1" aria-labelledby="notesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="notesForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="notesModalLabel" style="font-family: 'Poppins', sans-serif; color: #00796b;">Add Notes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="notes" style="font-weight: bold;">Notes</label>
                        <textarea class="form-control rounded shadow-sm" id="notes" name="notes" rows="4" placeholder="Provide additional notes here..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill shadow-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill shadow-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(id, action) {
        // Set form action URL based on the selected action
        let url = '';
        let modalTitle = '';

        if (action === 'accept') {
            url = "{{ url('/admin/quotations/negotiations') }}/" + id + "/accept";
            modalTitle = 'Accept Negotiation';
        } else if (action === 'reject') {
            url = "{{ url('/admin/quotations/negotiations') }}/" + id + "/reject";
            modalTitle = 'Reject Negotiation';
        } else if (action === 'process') {
            url = "{{ url('/admin/quotations/negotiations') }}/" + id + "/process";
            modalTitle = 'Process Negotiation';
        }

        // Set form action and modal title
        document.getElementById('notesForm').action = url;
        document.getElementById('notesModalLabel').textContent = modalTitle;

        // Show modal
        var notesModal = new bootstrap.Modal(document.getElementById('notesModal'));
        notesModal.show();
    }
</script>


@endsection
