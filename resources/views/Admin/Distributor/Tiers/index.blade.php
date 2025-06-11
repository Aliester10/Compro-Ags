@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Distributorship Tiers</h1>
        <a href="{{ route('admin.distributor.tiers.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Tier
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Distributorship Tiers</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tier Name</th>
                            <th>Level</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tiers as $tier)
                        <tr>
                            <td>{{ $tier->tier_name }}</td>
                            <td>{{ $tier->tier_level }}</td>
                            <td>{{ \Illuminate\Support\Str::limit(strip_tags($tier->description), 50) }}</td>
                            <td>
                                @if($tier->is_active)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $tier->created_by }}</td>
                            <td>{{ $tier->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.distributor.tiers.show', $tier->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.distributor.tiers.edit', $tier->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.distributor.tiers.toggle-active', $tier->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-{{ $tier->is_active ? 'secondary' : 'success' }} btn-sm">
                                        <i class="fas fa-{{ $tier->is_active ? 'times' : 'check' }}"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.distributor.tiers.destroy', $tier->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();

        // Confirmation for delete
        $('.delete-form').on('submit', function(e){
            e.preventDefault();
            if (confirm('Are you sure you want to delete this tier?')) {
                this.submit();
            }
        });
    });
</script>
@endpush