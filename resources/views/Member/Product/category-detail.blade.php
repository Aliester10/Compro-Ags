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

    /* Membuat teks dan ikon di dropdown profile menjadi hitam */
#profile-dropdown .profile-menu-item,
#profile-dropdown .profile-menu-item svg {
    color: #000000 !important;
    stroke: #000000 !important;
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

<div class="category-banner">
    <div class="category-icon">
        <img src="{{ asset($category->icon_hover) }}" alt="{{ $category->nama }}">
    </div>
    <h1>{{ $category->nama }}</h1>
</div>

<div class="container category-content">
    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar menu dari tabel sub_kategori -->
            <div class="sidebar-menu">
                @foreach($bidangPerusahaans as $bidang)
                <a href="{{ route('member.product.bidang', $bidang->id) }}" 
                   class="{{ isset($activeBidang) && $activeBidang->id == $bidang->id ? 'active' : '' }}">
                    {{ $bidang->name }}
                </a>
                @endforeach
            </div>
        </div>
        
        <div class="col-md-9">
            <!-- Header and sort container combined in a flex container -->
            <div class="header-sort-container mb-4">
                <!-- Header for active bidang if selected -->
                @if(isset($activeBidang))
                <div class="subcategory-header">
                    <h2>{{ $activeBidang->name }}</h2>
                </div>
                @endif
                
                <!-- Sort dropdown -->
                <div class="sort-container">
                    <span>Sort By:</span>
                    <select class="sort-select">
                        <option value="newest" selected>Newest</option>
                        <option value="oldest">Oldest</option>
                        <option value="name-asc">Name A-Z</option>
                        <option value="name-desc">Name Z-A</option>
                    </select>
                </div>
            </div>
            
            <!-- Products grid -->
            <div class="products-grid">
                <div class="row">
                    @forelse($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="product-card">
                            <div class="product-image">
                                @foreach ($product->images as $key => $image)
                                    @if($key === 0) <!-- Only show the first image -->
                                        <img src="{{ asset($image->gambar) }}" alt="{{ $product->nama }}">
                                    @endif
                                @endforeach
                            </div>
                            <div class="product-details">
                                <h3 class="product-title">{{ $product->nama }}</h3>
                                <a href="{{ route('product.show', $product->id) }}"
                                class="read-more">Read More..
                                    </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="no-products">
                            <p>Tidak ada produk yang tersedia untuk 
                               {{ isset($activeBidang) ? 'bidang ini' : 'kategori ini' }}.</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
<style>
/* Banner styling with background image and black blur overlay */
.category-banner {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                url('/assets/img/Category-Detail.png');
    background-size: cover;
    background-position: center;
    color: #A9D1F8;
    text-align: center;
    height: 497px;
    padding: 40px 0 30px;
    position: relative;
    margin-bottom: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
/* Membuat layout full width */
.container.category-content {
    max-width: 100%;
    width: 100%;
    padding-left: 0;
    padding-right: 0;
}

.category-content .row {
    margin-left: 0;
    margin-right: 0;
    width: 100%;
}

.category-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 10px;
    display: flex;
    justify-content: center;
}

.category-icon img {
    width: 100%;
    height: auto;
    object-fit: contain;
    filter: brightness(0) invert(1); /* Make icon white */
}

.category-banner h1 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 0;
    color: white;
}

/* Content styling */
.category-content {
    padding: 30px 0;
    background-color: #E6F3FF;
    min-height: 500px;
    position: relative;
}

/* Updated sidebar menu with specific dimensions */
.sidebar-menu {
    width: 378px;
    height: 337px;
    position: absolute;
    left: 10px;
    border-radius: 40px;
    background:rgb(255, 255, 255);
    padding: 20px;
    margin-top: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    overflow-y: auto;
    z-index: 10;
}

.sidebar-menu a {
    display: block;
    padding: 12px 15px;
    margin-bottom: 8px;
    border-radius: 20px;
    color: black;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    height: 80;
    top: 555px;
    left: 48px;
}

.sidebar-menu a:last-child {
    margin-bottom: 0;
}

.sidebar-menu a.active, 
.sidebar-menu a:hover {
    background-color: #599BEC;
    color:rgb(255, 255, 255);
    border-color:rgb(255, 255, 255);
}

/* Adjust content layout for fixed sidebar position */
.category-content .row {
    position: relative;
}

.category-content .col-md-9 {
    margin-left: auto;
    width: 75%;
}

/* New header and sort container for alignment */
.header-sort-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
}

/* Subcategory header */
.subcategory-header h2 {
    font-size: 20px;
    color: #333;
    margin: 0;
    padding-bottom: 0;
}

