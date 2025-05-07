@extends('layouts.Member.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Distributor Portal</h3>
            <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item active text-primary">Distributor Portal</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->
    <br><br>

    <!-- Services Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">

                <!-- Pilih Produk & Minta Quotation -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <a href="{{ route('distribution.request-quotation') }}" class="text-decoration-none">
                        <div class="service-item rounded shadow-sm">
                            <div class="service-img rounded-top bg-light d-flex justify-content-center align-items-center" style="height: 200px;">
                                <i class='bx bx-package' style="font-size: 100px; color: #00796b;"></i>
                            </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <h5 class="text-center mb-4 text-dark">Pilih Produk & Quotation</h5>
                                <div class="d-grid">
                                    <button class="btn btn-primary rounded-pill w-100 text-white">Ajukan Quotation</button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Kelola Invoice -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <a href="{{ route('distributor.invoices.index') }}" class="text-decoration-none">
                        <div class="service-item rounded shadow-sm">
                            <div class="service-img rounded-top bg-light d-flex justify-content-center align-items-center" style="height: 200px;">
                                <i class='bx bx-receipt' style="font-size: 100px; color: #00796b;"></i>
                            </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <h5 class="text-center mb-4 text-dark">Kelola Invoice</h5>
                                <div class="d-grid">
                                    <button class="btn btn-primary rounded-pill w-100 text-white">Lihat Invoice</button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Lihat Negosiasi -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <a href="{{ route('distributor.quotations.negotiations.index') }}" class="text-decoration-none">
                        <div class="service-item rounded shadow-sm">
                            <div class="service-img rounded-top bg-light d-flex justify-content-center align-items-center" style="height: 200px;">
                                <i class='bx bx-conversation' style="font-size: 100px; color: #00796b;"></i>
                            </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <h5 class="text-center mb-4 text-dark">Lihat Negosiasi</h5>
                                <div class="d-grid">
                                    <button class="btn btn-primary rounded-pill w-100 text-white">Selengkapnya</button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Kelola Proforma Invoice -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                    <a href="{{ route('distributor.proforma-invoices.index') }}" class="text-decoration-none">
                        <div class="service-item rounded shadow-sm">
                            <div class="service-img rounded-top bg-light d-flex justify-content-center align-items-center" style="height: 200px;">
                                <i class='bx bx-file' style="font-size: 100px; color: #00796b;"></i>
                            </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <h5 class="text-center mb-4 text-dark">Proforma Invoice</h5>
                                <div class="d-grid">
                                    <button class="btn btn-primary rounded-pill w-100 text-white">Lihat Proforma Invoice</button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Lihat PO -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <a href="{{ route('distributor.purchase-orders.index') }}" class="text-decoration-none">
                        <div class="service-item rounded shadow-sm">
                            <div class="service-img rounded-top bg-light d-flex justify-content-center align-items-center" style="height: 200px;">
                                <i class='bx bx-cart' style="font-size: 100px; color: #00796b;"></i>
                            </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <h5 class="text-center mb-4 text-dark">Lihat PO</h5>
                                <div class="d-grid">
                                    <button class="btn btn-primary rounded-pill w-100 text-white">Lihat PO</button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Ticketing -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                    <a href="{{ route('distribution.tickets.index') }}" class="text-decoration-none">
                        <div class="service-item rounded shadow-sm">
                            <div class="service-img rounded-top bg-light d-flex justify-content-center align-items-center" style="height: 200px;">
                                <i class='bx bx-help-circle' style="font-size: 100px; color: #00796b;"></i>
                            </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <h5 class="text-center mb-4 text-dark">Ticketing</h5>
                                <div class="d-grid">
                                    <button class="btn btn-primary rounded-pill w-100 text-white">Selengkapnya</button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- Services End -->
@endsection
