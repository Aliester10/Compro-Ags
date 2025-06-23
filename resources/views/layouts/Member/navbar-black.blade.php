<!-- Navbar Start-->

<body class="overflow-x-hidden font-WorkSans">
    @php
        $compro = \App\Models\CompanyParameter::first();
        // This query is already being passed from the controller as $ecommerces
        // We're keeping this line for the navbar only as a fallback
        $ecommercePartners = $ecommerces ?? \App\Models\BrandPartner::where('type', 'ecommerce')->get();
        
        // Ambil semua kategori beserta subcategori-nya untuk dropdown menu Product
        $kategoris = \App\Models\Kategori::with('subKategoris')->get();
    @endphp
        
<!-- Font loading and default font setup -->
<link rel="stylesheet" href="{{ asset('asset/css/fonts.css') }}">
<style>
    body, h1, h2, h3, h4, h5, h6, p, a, span, div, li, button, input {
        font-family: 'Work Sans', sans-serif;
    }

    /* Set all navbar text to black - changed from white to black */
    nav .navbar-content a,
    nav .navbar-content span,
    nav ion-icon,
    nav #ecommerce-toggle,
    nav svg {
        color: #000000 !important; /* Changed from #ffffff to #000000 */
    }
    
    nav svg {
        stroke: #000000 !important; /* Changed from #ffffff to #000000 */
    }

    /* CRITICALLY IMPORTANT: Override text color for dropdown menu items */
    #product-dropdown * {
        color: #000000 !important;
    }
    
    #product-dropdown a, 
    #product-dropdown span, 
    #product-dropdown h4, 
    #product-dropdown .product-dropdown-category-title,
    #product-dropdown .product-dropdown-subcategory a {
        color: #000000 !important;
    }

    /* Dropdown menu styling */
    #product-container {
        position: relative;
    }

    #product-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: max-content;
        min-width: 600px;
        z-index: 1000;
    }
    
    /* PENTING: Tampilkan dropdown saat hover pada desktop */
    @media (min-width: 768px) {
        #product-container:hover #product-dropdown {
            display: block;
        }
    }

    /* Triangle pointer styling */
    #product-dropdown:before {
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

    /* Product dropdown styling */
    .product-dropdown-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .product-dropdown-category {
        min-width: 300px;
    }
    
    .product-dropdown-category-title {
        font-weight: 600;
        color: #000000 !important;
        margin-bottom: 8px;
        padding-bottom: 4px;
        border-bottom: 1px solid #f0f0f0;
        cursor: pointer; /* Added to show it's clickable */
        transition: color 0.2s ease; /* Added for hover effect */
    }
    
    .product-dropdown-category-title:hover {
        color: #007bff !important; /* Added hover effect */
    }
    
    .product-dropdown-subcategory {
        margin-bottom: 5px;
    }
    
    .product-dropdown-subcategory a {
        color: #000000 !important; /* Mengubah warna menjadi hitam */
        font-weight: normal;
        font-size: 0.95rem;
        transition: color 0.2s ease;
        display: block;
        padding: 3px 0;
    }
    
    .product-dropdown-subcategory a:hover {
        color: #007bff !important;
    }

    /* Existing ecommerce dropdown styling */
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
    
    /* Improved Circular Search Styling */
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
        background-color: rgba(0, 0, 0, 0.1); /* Changed from white to dark background */
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
        background-color: rgba(0, 0, 0, 0.2); /* Changed from white to dark background */
    }

    .circular-search-icon {
        width: 20px;
        height: 20px;
        stroke: black; /* Changed from white to black */
        stroke-width: 2px;
    }

    .circular-search-input {
        background-color: rgba(0, 0, 0, 0.05); /* Changed from white to darker background */
        border: 1px solid rgba(0, 0, 0, 0.2); /* Changed from white to dark border */
        border-radius: 20px;
        padding: 8px 40px 8px 16px;
        width: 100%;
        color: black; /* Changed from white to black */
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
        background-color: rgba(0, 0, 0, 0.1); /* Changed from white to darker background */
        border-color: rgba(0, 0, 0, 0.3); /* Changed from white to dark border */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); /* Changed from white to dark shadow */
    }

    .circular-search-input::placeholder {
        color: rgba(0, 0, 0, 0.6); /* Changed from white to dark text */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .circular-search-container.active {
            width: 180px;
        }
        
        #product-dropdown {
            position: static;
            transform: none;
            min-width: 100%;
            box-shadow: none;
            border-radius: 0;
            margin-top: 10px;
            padding: 10px;
            background-color: #f0f0f0;
        }
        
        #product-dropdown:before {
            display: none;
        }
        
        .product-dropdown-container {
            flex-direction: column;
            gap: 10px;
        }
        
        .product-dropdown-category {
            min-width: 100%;
        }
        
        /* Update mobile navigation text color to black */
        .md\:static.absolute.bg-gray-800 {
            background-color: transparent !important;
        }
        
        .md\:static.absolute.bg-gray-800 a {
            color: #000000 !important;
        }
    }
</style>
    
<!-- top bar start -->
<div class="absolute top-0 left-0 right-0 z-50 w-full">
    <div class="w-full bg-gray-800 bg-opacity-80 backdrop-blur-md py-2 px-4 text-center">
        <h1 class="text-white font-Work Sans text-sm md:text-base">{{ $compro->nama_perusahaan }}</h1>
    </div>
<!-- top bar end -->


    <!-- Navbar with black text -->
