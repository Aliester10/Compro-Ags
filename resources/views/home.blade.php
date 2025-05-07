@extends('layouts.Member.master')

@section('content')
<style>
    .category-section {
        text-align: center;
        margin-top: 50px;
        margin-bottom: 50px;
        padding: 0 15px;
    }
    .category-section h1 {
        font-weight: bold;
        font-size: 2.5rem;
        color: #0056b3;
        margin-bottom: 10px;
    }
    .category-section p {
        color: #0056b3;
        font-size: 1.2rem;
        margin-bottom: 40px;
    }
    .category-grid {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .category-row {
        display: flex;
        justify-content: center;
        gap: 30px;
        width: 100%;
        flex-wrap: wrap;
    }
    .category-card {
        display: flex;
        align-items: center;
        width: 380px;
        height: 100px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s, color 0.3s;
        text-decoration: none;
        color: inherit;
        padding: 15px 25px;
        position: relative;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        background-color: #0056b3;
        color: #ffffff;
    }
    .category-card:hover h5 {
        color: #ffffff;
    }
    .category-card img {
        width: 70px; /* Increased icon size */
        height: 70px; /* Increased icon size */
        margin-right: 20px;
        object-fit: contain;
    }
    .category-card h5 {
        font-size: 1.25rem;
        font-weight: bold;
        margin: 0;
        color: #0056b3;
        flex: 1;
    }
    .category-card:hover img.default-icon {
        display: none;
    }
    .category-card:hover img.hover-icon {
        display: block;
    }
    img.hover-icon {
        display: none;
    }
    
    /* Responsive adjustments */
    @media (max-width: 1200px) {
        .category-row {
            flex-wrap: wrap;
        }
    }
    
    @media (max-width: 768px) {
        .category-card {
            width: 320px;
        }
        .category-card img {
            width: 60px;
            height: 60px;
        }
    }
    
    @media (max-width: 576px) {
        .category-section h1 {
            font-size: 2rem;
        }
        .category-card {
            width: 100%;
        }
    }
  /* Modified partners section styles */
  .partners-section {
        text-align: center;
        margin-top: 50px;
        margin-bottom: 50px;
        padding: 0 15px;
    }
    .partners-section h1 {
        font-weight: bold;
        font-size: 2.5rem;
        color: #0056b3;
        margin-bottom: 10px;
    }
    .partners-section p {
        color: #0056b3;
        font-size: 1.2rem;
        margin-bottom: 40px;
    }
    .partners-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    .partner-item {
        display: inline-block;
        transition: transform 0.3s ease;
    }
    .partner-item:hover {
        transform: translateY(-5px);
    }
    .partner-item img {
        max-height: 80px;
        max-width: 180px;
        object-fit: contain;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .partners-grid {
            gap: 25px;
        }
        .partner-item img {
            max-height: 60px;
            max-width: 140px;
        }
    }
    
    @media (max-width: 576px) {
        .partners-section h1 {
            font-size: 2rem;
        }
        .partners-grid {
            gap: 20px;
        }
        .partner-item img {
            max-height: 50px;
            max-width: 120px;
        }
    }
    
</style>
<!-- Hero/Banner Slider Section -->
<div class="relative">
    <!-- Slider component -->
    <div class="slider-container h-screen relative overflow-hidden rounded-b-[50px]">
        <div class="slides-wrapper" id="slidesWrapper">
            @if(isset($sliders) && count($sliders) > 0)
                @foreach($sliders as $index => $slider)
                    <div class="slide absolute inset-0 w-full h-full transition-opacity duration-500 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                         style="background-image:  url('{{ asset($slider->image_url) }}'); 
                                background-size: cover; 
                                background-position: center right;">
                        <div class="container mx-auto px-6 md:px-12 h-full flex items-center">
                            <div class="w-full md:w-1/2 text-white mt-32">
                                <!-- Title -->
                                <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: {{ $slider->title_color ?? '#FFFFFF' }}">
                                    {{ $slider->title }}
                                </h1>

                                <!-- Specification -->
                                @if($slider->show_specification == 1)
                                    <hr style="border-color: {{ $slider->line_color ?? '#FFFFFF' }}; border-width: 2px; margin-bottom: 10px;">
                                    <p class="mb-4" style="color: {{ $slider->specification_color ?? '#FFFFFF' }}">
                                        {{ $slider->specification_text }}
                                    </p>
                                @endif

                                <!-- Description -->
                                <p class="text-lg md:text-xl mb-8" style="color: {{ $slider->description_color ?? '#FFFFFF' }}">
                                    {{ $slider->description }}
                                </p>

                                <!-- Button -->
                                @if($slider->show_button == 1)
                                    <a href="{{ $slider->button_url }}" target="_blank" 
                                    class="relative inline-block px-20 py-2 text-center font-semibold transition-all hover:scale-105"
                                    style="background-color: transparent; color: {{ $slider->button_text_color ?? '#000000' }};">
                                        <span class="relative z-10">{{ $slider->button_text }}</span>
                                        <span class="absolute inset-0 rounded-full" 
                                            style="background: linear-gradient(90deg, red, blue); opacity: 0.2; z-index: 0;"></span>
                                        <span class="absolute inset-0 rounded-full border-2 border-transparent" 
                                            style="background: linear-gradient(90deg, red, blue) border-box; 
                                                    -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
                                                    -webkit-mask-composite: xor;
                                                    mask-composite: exclude;"></span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Default slide if no sliders are available -->
                <div class="slide absolute inset-0 w-full h-full opacity-100"
                     style="background-image: linear-gradient(to right, rgba(0, 124, 255, 0.8), rgba(125, 185, 232, 0.4)), url('{{ asset('assets/img/banner-bg.jpg') }}'); 
                            background-size: cover; 
                            background-position: center right;">
                    <div class="container mx-auto px-6 md:px-12 h-full flex items-center">
                        <div class="w-full md:w-1/2 text-white mt-32"> <!-- Added bigger margin-top to push content below navbar -->
                            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                                Technology start-up that empowered by innovation.
                            </h1>
                            <p class="text-lg md:text-xl mb-8">
                                Arkamaya Guna Saharea is a company that focuses on innovation to support industrial development. We offer the latest technology-based solutions, as well as perfecting existing products and services with a more innovative and relevant approach.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Slider navigation dots -->
        <div class="absolute bottom-10 left-0 right-0 flex justify-center">
            <div class="flex space-x-2" id="sliderDots">
                @if(isset($sliders) && count($sliders) > 0)
                    @foreach($sliders as $index => $slider)
                        <button type="button" class="slider-dot h-3 w-3 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-white/40' }}" 
                                data-index="{{ $index }}"></button>
                    @endforeach
                @else
                    <!-- Default navigation dots -->
                    <button type="button" class="slider-dot h-3 w-3 rounded-full bg-white" data-index="0"></button>
                    <button type="button" class="slider-dot h-3 w-3 rounded-full bg-white/40" data-index="1"></button>
                    <button type="button" class="slider-dot h-3 w-3 rounded-full bg-white/40" data-index="2"></button>
                    <button type="button" class="slider-dot h-3 w-3 rounded-full bg-white/40" data-index="3"></button>
                    <button type="button" class="slider-dot h-3 w-3 rounded-full bg-white/40" data-index="4"></button>
                @endif
            </div>
        </div>
        
        <!-- Left/Right navigation arrows (optional) -->
        <button type="button" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/30 hover:bg-white/50 rounded-full p-2 focus:outline-none" id="prevSlide">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/30 hover:bg-white/50 rounded-full p-2 focus:outline-none" id="nextSlide">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>

<!-- Brand Section -->
<div class="w-full bg-white py-10 px-6 rounded-b-[50px] shadow-lg">
    <div class="container mx-auto">
        <div class="flex flex-wrap items-center justify-center">
            <!-- Horizontal layout with all elements and separators -->
            <div class="flex flex-wrap items-center justify-center gap-1">
                <!-- LABTEK (first brand) -->
                @php
                    $brand1 = DB::table('brand_partner')->where('type', 'brand')->where('nama', 'Labtek')->first();
                @endphp
                @if($brand1)
                    <div class="brand-item flex justify-center">
                        <img src="{{ asset($brand1->gambar) }}" alt="{{ $brand1->nama }}" class="h-16 md:h-16 object-contain">
                    </div>
                @endif

                <!-- Light blue separator dot -->
                <div class="h-3 w-3 rounded-full bg-blue-200"></div>

                <!-- LABVERSE (second brand) -->
                @php
                    $brand2 = DB::table('brand_partner')->where('type', 'brand')->where('nama', 'Labverse')->first();
                @endphp
                @if($brand2)
                    <div class="brand-item flex justify-center">
                        <img src="{{ asset($brand2->gambar) }}" alt="{{ $brand2->nama }}" class="h-16 md:h-16 object-contain">
                    </div>
                @endif

                <!-- Light blue separator dot -->
                <div class="h-3 w-3 rounded-full bg-blue-200"></div>

                <!-- "Our Brand" text -->
                <div class="mx-4">
                    <h3 class="text-xl md:text-2xl font-bold text-blue-500">Our Brand</h3>
                </div>

                <!-- Light blue separator dot -->
                <div class="h-3 w-3 rounded-full bg-blue-200"></div>

                <!-- MICROME (third brand) -->
                @php
                    $brand3 = DB::table('brand_partner')->where('type', 'brand')->where('nama', 'microme')->first();
                @endphp
                @if($brand3)
                    <div class="brand-item flex justify-center">
                        <img src="{{ asset($brand3->gambar) }}" alt="{{ $brand3->nama }}" class="h-16 md:h-16 object-contain">
                    </div>
                @endif

                <!-- Light blue separator dot -->
                <div class="h-3 w-3 rounded-full bg-blue-200"></div>

                <!-- VULCAN (fourth brand) -->
                @php
                    $brand4 = DB::table('brand_partner')->where('type', 'brand')->where('nama', 'Vulcan')->first();
                @endphp
                @if($brand4)
                    <div class="brand-item flex justify-center">
                        <img src="{{ asset($brand4->gambar) }}" alt="{{ $brand4->nama }}" class="h-16 md:h-16 object-contain">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container category-section">
    <h1>One Vision, Endless Solutions For Every Field</h1>
    <p>Section Products PT. Arkamaya Guna Saharsa</p>

    <div class="category-grid">
        <!-- Baris pertama (2 item) -->
        <div class="category-row">
            @foreach($categories->slice(0, 2) as $category)
            <a href="{{ $category->url }}" class="category-card">
                <img src="{{ asset($category->icon_default) }}" alt="{{ $category->nama }} Icon" class="default-icon">
                <img src="{{ asset($category->icon_hover) }}" alt="{{ $category->nama }} Hover Icon" class="hover-icon">
                <h5>{{ $category->nama }}</h5>
            </a>
            @endforeach
        </div>

        <!-- Baris kedua (3 item) -->
        <div class="category-row">
            @foreach($categories->slice(2, 3) as $category)
            <a href="{{ $category->url }}" class="category-card">
                <img src="{{ asset($category->icon_default) }}" alt="{{ $category->nama }} Icon" class="default-icon">
                <img src="{{ asset($category->icon_hover) }}" alt="{{ $category->nama }} Hover Icon" class="hover-icon">
                <h5>{{ $category->nama }}</h5>
            </a>
            @endforeach
        </div>

        <!-- Baris ketiga (2 item) -->
        <div class="category-row">
            @foreach($categories->slice(5, 2) as $category)
            <a href="{{ $category->url }}" class="category-card">
                <img src="{{ asset($category->icon_default) }}" alt="{{ $category->nama }} Icon" class="default-icon">
                <img src="{{ asset($category->icon_hover) }}" alt="{{ $category->nama }} Hover Icon" class="hover-icon">
                <h5>{{ $category->nama }}</h5>
            </a>
            @endforeach
        </div>

        <!-- Baris tambahan untuk item baru -->
        @if($categories->count() > 7)
        <div class="category-row">
            @foreach($categories->slice(7) as $category)
            <a href="{{ $category->url }}" class="category-card">
                <img src="{{ asset($category->icon_default) }}" alt="{{ $category->nama }} Icon" class="default-icon">
                <img src="{{ asset($category->icon_hover) }}" alt="{{ $category->nama }} Hover Icon" class="hover-icon">
                <h5>{{ $category->nama }}</h5>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</div>

<div class="h-px w-full bg-gray-300 my-4"></div>

<div class="container partners-section">
    <h1>Our Trusted Principal Partners</h1>
    <p>Exclusive Principal Partners of PT. Arkamaya Guna Saharsa</p>

    <div class="partners-grid">
        @foreach($principals as $principal)
        <a href="{{ $principal->url ?? '#' }}" class="partner-item">
            <img src="{{ asset($principal->gambar) }}" alt="{{ $principal->nama ?? 'Principal Partner' }} Logo">
        </a>
        @endforeach
    </div>
</div>
<div class="container distributor-section collaboration-section">
    <h1>Our Distributor</h1>
    <p>Trusted Collaboration</p>

    <!-- Swiper Container -->
    <div class="swiper-container distributor-swiper">
        <div class="swiper-wrapper">
            @foreach($distributors as $distributor)
            <div class="swiper-slide">
                <a href="{{ $distributor->url ?? '#' }}" class="distributor-link">
                    <img 
                        src="{{ asset($distributor->gambar) }}" 
                        alt="{{ $distributor->nama ?? 'Distributor Logo' }}" 
                        class="principal-logo distributor-logo"
                        loading="lazy"
                    >
                </a>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination dots -->
        <div class="swiper-pagination distributor-pagination"></div>
    </div>
</div>
<div class="h-px w-full bg-gray-300 my-4"></div>

<!-- Interactive Map Section - Starts here -->
<div class="container mx-auto my-12 px-4 text-center interactive-map-section">
    <h1 class="text-4xl font-bold text-blue-700 mb-4">Our Distribution</h1>
    <p class="text-lg text-blue-700 mb-10">Indonesia Distribution Map</p>

    <div class="map-container">
        <!-- Peta SVG Indonesia - Updated path -->
        <object
            id="svg-map"
            type="image/svg+xml"
            data="{{ asset('assets/img/maps/country (1).svg') }}"
            width="1000"
            height="500"
        ></object>

        <!-- Logo universities with correct paths -->
         <!--Jawa -->
        <img
            src="{{ asset('assets/img/maps/jawa/ITS.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 275px;
            left: 400px;
            width: 20px;
            height: 20px;
            "
            data-name="Institut Teknologi Sepuluh Nopember"
        />
        <img
            src="{{ asset('assets/img/maps/jawa/Universitas Jember.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 290px;
            left: 385px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Jember"
        />
        <img
            src="{{ asset('assets/img/maps/jawa/UPN Veteran Jawa Timur.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 265px;
            left: 380px;
            width: 20px;
            height: 20px;
            "
            data-name="UPN Veteran Jawa Timur"
        />
        <img
            src="{{ asset('assets/img/maps/jawa/UNM.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 280px;
            left: 365px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Negeri Malang"
        />
        <img
            src="{{ asset('assets/img/maps/jawa/BLK Wonogiri 1.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 260px;
            left: 354px;
            width: 18px;
            height: 18px;
            "
            data-name="BLK Wonogiri 1"
        />
        <img
            src="{{ asset('assets/img/maps/jawa/Politeknik Negeri Madiun.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 280px;
            left: 340px;
            width: 20px;
            height: 20px;
            "
            data-name="Politeknik Negeri Madiun"
        />
        <img
            src="{{ asset('assets/img/maps/jawa/Politeknik Kesehatan Semarang.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 260px;
            left: 325px;
            width: 23px;
            height: 23px;
            "
            data-name="Politeknik Kesehatan Semarang"
        />
        <img
            src="{{ asset('assets/img/maps/jawa/Politeknik Negeri Cilacap.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 275px;
            left: 305px;
            width: 25px;
            height: 25px;
            "
            data-name="Politeknik Negeri Cilacap"
        />
        <img
            src="{{ asset('assets/img/maps/jawa/Badan Nasional Penanggulangan Terorisme.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 250px;
            left: 300px;
            width: 20px;
            height: 20px;
            "
            data-name="Badan Nasional Penanggulangan Terorisme"
        />
        <img
            src="{{ asset('assets/img/maps/jawa/Kementerian Ketenagakerjaan RI.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 260px;
            left: 285px;
            width: 15px;
            height: 20px;
            "
            data-name="Kementerian Ketenagakerjaan RI"
        />
        <img
            src="{{ asset('assets/img/maps/jawa/Universitas Singaperbangsa Karawang.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 265px;
            left: 265px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Singaperbangsa Karawang"
        />
        <img
            src="{{ asset('assets/img/maps/jawa/BKKBN.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 250px;
            left: 240px;
            width: 30px;
            height: 20px;
            "
            data-name="Badan Kependudukan dan Keluarga Berencana Nasional"
        />
        <img
            src="{{ asset('assets/img/maps/jawa/Politeknik Kesehatan Banten 1.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 240px;
            left: 270px;
            width: 20px;
            height: 20px;
            "
            data-name="Politeknik Kesehatan Banten"
        />
        <!-- Bali -->
        <img
            src="{{ asset('assets/img/maps/bali/Politeknik Negeri Bali.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 285px;
            left: 430px;
            width: 20px;
            height: 20px;
            "
            data-name="Politeknik Negeri Bali"
        />
        <!-- NTT -->
        <img 
            src="{{ asset('assets/img/maps/Nusa Tenggara Timur/Universitas Nusa Cendana.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 325px;
            left: 610px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Nusa Cendana"
        />
        <!-- Maluku -->
        <img 
            src="{{ asset('assets/img/maps/Maluku/Universitas Pattimura.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 190px;
            left: 700px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Pattimura"
        />
        <!-- Papua -->
        <img 
            src="{{ asset('assets/img/maps/Papua/Universitas Cendrawasih.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 160px;
            left: 880px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Cendrawasih"
        />
        <img 
            src="{{ asset('assets/img/maps/Papua/Universitas Negeri Papua.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 140px;
            left: 770px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Negeri Papua"
        />
       <!-- Sulawesi -->
        <img 
            src="{{ asset('assets/img/maps/Sulawesi/RSUD Bumi Panua.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 110px;
            left: 600px;
            width: 20px;
            height: 20px;
            "
            data-name="RSUD Bumi Panua"
        />
        <img 
            src="{{ asset('assets/img/maps/Sulawesi/Universitas Hasanuddin.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 210px;
            left: 530px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Hasanuddin"
        />
        <img 
            src="{{ asset('assets/img/maps/Sulawesi/Universitas Negeri Makassar.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 230px;
            left: 540px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Negeri Makassar"
        />
        <img 
            src="{{ asset('assets/img/maps/Sulawesi/Universitas Tadulako.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 150px;
            left: 530px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Tadulako"
        />
        <img 
            src="{{ asset('assets/img/maps/Sulawesi/ITH.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 230px;
            left: 520px;
            width: 20px;
            height: 20px;
            "
            data-name="Institut Teknologi Halu Oleo"
        />
        <!-- Kalimantan -->
        <img 
            src="{{ asset('assets/img/maps/Kalimantan/Politeknik Tanah Laut.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 160px;
            left: 440px;
            width: 20px;
            height: 20px;
            "
            data-name="Politeknik Tanah Laut" 
        />
        <img 
            src="{{ asset('assets/img/maps/Kalimantan/Universitas Lambung Mangkurat.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 180px;
            left: 440px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Lambung Mangkurat"
        />
        <img 
            src="{{ asset('assets/img/maps/Kalimantan/Universitas Tanjungpura.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 140px;
            left: 340px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Tanjungpura"
        />
        <img 
            src="{{ asset('assets/img/maps/Kalimantan/Universitas Mulawarman.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 140px;
            left: 440px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Mulawarman"
        />
        <img 
            src="{{ asset('assets/img/maps/Kalimantan/Universitas Borneo Tarakan.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 80px;
            left: 460px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Borneo Tarakan"
        />
        <img 
            src="{{ asset('assets/img/maps/Kalimantan/Politeknik Negeri Samarinda.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 100px;
            left: 470px;
            width: 20px;
            height: 20px;
            "
            data-name="Politeknik Negeri Samarinda"
        />
        <img 
            src="{{ asset('assets/img/maps/Kalimantan/politeknik negeri balikpapan png.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 150px;
            left: 460px;
            width: 20px;
            height: 20px;
            "
            data-name="Politeknik Negeri Balikpapan"
        />
        <img 
            src="{{ asset('assets/img/maps/Kalimantan/Institut Teknologi Kalimantan.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 120px;
            left: 460px;
            width: 30px;
            height: 20px;
            "
            data-name="Institut Teknologi Kalimantan"
        />
        <img 
            src="{{ asset('assets/img/maps/Kalimantan/Dinas Kesehatan Ketapang.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 170px;
            left: 340px;
            width: 20px;
            height: 30px;
            "
            data-name="Dinas Kesehatan Ketapang"
        />
        <!--Bangka Belitung -->
        <img 
            src="{{ asset('assets/img/maps/Bangka Belitung/UBB 1.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 170px;
            left: 250px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Bangka Belitung"
        />
        <!-- Sumatera -->
        <img 
            src="{{ asset('assets/img/maps/Sumatera/Dinas Pendidikan Kepulauan Riau.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 100px;
            left: 220px;
            width: 20px;
            height: 20px;
            "
            data-name="Dinas Pendidikan Kepulauan Riau"
        />
        <img 
            src="{{ asset('assets/img/maps/Sumatera/Institut Teknologi Sumatera Logo.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 220px;
            left: 230px;
            width: 30px;
            height: 30px;
            "
            data-name="Institut Teknologi Sumatera"
        />
        <img 
            src="{{ asset('assets/img/maps/Sumatera/Universitas Negeri Sriwijaya.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 190px;
            left: 230px;
            width: 25px;
            height: 20px;
            "
            data-name="Universitas Negeri Sriwijaya"
        />
        <img 
            src="{{ asset('assets/img/maps/Sumatera/Politeknik Negeri Sriwijaya.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 170px;
            left: 220px;
            width: 20px;
            height: 20px;
            "
            data-name="Politeknik Negeri Sriwijaya"
        />
        <img 
            src="{{ asset('assets/img/maps/Sumatera/Universitas Riau.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 100px;
            left: 180px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Riau"
        />
        <img 
            src="{{ asset('assets/img/maps/Sumatera/RSUD Batu Bara.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 100px;
            left: 160px;
            width: 20px;
            height: 20px;
            "
            data-name="RSUD Batu Bara"
        />
        <img 
            src="{{ asset('assets/img/maps/Sumatera/BBPPMPV Bidang Bangunan dan Listrik Medan.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 80px;
            left: 140px;
            width: 20px;
            height: 20px;
            "
            data-name="BBPPMPV Bidang Bangunan dan Listrik Medan"
        />
        <img 
            src="{{ asset('assets/img/maps/Sumatera/UIN Aceh.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 60px;
            left: 110px;
            width: 30px;
            height: 20px;
            "
            data-name="UIN Aceh"
        />
        <img 
            src="{{ asset('assets/img/maps/Sumatera/Universitas Syah Kuala.png') }}"
            class="logo"
            style="
            position: absolute;
            top: 40px;
            left: 90px;
            width: 20px;
            height: 20px;
            "
            data-name="Universitas Syah Kuala"
        />
        <!-- Add tooltip container -->
        <div id="tooltip" class="tooltip-box" style="display: none;"></div>
    </div>
</div>

<div class="h-px w-full bg-gray-300 my-4"></div>
<!-- Interactive Map Section - Ends here -->

<!-- Lets Connect -->
<div class="lets-connect-container">
    <div class="lets-connect-content">
        <h2 class="lets-connect-heading">Let's make awesome<br>work together.</h2>
        <a href="http://127.0.0.1:8000/en/login" class="lets-connect-button">Let's Connect!</a>
    </div>
</div>

<!-- Include SwiperJS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<style>
    .lets-connect-container {
        background-image: linear-gradient(to right, #3498db, #73b6e6), url('{{ asset("assets/img/Banner Home Page Websie Ags.png") }}');
        background-size: cover;
        background-position: center;
        background-blend-mode: overlay;
        padding: 80px 0;
        margin: 0; /* Removed vertical margins */
        width: 100%;
        position: relative;
        overflow: hidden;
    }

    .lets-connect-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .lets-connect-heading {
        color: white;
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1.2;
        margin: 0;
        max-width: 600px;
    }

    .lets-connect-button {
        background-color: #e91e63;
        color: white;
        font-size: 1.25rem;
        font-weight: 600;
        padding: 15px 40px;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: none;
        cursor: pointer;
        display: inline-block;
    }

    .lets-connect-button:hover {
        background-color: #d81557;
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    /* Responsive styles */
    @media (max-width: 992px) {
        .lets-connect-heading {
            font-size: 3rem;
        }
    }

    @media (max-width: 768px) {
        .lets-connect-content {
            flex-direction: column;
            text-align: center;
            gap: 30px;
        }
        
        .lets-connect-heading {
            font-size: 2.5rem;
            max-width: 100%;
        }
    }

    @media (max-width: 576px) {
        .lets-connect-heading {
            font-size: 2rem;
        }
        
        .lets-connect-button {
            padding: 12px 30px;
            font-size: 1.1rem;
        }
        
        .lets-connect-container {
            padding: 60px 0;
        }
    }
    /* Collaboration With Principal Section Styling */
/* Distributor Section Styling */
.distributor-section {
    margin: 48px auto;
    padding: 0 16px;
    text-align: center;
    /* Add max height to prevent excessive vertical space */
    max-height: 300px; /* Adjust this value as needed */
}

.distributor-section h1 {
    font-size: 40px;
    font-weight: 600;
    color: #0066b3;
    margin-bottom: 10px;
}

.distributor-section p {
    font-size: 18px;
    color: #0066b3;
    margin-bottom: 30px; /* Reduced from 40px */
}

/* Distributor Swiper Container */
.distributor-swiper {
    width: 100%;
    /* Set explicit height to prevent extra space */
    height: 100px; /* Adjust based on your logo size */
    padding: 0; /* Removed padding that causes extra space */
    position: relative;
    overflow: hidden;
    margin-bottom: 40px; /* Add bottom margin for pagination */
}

.distributor-swiper .swiper-wrapper {
    align-items: center;
    height: 100%; /* Ensure wrapper takes full height */
}

.distributor-swiper .swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    padding: 0 10px;
}

.distributor-swiper .distributor-logo {
    max-width: 150px;
    max-height: 60px;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.distributor-link:hover .distributor-logo {
    transform: translateY(-5px);
}

/* Pagination styling - position properly */
.distributor-swiper .swiper-pagination {
    position: absolute;
    bottom: -25px; /* Position closer to the slider */
    left: 0;
    right: 0;
    height: 20px; /* Give it an explicit height */
}

.swiper-pagination-bullet {
    width: 8px;
    height: 8px;
    display: inline-block;
    border-radius: 50%;
    background: #d8d8d8;
    margin: 0 5px;
    opacity: 1;
    cursor: pointer;
}

.swiper-pagination-bullet-active {
    background: #0066b3;
    opacity: 1;
}

/* Add a clear termination to the section */
.distributor-section:after {
    content: "";
    display: block;
    clear: both;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .distributor-section h1 {
        font-size: 32px;
    }
    
    .distributor-section p {
        font-size: 16px;
    }
    
    .distributor-swiper .distributor-logo {
        max-width: 120px;
        max-height: 50px;
    }
}

    /* Interactive Map Styles */
    .interactive-map-section h1 {
        font-weight: bold;
        font-size: 2.5rem;
        color: #0056b3;
        margin-bottom: 10px;
    }
    
    .interactive-map-section p {
        color: #0056b3;
        font-size: 1.2rem;
        margin-bottom: 40px;
    }

    .map-container {
        position: relative;
        width: 100%;
        max-width: 1000px;
        margin: auto;
    }

    svg {
        width: 100%;
        height: auto;
    }

    .logo {
        cursor: pointer;
        z-index: 10;
        transition: transform 0.2s ease;
    }

    .logo:hover {
        transform: scale(1.1);
    }
    
    /* Updated Tooltip style based on the image */
    .tooltip-box {
        position: absolute;
        background-color: white;
        color: #000;
        padding: 15px 25px;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 500;
        z-index: 100;
        min-width: 200px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        pointer-events: none;
        transition: opacity 0.3s;
        border: 2px solid #0056b3;
        transform: translateX(-50%); /* Center horizontally */
    }

    .tooltip-box::after {
        content: "";
        position: absolute;
        bottom: -30px;
        left: 50%;
        margin-left: -15px;
        border-width: 15px;
        border-style: solid;
        border-color: #0056b3 transparent transparent transparent;
    }

    /* Additional styling to make the tooltip look more like the image */
    .tooltip-box::before {
        content: "";
        position: absolute;
        bottom: -26px;
        left: 50%;
        margin-left: -13px;
        border-width: 13px;
        border-style: solid;
        border-color: white transparent transparent transparent;
        z-index: 1;
    }

    /* Media queries for interactive map */
    @media (max-width: 768px) {
        .interactive-map-section h1 {
            font-size: 2rem;
        }
        
        .interactive-map-section p {
            font-size: 1rem;
            margin-bottom: 25px;
        }
        
        .tooltip-box {
            font-size: 14px;
            padding: 10px 15px;
            min-width: 150px;
        }
    }
    
    @media (max-width: 576px) {
        .interactive-map-section h1 {
            font-size: 1.75rem;
        }
        
        .tooltip-box {
            font-size: 12px;
            padding: 8px 12px;
            min-width: 120px;
        }
    }
</style>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    const distributorSwiper = new Swiper('.distributor-swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.distributor-pagination',
      clickable: true,
    },
    breakpoints: {
      // when window width is >= 480px
      480: {
        slidesPerView: 2,
        spaceBetween: 20
      },
      // when window width is >= 640px
      640: {
        slidesPerView: 3,
        spaceBetween: 30
      },
      // when window width is >= 992px
      992: {
        slidesPerView: 6,
        spaceBetween: 20
      }
    },
    // This helps resize the swiper when contents are loaded
    on: {
      init: function() {
        // Update swiper size after all images are loaded
        window.addEventListener('load', function() {
          distributorSwiper.update();
        });
      }
    }
  });
        // Tooltip functionality for university logos
        const logos = document.querySelectorAll('.logo');
        const tooltip = document.getElementById('tooltip');
        
        logos.forEach(logo => {
            // Show tooltip on hover
            logo.addEventListener('mouseenter', function(e) {
                const name = this.getAttribute('data-name');
                tooltip.textContent = name;
                
                // Position the tooltip above the logo
                const rect = this.getBoundingClientRect();
                const mapContainer = document.querySelector('.map-container');
                const mapRect = mapContainer.getBoundingClientRect();
                
                // Calculate position directly above the logo
                const logoTop = rect.top - mapRect.top;
                const logoLeft = rect.left - mapRect.left + (rect.width / 2);
                
                // Position tooltip centered above the logo
                tooltip.style.left = logoLeft + 'px';
                tooltip.style.top = (logoTop - 20) + 'px'; // 20px is for spacing between tooltip and logo
                tooltip.style.bottom = 'auto'; // Remove any bottom positioning
                tooltip.style.transform = 'translate(-50%, -100%)'; // Center horizontally and position above
                
                // Show the tooltip
                tooltip.style.display = 'block';
            });
            
            // Hide tooltip when mouse leaves
            logo.addEventListener('mouseleave', function() {
                tooltip.style.display = 'none';
            });
            
            // Also show tooltip on click for mobile users
            logo.addEventListener('click', function(e) {
                const name = this.getAttribute('data-name');
                tooltip.textContent = name;
                
                // Position the tooltip above the logo
                const rect = this.getBoundingClientRect();
                const mapContainer = document.querySelector('.map-container');
                const mapRect = mapContainer.getBoundingClientRect();
                
                // Calculate position directly above the logo
                const logoTop = rect.top - mapRect.top;
                const logoLeft = rect.left - mapRect.left + (rect.width / 2);
                
                // Position tooltip centered above the logo
                tooltip.style.left = logoLeft + 'px';
                tooltip.style.top = (logoTop - 20) + 'px'; // 20px is for spacing between tooltip and logo
                tooltip.style.bottom = 'auto'; // Remove any bottom positioning
                tooltip.style.transform = 'translate(-50%, -100%)'; // Center horizontally and position above
                
                // Show the tooltip
                tooltip.style.display = 'block';
                
                // Add a click event to the document to hide the tooltip when clicking elsewhere
                const hideTooltip = function() {
                    tooltip.style.display = 'none';
                    document.removeEventListener('click', hideTooltip);
                };
                
                // Set a timeout to add the event listener to prevent immediate firing
                setTimeout(() => {
                    document.addEventListener('click', hideTooltip);
                }, 100);
                
                e.stopPropagation();
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Slider functionality
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');
        const prevButton = document.getElementById('prevSlide');
        const nextButton = document.getElementById('nextSlide');
        
        let currentSlideIndex = 0;
        const totalSlides = slides.length;
        let slideInterval;
        
        // Initialize the slider
        function initSlider() {
            if (totalSlides <= 1) return;
            
            // Start automatic slideshow
            startSlideInterval();
            
            // Handle dot navigation clicks
            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const slideIndex = parseInt(dot.getAttribute('data-index'));
                    goToSlide(slideIndex);
                });
            });
            
            // Handle prev/next button clicks
            prevButton.addEventListener('click', () => {
                goToSlide((currentSlideIndex - 1 + totalSlides) % totalSlides);
            });
            
            nextButton.addEventListener('click', () => {
                goToSlide((currentSlideIndex + 1) % totalSlides);
            });
        }
        
        function goToSlide(index) {
            // Reset the interval when manually changing slides
            resetSlideInterval();
            
            // Hide current slide
            slides[currentSlideIndex].classList.remove('opacity-100');
            slides[currentSlideIndex].classList.add('opacity-0');
            dots[currentSlideIndex].classList.remove('bg-white');
            dots[currentSlideIndex].classList.add('bg-white/40');
            
            // Show the selected slide
            currentSlideIndex = index;
            slides[currentSlideIndex].classList.remove('opacity-0');
            slides[currentSlideIndex].classList.add('opacity-100');
            dots[currentSlideIndex].classList.remove('bg-white/40');
            dots[currentSlideIndex].classList.add('bg-white');
        }
        
        function nextSlide() {
            goToSlide((currentSlideIndex + 1) % totalSlides);
        }
        
        function startSlideInterval() {
            slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
        }
        
        function resetSlideInterval() {
            clearInterval(slideInterval);
            startSlideInterval();
        }
        
        // Initialize the slider
        initSlider();
        
        // Stop auto sliding when user hovers over the slider
        const sliderContainer = document.querySelector('.slider-container');
        sliderContainer.addEventListener('mouseenter', () => {
            clearInterval(slideInterval);
        });
        
        sliderContainer.addEventListener('mouseleave', () => {
            startSlideInterval();
        });
    });
</script>
@endsection