/* Sort dropdown */
.sort-container {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.sort-container span {
    margin-right: 8px;
    color: #666;
    font-size: 14px;
}

.sort-select {
    padding: 6px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: white;
    font-size: 14px;
    cursor: pointer;
    transition: border-color 0.3s;
}

.sort-select:focus {
    border-color: #599BEC;
    outline: none;
}

/* Product cards */
.products-grid {
    margin-top: 10px;
}

.product-card {
    border: 1px solid #eee;
    border-radius: 20px;
    overflow: hidden;
    height: 100%;
    width: 294px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    background-color: #fff;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transform: translateY(-3px);
}

.product-header {
    padding: 8px 12px;
    background-color: #f8e8c1;
    border-bottom: 1px solid #e0d0ac;
    text-align: center;
}

.product-category {
    font-size: 12px;
    color: #7b6b45;
    font-weight: 500;
}

/* Product image improvements */
.product-image {
    height: 294px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0px;
    background-color: white;
    position: relative; /* Added for image positioning */
}

.product-image img {
    max-width: 100%;
    height: 100%;
    object-fit: contain; /* This keeps the aspect ratio while filling the container */
    transition: transform 0.3s ease;
    position: absolute; /* Position images on top of each other */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto; /* Center images */
    opacity: 0; /* Hide all images by default */
}

/* Show only the first image */
.product-image img:first-child {
    opacity: 1; /* Show only the first image */
}

/* Alternative: If you want a simple image slider/carousel effect */
@keyframes fadeInOut {
    0%, 100% { opacity: 0; }
    20%, 80% { opacity: 1; }
}

/* Apply animation if you want a carousel effect */
.product-card:hover .product-image img {
    animation: fadeInOut 3s infinite;
    animation-delay: calc(var(--i) * 3s); /* Each image appears with delay */
}

.product-details {
    padding: 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.product-title {
    font-size: 15px;
    margin-bottom: 15px;
    height: 44px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    color: #333;
    font-weight: 500;
    text-align: center;
}

.read-more {
    display: inline-block;
    color: #599BEC;
    font-size: 13px;
    font-weight: 500;
    padding: 5px 15px;
    border: 1px solid #599BEC;
    border-radius: 15px;
    text-decoration: none;
    text-align: center;
    background-color: #f9f9f9;
    transition: all 0.3s ease;
}

.read-more:hover {
    background-color: #599BEC;
    color: white;
    text-decoration: none;
}

/* No products message */
.no-products {
    text-align: center;
    padding: 40px;
    background-color: #f9f9f9;
    border-radius: 8px;
    color: #666;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

/* Pagination styling */
.pagination-container {
    display: flex;
    justify-content: center;
}

.pagination {
    margin: 0;
}

.pagination .page-item .page-link {
    color: #599BEC;
    border-color: #ddd;
    margin: 0 3px;
    border-radius: 4px;
}

.pagination .page-item.active .page-link {
    background-color: #599BEC;
    border-color: #599BEC;
}

.pagination .page-item .page-link:hover {
    background-color: #f8e8c1;
    color: #599BEC;
}

/* Responsive styling */
@media (max-width: 1200px) {
    .sidebar-menu {
        width: 320px;
        height: auto;
        position: sticky;
        top: 20px;
        left: auto;
    }
    
    .category-content .col-md-9 {
        width: 100%;
        margin-left: 0;
    }
}

/* Ensure images look good on all screen sizes */
@media (max-width: 991px) {
    .product-image {
        height: 180px;
    }
    
    .product-image img {
        max-height: 150px;
    }
    .sidebar-menu {
        width: 100%;
        position: static;
        border-radius: 20px;
        margin-bottom: 30px;
    }
}

@media (max-width: 767px) {
    .sidebar-menu {
        margin-bottom: 20px;
        height: auto;
    }
    
    /* Adjust header-sort-container for mobile */
    .header-sort-container {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .sort-container {
        justify-content: flex-start;
        margin-top: 15px;
        width: 100%;
    }
    
    .category-content {
        padding: 20px 0;
    }
    
    .category-banner {
        padding: 30px 0 20px;
    }
    
    .category-icon {
        width: 60px;
        height: 60px;
    }
}

@media (max-width: 575px) {
    .col-sm-6 {
        width: 50%;
    }
    
    .product-title {
        font-size: 14px;
        height: 40px;
    }
    
    .read-more {
        font-size: 12px;
        padding: 4px 12px;
    }
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add title attributes for better accessibility
        document.querySelectorAll('.product-title').forEach(function(title) {
            if (title.scrollHeight > title.clientHeight) {
                title.setAttribute('title', title.textContent.trim());
            }
        });
    });
</script>
@endsection