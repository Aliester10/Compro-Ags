@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header">
            <h2 class="h4">Edit Lokasi</h2>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.location.update', $location->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="province">Provinsi</label>
                    <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $location->province) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="latitude">Lintang</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $location->latitude) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="longitude">Bujur</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $location->longitude) }}" required>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Perbaharui Lokasi</button>
            </form>
        </div>
    </div>
</div>
@endsection
