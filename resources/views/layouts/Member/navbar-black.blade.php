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
    
    /* Improved Circular Search Styling with BLACK theme */
    .circular-search-container {
        position: relative;
        display: flex;
        align-items: center;
        width: 40px;
        transition: width 0.3s ease;
    }

    .circular-search-container.active {
        width: 250px;
    }

    .circular-search-form {
        display: flex;
        align-items: center;
        width: 100%;
        position: relative;
    }

    .circular-search-button {
        background-color: rgba(0, 0, 0, 0.1);
        border: none;
        border-radius: 50%;
        min-width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: absolute;
        right: 0;
        z-index: 20;
    }

    .circular-search-button:hover {
        background-color: rgba(0, 0, 0, 0.15);
    }

    .circular-search-icon {
        width: 20px;
        height: 20px;
        stroke: #000000;
        stroke-width: 2px;
    }

    .circular-search-input {
        background-color: rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 20px;
        padding: 8px 40px 8px 16px;
        width: 100%;
        color: #000000;
        font-size: 14px;
        opacity: 0;
        position: absolute;
        right: 0;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .circular-search-container.active .circular-search-input {
        opacity: 1;
        pointer-events: auto;
    }

    .circular-search-input:focus {
        outline: none;
        background-color: rgba(0, 0, 0, 0.07);
        border-color: rgba(0, 0, 0, 0.3);
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .circular-search-input::placeholder {
        color: rgba(0, 0, 0, 0.7);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .circular-search-container.active {
            width: 180px;
        }
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
                <!-- Mobile-only circular search button -->
                <div class="md:hidden mr-4">
                    <div class="circular-search-container" id="mobileSearchContainer">
                        <form action="{{ route('products.search') }}" method="GET" class="circular-search-form" id="mobileSearchForm">
                            <input type="search" 
                                name="query"
                                class="circular-search-input" 
                                id="mobileSearchInput"
                                placeholder="Search products..." />
                            <button type="button" class="circular-search-button" id="mobileSearchToggle">
                                <svg xmlns="http://www.w3.org/2000/svg" class="circular-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>
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
                    
                <!-- Desktop circular search button -->
                <li class="mx-2 my-6 md:my-0 hidden md:block">
                    <div class="circular-search-container" id="searchContainer">
                        <form action="{{ route('products.search') }}" method="GET" class="circular-search-form" id="searchForm">
                            <input type="search" 
                                name="query"
                                class="circular-search-input" 
                                id="searchInput"
                                placeholder="Search products..." />
                            <button type="button" class="circular-search-button" id="searchToggle">
                                <svg xmlns="http://www.w3.org/2000/svg" class="circular-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>
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
        
        // Desktop circular search functionality
        const searchToggle = document.getElementById('searchToggle');
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');
        const searchContainer = document.getElementById('searchContainer');
        
        let isSearchActive = false;
        
        if (searchToggle && searchContainer) {
            searchToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (!isSearchActive) {
                    // Activate search
                    searchContainer.classList.add('active');
                    setTimeout(() => {
                        searchInput.focus();
                    }, 300); // Wait for transition to complete
                    isSearchActive = true;
                } else {
                    // If input has value, submit the search
                    if (searchInput.value.trim() !== '') {
                        searchForm.submit();
                    } else {
                        // Otherwise hide the search input
                        searchContainer.classList.remove('active');
                        isSearchActive = false;
                    }
                }
            });
            
            // Hide search when clicking outside
            document.addEventListener('click', function(e) {
                if (isSearchActive && !searchContainer.contains(e.target)) {
                    searchContainer.classList.remove('active');
                    isSearchActive = false;
                }
            });
            
            // Submit search on Enter key
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    if (this.value.trim() !== '') {
                        searchForm.submit();
                    }
                }
            });
        }
        
        // Mobile circular search functionality
        const mobileSearchToggle = document.getElementById('mobileSearchToggle');
        const mobileSearchForm = document.getElementById('mobileSearchForm');
        const mobileSearchInput = document.getElementById('mobileSearchInput');
        const mobileSearchContainer = document.getElementById('mobileSearchContainer');
        
        let isMobileSearchActive = false;
        
        if (mobileSearchToggle && mobileSearchContainer) {
            mobileSearchToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (!isMobileSearchActive) {
                    // Activate search
                    mobileSearchContainer.classList.add('active');
                    setTimeout(() => {
                        mobileSearchInput.focus();
                    }, 300); // Wait for transition to complete
                    isMobileSearchActive = true;
                } else {
                    // If input has value, submit the search
                    if (mobileSearchInput.value.trim() !== '') {
                        mobileSearchForm.submit();
                    } else {
                        // Otherwise hide the search input
                        mobileSearchContainer.classList.remove('active');
                        isMobileSearchActive = false;
                    }
                }
            });
            
            // Hide search when clicking outside
            document.addEventListener('click', function(e) {
                if (isMobileSearchActive && !mobileSearchContainer.contains(e.target)) {
                    mobileSearchContainer.classList.remove('active');
                    isMobileSearchActive = false;
                }
            });
            
            // Submit search on Enter key
            mobileSearchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    if (this.value.trim() !== '') {
                        mobileSearchForm.submit();
                    }
                }
            });
        }
    });
</script>
<!-- Navbar End -->