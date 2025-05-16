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
        margin-top: 70px;
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
  /* Brand Partners Section Styles */
.partners-section {
    padding: 20px 0;
    background-color: #ffffff;
    max-width: 1200px;
    margin: 0 auto;
}

.partners-section h1 {
    text-align: center;
    margin-bottom: 40px;
    font-size: 40px;
    font-weight: 700;
    color: #0F69AF; /* Blue color matching your heading */
}

/* Grid layout with reduced horizontal spacing */
.partners-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 60px 30px; /* 60px vertical spacing, 30px horizontal spacing (reduced) */
    margin: 0 auto;
    max-width: 800px; /* Reduced width to bring logos closer */
}

.partner-item {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 120px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.partner-item img {
    max-width: 100%;
    max-height: 100px;
    object-fit: contain;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .partners-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .partners-section h1 {
        font-size: 28px;
        margin-bottom: 30px;
    }
}

@media (max-width: 480px) {
    .partner-item {
        height: auto;
    }
    
    .partner-item img {
        max-height: 80px;
    }
}
</style>
<!-- Hero/Banner Slider Section -->
<div class="relative">
    <!-- Slider component -->
    <div class="slider-container relative overflow-hidden rounded-b-[50px]" style="height: calc(150vh - 120px);">
        <div class="slides-wrapper" id="slidesWrapper">
            @if(isset($sliders) && count($sliders) > 0)
                @foreach($sliders as $index => $slider)
                    <div class="slide absolute inset-0 w-full h-full transition-opacity duration-500 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                         style="background-image:  url('{{ asset($slider->image_url) }}'); 
                                background-size: cover; 
                                background-position: center right;">
                        <div class="container mx-auto px-6 md:px-12 h-full flex items-center">
                            <div class="w-full md:w-1/2 text-white mt-12">
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
            <div class="flex items-center justify-center gap-1 flex-nowrap">
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
    <h1>Our Brand</h1>
    <div class="partners-grid">
        @php
        $brands = DB::table('brand_partner')->where('type', 'brand')->get();
        @endphp
        
        @foreach($brands as $brand)
        <a href="{{ $brand->url ?? '#' }}" class="partner-item">
            <img src="{{ asset($brand->gambar) }}" alt="{{ $brand->nama }}">
        </a>
        @endforeach
    </div>
</div>
<div class="container distributor-section collaboration-section">
    <h1>Collaboration With Our Principal</h1>
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
                width="100%"
                height="auto"
            ></object>

            <!-- Logo universities with correct paths -->
             <!--Jawa -->
            <img
                src="{{ asset('assets/img/maps/jawa/ITS.png') }}"
                class="logo"
                data-name="Institut Teknologi Sepuluh Nopember"
            />
            <img
                src="{{ asset('assets/img/maps/jawa/Universitas Jember.png') }}"
                class="logo"
                data-name="Universitas Jember"
            />
            <img
                src="{{ asset('assets/img/maps/jawa/UPN Veteran Jawa Timur.png') }}"
                class="logo"
                data-name="UPN Veteran Jawa Timur"
            />
            <img
                src="{{ asset('assets/img/maps/jawa/UNM.png') }}"
                class="logo"
                data-name="Universitas Negeri Malang"
            />
            <img
                src="{{ asset('assets/img/maps/jawa/BLK Wonogiri 1.png') }}"
                class="logo"
                data-name="BLK Wonogiri 1"
            />
            <img
                src="{{ asset('assets/img/maps/jawa/Politeknik Negeri Madiun.png') }}"
                class="logo"
                data-name="Politeknik Negeri Madiun"
            />
            <img
                src="{{ asset('assets/img/maps/jawa/Politeknik Kesehatan Semarang.png') }}"
                class="logo"
                data-name="Politeknik Kesehatan Semarang"
            />
            <img
                src="{{ asset('assets/img/maps/jawa/Politeknik Negeri Cilacap.png') }}"
                class="logo"
                data-name="Politeknik Negeri Cilacap"
            />

            <img
                src="{{ asset('assets/img/maps/jawa/Kementerian Ketenagakerjaan RI.png') }}"
                class="logo"
                data-name="Kementerian Ketenagakerjaan RI"
            />
            <img
                src="{{ asset('assets/img/maps/jawa/Universitas Singaperbangsa Karawang.png') }}"
                class="logo"
                data-name="Universitas Singaperbangsa Karawang"
            />
            <img
                src="{{ asset('assets/img/maps/jawa/BKKBN.png') }}"
                class="logo"
                data-name="Badan Kependudukan dan Keluarga Berencana Nasional"
            />
            <img
                src="{{ asset('assets/img/maps/jawa/Politeknik Kesehatan Banten 1.png') }}"
                class="logo"
                data-name="Politeknik Kesehatan Banten"
            />
            <!-- Bali -->
            <img
                src="{{ asset('assets/img/maps/bali/Politeknik Negeri Bali.png') }}"
                class="logo"
                data-name="Politeknik Negeri Bali"
            />
            <!-- NTT -->
            <img 
                src="{{ asset('assets/img/maps/Nusa Tenggara Timur/Universitas Nusa Cendana.png') }}"
                class="logo"
                data-name="Universitas Nusa Cendana"
            />
            <!-- Maluku -->
            <img 
                src="{{ asset('assets/img/maps/Maluku/Universitas Pattimura.png') }}"
                class="logo"
                data-name="Universitas Pattimura"
            />
            <!-- Papua -->
            <img 
                src="{{ asset('assets/img/maps/Papua/Universitas Cendrawasih.png') }}"
                class="logo"
                data-name="Universitas Cendrawasih"
            />
            <img 
                src="{{ asset('assets/img/maps/Papua/Universitas Negeri Papua.png') }}"
                class="logo"

                data-name="Universitas Negeri Papua"
            />
           <!-- Sulawesi -->
            <img 
                src="{{ asset('assets/img/maps/Sulawesi/RSUD Bumi Panua.png') }}"
                class="logo"
                data-name="RSUD Bumi Panua"
            />
            <img 
                src="{{ asset('assets/img/maps/Sulawesi/Universitas Hasanuddin.png') }}"
                class="logo"
                data-name="Universitas Hasanuddin"
            />
            <img 
                src="{{ asset('assets/img/maps/Sulawesi/Universitas Negeri Makassar.png') }}"
                class="logo"
                data-name="Universitas Negeri Makassar"
            />
            <img 
                src="{{ asset('assets/img/maps/Sulawesi/Universitas Tadulako.png') }}"
                class="logo"
                data-name="Universitas Tadulako"
            />

            <!-- Kalimantan -->
            <img 
                src="{{ asset('assets/img/maps/Kalimantan/Politeknik Tanah Laut.png') }}"
                class="logo"
                data-name="Politeknik Tanah Laut" 
            />
            <img 
                src="{{ asset('assets/img/maps/Kalimantan/Universitas Lambung Mangkurat.png') }}"
                class="logo"
                data-name="Universitas Lambung Mangkurat"
            />
            <img 
                src="{{ asset('assets/img/maps/Kalimantan/Universitas Tanjungpura.png') }}"
                class="logo"
                data-name="Universitas Tanjungpura"
            />
            <img 
                src="{{ asset('assets/img/maps/Kalimantan/Universitas Mulawarman.png') }}"
                class="logo"
                data-name="Universitas Mulawarman"
            />
            <img 
                src="{{ asset('assets/img/maps/Kalimantan/Universitas Borneo Tarakan.png') }}"
                class="logo"
                data-name="Universitas Borneo Tarakan"
            />
            <img 
                src="{{ asset('assets/img/maps/Kalimantan/Politeknik Negeri Samarinda.png') }}"
                class="logo"
                data-name="Politeknik Negeri Samarinda"
            />
            <img 
                src="{{ asset('assets/img/maps/Kalimantan/politeknik negeri balikpapan png.png') }}"
                class="logo"
                data-name="Politeknik Negeri Balikpapan"
            />
            <img 
                src="{{ asset('assets/img/maps/Kalimantan/Institut Teknologi Kalimantan.png') }}"
                class="logo"
                data-name="Institut Teknologi Kalimantan"
            />
            <img 
                src="{{ asset('assets/img/maps/Kalimantan/Dinas Kesehatan Ketapang.png') }}"
                class="logo"
                data-name="Dinas Kesehatan Ketapang"
            />
            <!--Bangka Belitung -->
            <img 
                src="{{ asset('assets/img/maps/Bangka Belitung/UBB 1.png') }}"
                class="logo"
                data-name="Universitas Bangka Belitung"
            />
            <!-- Sumatera -->
            <img 
                src="{{ asset('assets/img/maps/Sumatera/Dinas Pendidikan Kepulauan Riau.png') }}"
                class="logo"
                data-name="Dinas Pendidikan Kepulauan Riau"
            />
            <img 
                src="{{ asset('assets/img/maps/Sumatera/Institut Teknologi Sumatera Logo.png') }}"
                class="logo"
                data-name="Institut Teknologi Sumatera"
            />
            <img 
                src="{{ asset('assets/img/maps/Sumatera/Universitas Negeri Sriwijaya.png') }}"
                class="logo"
                data-name="Universitas Negeri Sriwijaya"
            />
            <img 
                src="{{ asset('assets/img/maps/Sumatera/Politeknik Negeri Sriwijaya.png') }}"
                class="logo"
                data-name="Politeknik Negeri Sriwijaya"
            />
            <img 
                src="{{ asset('assets/img/maps/Sumatera/Universitas Riau.png') }}"
                class="logo"
                data-name="Universitas Riau"
            />
            <img 
                src="{{ asset('assets/img/maps/Sumatera/RSUD Batu Bara.png') }}"
                class="logo"
                data-name="RSUD Batu Bara"
            />
            <img 
                src="{{ asset('assets/img/maps/Sumatera/BBPPMPV Bidang Bangunan dan Listrik Medan.png') }}"
                class="logo"
                data-name="BBPPMPV Bidang Bangunan dan Listrik Medan"
            />
            <img 
                src="{{ asset('assets/img/maps/Sumatera/UIN Aceh.png') }}"
                class="logo"
                data-name="UIN Aceh"
            />
            <img 
                src="{{ asset('assets/img/maps/Sumatera/Universitas Syah Kuala.png') }}"
                class="logo"
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

/* Interactive Map Styles - Full Responsive Solution */
/* Base Map Section Styles */
.interactive-map-section {
    max-width: 100%;
    margin: 0 auto;
    position: relative;
    overflow: visible;
    padding: 20px 10px;
}

.interactive-map-section h1 {
    font-weight: bold;
    font-size: clamp(1.5rem, 4vw, 2.5rem);
    color: #0056b3;
    margin-bottom: 10px;
    text-align: center;
}
    
.interactive-map-section p {
    color: #0056b3;
    font-size: clamp(0.9rem, 2vw, 1.2rem);
    margin-bottom: clamp(15px, 4vw, 40px);
    text-align: center;
}

/* Container Styles */
.container {
    width: 100%;
    padding: 0 15px;
    margin: 0 auto;
    box-sizing: border-box;
}

/* Map Container with Aspect Ratio */
.map-container {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 56.25%; /* Keep your 16:9 aspect ratio */
    margin: 0 auto;
    overflow: visible;
    /* Add this line to create positioning context */
    transform-style: preserve-3d;
}

#svg-map {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: block;
}

