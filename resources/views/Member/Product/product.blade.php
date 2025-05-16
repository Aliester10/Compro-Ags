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
    
    /* Membuat teks dan ikon di dropdown profile menjadi hitam */
#profile-dropdown .profile-menu-item,
#profile-dropdown .profile-menu-item svg {
    color: #000000 !important;
    stroke: #000000 !important;
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
</body>
    <!-- navbar end -->


    <!-- Our Product Header Section -->
    <div class="products-header">
        <div class="overlay"></div>
        <div class="header-content">
            <h1>Our Product.</h1>
        </div>
    </div>

    <!-- Product Category Section -->
    <div class="product-category-section">
        <div class="category-container">
            <h2>Product Category.</h2>
            
            <!-- Search Bar -->
            <div class="search-bar">
                <form action="{{ route('products.search') }}" method="POST">
                    @csrf
                    <div class="search-input-group">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="Search For Product..." name="search">
                    </div>
                </form>
            </div>
            
            <!-- Category Grid -->
            <div class="category-grid">
                @php
                    $count = 0;
                    $totalCategories = count($kategori);
                @endphp
                
                @foreach($kategori as $category)
                    @php $count++; @endphp
                    
                    @if($count <= $totalCategories - 3)
                    <!-- Top row categories -->
                    <a href="{{ route('member.product.category', $category->id) }}" class="category-card">
                        <div class="category-image">
                            <img src="{{ asset($category->icon_hover) }}" class="category-icon" alt="{{ $category->nama }}">
                        </div>
                        <div class="category-name font-black">
                            {{ $category->nama }}
                        </div>
                    </a>
                    @endif
                @endforeach
            </div>
            
            <!-- Bottom Row (Centered) -->
            <div class="bottom-category-row">
                @php
                    $count = 0;
                @endphp
                
                @foreach($kategori as $category)
                    @php $count++; @endphp
                    
                    @if($count > $totalCategories - 3)
                    <!-- Bottom row categories (last 3) -->
                    <a href="{{ route('member.product.category', $category->id) }}" class="category-card">
                        <div class="category-image">
                            <img src="{{ asset($category->icon_hover) }}" class="category-icon" alt="{{ $category->nama }}">
                        </div>
                        <div class="category-name font-black">
                            {{ $category->nama }}
                        </div>
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- Best Seller Products Section -->
    <div class="bestseller-section">
        <div class="bestseller-container">
            <h2>Best Seller Products.</h2>
            
            @php
                // For debugging - uncomment to see what products exist
                // foreach($produks as $p) {
                //     echo $p->nama . "<br>";
                // }
                
                // Define product name keywords to search for
                $keywords = [
                    'air bag',
                    'simulator',
                    'Controller Training',
                    'PCE Water', 
                    'Suntex Laboratory',
                    'basic electric',
                    'Shielded Ground',
                    'Automatic Kjedahl',
                    'Automatic Multichannel',                
                ];
                
                // More flexible filter that looks for keywords instead of exact matches
                $bestSellerProducts = $produks->filter(function($product) use ($keywords) {
                    $productName = strtolower($product->nama);
                    foreach ($keywords as $keyword) {
                        if (stripos($productName, strtolower($keyword)) !== false) {
                            return true;
                        }
                    }
                    return false;
                });
                
                // Check if any products match the filter
                if ($bestSellerProducts->count() > 0) {
                    // If products exist, chunk them
                    $productsChunks = $bestSellerProducts->chunk(3);
                } else {
                    // If no products match, create an empty collection to handle in the loop
                    $productsChunks = collect([]);
                }
            @endphp
            
            @if($bestSellerProducts->count() > 0)
                @foreach($productsChunks as $chunk)
                    <!-- Products grid -->
                    <div class="products-grid">
                        <div class="row">
                            @foreach($chunk as $product)
                                <div class="col-md-4 mb-4">
                                    <div class="product-card">
                                        <div class="product-image">
                                        @if($product->images->count() > 0)
                                            <img src="{{ asset($product->images->first()->gambar) }}" alt="{{ $product->nama }}">
                                        @else
                                            <img src="{{ asset('assets/img/default.jpg') }}" alt="{{ $product->nama }}" class="default-image">
                                        @endif
                                        </div>
                                        <div class="product-details">
                                            <h3 class="product-title">{{ $product->nama }}</h3>
                                            <a href="{{ route('product.show', $product->id) }}" class="read-more">Read More..</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="no-products text-center">
                            <p>No bestseller products available at this time.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <style>
        /* Font import */
        @import url('/assets/css/fonts.css');
        /* Import AOS CSS for scroll animations */
        @import url('https://unpkg.com/aos@2.3.1/dist/aos.css');
        
        /* Font family base */
        * {
            font-family: 'Poppins', sans-serif; /* Assuming your local font is Poppins, adjust if needed */
        }
        
        /* Font weight classes */
        .font-thin { font-weight: 100; }
        .font-extralight { font-weight: 200; }
        .font-light { font-weight: 300; }
        .font-regular { font-weight: 400; }
        .font-medium { font-weight: 500; }
        .font-semibold { font-weight: 600; }
        .font-bold { font-weight: 700; }
        .font-extrabold { font-weight: 800; }
        .font-black { font-weight: 900; }
        
        /* Header Styles */
        .products-header {
            background-image: url('{{ asset('assets/img/header/our-product.png') }}');
            background-size: cover;
            background-position: center;
            height: 498px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        /* Added transparent black overlay */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0);
        }
        
        .header-content {
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .products-header h1 {
            color: white;
            font-size: 48px;
            font-weight: bold;
            margin: 0;
        }
        
        /* Product Category Section */
        .product-category-section {
            padding: 40px 0;
            background-color: #f5f9fd;
            position: relative;
            overflow: hidden;
        }
        
        .product-category-section::before,
        .product-category-section::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background-color: #e1eaf8;
            z-index: 0;
        }
        
        .product-category-section::before {
            left: -250px;
            top: -100px;
        }
        
        .product-category-section::after {
            right: -250px;
            bottom: -100px;
        }
        
        .category-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }
        
        .category-container h2 {
            font-size: 40px;
            font-weight: 900;
            text-align: center;
            margin-bottom: 30px;
        }
        
        /* Search Bar Styles - Updated with exact dimensions */
        .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
        }
        
        .search-input-group {
            position: relative;
            width: 549px; /* Exact width as requested */
            max-width: 100%; /* For responsiveness */
        }
        
        .search-input-group input {
            width: 100%;
            height: 38px; /* Exact height as requested */
            padding: 0 15px 0 45px;
            border: 1px solid #ddd;
            border-radius: 30px;
            font-size: 16px;
            outline: none;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        
        .search-input-group input::placeholder {
            color: #aaa;
            vertical-align: middle; /* Center placeholder vertically */
            line-height: 38px; /* Match the height */
        }
        
        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 16px;
        }
        
        /* Category Grid Styles */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(236px, 1fr));
            gap: 20px;
            justify-content: center;
            margin-bottom: 30px;
            margin-top: 40px;
        }
        
        /* Bottom Row Styling */
        .bottom-category-row {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        /* Category Card Styles */
        .category-card {
            width: 236px;
            height: 333px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            transition: transform 0.3s;
            position: relative;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            background-color: #000;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
        }
        
        .category-image {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Update all category backgrounds to use header.png */
        .category-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('assets/img/header.png') }}');
            background-size: cover;
            background-position: center;
        }
        
        /* Add dark overlay on top of the background image */
        .category-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.65);
        }
        
        /* Updated icon styling with exact dimensions */
        .category-image img {
            width: 126px; /* Exact width as requested */
            height: 126px; /* Exact height as requested */
            object-fit: contain;
            position: relative;
            z-index: 2;
            /* Position icon to leave exactly 10px gap with category name */
            margin-bottom: 60px; /* This positions the icon appropriately */
        }
        
        /* Updated category name styling with exact spacing */
        .category-name {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 160px; /* Fixed height for the name area */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            text-align: center;
            color: white;
            font-weight: 800;
            font-size: 18px;
            z-index: 2;
            line-height: 1.2;
        }
        
        /* Best Seller Products Section */
        .bestseller-section {
            padding: 60px 0;
            background-color: #f5f9fd;
            position: relative;
            overflow: hidden;
        }
        
        .bestseller-section::before,
        .bestseller-section::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background-color: #e1eaf8;
            z-index: 0;
        }
        
        .bestseller-section::before {
            left: -250px;
            top: -100px;
        }
        
        .bestseller-section::after {
            right: -250px;
            bottom: -100px;
        }
        
        .bestseller-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }
        
        .bestseller-container h2 {
            font-size: 40px;
            font-weight: 900;
            text-align: center;
            margin-bottom: 50px;
        }
        
        .product-card {
            width: 300px;
            height: 400px;
            background-color: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
        
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
            padding: 15px;
            text-align: center;
        }
        
        .product-title {
            font-size: 15px;
            margin-bottom: 1px;
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

        /* Responsive adjustments */category-name
        @media (max-width: 992px) {
            .product-card {
                width: calc(50% - 20px);
            }
        }
        
        @media (max-width: 768px) {
            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .category-card {
                width: 100%;
            }
            
            .bottom-category-row {
                flex-direction: column;
                align-items: center;
            }
            
            .product-card {
                width: 100%;
                max-width: 350px;
            }
            
            .search-input-group {
                width: 100%; /* Full width on mobile */
            }
        }
        
        @media (max-width: 480px) {
            .category-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection