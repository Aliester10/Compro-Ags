@extends('layouts.Member.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h1 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{ ucfirst($meta->type) }}</h1>
            <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item">{{ ucfirst($meta->type) }}</li>
                <li class="breadcrumb-item active text-primary">{{ ucfirst($meta->title) }}</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Meta Content Section Start -->
    <div class="container mt-5 mb-5">
        <!-- Meta Title -->
        <h1 class="mb-4">{{ $meta->title }}</h1>

        <!-- Card for Meta Content -->
        <div class="card border-light shadow-sm">
            <div class="card-body">
                <div class="content-wrapper">
                    {!! $meta->content !!}
                </div>
                <!-- Display the creation date -->
                <p class="text-muted mt-3">Created on: {{ $meta->created_at->format('d F Y') }}</p>
            </div>
        </div>
    </div>
    <!-- Meta Content Section End -->

@endsection

@section('styles')
    <!-- Custom Styles for Meta Page -->
    <style>
        .card {
            border-radius: 0.5rem;
        }

        .content-wrapper {
            padding: 1.5rem;
            border: 1px solid #e2e6ea;
            border-radius: 0.5rem;
            background-color: #f8f9fa;
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
        }

        .card-body {
            padding: 2rem;
        }

        .breadcrumb-item a {
            color: white;
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: #f8c146;
        }

        @media (max-width: 767.98px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
@endsection