/* Logo Styling */
.logo {
    position: absolute;
    width: clamp(18px, 3vw, 35px) !important;
    height: clamp(18px, 3vw, 35px) !important;
    cursor: pointer;
    transition: transform 0.2s ease;
    z-index: 10;
    transform-origin: center;
    /* Add these two properties for consistent positioning */
    transform: translate(-50%, -50%);
    margin: 0;
}

.logo:hover {
    transform: scale(1.2);
    z-index: 11;
}
.logo-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none; /* Allow clicks to pass through to SVG */
}

/* Tooltip Styling */
.tooltip-box {
    position: absolute;
    background-color: white;
    color: #000;
    padding: clamp(8px, 2vw, 15px) clamp(12px, 3vw, 25px);
    border-radius: 50px;
    font-size: clamp(12px, 1.5vw, 16px);
    font-weight: 500;
    z-index: 100;
    min-width: clamp(100px, 20vw, 200px);
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
    bottom: clamp(-20px, -3vw, -30px);
    left: 50%;
    margin-left: clamp(-10px, -1.5vw, -15px);
    border-width: clamp(10px, 1.5vw, 15px);
    border-style: solid;
    border-color: #0056b3 transparent transparent transparent;
}

.tooltip-box::before {
    content: "";
    position: absolute;
    bottom: clamp(-16px, -2.6vw, -26px);
    left: 50%;
    margin-left: clamp(-8px, -1.3vw, -13px);
    border-width: clamp(8px, 1.3vw, 13px);
    border-style: solid;
    border-color: white transparent transparent transparent;
    z-index: 1;
}


/* UPDATED Logo Positioning - Java and Sumatra logos adjusted lower and slightly right */

/* Java Region - ADJUSTED LOWER AND SLIGHTLY RIGHT */
[data-name="Institut Teknologi Sepuluh Nopember"] {
    top: 50%;
    left: 41%;
}

[data-name="Universitas Jember"] {
    top: 52%;
    left: 39.5%;
}

[data-name="UPN Veteran Jawa Timur"] {
    top: 47%;
    left: 39%;
}

[data-name="Universitas Negeri Malang"] {
    top: 50%;
    left: 37.5%;
}

[data-name="BLK Wonogiri 1"] {
    top: 47%;
    left: 36%;
}

[data-name="Politeknik Negeri Madiun"] {
    top: 50%;
    left: 34.5%;
}

[data-name="Politeknik Kesehatan Semarang"] {
    top: 47%;
    left: 33%;
}

[data-name="Politeknik Negeri Cilacap"] {
    top: 49.5%;
    left: 30.5%;
}

[data-name="Kementerian Ketenagakerjaan RI"] {
    top: 47%;
    left: 28.5%;
}

[data-name="Universitas Singaperbangsa Karawang"] {
    top: 47.5%;
    left: 26.5%;
}

[data-name="Badan Kependudukan dan Keluarga Berencana Nasional"] {
    top: 45.5%;
    left: 25%;
}

