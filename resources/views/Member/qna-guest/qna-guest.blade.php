@extends('layouts.Member.master')

@section('content')
    <div class="container-fluid team py-5">
        <div class="container py-5">
            <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h4 class="sub-title px-3 mb-0">{{ __('messages.qna_top') }}</h4>
                </div>
                <h1 class="display-3 mb-4">{{ __('messages.qna_bottom') }}</h1>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        @forelse($qnaguests as $qnaguest)
                            <div class="mb-5">
                                <div class="accordion" id="qnaAccordion-{{ $qnaguest->id }}">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $qnaguest->id }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $qnaguest->id }}" aria-expanded="false" aria-controls="collapse{{ $qnaguest->id }}">
                                                {{ $qnaguest->pertanyaan }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $qnaguest->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $qnaguest->id }}"
                                            data-bs-parent="#qnaAccordion-{{ $qnaguest->id }}">
                                            <div class="accordion-body">
                                                <p>{{ $qnaguest->jawaban }}</p>
                                                @if($qnaguest->image)
                                                    <img src="{{ asset($qnaguest->image) }}" alt="Image related to Qna Guest" class="img-fluid mt-3">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No Qna Guest available.</p>
                        @endforelse
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
