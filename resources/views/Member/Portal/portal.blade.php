@extends('layouts.Member.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Member Portal</h1>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
                    <li class="breadcrumb-item active text-primary">Member Portal</li>
                </ol>
        </div>
    </div>
    <!-- Header End --><br><br>

    <!-- Services Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded">
                        <div class="service-img rounded-top"
                            style="display: flex; justify-content: center; align-items: center; height: 200px; width: 200px; margin: 0 auto; background-color: #f8f9fa;">
                            <i class='bx bx-package' style="font-size: 200px; color: #000000;"></i>
                        </div>
                        <div class="service-content rounded-bottom bg-light p-4">
                            <div class="service-content-inner">
                                <h5 class="mb-4">{{ __('messages.my_product') }}</h5>
                                <a href="{{ route('portal.user-product') }}"
                                    class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.show_more') }} →</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded">
                        <div class="service-img rounded-top"
                            style="display: flex; justify-content: center; align-items: center; height: 200px; width: 200px; margin: 0 auto; background-color: #f8f9fa;">
                            <i class='bx bx-book' style="font-size: 200px; color: #000000;"></i>
                        </div>
                        <div class="service-content rounded-bottom bg-light p-4">
                            <div class="service-content-inner">
                                <h5 class="mb-4">{{ __('messages.user_manual') }}</h5>
                                <a href="{{ route('portal.instructions') }}"
                                    class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.show_more') }} →</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded">
                        <div class="service-img rounded-top"
                            style="display: flex; justify-content: center; align-items: center; height: 200px; width: 200px; margin: 0 auto; background-color: #f8f9fa;">
                            <i class='bx bx-file doc' style="font-size: 200px; color: #000000;"></i>
                        </div>
                        <div class="service-content rounded-bottom bg-light p-4">
                            <div class="service-content-inner">
                                <h5 class="mb-4">{{ __('messages.doc_cert') }}</h5>
                                <a href="{{ route('portal.document') }}"
                                    class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.show_more') }} →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded">
                        <div class="service-img rounded-top"
                            style="display: flex; justify-content: center; align-items: center; height: 200px; width: 200px; margin: 0 auto; background-color: #f8f9fa;">
                            <i class='bx bx-video' style="font-size: 200px; color: #000000;"></i>
                        </div>
                        <div class="service-content rounded-bottom bg-light p-4">
                            <div class="service-content-inner">
                                <h5 class="mb-4">{{ __('messages.tutor') }}</h5>
                                <a href="{{ route('portal.tutorials') }}"
                                    class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.show_more') }} →</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Ticketing -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded">
                        <div class="service-img rounded-top"
                            style="display: flex; justify-content: center; align-items: center; height: 200px; width: 200px; margin: 0 auto; background-color: #f8f9fa;">
                            <i class='bx bx-receipt' style="font-size: 200px; color: #000000;"></i>
                        </div>
                        <div class="service-content rounded-bottom bg-light p-4">
                            <div class="service-content-inner">
                                <h5 class="mb-4">{{ __('messages.ticketing') }}</h5>
                                <a href="{{ route('tickets.index') }}"
                                    class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.show_more') }} →</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded">
                        <div class="service-img rounded-top"
                            style="display: flex; justify-content: center; align-items: center; height: 200px; width: 200px; margin: 0 auto; background-color: #f8f9fa;">
                            <i class='bx bx-help-circle' style="font-size: 200px; color: #000000;"></i>
                        </div>
                        <div class="service-content rounded-bottom bg-light p-4">
                            <div class="service-content-inner">
                                <h5 class="mb-4">{{ __('messages.qna') }}</h5>
                                <a href="{{ route('portal.qna') }}"
                                    class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.show_more') }} →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->
@endsection
