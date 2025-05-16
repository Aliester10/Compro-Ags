@extends('layouts.Member.master')

@section('content')
<style>
    body {
        background: linear-gradient(to right, 
            #dfefff 0%, 
            #dfefff 15%, 
            white 35%, 
            white 65%, 
            #dfefff 85%, 
            #dfefff 100%);
        background-attachment: fixed;
        min-height: 100vh;
    }
    
    /* Event Feature Styling */
    .event-feature {
        max-width: 1200px;
        margin: 80px auto 0;
        padding-top: 100px;
        font-family: 'Helvetica Neue', Arial, sans-serif;
    }
    
    /* Event Header Styling */
    .event-header {
        margin-bottom: 30px;
    }
    
    .event-title {
        font-size: 44px;
        font-weight: 900;
        color: #000;
        line-height: 1.1;
        margin: 0 0 5px 0;
    }
    
    .event-venue {
        font-size: 18px;
        font-weight: 400;
        color: #000;
        margin: 0;
    }
    
    /* Event Gallery Styling */
    .event-gallery {
        display: grid;
        gap: 15px;
        margin-bottom: 40px;
    }
    
    /* Grid layouts based on image count */
    .event-gallery.one-image {
        grid-template-columns: 1fr;
    }
    
    .event-gallery.two-images {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .event-gallery.three-images {
        grid-template-columns: repeat(3, 1fr);
    }
    
    .event-gallery.four-images {
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 1fr);
    }
    
    .event-gallery.many-images {
        grid-template-columns: repeat(3, 1fr);
    }
    
    .gallery-image {
        border-radius: 6px;
        overflow: hidden;
        height: 280px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .event-gallery.one-image .gallery-image {
        height: 400px;
    }
    
    .event-gallery.four-images .gallery-image {
        height: 250px;
    }
    
    .gallery-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .gallery-image img:hover {
        transform: scale(1.03);
    }
    
    /* Event Description Styling */
    .event-description {
        font-size: 16px;
        line-height: 1.6;
        color: #000;
        text-align: justify;
    }
    
    /* Navigation buttons */
    .activity-nav {
        display: flex;
        justify-content: space-between;
        margin-top: 60px;
        padding-bottom: 60px;
    }
    
    .nav-btn {
        display: inline-block;
        padding: 12px 24px;
        background-color: white;
        color: #333;
        border: 1px solid #d0d0d0;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .nav-btn:hover {
        background-color: #4a90e2;
        color: white;
        border-color: #4a90e2;
        text-decoration: none;
    }
    
    .nav-btn i {
        margin: 0 5px;
    }
    
    /* Responsive styles */
    @media (max-width: 992px) {
        .event-title {
            font-size: 36px;
        }
    }
    
    @media (max-width: 768px) {
        .event-gallery {
            grid-template-columns: 1fr !important;
        }
        
        .gallery-image {
            height: 220px;
        }
    }
    
    @media (max-width: 480px) {
        .event-title {
            font-size: 28px;
        }
    }
</style>

<!-- navbar start -->

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

    /* Set all navbar text to BLACK instead of white */
    nav .navbar-content a,
    nav .navbar-content span,
    nav ion-icon,
    nav #ecommerce-toggle,
    nav svg {
        color: #000000 !important;
    }
    
    nav svg {
        stroke: #000000 !important;
    }

    /* E-commerce dropdown text in black */
    #desktop-ecommerce-dropdown a,
    #desktop-ecommerce-dropdown span,
    #desktop-ecommerce-dropdown div {
        color: #000000 !important;
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
    
    /* Search input text color - updated to black */
    nav input::placeholder {
        color: rgba(0, 0, 0, 0.7);
    }
    
    nav input {
        color: #000000;
    }
    
    nav input:focus {
        border-color: #000000;
    }
</style>
    
<div class="absolute top-0 left-0 right-0 z-50 w-full">
    <div class="w-full bg-gray-800 bg-opacity-80 backdrop-blur-md py-2 px-4 text-center">
        <h1 class="text-black font-Work Sans text-sm md:text-base">{{ $compro->nama_perusahaan }}</h1>
    </div>
    <!-- Navbar with black text instead of white -->
<nav class="px-4 pb-4 pt-0 bg-transparent transition-all duration-300" id="mainNav">
        <div class="flex items-center justify-between relative navbar-content" id="navbarContent">
            <div class="flex items-center">
              <img class="w-[119px] h-[119px] cursor-pointer" src="{{ asset('assets/img/ags-icon-black.png') }}" alt="Logo" onclick="window.location.href='{{ url('/') }}'">
            </div>
            <div class="flex items-center">
                <div class="md:hidden mr-4">
                    <form action="" class="relative mx-auto w-max">
                        <input type="search" 
                              class="peer cursor-pointer relative z-10 h-12 w-12 rounded-full border bg-transparent pl-12 outline-none focus:w-full focus:cursor-text focus:border-black focus:pl-16 focus:pr-4" />
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute inset-y-0 my-auto h-8 w-12 border-r border-transparent px-3.5 peer-focus:border-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
                    <!-- Updated desktop ecommerce dropdown with fixed width and height and BLACK text -->
                    <div id="desktop-ecommerce-dropdown" class="hidden mt-2 z-50">
                        <div class="ecommerce-partner-container text-black">
                            @foreach($ecommercePartners as $partner)
                                <div class="ecommerce-partner-item">
                                    <a href="{{ $partner->url ?? '#' }}" class="hover:opacity-80 transition-opacity text-black">
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
                              class="peer cursor-pointer relative z-10 h-12 w-12 rounded-full border bg-transparent pl-12 outline-none focus:w-full focus:cursor-text focus:border-black focus:pl-16 focus:pr-4" />
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute inset-y-0 my-auto h-8 w-12 border-r border-transparent px-3.5 peer-focus:border-black" fill="none" viewBox="0 0 24 24" stroke-width="2">
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

<!-- Navbar End -->


<div class="event-feature">
    <div class="event-header">
        <h1 class="event-title">{{ $activity->title }}</h1>
        <p class="event-venue">{{ $activity->location }}</p>
    </div>
    
    @php
    $galleryImages = DB::table('activity_images')
                    ->where('activity_id', $activity->id)
                    ->get();
    
    $imageCount = count($galleryImages);
    
    // Determine gallery class based on number of images
    $galleryClass = '';
    if($imageCount == 1) {
        $galleryClass = 'one-image';
    } elseif($imageCount == 2) {
        $galleryClass = 'two-images';
    } elseif($imageCount == 3) {
        $galleryClass = 'three-images';
    } elseif($imageCount == 4) {
        $galleryClass = 'four-images';
    } else {
        $galleryClass = 'many-images';
    }
    @endphp
    
    @if($imageCount > 0)
        <div class="event-gallery {{ $galleryClass }}">
            @foreach($galleryImages as $image)
                <div class="gallery-image">
                    <img src="{{ asset('assets/img/about/' . $image->image) }}" alt="{{ $activity->title }} image">
                </div>
            @endforeach
        </div>
    @else
        <div class="event-gallery one-image">
            <div class="gallery-image">
                <img src="{{ asset('assets/img/default-event.jpg') }}" alt="Default image">
            </div>
        </div>
    @endif
    
    <div class="event-description">
        <p>{{ $activity->description }}</p>
    </div>
    
    <div class="activity-nav">
        {{-- You can add navigation buttons here if needed --}}
        {{-- Example:
        <a href="#" class="nav-btn"><i class="fas fa-arrow-left"></i> Previous Event</a>
        <a href="#" class="nav-btn">Next Event <i class="fas fa-arrow-right"></i></a>
        --}}
    </div>
</div>
@endsection