<nav class="px-4 pb-4 pt-0 bg-transparent transition-all duration-300" id="mainNav">
        <div class="flex items-center justify-between relative navbar-content" id="navbarContent">
            <div class="flex items-center">
                <img class="w-[119px] h-[119px] cursor-pointer" src="{{ asset('assets/img/ags-icon-black.png') }}" alt="Logo" onclick="window.location.href='{{ url('/') }}'">
            </div>
            <div class="flex items-center">
                <span class="text-3xl cursor-pointer md:hidden block z-20 text-black"> <!-- Added text-black class -->
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
                <li class="mx-4 my-6 md:my-0 relative" id="product-container">
                    <a href="{{ route('product.index') }}" class="text-x1 hover:text-cyan-500 duration-500 font-semibold" id="product-toggle">Product</a>
                    
                    <!-- Product Dropdown Menu -->
                    <div id="product-dropdown">
                        <div class="product-dropdown-container">
                            @foreach($kategoris->chunk(ceil($kategoris->count() / 2)) as $kategoriChunk)
                                <div class="product-dropdown-column">
                                    @foreach($kategoriChunk as $kategori)
                                        <div class="product-dropdown-category">
                                            <!-- Updated to use member.product.category route -->
                                            <a href="{{ route('member.product.category', ['id' => $kategori->id]) }}" class="product-dropdown-category-title" style="display: block; text-decoration: none;">
                                                {{ $kategori->nama }}
                                            </a>
                                            @foreach($kategori->subKategoris as $subKategori)
                                                <div class="product-dropdown-subcategory">
                                                    <!-- Updated to use member.product.bidang route -->
                                                    <a href="{{ route('member.product.bidang', ['id' => $subKategori->id]) }}" style="color: #000000 !important;">
                                                        {{ $subKategori->name }}
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Mobile Product Dropdown -->
                    <div id="mobile-product-dropdown" class="hidden mt-2 w-full bg-gray-700 rounded-md p-3">
                        @foreach($kategoris as $kategori)
                            <div class="mb-3">
                                <!-- Updated to use member.product.category route -->
                                <a href="{{ route('member.product.category', ['id' => $kategori->id]) }}" class="font-semibold text-white border-b border-gray-600 pb-1 mb-1 block">
                                    {{ $kategori->nama }}
                                </a>
                                <div class="pl-2">
                                    @foreach($kategori->subKategoris as $subKategori)
                                        <div class="py-1">
                                            <!-- Updated to use member.product.bidang route -->
                                            <a href="{{ route('member.product.bidang', ['id' => $subKategori->id]) }}" class="text-gray-200 hover:text-white">
                                                {{ $subKategori->name }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </li>
                <li class="mx-4 my-6 md:my-0 relative group" id="ecommerce-container">
                    <a href="#" class="text-x1 hover:text-cyan-500 duration-500 font-semibold" id="ecommerce-toggle">E-Commerce</a>
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
                <!-- Contact Us Menu Item -->
                <li class="mx-4 my-6 md:my-0">
                    <a href="{{ route('contact') }}" class="text-x1 hover:text-cyan-500 duration-500 font-semibold">Contact Us</a>
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
                    
                <!-- New Circular Search Button with Fixed Styling -->
                <li class="mx-2 my-6 md:my-0">
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
    // Menerapkan warna hitam untuk semua teks dalam dropdown menu (tambahan inline script)
    document.addEventListener('DOMContentLoaded', function() {
        // Hapus style yang menyebabkan warna putih pada teks dropdown
        var dropdown = document.getElementById('product-dropdown');
        if (dropdown) {
            var links = dropdown.getElementsByTagName('a');
            for (var i = 0; i < links.length; i++) {
                links[i].style.color = '#000000';
            }
            
            var headings = dropdown.getElementsByTagName('h4');
            for (var i = 0; i < headings.length; i++) {
                headings[i].style.color = '#000000';
            }
        }
        
        // Apply black color to all navbar links
        var navbarLinks = document.querySelectorAll('nav a, nav span, nav ion-icon, nav svg');
        for (var i = 0; i < navbarLinks.length; i++) {
            navbarLinks[i].style.color = '#000000';
            if (navbarLinks[i].tagName.toLowerCase() === 'svg') {
                navbarLinks[i].style.stroke = '#000000';
            }
        }
        
        // Fungsi Menu asli
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
        
        // Product dropdown functionality - UPDATED FOR MOBILE ONLY
        const productContainer = document.getElementById('product-container');
        const productToggle = document.getElementById('product-toggle');
        const productDropdown = document.getElementById('product-dropdown');
        const mobileProductDropdown = document.getElementById('mobile-product-dropdown');
        
        // Toggle dropdown on click for mobile only
        if (productContainer && productToggle && mobileProductDropdown) {
            let isProductDropdownOpen = false;
            productToggle.addEventListener('click', function(e) {
                if (window.innerWidth < 768) {
                    e.preventDefault();
                    if (isProductDropdownOpen) {
                        mobileProductDropdown.classList.add('hidden');
                    } else {
                        mobileProductDropdown.classList.remove('hidden');
                    }
                    isProductDropdownOpen = !isProductDropdownOpen;
                }
            });
        }
        
        // E-commerce dropdown elements
        const ecommerceContainer = document.getElementById('ecommerce-container');
        const ecommerceToggle = document.getElementById('ecommerce-toggle');
        const desktopEcommerceDropdown = document.getElementById('desktop-ecommerce-dropdown');
        const mobileEcommerceDropdown = document.getElementById('mobile-ecommerce-dropdown');
        
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

        // E-commerce dropdown functionality
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
        
        // Updated Circular search functionality
        const searchToggle = document.getElementById('searchToggle');
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');
        const searchContainer = document.getElementById('searchContainer');
        
        let isSearchActive = false;
        
        if (searchToggle && searchForm && searchInput && searchContainer) {
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
    });
    
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
</script>

<!-- navbar -->

</body>

<!-- navbar end -->