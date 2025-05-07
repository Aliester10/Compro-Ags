@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4>{{ $activity->title }}</h4>
                </div>
                <div class="card-body">
                    @if ($activity->image)
                        <div class="mb-3 text-center">
                            <img src="{{ asset('images/' . $activity->image) }}" class="img-fluid img-thumbnail" alt="{{ $activity->title }}">
                        </div>
                    @endif
                    <p><strong>Tanggal :</strong> {{ $activity->date->format('d M Y') }}</p>
                    <p><strong>Deskripsi :</strong></p>
                    <p>{{ $activity->description }}</p>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.activity.index') }}" class="btn btn-primary">Kembali ke Aktivitas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
