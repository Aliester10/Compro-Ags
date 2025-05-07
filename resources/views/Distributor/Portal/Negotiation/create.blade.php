@extends('layouts.Member.master')
@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Create Negotiate</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
            <li class="breadcrumb-item active text-primary">Create Negotiate</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4 rounded-3 border-0" style="background: linear-gradient(135deg, #e0f7fa, #80deea);">
                <div class="card-body">
                    <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">
                        Negotiate Quotation #{{ $quotation->quotation_number }}
                    </h2>
                    <form action="{{ route('distributor.quotations.negotiations.store', $quotation->id) }}" method="POST">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="notes" class="form-label" style="font-weight: bold; color: #004d40;">Notes</label>
                            <textarea class="form-control rounded-3 px-3 py-2 border-0 shadow-sm" id="notes" name="notes" rows="4" placeholder="Add any additional notes..."></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" style="background: #00796b; border: none;">
                                <i class="fas fa-paper-plane me-2"></i>Submit Negotiation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
