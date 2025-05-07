@extends('layouts.Member.master2')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="text-center">
        <h2>Registration Submitted</h2>
        <p>Your registration is complete. Please wait for admin approval before you can log in.</p>
        <p>We will notify you once your account has been verified.</p>
        
        <!-- Back to Home Button -->
        <a href="{{ url('/') }}" class="btn btn-primary mt-4">Back to Home</a>
    </div>
</div>
@endsection
