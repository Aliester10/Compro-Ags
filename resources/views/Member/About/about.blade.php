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
    
/* Membuat teks dan ikon di dropdown profile menjadi hitam */
#profile-dropdown .profile-menu-item,
#profile-dropdown .profile-menu-item svg {
    color: #000000 !important;
    stroke: #000000 !important;
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
    
<!-- top bar start -->
<div class="absolute top-0 left-0 right-0 z-50 w-full">
    <div class="w-full bg-gray-800 bg-opacity-80 backdrop-blur-md py-2 px-4 text-center">
        <h1 class="text-white font-Work Sans text-sm md:text-base">{{ $compro->nama_perusahaan }}</h1>
    </div>
<!-- top bar end -->


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

<style>
    /* Font import */
    @import url('/assets/css/fonts.css');
    /* Import AOS CSS for scroll animations */
    @import url('https://unpkg.com/aos@2.3.1/dist/aos.css');
    
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
    
    /* Animation keyframes */
    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }
    
    @keyframes fadeInUp {
        0% { 
            opacity: 0; 
            transform: translateY(30px); 
        }
        100% { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
    
    @keyframes fadeInDown {
        0% { 
            opacity: 0; 
            transform: translateY(-30px); 
        }
        100% { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
    
    @keyframes fadeInLeft {
        0% { 
            opacity: 0; 
            transform: translateX(-30px); 
        }
        100% { 
            opacity: 1; 
            transform: translateX(0); 
        }
    }
    
    @keyframes fadeInRight {
        0% { 
            opacity: 0; 
            transform: translateX(30px); 
        }
        100% { 
            opacity: 1; 
            transform: translateX(0); 
        }
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    
    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }
    
    @keyframes textGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Header animation */
    .header-content-animated {
        animation: fadeInDown 1.2s ease-out;
    }
    
    /* Styling untuk visi-misi sesuai gambar */
    .vision-mission-container {
        background: url('{{ asset('assets/img/About Us.png') }}') no-repeat top center; 
        background-size: 100% auto; /* Show image at original aspect ratio, full width */
        position: relative;
        height: 560px; /* Increased height for more room */
        margin-top: 50px;
        margin-bottom: 50px;
        display: flex;
        align-items: flex-end; /* Align content to bottom */
    }
    
    .vision-mission-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 2;
        padding-bottom: 30px; /* Smaller padding to position text closer to bottom */
        width: 100%;
    }
    
    .vision-title {
        font-size: 64px;
        font-weight: 900;
        margin-bottom: 20px;
        font-family: 'Work Sans', sans-serif;
        line-height: 1;
        text-align: left;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0);
        transition: all 0.3s ease;
    }
    
    .mission-title {
        font-size: 64px;
        font-weight: 900;
        margin-bottom: 20px;
        font-family: 'Work Sans', sans-serif;
        line-height: 1;
        text-align: right;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    /* Animated titles with gradient hover effect */
    .vision-title:hover, .mission-title:hover {
        background: linear-gradient(45deg, #000, #444, #000);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textGradient 3s ease infinite;
    }
    
    .vision-text {
        font-size: 18px;
        line-height: 1.6;
        font-weight: 600;
        margin-bottom: 20px;
        font-family: 'Work Sans', sans-serif;
        color: #000;
        text-align: left;
    }
    
    .mission-text {
        font-size: 18px;
        line-height: 1.6;
        font-weight: 600;
        margin-bottom: 20px;
        font-family: 'Work Sans', sans-serif;
        color: #000; 
        text-align: right;
    }
    
    /* Text animation on scroll */
    .animated-text {
        position: relative;
        transition: all 0.5s ease;
    }
    
    /* About Values Section Styling - FIXED VERSION */
    .about-values-container {
        background: url('{{ asset('assets/img/About Us_2.png') }}') no-repeat center center;
        background-size: cover;
        position: relative;
        height: 780px; /* Increased height to accommodate the lower positioning */
        margin-bottom: 10px;
    }

    /* Title styling - moved 240px down from original position */
    .about-values-title {
        position: absolute;
        top: 400px; /* Original 40px + 240px = 280px */
        left: 40px;
        font-size: 48px;
        font-weight: 900;
        color: #000;
        line-height: 1.1;
        font-family: 'Work Sans', sans-serif;
        margin: 0;
    }
    
    /* Values sections container - adjusted to maintain proper spacing from title */
    .values-sections {
        position: absolute;
        top: 550px; /* Original 40px + 240px = 280px */
        bottom: 40px;
        left: 40px;
        right: 40px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    
    /* Each value block */
    .value-block {
        width: 48%; /* Just under half width to create space between */
        margin-bottom: 30px;
        transition: all 0.4s ease;
        transform: translateY(0);
    }
    
    .value-block:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        border-radius: 10px;
        padding: 15px;
    }
    
    /* Title with icon */
    .value-title-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    
    .value-title-container img {
        width: 30px;
        height: 30px;
        margin-right: 10px;
        transition: transform 0.3s ease;
    }
    
    .value-block:hover .value-title-container img {
        transform: rotate(15deg) scale(1.2);
    }
    
    .value-title-container h3 {
        font-size: 24px;
        font-weight: 900;
        margin: 0;
        font-family: 'Work Sans', sans-serif;
        transition: all 0.3s ease;
    }
    
    .value-block:hover .value-title-container h3 {
        letter-spacing: 1px;
    }
    
    /* List items */
    .value-list {
        list-style-type: none;
        padding-left: 0;
        margin: 0;
    }
    
    .value-list li {
        position: relative;
        padding-left: 20px;
        margin-bottom: 8px;
        font-size: 16px;
        font-family: 'Work Sans', sans-serif;
        line-height: 1.4;
        transition: transform 0.3s ease, opacity 0.3s ease;
        opacity: 0.9;
    }
    
    .value-list li:before {
        content: "•";
        position: absolute;
        left: 0;
        transition: all 0.3s ease;
    }
    
    .value-block:hover .value-list li {
        transform: translateX(5px);
        opacity: 1;
    }
    
    .value-block:hover .value-list li:before {
        color: #444;
        transform: scale(1.2);
    }
    
    /* SVG-based Level-Up Circle Styling - ENHANCED VERSION */
    .level-up-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 80px 0;
        position: relative;
        margin: 180px 0px -100px 0px;
        perspective: 1000px;
    }

    .svg-container {
        position: relative;
        width: 460px;
        height: 460px;
        display: flex;
        justify-content: center;
        align-items: center;
        transform-style: preserve-3d;
        transition: transform 0.5s ease;
    }
    
    .svg-container:hover {
        transform: rotateY(10deg) rotateX(5deg);
    }

    .svg-container svg {
        position: absolute;
        width: 100%;
        height: 100%;
        animation: rotate 30s linear infinite;
        filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.2));
    }
    
    .level-up-circle {
        width: 370px;
        height: 370px;
        background-color: #000;
        border-radius: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
        position: relative;
        z-index: 1;
        transition: all 0.5s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        overflow: hidden;
    }
    
    .level-up-circle::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        transform: rotate(45deg);
        animation: shimmer 4s linear infinite;
        pointer-events: none;
    }
    
    .level-up-circle:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        background-color: #111;
    }

    .level-up-text {
        font-family: 'Work Sans', sans-serif;
        font-weight: 700;
        font-size: 40px;
        line-height: 1.6;
        letter-spacing: 0.5px;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .level-up-circle:hover .level-up-text {
        text-shadow: 0 0 15px rgba(255,255,255,0.5);
        letter-spacing: 1px;
    }

    .rotating-text {
        font-family: 'Work Sans', sans-serif;
        font-size: 24px;
        font-weight: 500;
        fill: #000;
        letter-spacing: 5.3px;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    
    /* Reverse rotation for hover effect */
    .svg-container:hover svg {
        animation: rotate 15s linear infinite;
    }
    
    /* Our Brand Section Styling - UPDATED */
    .our-brand-container {
        padding: 60px 0;
        margin: 50px 0;
        text-align: center;
        position: relative;
    }
    
    .our-brand-title {
        position: relative;
        font-family: 'Work Sans', sans-serif;
        font-weight: 900;
        font-size: 48px;
        color: #000;
        margin-bottom: 40px;
        display: inline-block;
        transition: all 0.5s ease;
    }
    
    .our-brand-title::before,
    .our-brand-title::after {
        content: "";
        position: absolute;
        top: 50%;
        height: 1px;
        background-color: #000;
        width: 300px;
        transition: all 0.5s ease;
    }
    
    .our-brand-title::before {
        right: 100%;
        margin-right: 15px;
    }
    
    .our-brand-title::after {
        left: 100%;
        margin-left: 15px;
    }
    
    .our-brand-title:hover::before,
    .our-brand-title:hover::after {
        width: 350px;
        height: 2px;
    }
    
    .brand-logos {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
        margin-top: 30px;
    }
    
    /* UPDATED - Removed box-shadow and border on hover */
    .brand-logo {
        padding: 1px;
        max-width: 320px;
        height: auto;
        margin: 15px;
        position: relative;
        overflow: hidden;
        transition: all 0.5s ease;
        background-color: transparent;
    }
    
    .brand-logo img {
        max-width: 100%;
        height: auto;
        transition: transform 0.5s ease, filter 0.5s ease;
    }
    
    /* UPDATED - Removed box-shadow, kept only translateY animation */
    .brand-logo:hover {
        transform: translateY(-5px);
        background-color: transparent;
    }
    
    .brand-logo:hover img {
        transform: scale(1.1);
        filter: brightness(1.1);
    }
    
    /* UPDATED - Modified the after pseudo-element for a cleaner effect */
    .brand-logo::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: transparent;
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }
    
    .brand-logo:hover::after {
        transform: translateX(100%);
    }
    
    /* Feature item styles */
    .feature-item {
        background-color: #fff;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transform-origin: center bottom;
    }

    .feature-item img {
        max-width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .feature-item:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }
    
    .feature-item:hover img {
        transform: scale(1.05);
    }
    
    /* About img styles */
    .about-img {
        position: relative;
        max-height: 400px;
        overflow: hidden;
    }

    .about-img img {
        object-fit: cover;
    }

    .about-logo {
        position: absolute;
        top: 88%;
        left: 8%;
        transform: translate(-50%, -50%);
        z-index: 10;
        width: 130px;
        height: 130px;
        border: 3px solid #fff;
        border-radius: 50%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        transition: all 0.5s ease;
        animation: pulse 3s infinite ease-in-out;
    }
    
    .about-logo:hover {
        border-color: #eee;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        transform: translate(-50%, -50%) scale(1.1);
    }

    .about-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        transition: transform 0.5s ease;
    }
    
    .about-logo:hover img {
        transform: scale(1.1);
    }
    
    /* Map styles */
    .marker-tooltip {
        background-color: #b3d9ff;
        border: 1px solid #80b3ff;
        padding: 5px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        font-size: 12px;
        color: #333;
        font-family: 'Work Sans', sans-serif;
        transition: all 0.3s ease;
    }
    
    .marker-tooltip:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    .info-window img.popup-image {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin-bottom: 5px;
        transition: all 0.3s ease;
        transform: scale(1);
    }
    
    .info-window:hover img.popup-image {
        transform: scale(1.03);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .popup-title {
        font-size: 20px;
        color: black;
        font-weight: bold;
        font-family: 'Work Sans', sans-serif;
        transition: all 0.3s ease;
    }
    
    .info-window:hover .popup-title {
        color: #444;
    }

    .popup-description,
    .popup-address {
        font-size: 12px;
        color: #333;
        margin-top: 10px;
        text-align: justify;
        font-family: 'Work Sans', sans-serif;
        transition: all 0.3s ease;
    }
    
    .info-window:hover .popup-description,
    .info-window:hover .popup-address {
        color: #555;
    }
    
    /* Enhanced Media queries for better responsiveness */
    @media (max-width: 1200px) {
        .vision-title, .mission-title {
            font-size: 56px;
        }
        
        .our-brand-title::before,
        .our-brand-title::after {
            width: 200px;
        }
    }
    
    @media (max-width: 992px) {
        .vision-title, .mission-title {
            font-size: 48px;
        }
        
        .vision-text, .mission-text {
            font-size: 16px;
        }
        
        .svg-container {
            width: 400px;
            height: 400px;
        }
        
        .level-up-circle {
            width: 320px;
            height: 320px;
        }
        
        .level-up-text {
            font-size: 32px;
        }
        
        .our-brand-title::before,
        .our-brand-title::after {
            width: 150px;
        }
    }
    
    @media (max-width: 768px) {
        .vision-mission-container {
            height: auto;
            padding: 40px 20px 120px;
            background-size: cover;
            background-position: center;
        }
        
        .vision-mission-content {
            position: relative;
            padding-bottom: 0;
        }
        
        .vision-title, .mission-title {
            font-size: 40px;
        }
        
        .mission-title, .mission-text {
            text-align: left;
        }
        
        .about-values-container {
            min-height: 980px; /* Increased to accommodate the lower positioning on mobile */
            padding: 20px 20px 40px;
            background-position: center top;
        }
        
        .about-values-title {
            position: relative;
            top: 280px; /* Keep consistent with desktop */
            left: 20px;
            margin-bottom: 200px;
            font-size: 40px;
        }
        
        .values-sections {
            position: relative;
            flex-direction: column;
            top: auto;
            bottom: auto;
            left: 20px;
            right: 20px;
            margin-top: 350px; /* Increased to maintain spacing from title */
        }
        
        .value-block {
            width: 100%;
        }
        
        .svg-container {
            width: 360px;
            height: 360px;
        }
        
        .level-up-circle {
            width: 280px;
            height: 280px;
        }
        
        .level-up-text {
            font-size: 28px;
        }
        
        .rotating-text {
            font-size: 18px;
            letter-spacing: 5.3px;
        }
        
        .our-brand-title {
            font-size: 40px;
        }
        
        .our-brand-title::before,
        .our-brand-title::after {
            width: 100px;
        }
        
        .brand-logo {
            padding: 10px;
            max-width: 45%;
            margin: 10px 5px;
        }
        
        .feature-item {
            min-height: 300px;
        }
        
        .about-logo {
            width: 110px;
            height: 110px;
            top: 90%;
            left: 10%;
        }
        
        .info-window {
            padding: 10px;
        }

        .popup-title {
            font-size: 18px;
        }

        .popup-description,
        .popup-address {
            font-size: 10px;
        }

        .info-window img.popup-image {
            margin-bottom: 5px
        }
    }
    
    @media (max-width: 576px) {
        .container-fluid.bg-breadcrumb {
            height: 540px !important;
        }
        
        .container-fluid.bg-breadcrumb h1.display-2 {
            font-size: 48px !important;
        }
        
        .container-fluid.bg-breadcrumb p {
            font-size: 20px !important;
        }
        
        .container h1 {
            font-size: 42px !important;
        }
        
        .container p {
            font-size: 18px !important;
        }
        
        .vision-title, .mission-title {
            font-size: 36px;
        }
        
        .vision-text, .mission-text {
            font-size: 14px;
        }
        
        .about-values-title {
            font-size: 36px;
        }
        
        .value-title-container h3 {
            font-size: 20px;
        }
        
        .value-list li {
            font-size: 14px;
        }
        
        .svg-container {
            width: 280px;
            height: 280px;
        }
        
        .level-up-circle {
            width: 220px;
            height: 220px;
        }
        
        .level-up-text {
            font-size: 24px;
        }
        
        .rotating-text {
            font-size: 14px;
            letter-spacing: 2px;
        }
        
        .our-brand-title {
            font-size: 36px;
        }
        
        .our-brand-title::before,
        .our-brand-title::after {
            width: 60px;
        }
        
        .about-logo {
            width: 90px;
            height: 90px;
            top: 90%;
            left: 15%;
        }
    }
    
    @media (max-width: 480px) {
        .container-fluid.bg-breadcrumb {
            height: 480px !important;
        }
        
        .container-fluid.bg-breadcrumb h1.display-2 {
            font-size: 36px !important;
        }
        
        .container-fluid.bg-breadcrumb p {
            font-size: 18px !important;
        }
        
        .container h1 {
            font-size: 32px !important;
            margin-left: 0px !important;
        }
        
        .container .text-start.mb-6 {
            margin-left: 20px !important;
        }
        
        .vision-title, .mission-title {
            font-size: 30px;
        }
        
        .svg-container {
            width: 260px;
            height: 260px;
        }
        
        .level-up-circle {
            width: 200px;
            height: 200px;
        }
        
        .level-up-text {
            font-size: 20px;
        }
        
        .rotating-text {
            font-size: 25px;
            letter-spacing: 5px;
        }
        
        .popup-title {
            font-size: 16px;
        }

        .popup-description,
        .popup-address {
            font-size: 9px;
        }
        
        .brand-logo {
            max-width: 85%;
        }
    }
    
    @media (max-width: 380px) {
        .vision-mission-container {
            padding: 40px 15px 100px;
        }
        
        .vision-title, .mission-title {
            font-size: 28px;
        }
        
        .vision-text, .mission-text {
            font-size: 12px;
        }
        
        .svg-container {
            width: 240px;
            height: 240px;
        }
        
        .level-up-circle {
            width: 180px;
            height: 180px;
        }
        
        .level-up-text {
            font-size: 18px;
        }
        
        .our-brand-title {
            font-size: 30px;
        }
        
        .our-brand-title::before,
        .our-brand-title::after {
            width: 40px;
        }
    }
</style>

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb p-0" style="position: relative; overflow: hidden; height: 740px; width: 100%;">
        <!-- Background Image with normal positioning -->
        <div style="background: url('{{ asset('assets/img/About Us header.png') }}') no-repeat center center; background-size: cover; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
        
        <!-- Overlay Hitam Transparan with animation -->
        <div style="background-image: linear-gradient(to top, #ffffff,rgba(217, 217, 217, 0)); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2; animation: fadeIn 1.5s ease-out;"></div>        

    <!-- Konten Header yang Diposisikan di Tengah Secara Vertikal dan Horizontal -->
    <div class="d-flex flex-column justify-content-center align-items-center h-100 header-content-animated" style="position: relative; z-index: 3;">
    <h1 class="display-2 text-center fw-bold mb-3" data-aos="fade-down" data-aos-delay="300" data-aos-duration="800" style="line-height: 120%; letter-spacing: -0.022em; font-size: 64px; font-family: 'Work Sans', sans-serif; color: black; font-weight: 900; text-shadow: 0px 4px 4px rgb(0, 0, 0);">    {{ __('messages.about_us') }}. </h1>
         <p data-aos="fade-up" data-aos-delay="600" data-aos-duration="800" style="line-height: 120%; letter-spacing: -0.022em; font-family: 'Work Sans', sans-serif; color: black; font-weight: 600; font-size: 24px; text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">{{ __('messages.company_name') }}</p>
    </div>
</div>

<!-- About Start -->
    <div class="container">
        <div class="text-start mb-6" style="margin-left: 10px;" data-aos="fade-up" data-aos-duration="1000">
            <h1 style="font-weight: 900; font-size: 64px; color: #000; margin-bottom: 0; line-height: 1.1; font-family: 'Work Sans', sans-serif;" class="animated-text"> {{__('messages.about')}} </h1>
            <h1 style="font-weight: 900; font-size: 64px; color: #000; margin-bottom: 25px; line-height: 1.1; font-family: 'Work Sans', sans-serif;" class="animated-text"> {{__('messages.company')}}. </h1>
            <p style="font-weight: 600; font-size: 24px; color: #000; max-width: 100%; font-family: 'Work Sans', sans-serif;" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000"> {{ $company->sejarah_singkat ?? ' ' }} </p>
        </div>
    </div>
<!-- About End -->

<!-- Vision Mission Start -->
<div class="vision-mission-container">
    <div class="container vision-mission-content">
        <div class="row">
            <!-- Vision Section (Left) -->
            <div class="col-md-5" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
                <h1 class="vision-title"> Our <br> Mission. </h1>
                <p class="vision-text animated-text" > {{ $company->misi ?? 'By providing the best service through innovation so that you get the right solution in meeting every need in detail orientation and also a reliable guarantee.' }} </p>
            </div>

            <div class="col-md-2">
                <!-- Spacer column -->
            </div>

            <!-- Mission Section (Right) -->
            <div class="col-md-5" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400">
                <h1 class="mission-title"> Our <br> Vision.</h1>
                <p class="mission-text animated-text" >{{ $company->visi ?? 'The technology start-up that provide any innovative solutions for growing up and give the value added your industry.' }}</p>
            </div>
        </div>
    </div>
</div>
<!-- Vision Mission End -->

<!-- About Values Start -->
<div class="about-values-container">
    <!-- Title at top left, moved 240px down -->
    <h1 class="about-values-title" data-aos="fade-right" data-aos-duration="800">About<br>Values.</h1>
    
    <!-- Values placed at the bottom in a 2x2 grid -->
    <div class="values-sections">
        <!-- Innovation Section -->
        <div class="value-block" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
            <div class="value-title-container">
                <img src="{{ asset('assets/icons/Icon About/lamp-icon.png') }}" alt="Innovation">
                <h3>Innovation</h3>
            </div>
            <ul class="value-list">
                <li>Create value through product innovation and improvements.</li>
                <li>Seek innovative ways to introduce new ideas and approaches to solve existing and new challenges.</li>
                <li>Develop new ideas—and run with them.</li>
                <li>Build mutually successful relationships with customers to better under stand their needs</li>
            </ul>
        </div>
        
        <!-- Move Quickly Section -->
        <div class="value-block" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
            <div class="value-title-container">
                <img src="{{ asset('assets/icons/Icon About/forward-all-arrow-icon.png') }}" alt="Move Quickly">
                <h3>Move Quickly</h3>
            </div>
            <ul class="value-list">
                <li>Acting with urgency while removing obstacles that get in the way of high priority initiatives. We are not waiting until next week to do something that will help you today.</li>
                <li>Continuously working to increase the velocity of our highest priority initiatives by methodically removing barriers that get in the way</li>
            </ul>
        </div>
        
        <!-- Quality Section -->
        <div class="value-block" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
            <div class="value-title-container">
                <img src="{{ asset('assets/icons/Icon About/thumbs-up-line-icon.png') }}" alt="Quality">
                <h3>Quality</h3>
            </div>
            <ul class="value-list">
                <li>We take pride in providing high value products and services that we stand behind.</li>
                <li>We ensures customer satisfaction, profitability and the future of our employees and our growth</li>
            </ul>
        </div>
        
        <!-- Customer Satisfaction Section -->
        <div class="value-block" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
            <div class="value-title-container">
                <img src="{{ asset('assets/icons/Icon About/employees-icon.png') }}" alt="Customer Satisfaction">
                <h3>Customer Satisfaction</h3>
            </div>
            <ul class="value-list">
                <li>We take pride in providing high value products and services that we stand behind.</li>
                <li>We ensures customer satisfaction, profitability and the future of our employees and our growth</li>
            </ul>
        </div>
    </div>
</div>
<!-- About Values End -->

<!-- Level-Up Circle with SVG Start -->
<div class="level-up-container" data-aos="zoom-in" data-aos-duration="1200">
    <div class="svg-container">
        <svg viewBox="0 0 500 500">
            <!-- Background circle with rotating text -->
            <circle cx="250" cy="250" r="230" fill="transparent" stroke="transparent"/>
            
            <text>
                <textPath href="#textcircle" startOffset="0%" class="rotating-text">
                    Independence • Quality • Customer Satisfaction • Respect • Move Quickly • Innovation •
                </textPath>
            </text>
            
            <!-- Path for text to follow -->
            <path id="textcircle" d="M 250,25 A 225,225 0 1,1 249,25 A 225,225 0 1,1 250,25" fill="none"/>
        </svg>
        
        <!-- Black center circle -->
        <div class="level-up-circle">
            <div class="level-up-text">LEVEL-UP<br>YOUR OUTPUT<br>WITH US</div>
        </div>
    </div>
</div>
<!-- Level-Up Circle End -->

<!-- Our Brand Start -->
<div class="our-brand-container" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <h2 class="our-brand-title" data-aos="fade-up" data-aos-duration="800">Our Brand.</h2>
        
        <div class="brand-logos">
            <!-- Brand Logo 1 -->
            <div class="brand-logo" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <img src="{{ asset('assets/img/Logo Brand AGS/labtek logo_.png') }}" alt="LABTEK Logo">
            </div>
            
            <!-- Brand Logo 2 -->
            <div class="brand-logo" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                <img src="{{ asset('assets/img/Logo Brand AGS/logo labverse2.png') }}" alt="LABVERSE Logo">
            </div>
            
            <!-- Brand Logo 3 -->
            <div class="brand-logo" data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
                <img src="{{ asset('assets/img/Logo Brand AGS/microme logo.png') }}" alt="MICROME Logo">
            </div>
            
            <!-- Brand Logo 4 -->
            <div class="brand-logo" data-aos="fade-up" data-aos-duration="800" data-aos-delay="700">
                <img src="{{ asset('assets/img/Logo Brand AGS/Vulcan Logo.png') }}" alt="VULCAN Logo">
            </div>

        </div>
    </div>
</div>
<!-- Our Brand End -->

<!-- Include Leaflet.js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<!-- Include AOS library for scroll animations -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    // Initialize AOS animations
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            once: false,
            mirror: true,
            offset: 120,
            easing: 'ease-out-cubic'
        });
        
        // Animation for text elements when they come into view
        const animatedTextElements = document.querySelectorAll('.animated-text');
        
        // Add floating animation to specific elements
        const floatingElements = document.querySelectorAll('.about-logo');
        floatingElements.forEach(element => {
            element.style.animation = 'float 4s ease-in-out infinite';
        });
    });
</script>

@endsection