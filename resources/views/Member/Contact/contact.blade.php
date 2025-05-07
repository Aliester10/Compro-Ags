@extends('layouts.Member.master')

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Contact Us</h1>
            <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active text-primary">Contact</li>
            </ol>
    </div>
</div>
<!-- Header End --><br><br>

<!-- Contact Start -->
<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="sub-style">
                <h4 class="sub-title px-3 mb-0">Contact Information</h4>
            </div>
            <h1 class="display-3 mb-4">Contact Us For Any Query</h1>
        </div>
        <div class="container-fluid">
            <div class="row text-center justify-content-center">
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <a href="tel:(021) 85850913" class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF; text-decoration: none;">
                                <i class="fa fa-phone-alt fa-2x" style="color: white;"></i>
                            </a>
                            <h4 class="text-dark">PHONE</h4>
                            <p class="mb-0 text-dark" style="font-weight: bold;">(021) 85850913</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <a href="https://maps.app.goo.gl/tyu8r4ncFS69fCmH7" target="_blank" class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF; text-decoration: none;">
                                <i class="fa fa-map-marker-alt fa-2x" style="color: white;"></i>
                            </a>
                            <h4 class="text-dark">ADDRESS</h4>
                            <p class="mb-0 text-dark" style="font-weight: bold;">Ruko Mitra Matraman A2 No. 3 Jakarta Timur, DKI Jakarta</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <div class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF;">
                                <i class="fa fa-clock fa-2x" style="color: white;"></i>
                            </div>
                            <h4 class="text-dark">WORK TIME</h4>
                            <p class="mb-0 text-dark" style="font-weight: bold;">08.00 am to 17.00 pm</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <a href="mailto:info@labtek.id" class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF; text-decoration: none;">
                                <i class="fa fa-envelope-open fa-2x" style="color: white;"></i>
                            </a>
                            <h4 class="text-dark">EMAIL</h4>
                            <p class="mb-0 text-dark" style="font-weight: bold;">info@labtek.id</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <a href="https://www.labtek.id" target="_blank" class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF; text-decoration: none;">
                                <i class="fa fa-globe fa-2x" style="color: white;"></i>
                            </a>
                            <h4 class="text-dark">WEBSITE</h4>
                            <p class="mb-0 text-dark" style="font-weight: bold;">www.labtek.id</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br>
        <!-- Contact Details End -->

        <!-- Map Begin -->
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15865.583185041489!2d106.8600596!3d-6.2114159!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f33d51cd6119%3A0x1bc64c80b9328ca6!2sPT.%20Arkamaya%20Guna%20Saharsa!5e0!3m2!1sid!2sid!4v1724830322086!5m2!1sid!2sid" width="600" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- Map End -->
    </div>
</div><br><br><br>
<!-- Contact End -->
@endsection
