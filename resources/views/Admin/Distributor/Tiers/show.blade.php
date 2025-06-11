@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Distributorship Tier Details</h1>
        <div>
            <a href="{{ route('admin.distributor.tiers.edit', $tier->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.distributor.tiers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $tier->tier_name }} (Level {{ $tier->tier_level }})</h6>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="font-weight-bold">Status</h5>
                    @if($tier->is_active)
                    <span class="badge badge-success px-3 py-2">Active</span>
                    @else
                    <span class="badge badge-secondary px-3 py-2">Inactive</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <h5 class="font-weight-bold">Created By</h5>
                    <p>{{ $tier->created_by }}</p>
                </div>
            </div>

            <div class="mb-4">
                <h5 class="font-weight-bold">Description</h5>
                <div class="p-3 bg-light rounded">
                    {!! $tier->description !!}
                </div>
            </div>

            <div class="mb-4">
                <h5 class="font-weight-bold">Rights & Benefits</h5>
                <div class="p-3 bg-light rounded">
                    {!! $tier->rights !!}
                </div>
            </div>

            <div class="mb-4">
                <h5 class="font-weight-bold">Obligations</h5>
                <div class="p-3 bg-light rounded">
                    {!! $tier->obligations !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h5 class="font-weight-bold">Created At</h5>
                    <p>{{ $tier->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="font-weight-bold">Last Updated</h5>
                    <p>{{ $tier->updated_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>

            @if($tier->updated_by)
            <div class="mt-3">
                <h5 class="font-weight-bold">Updated By</h5>
                <p>{{ $tier->updated_by }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection