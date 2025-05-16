@extends('layouts.Member.master')

@section('content')

<!-- Navbar Start-->

<body class="overflow-x-hidden font-WorkSans">
    @php
        $compro = \App\Models\CompanyParameter::first();
        // This query is already being passed from the controller as $ecommerces
        // We're keeping this line for the navbar only as a fallback
        $ecommercePartners = $ecommerces ?? \App\Models\BrandPartner::where('type', 'ecommerce')->get();
    @endphp
        
<!-- Font loading and default font setup -->
<link rel="stylesheet" href="{{ asset('asset/css/fonts.css') }}">
<style>
    body, h1, h2, h3, h4, h5, h6, p, a, span, div, li, button, input {
        font-family: 'Work Sans', sans-serif;
    }

    /* Set all navbar text to white */
    nav .navbar-content a,
    nav .navbar-content span,
    nav ion-icon,
    nav #ecommerce-toggle,
    nav svg {
        color: #ffffff !important;
    }
    
    nav svg {
        stroke: #ffffff !important;
    }

    .ecommerce-dropdown {
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }
    .ecommerce-dropdown.active {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .navbar-content, .navbar-content a, .navbar-content svg {
        transition: color 0.3s ease, stroke 0.3s ease;
    }

    /* Fixed ecommerce partner image sizes */
    .ecommerce-partner-img {
        object-fit: contain;
        max-height: 40px;
        width: auto;
        display: block;
        margin: 0 auto;
    }
    
    /* E-commerce dropdown styling based on image */
    #desktop-ecommerce-dropdown {
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 10px;
        width: 131px;
        height: 100px;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }
    
    #desktop-ecommerce-dropdown:before {
        content: '';
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid white;
    }
    
    .ecommerce-partner-container {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        padding: 5px;
    }
    
    .ecommerce-partner-item {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .ecommerce-partner-divider {
        height: 1px;
        background-color: #e5e7eb;
        margin: 5px 0;
        width: 100%;
    }
    
    /* Membuat teks dan ikon di dropdown profile menjadi hitam */
#profile-dropdown .profile-menu-item,
#profile-dropdown .profile-menu-item svg {
    color: #000000 !important;
    stroke: #000000 !important;
}

    /* Profile dropdown styling */
    .profile-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background-color: white;
        border-radius: 0.375rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        min-width: 10rem;
        z-index: 50;
    }
    
    .profile-dropdown.active {
        display: block;
        animation: fadeIn 0.2s ease-in-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .profile-menu-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: #374151;
        font-size: 0.875rem;
        transition: background-color 0.2s;
    }
    
    .profile-menu-item:hover {
        background-color: #f3f4f6;
    }
    
    .profile-menu-item svg {
        width: 1.25rem;
        height: 1.25rem;
        margin-right: 0.5rem;
        stroke: #4b5563;
    }
    
    .profile-menu-divider {
        height: 1px;
        background-color: #e5e7eb;
        margin: 0.25rem 0;
    }
    
    /* Search input text color */
    nav input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    
    nav input {
        color: white;
    }
    
    nav input:focus {
        border-color: white;
    }
</style>
    
<div class="absolute top-0 left-0 right-0 z-50 w-full">
    <div class="w-full bg-gray-800 bg-opacity-80 backdrop-blur-md py-2 px-4 text-center">
        <h1 class="text-white font-Work Sans text-sm md:text-base">{{ $compro->nama_perusahaan }}</h1>
    </div>
    <!-- Navbar with white text -->
