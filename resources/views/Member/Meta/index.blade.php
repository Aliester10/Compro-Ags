@extends('layouts.Member.master')

@section('content')
    <div class="container mt-5">
        <h1 class="h3 mb-4">Available Meta Content</h1>

        @if($metas->isEmpty())
            <p>No active meta content available at the moment.</p>
        @else
            @foreach($metas as $meta)
                <div class="card mb-4 shadow">
                    <div class="card-header">
                        <h3>{{ $meta->title }}</h3>
                        <p><strong>Start Date:</strong> {{ $meta->start_date }}</p>
                        <p><strong>End Date:</strong> {{ $meta->end_date }}</p>
                    </div>
                    <div class="card-body">
                        <!-- Show a preview of the content or a link to the full content -->
                        <a href="{{ route('member.meta.show', $meta->slug) }}" class="btn btn-primary">
                            View More
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