[data-name="Politeknik Kesehatan Banten"] {
    top: 45%;
    left: 27%;
}

/* Sumatera Region - ADJUSTED LOWER AND SLIGHTLY RIGHT */
[data-name="Dinas Pendidikan Kepulauan Riau"] {
    top: 20%;
    left: 21.5%;
}

[data-name="Institut Teknologi Sumatera"] {
    top: 36.5%;
    left: 22.5%;
}

[data-name="Universitas Negeri Sriwijaya"] {
    top: 32.5%;
    left: 22.5%;
}

[data-name="Politeknik Negeri Sriwijaya"] {
    top: 29.5%;
    left: 21.5%;
}

[data-name="Universitas Riau"] {
    top: 20%;
    left: 17%;
}

[data-name="RSUD Batu Bara"] {
    top: 20%;
    left: 14.5%;
}

[data-name="BBPPMPV Bidang Bangunan dan Listrik Medan"] {
    top: 17%;
    left: 12.5%;
}

[data-name="UIN Aceh"] {
    top: 8%;
    left: 9%;
}

[data-name="Universitas Syah Kuala"] {
    top: 9%;
    left: 7%;
}

/* Bali Region */
[data-name="Politeknik Negeri Bali"] {
    top: 52%;
    left: 45%;
}

/* NTT Region */
[data-name="Universitas Nusa Cendana"] {
    top: 49%;
    left: 63.5%;
}

/* Maluku Region */
[data-name="Universitas Pattimura"] {
    top: 30.5%;
    left: 73.5%;
}

/* Papua Region */
[data-name="Universitas Cendrawasih"] {
    top: 30%;
    left: 93.5%;
}

[data-name="Universitas Negeri Papua"] {
    top: 25%;
    left: 81%;
}

/* Sulawesi Region */
[data-name="RSUD Bumi Panua"] {
    top: 19.5%;
    left: 62.5%;
}

[data-name="Universitas Hasanuddin"] {
    top: 33%;
    left: 54.5%;
}

[data-name="Universitas Negeri Makassar"] {
    top: 36%;
    left: 56%;
}

[data-name="Universitas Tadulako"] {
    top: 25%;
    left: 54.5%;
}