<nav class="px-4 pb-4 pt-0 bg-transparent transition-all duration-300" id="mainNav">
        <div class="flex items-center justify-between relative navbar-content" id="navbarContent">
            <div class="flex items-center">
                <img class="w-[119px] h-[119px] cursor-pointer" src="{{ asset('assets/img/AGS Logo-01.png') }}" alt="Logo" onclick="window.location.href='{{ url('/') }}'">
            </div>
            <div class="flex items-center">
                <div class="md:hidden mr-4">
                    <form action="" class="relative mx-auto w-max">
                        <input type="search" 
                              class="peer cursor-pointer relative z-10 h-12 w-12 rounded-full border bg-transparent pl-12 outline-none focus:w-full focus:cursor-text focus:border-white focus:pl-16 focus:pr-4" />
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute inset-y-0 my-auto h-8 w-12 border-r border-transparent px-3.5 peer-focus:border-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </form>
                </div>
                <span class="text-3xl cursor-pointer md:hidden block z-20">
                    <ion-icon name="menu" onclick="Menu(this)"></ion-icon>
                </span>
            </div>
            <ul class="md:flex md:items-center z-10 md:z-auto md:static absolute bg-gray-800 md:bg-transparent w-full left-0 md:w-auto md:py-0 py-4 md:pl-0 pl-7 md:opacity-100 opacity-0 top-[-400px] transition-all ease-in duration-500">
                <li class="mx-4 my-6 md:my-0">
                    <a href="{{ route('home') }}" class="text-x1 hover:text-cyan-500 duration-500 font-semibold">Home</a>
                </li>
                <li class="mx-4 my-6 md:my-0">
                    <a href="{{ route('about') }}" class="text-x1 hover:text-cyan-500 duration-500 font-semibold">About</a>
                </li>
                <li class="mx-4 my-6 md:my-0">
                    <a href="{{ route('activity') }}" class="text-x1 hover:text-cyan-500 duration-500 font-semibold">Our Activities</a>
                </li>
                <li class="mx-4 my-6 md:my-0">
                    <a href="{{ route('product.index') }}" class="text-x1 hover:text-cyan-500 duration-500 font-semibold">Product</a>
                </li>
                <li class="mx-4 my-6 md:my-0 relative group" id="ecommerce-container">
                    <a href="#" class="text-x1 hover:text-cyan-500 duration-500 font-semibold" id="ecommerce-toggle">
                        E-Commerce
                    </a>
                    <!-- Updated desktop ecommerce dropdown with fixed width and height -->
                    <div id="desktop-ecommerce-dropdown" class="hidden mt-2 z-50">
                        <div class="ecommerce-partner-container">
                            @foreach($ecommercePartners as $partner)
                                <div class="ecommerce-partner-item">
                                    <a href="{{ $partner->url ?? '#' }}" class="hover:opacity-80 transition-opacity">
                                        <img src="{{ asset($partner->gambar) }}" alt="{{ $partner->nama }}" class="ecommerce-partner-img">
                                    </a>
                                </div>
                                @if(!$loop->last)
                                    <div class="ecommerce-partner-divider"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="mobile-ecommerce-dropdown" class="hidden mt-2 w-full bg-gray-700 rounded-md p-3">
                        <div class="flex flex-col gap-3">
                            @foreach($ecommercePartners as $partner)
                            <div class="flex justify-center">
                                <a href="{{ $partner->url ?? '#' }}" class="hover:opacity-80 transition-opacity">
                                    <img src="{{ asset($partner->gambar) }}" alt="{{ $partner->nama }}" class="ecommerce-partner-img">
                                </a>
                            </div>
                            @if(!$loop->last)
                                <div class="ecommerce-partner-divider"></div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </li>
                    
                <!-- Profile icon with dropdown menu -->
                <li class="mx-2 my-6 md:my-0 relative" id="profile-container">
                    @auth
                        <!-- User is logged in - show profile icon with dropdown -->
                        <div class="cursor-pointer nav-link text-xl hover:text-cyan-500 duration-500 flex items-center drop-shadow-md" id="profile-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        
                        <!-- Profile dropdown menu -->
                        <div id="profile-dropdown" class="profile-dropdown">
                            <a href="{{ route('profile.show') }}" class="profile-menu-item">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Profile
                            </a>
                            <div class="profile-menu-divider"></div>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="profile-menu-item w-full text-left">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- User is not logged in - link directly to login page -->
                        <a href="{{ route('login') }}" class="nav-link text-xl hover:text-cyan-500 duration-500 flex items-center drop-shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                    @endauth
                </li>
                    
                <li class="mx-2 my-6 md:my-0 hidden md:block">
                    <form action="" class="relative mx-auto w-max">
                        <input type="search" 
                              class="peer cursor-pointer relative z-10 h-12 w-12 rounded-full border bg-transparent pl-12 outline-none focus:w-full focus:cursor-text focus:border-white focus:pl-16 focus:pr-4" />
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute inset-y-0 my-auto h-8 w-12 border-r border-transparent px-3.5 peer-focus:border-white" fill="none" viewBox="0 0 24 24" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </form>
                </li>
            </ul>
        </div>  
    </nav>
