@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid">
    <h1>Create Distributorship Tier</h1>
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="card">
        <div class="card-header">
            <h6>Tier Information</h6>
        </div>
        <div class="card-body">
            <!-- Make sure the form has the correct action and method -->
            <form action="{{ route('admin.distributor.tiers.store') }}" method="POST">
                <!-- CSRF token is required for POST requests in Laravel -->
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tier_name">Tier Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tier_name" name="tier_name" value="{{ old('tier_name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tier_level">Tier Level<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="tier_level" name="tier_level" value="{{ old('tier_level') }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="rights">Rights & Benefits</label>
                    <textarea class="form-control" id="rights" name="rights" rows="4">{{ old('rights') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="obligations">Obligations</label>
                    <textarea class="form-control" id="obligations" name="obligations" rows="4">{{ old('obligations') }}</textarea>
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
                
                <!-- Make sure this button type is submit -->
                <button type="submit" class="btn btn-primary">Create Tier</button>
            </form>
        </div>
    </div>
</div>
@endsection