/* Kalimantan Region */
[data-name="Politeknik Tanah Laut"] {
    top: 26%;
    left: 44.5%;
}

[data-name="Universitas Lambung Mangkurat"] {
    top: 29%;
    left: 44.5%;
}

[data-name="Universitas Tanjungpura"] {
    top: 23.5%;
    left: 33.5%;
}

[data-name="Universitas Mulawarman"] {
    top: 23.5%;
    left: 44.5%;
}

[data-name="Universitas Borneo Tarakan"] {
    top: 15%;
    left: 47%;
}

[data-name="Politeknik Negeri Samarinda"] {
    top: 18%;
    left: 48%;
}

[data-name="Politeknik Negeri Balikpapan"] {
    top: 25%;
    left: 47%;
}

[data-name="Institut Teknologi Kalimantan"] {
    top: 20.5%;
    left: 47%;
}

[data-name="Dinas Kesehatan Ketapang"] {
    top: 27.5%;
    left: 33.5%;
}

/* Bangka Belitung */
[data-name="Universitas Bangka Belitung"] {
    top: 27.5%;
    left: 23.5%;
}

/* Enhanced Responsive Media Queries */
@media (max-width: 1200px) {
    .interactive-map-section {
        padding: 15px 5px;
    }
    
    .logo:hover {
        transform: scale(1.5);
    }
}

@media (max-width: 992px) {
    .interactive-map-section h1 {
        margin-bottom: 5px;
    }
    
    .interactive-map-section p {
        margin-bottom: 20px;
    }
    
    .logo {
        transform-origin: center;
    }
}

@media (max-width: 768px) {
    .tooltip-box {
        padding: 10px 15px;
        border-radius: 30px;
    }
    
    .tooltip-box::after {
        bottom: -20px;
        border-width: 10px;
        margin-left: -10px;
    }
    
    .tooltip-box::before {
        bottom: -16px;
        border-width: 8px;
        margin-left: -8px;
    }
    
    /* Increase tap target for mobile */
  .logo {
    }
}

@media (max-width: 576px) {
    .interactive-map-section {
        padding: 10px 5px;
    }
    
    .tooltip-box {
        min-width: 110px;
        padding: 6px 10px;
        border-radius: 20px;
        border-width: 1px;
    }
    
    .tooltip-box::after {
        bottom: -15px;
        border-width: 8px;
        margin-left: -8px;
    }
    
    .tooltip-box::before {
        bottom: -11px;
        border-width: 6px;
        margin-left: -6px;
    }
}

@media (max-width: 480px) {
    .map-container {
        padding-bottom: 60%; /* Slightly taller for mobile */
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
        const logos = document.querySelectorAll('.logo');
        const tooltip = document.getElementById('tooltip');
        
        logos.forEach(logo => {
            logo.addEventListener('mouseenter', function() {
                const name = this.getAttribute('data-name');
                tooltip.textContent = name;
                tooltip.style.display = 'block';
                
                // Position tooltip above the logo
                const logoRect = this.getBoundingClientRect();
                const mapContainer = document.querySelector('.map-container');
                const mapRect = mapContainer.getBoundingClientRect();
                
                tooltip.style.left = (logoRect.left + logoRect.width/2 - mapRect.left) + 'px';
                tooltip.style.top = (logoRect.top - 50 - mapRect.top) + 'px';
            });
            
            logo.addEventListener('mouseleave', function() {
                tooltip.style.display = 'none';
            });
            
            // For touch devices
            logo.addEventListener('touchstart', function(e) {
                e.preventDefault();
                const name = this.getAttribute('data-name');
                tooltip.textContent = name;
                tooltip.style.display = 'block';
                
                const logoRect = this.getBoundingClientRect();
                const mapContainer = document.querySelector('.map-container');
                const mapRect = mapContainer.getBoundingClientRect();
                
                tooltip.style.left = (logoRect.left + logoRect.width/2 - mapRect.left) + 'px';
                tooltip.style.top = (logoRect.top - 50 - mapRect.top) + 'px';
                
                // Hide other tooltips after a short delay
                setTimeout(() => {
                    tooltip.style.display = 'none';
                }, 2000);
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