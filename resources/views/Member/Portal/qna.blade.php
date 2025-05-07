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
                        @forelse($faqs as $faq)
                            <div class="mb-5">
                                <div class="accordion" id="qnaAccordion-{{ $faq->id }}">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                                {{ $faq->pertanyaan }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}"
                                            data-bs-parent="#qnaAccordion-{{ $faq->id }}">
                                            <div class="accordion-body">
                                                <p>{{ $faq->jawaban }}</p>
                                                @if($faq->image) <!-- Check if there is an associated image -->
                                                    <img src="{{ asset($faq->image) }}" alt="Image related to FAQ" class="img-fluid mt-3">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No FAQs available.</p>
                        @endforelse
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
