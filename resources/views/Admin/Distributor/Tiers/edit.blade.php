@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Distributorship Tier</h1>
        <a href="{{ route('admin.distributor.tiers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Tiers
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tier Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.distributor.tiers.update', $tier->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tier_name">Tier Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('tier_name') is-invalid @enderror" id="tier_name" name="tier_name" value="{{ old('tier_name', $tier->tier_name) }}" required>
                            @error('tier_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tier_level">Tier Level<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('tier_level') is-invalid @enderror" id="tier_level" name="tier_level" value="{{ old('tier_level', $tier->tier_level) }}" required>
                            @error('tier_level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $tier->description) }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="rights">Rights & Benefits</label>
                    <textarea class="form-control @error('rights') is-invalid @enderror" id="rights" name="rights" rows="4">{{ old('rights', $tier->rights) }}</textarea>
                    @error('rights')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="obligations">Obligations</label>
                    <textarea class="form-control @error('obligations') is-invalid @enderror" id="obligations" name="obligations" rows="4">{{ old('obligations', $tier->obligations) }}</textarea>
                    @error('obligations')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $tier->is_active ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Active</label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Update Tier</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
        
    ClassicEditor
        .create(document.querySelector('#rights'))
        .catch(error => {
            console.error(error);
        });
        
    ClassicEditor
        .create(document.querySelector('#obligations'))
        .catch(error => {
            console.error(error);
        });
</script>
@endpush