</div>

<script>
    function Menu(e) {
        let list = document.querySelector('ul');
        if (e.name === 'menu') {
            e.name = "close";
            list.classList.add('top-[80px]');
            list.classList.add('opacity-100');
        } else {
            e.name = "menu";
            list.classList.remove('top-[80px]');
            list.classList.remove('opacity-100');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const ecommerceContainer = document.getElementById('ecommerce-container');
        const ecommerceToggle = document.getElementById('ecommerce-toggle');
        const desktopEcommerceDropdown = document.getElementById('desktop-ecommerce-dropdown');
        const mobileEcommerceDropdown = document.getElementById('mobile-ecommerce-dropdown');
        const mainNav = document.getElementById('mainNav');
        
        // Profile dropdown functionality
        const profileToggle = document.getElementById('profile-toggle');
        const profileDropdown = document.getElementById('profile-dropdown');
        
        // Only initialize dropdown functionality if user is logged in (elements exist)
        if (profileToggle && profileDropdown) {
            let isProfileDropdownOpen = false;
            
            // Profile dropdown toggle
            profileToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (isProfileDropdownOpen) {
                    profileDropdown.classList.remove('active');
                } else {
                    profileDropdown.classList.add('active');
                }
                
                isProfileDropdownOpen = !isProfileDropdownOpen;
            });
            
            // Close profile dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (isProfileDropdownOpen && !profileDropdown.contains(e.target) && !profileToggle.contains(e.target)) {
                    profileDropdown.classList.remove('active');
                    isProfileDropdownOpen = false;
                }
            });
        }

        if (ecommerceContainer && ecommerceToggle) {
            let isDropdownOpen = false;
            ecommerceToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (window.innerWidth >= 768) {
                    if (isDropdownOpen) {
                        desktopEcommerceDropdown.classList.add('hidden');
                    } else {
                        desktopEcommerceDropdown.classList.remove('hidden');
                    }
                } else {
                    if (isDropdownOpen) {
                        mobileEcommerceDropdown.classList.add('hidden');
                    } else {
                        mobileEcommerceDropdown.classList.remove('hidden');
                    }
                }
                isDropdownOpen = !isDropdownOpen;
            });

            if (desktopEcommerceDropdown) {
                desktopEcommerceDropdown.addEventListener('click', function(e) {
                    if (!e.target.closest('a')) {
                        e.stopPropagation();
                    }
                });
            }
            if (mobileEcommerceDropdown) {
                mobileEcommerceDropdown.addEventListener('click', function(e) {
                    if (!e.target.closest('a')) {
                        e.stopPropagation();
                    }
                });
            }
            document.addEventListener('click', function(e) {
                if (isDropdownOpen) {
                    if (!ecommerceContainer.contains(e.target)) {
                        if (window.innerWidth >= 768) {
                            desktopEcommerceDropdown.classList.add('hidden');
                        } else {
                            mobileEcommerceDropdown.classList.add('hidden');
                        }
                        isDropdownOpen = false;
                    }
                }
            });
            window.addEventListener('resize', function() {
                if (isDropdownOpen) {
                    if (window.innerWidth >= 768) {
                        mobileEcommerceDropdown.classList.add('hidden');
                        desktopEcommerceDropdown.classList.remove('hidden');
                    } else {
                        desktopEcommerceDropdown.classList.add('hidden');
                        mobileEcommerceDropdown.classList.remove('hidden');
                    }
                }
            });
        }
    });
</script>

<!-- navbar -->

</body>

<!-- navbar end -->

    <!-- Header Banner Section - FULL ORIGINAL SIZE WITH NO CROPPING -->
    <div class="header-banner">
        <img src="{{ asset('assets/img/header/detail-product.png') }}" alt="Header Banner" class="header-image">
        <div class="banner-overlay"></div>
        <div class="container">
            <div class="banner-content">
                <div class="title-container">
                @if($produk->kategori && $produk->kategori->icon_hover && file_exists(public_path($produk->kategori->icon_hover)))
                    <img src="{{ asset($produk->kategori->icon_hover) }}" alt="{{ $produk->kategori->nama ?? 'Category' }}" class="title-icon" style="width: 30px; height: 30px; margin-right: 10px;">
                @else
                    <i class="fas fa-th-large title-icon"></i>
                @endif
                    <span class="title-text">
                        @if($produk->kategori)
                            {{ $produk->kategori->nama }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <!-- Breadcrumbs and Back Button - EXACT MATCH -->
    <div class="breadcrumb-container">
        <div class="container">
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb-nav">
            <a href="#" class="breadcrumb-link">{{ $produk->kategori->nama  }}</a>
                <span class="breadcrumb-separator">></span>
                <a href="#" class="breadcrumb-link">{{ $produk->subKategori->name ?? 'Subcategory' }}</a>
                <span class="breadcrumb-separator">></span>
                <span class="breadcrumb-current">{{ $produk->nama }}</span>
            </div>
        </div>
            <div class="back-button-wrapper">
                <a href="javascript:history.back()" class="back-button">
                    <i class="fas fa-chevron-left"></i> Back
                </a>
            </div>
        </div>
    </div>

    <div class="container mt-4 py-4 mb-5">
        <!-- Banner Section -->
        <div class="product-detail-container">
            <div class="row">
                <!-- Left Column - Product Info -->
                <div class="col-md-8">
                    <div class="product-info-container bg-white p-4" style="border-radius: 20px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
                        <!-- Product Title -->
                        <h3 class="product-title">{{ $produk->nama }}</h3>
                        <hr class="divider">
                        
                        <!-- Description Section -->
                        <div class="product-section">
                            <h6 class="section-label">Description</h6>
                            <p id="product-description">{!! $produk->deskripsi !!}</p>
                            <a href="javascript:void(0);" id="toggle-description" class="read-more">Read More</a>
                        </div>
                        
                        <!-- Specification Section -->
                        <div class="product-section">
                            <h6 class="section-label">Specification :</h6>
                            <div id="specification-container">
                                @if($produk->spesifikasi)
                                    @php
                                        $items = preg_split("/;\s*|\n/", $produk->spesifikasi);
                                    @endphp
                                    <div id="product-specification" class="specification-text">
                                        @foreach ($items as $item)
                                            <p>{{ $item }}</p>
                                        @endforeach
                                    </div>
                                    <a href="javascript:void(0);" id="toggle-specification" class="read-more">Read More</a>
                                @else
                                    <p>Specifications not available.</p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Product Details Section - WITH DIVIDERS AFTER EACH ROW -->
                        <div class="product-details-section">
                            <div class="detail-row">
                                <div class="detail-label">Brand</div>
                                <div class="detail-value">{{ $produk->merk }}</div>
                            </div>
                            <hr class="divider">
                            
                            <div class="detail-row">
                                <div class="detail-label">Type</div>
                                <div class="detail-value">{{ $produk->tipe }}</div>
                            </div>
                            <hr class="divider">
                            
                            <div class="detail-row">
                                <div class="detail-label">Harga</div>
                                <div class="detail-value">Rp{{ number_format($produk->harga ?? 0, 0, ',', '.') }}</div>
                            </div>
                            <hr class="divider">
                        </div>
                        
                        <!-- Buy Now Button -->
                        <div class="buy-now-container">
                            <a href="#" class="btn buy-now-btn">Buy Now</a>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Product Images -->
                <div class="col-md-4">
                    <div class="product-image-container bg-white p-3" style="border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
                        @if ($produk->images->count() > 0)
                            <!-- Main Product Image -->
                            <div id="productImageCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                                <div class="carousel-inner">
                                    @foreach ($produk->images as $key => $image)
                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                            <div class="main-image-wrapper">
                                                <img src="{{ asset($image->gambar) }}" alt="{{ $produk->nama }}" class="img-fluid main-product-image">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Thumbnail Images -->
                            <div class="product-thumbnails mt-3">
                                <div class="row g-2">
                                    @php
                                        $thumbnailImages = $produk->images;
                                        $imageCount = $thumbnailImages->count();
                                        $displayImages = [];
                                        
                                        if ($imageCount == 1) {
                                            $singleImage = $thumbnailImages->first();
                                            $displayImages = [$singleImage, $singleImage, $singleImage];
                                        } else {
                                            $displayImages = $thumbnailImages->take(3);
                                        }
                                    @endphp
                                    
                                    @foreach ($displayImages as $key => $image)
                                        <div class="col-4">
                                            <div class="thumbnail-item {{ $key == 0 ? 'active' : '' }}" 
                                                data-bs-target="#productImageCarousel" 
                                                data-bs-slide-to="{{ $key < $imageCount ? $key : 0 }}">
                                                <img src="{{ asset($image->gambar) }}" 
                                                    class="img-fluid thumbnail-img">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="main-image-wrapper">
                                <img src="{{ asset('assets/img/default.jpg') }}" alt="{{ $produk->nama }}"
                                    class="img-fluid main-product-image">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Spacer -->
        <div class="my-5"></div>

        <!-- Similar Products Section -->
        <div class="similar-products-container mt-5">
            <h3 class="section-title text-center mb-4">Similar Product.</h3>
            
            <div class="row">
                @if ($produk->images->count() > 0) 
                    @foreach ($produkSerupa as $similarProduct)
                        <div class="col-md-3 mb-4">
                            <div class="similar-product-card">
                                <a href="{{ route('product.show', $similarProduct->id) }}" class="similar-product-link">
                                    <div class="similar-product-img-container">
                                        <img src="{{ asset($similarProduct->images->first()->gambar ?? 'assets/img/default.jpg') }}"
                                            class="img-fluid similar-product-img" alt="{{ $similarProduct->nama }}">
                                    </div>
                                    <div class="similar-product-info text-center p-2">
                                        <h6 class="similar-product-name">{{ $similarProduct->nama }}</h6>
                                        <a href="{{ route('product.show', $similarProduct->id) }}" class="btn btn-sm btn-outline-primary detail-btn">Read More</a>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        /* BACKGROUND GRADIENT */
        body {
            background: linear-gradient(to right, 
                #dfefff 0%, 
                #dfefff 15%, 
                white 35%, 
                white 65%, 
                #dfefff 85%, 
                #dfefff 100%);
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }
        
        /* Header Banner Styles - UPDATED FOR ORIGINAL SIZE IMAGE */
        .header-banner {
            margin-top: 30px;
            position: relative;
            height: 237px;
            width: 100%;
            overflow: hidden;
        }
        
        .header-image {
            display: block;
            width: 100%;
            height: auto;
        }
        
        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
        }
        
        .banner-content {
            position: absolute;
            z-index: 2;
            top: 50%;
            right: 10%;
            transform: translateY(-50%);
        }
        
        .title-container {
            display: flex;
            padding-top: 80px;
        }
        
        .title-icon {
            margin-right: 10px;
            font-size: 20px;
        }
        
        .title-text {
            font-size: 20px;
            font-weight: 600;
        }
        
        /* Breadcrumbs and Back Button Styles - EXACT MATCH */
        .breadcrumb-container {
            background-color:rgba(184, 207, 230, 0);
            padding: 0;
        }
        
        .breadcrumb-wrapper {
            padding: 12px 0;
        }
        
        .breadcrumb-nav {
            color: #8a9db5;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .breadcrumb-link {
            color: #8a9db5;
            text-decoration: none;
        }
        
        .breadcrumb-link:hover {
            color: #007bff;
        }
        
        .breadcrumb-separator {
            margin: 0 8px;
            color: #8a9db5;
        }
        
        .breadcrumb-current {
            color:rgb(0, 0, 0);

            font-weight: 700;
        }
        
        .back-button-wrapper {
            margin-top: 5px;
            padding-bottom: 12px;
        }
        
        .back-button {
            color: #8a9db5;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
        }
        
        .back-button:hover {
            color: #007bff;
        }
        
        .back-button i {
            margin-right: 5px;
            font-size: 12px;
        }
        
        /* Product Detail Page Styles */
        .product-detail-container {
            padding: 20px;
        }
        
        .product-info-container {
            border-radius: 20px !important;
            height: 100%;
            position: relative;
        }
        
        /* Product Title */
        .product-title {
            font-size: 24px;
            color: #000;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        /* Section Styling */
        .product-section {
            margin-bottom: 25px;
        }
        
        .section-label {
            font-weight: 700;
            color: #000;
            font-size: 16px;
            margin-bottom: 10px;
        }
        
        /* Dividers - BLACK COLOR */
        .divider {
            border: 0;
            border-top: 3px solid #000;
            margin: 3px 0;
        }
        
        /* Specification Text */
        .specification-text p {
            margin-bottom: 5px;
            color: #333;
        }
        
        /* Product Details */
        .product-details-section {
            margin-top: 25px;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 0;
            padding: 8px 0;
        }
        
        .detail-label {
            font-weight: 700;
            color: #000;
            min-width: 80px;
        }
        
        .detail-value {
            color: #333;
            margin-left: 20px;
        }
        
        /* Buy Now Button - IN RIGHT CORNER */
        .buy-now-container {
            margin-top: 25px;
            text-align: right;
            padding-right: 20px;
        }
        
        .buy-now-btn {
            width: 204px;
            height: 46px;
            border-radius: 40px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
            font-size: 16px;
            background-color: #BDDEFF;
            color: #000;
            border: none;
        }
        
        .buy-now-btn:hover {
            background-color: #a5d0fc;
            color: #000;
        }
        
        /* Read More Buttons */
        .read-more {
            color: #007bff;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 5px;
        }
        
        .read-more:hover {
            text-decoration: underline;
            color: #0056b3;
        }
        
        /* Main Image */
        .product-image-container {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
        }
        
        .main-image-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 350px;
            overflow: hidden;
        }
        
        .main-product-image {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }
        
        /* Thumbnails */
        .thumbnail-item {
            position: relative;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid transparent;
            border-radius: 5px;
        }
        
        .thumbnail-img {
            height: 80px;
            width: 100%;
            object-fit: cover;
            border-radius: 5px;
        }
        
        .thumbnail-item.active {
            border-color: #007bff;
        }
        
        .thumbnail-item:hover {
            border-color: #007bff;
        }
        
        /* Specification container - FIXED FOR READMORE */
        #specification-container {
            max-height: 150px;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        #specification-container.expanded {
            max-height: 1000px;
        }
        
        /* Similar Products Section */
        .section-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            position: relative;
        }
        
        .similar-product-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: 100%;
            background-color: white;
        }
        
        .similar-product-card:hover {
            transform: translateY(-5px);
        }
        
        .similar-product-link {
            text-decoration: none;
            color: inherit;
        }
        
        .similar-product-img-container {
            width: 294px;
            height: 294px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 0 auto;
            border-radius: 20px;
        }
        
        .similar-product-img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }
        
        .similar-product-name {
            color: #333;
            font-size: 14px;
            margin: 10px 0;
            height: 40px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        
        .detail-btn {
            font-size: 12px;
            padding: 3px 8px;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 767px) {
            .product-info-container, .product-image-container {
                margin-bottom: 20px;
            }
            
            .buy-now-container {
                text-align: center;
                padding-right: 0;
            }
            
            .similar-product-img-container {
                width: 100%;
                height: auto;
                aspect-ratio: 1/1;
            }
        }
    </style>

    <!-- JavaScript for functionality -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Description Read More/Less
            initToggleText("product-description", "toggle-description", 25);
            
            // Specifications Read More/Less - FIXED TO ALWAYS SHOW
            initToggleSpecification();
            
            // Initialize thumbnails
            initThumbnails();
            
            // Function to initialize read more/less toggle for description
            function initToggleText(contentId, toggleId, maxWords) {
                const element = document.getElementById(contentId);
                const toggleBtn = document.getElementById(toggleId);
                
                if (!element || !toggleBtn) return;
                
                const fullText = element.innerHTML;
                const words = fullText.split(" ");
                
                if (words.length > maxWords) {
                    const shortText = words.slice(0, maxWords).join(" ") + "...";
                    element.innerHTML = shortText;
                    
                    toggleBtn.addEventListener("click", function() {
                        if (element.innerHTML === shortText) {
                            element.innerHTML = fullText;
                            toggleBtn.innerHTML = "Read Less";
                        } else {
                            element.innerHTML = shortText;
                            toggleBtn.innerHTML = "Read More";
                        }
                    });
                } else {
                    toggleBtn.style.display = "none";
                }
            }
            
            // Function for technical specifications toggle - FIXED TO ALWAYS SHOW
            function initToggleSpecification() {
                const specContainer = document.getElementById("specification-container");
                const toggleBtn = document.getElementById("toggle-specification");
                
                if (!specContainer || !toggleBtn) return;
                
                // Always show the toggle button regardless of content length
                toggleBtn.style.display = "inline-block";
                
                toggleBtn.addEventListener("click", function() {
                    if (specContainer.classList.contains("expanded")) {
                        specContainer.classList.remove("expanded");
                        toggleBtn.innerHTML = "Read More";
                    } else {
                        specContainer.classList.add("expanded");
                        toggleBtn.innerHTML = "Read Less";
                    }
                });
            }
            
            // Function to initialize thumbnail functionality
            function initThumbnails() {
                const carousel = document.getElementById('productImageCarousel');
                if (!carousel) return;
                
                // Update active thumbnails when carousel slides
                carousel.addEventListener('slid.bs.carousel', function(e) {
                    updateActiveThumbnail(e.to);
                });
                
                // Handle thumbnail clicks
                document.querySelectorAll('.thumbnail-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const slideIndex = this.getAttribute('data-bs-slide-to');
                        const carouselInstance = bootstrap.Carousel.getInstance(carousel);
                        if (carouselInstance) {
                            carouselInstance.to(parseInt(slideIndex));
                        }
                        updateActiveThumbnail(parseInt(slideIndex));
                    });
                });
                
                // Function to update active thumbnail
                function updateActiveThumbnail(index) {
                    document.querySelectorAll('.thumbnail-item').forEach((item, i) => {
                        if (i === index) {
                            item.classList.add('active');
                        } else {
                            item.classList.remove('active');
                        }
                    });
                }
                
                // Initialize first thumbnail as active
                updateActiveThumbnail(0);
            }
        });
    </script>
@endsection