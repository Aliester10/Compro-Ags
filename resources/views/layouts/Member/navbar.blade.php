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
    /* Apply Work Sans font as default for the entire site */
    body, h1, h2, h3, h4, h5, h6, p, a, span, div, li, button, input {
        font-family: 'Work Sans', sans-serif;
    }
    
    /* Dropdown styling */
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

    /* Navbar transition classes */
    .navbar-dark {
        color: white;
    }
    
    .navbar-light {
        color: black;
    }

    .navbar-dark .nav-link {
        color: white;
    }
    
    .navbar-light .nav-link {
        color: black;
    }

    .navbar-dark svg {
        stroke: white;
    }
    
    .navbar-light svg {
        stroke: black;
    }

    /* Transition all color changes */
    .navbar-content, .navbar-content a, .navbar-content svg {
        transition: color 0.3s ease, stroke 0.3s ease;
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
</style>
    
    
    <!-- Main container for navbar positioning -->
    <div class="absolute top-0 left-0 right-0 z-50 w-full">
        <!-- Top bar -->
        <div class="w-full bg-gray-800 bg-opacity-80 backdrop-blur-md py-2 px-4 text-center">
            <h1 class="text-white font-Work Sans text-sm md:text-base">{{ $compro->nama_perusahaan }}</h1>
        </div>
        
        <!-- Transparent navbar -->
        <nav class="p-4 bg-transparent transition-all duration-300" id="mainNav">
            <div class="flex items-center justify-between relative navbar-content navbar-dark" id="navbarContent">
                <div class="flex items-center">
                    <img class="h-20 cursor-pointer" src="{{ asset('assets/img/AGS-logo.png') }}" alt="Logo" onclick="window.location.href='{{ url('/') }}'">
                </div>
                <div class="flex items-center">
                    <!-- Search button for mobile -->
                    <div class="md:hidden mr-4">
                        <form action="" class="relative mx-auto w-max">
                            <input type="search" 
                                  class="peer cursor-pointer relative z-10 h-12 w-12 rounded-full border bg-transparent pl-12 outline-none focus:w-full focus:cursor-text focus:border-white focus:pl-16 focus:pr-4" />
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute inset-y-0 my-auto h-8 w-12 border-r border-transparent px-3.5 peer-focus:border-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </form>
                    </div>
                    <span class="text-3xl cursor-pointer md:hidden block z-20">
                        <ion-icon name="menu" onclick="Menu(this)"></ion-icon>
                    </span>
                </div>
                <!-- Main navbar menu -->
                <ul class="md:flex md:items-center z-10 md:z-auto md:static absolute bg-gray-800 md:bg-transparent w-full left-0 md:w-auto md:py-0 py-4 md:pl-0 pl-7 md:opacity-100 opacity-0 top-[-400px] transition-all ease-in duration-500">
                    <li class="mx-4 my-6 md:my-0">
                        <a href="{{ route('home') }}" class="nav-link text-x1 hover:text-cyan-500 duration-500 drop-shadow-md font-semibold">Home</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0">
                        <a href="{{ route('about') }}" class="nav-link text-x1 hover:text-cyan-500 duration-500 drop-shadow-md font-semibold">About</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0">
                        <a href="{{ route('activity') }}" class="nav-link text-x1 hover:text-cyan-500 duration-500 drop-shadow-md font-semibold">Our Activities</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0">
                        <a href="{{ route('product.index') }}"  class="nav-link text-x1 hover:text-cyan-500 duration-500 drop-shadow-md font-semibold">Product</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0 relative group" id="ecommerce-container">
                        <a href="#" class="nav-link text-x1 hover:text-cyan-500 duration-500 drop-shadow-md font-semibold flex items-center gap-1" id="ecommerce-toggle">
                            E-Commerce
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 transition-transform duration-300" id="ecommerce-arrow">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </a>
                        
                        <!-- Desktop dropdown -->
                        <div id="desktop-ecommerce-dropdown" class="hidden absolute left-0 mt-2 w-60 bg-white rounded-md shadow-lg p-3 z-50">
                            <div class="flex flex-col gap-4">
                                @foreach($ecommercePartners as $partner)
                                <div class="flex justify-center">
                                    <a href="{{ $partner->url ?? '#' }}" class="hover:opacity-80 transition-opacity">
                                        <img src="{{ asset($partner->gambar) }}" alt="{{ $partner->nama }}" class="h-12 object-contain">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Mobile dropdown -->
                        <div id="mobile-ecommerce-dropdown" class="hidden mt-2 w-full bg-gray-700 rounded-md p-3">
                            <div class="flex flex-col gap-3">
                                @foreach($ecommercePartners as $partner)
                                <div class="flex justify-center">
                                    <a href="{{ $partner->url ?? '#' }}" class="hover:opacity-80 transition-opacity">
                                        <img src="{{ asset($partner->gambar) }}" alt="{{ $partner->nama }}" class="h-10 object-contain">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                        
                    <!-- Profile icon with dropdown menu -->
                    <li class="mx-2 my-6 md:my-0 relative" id="profile-container">
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
                    </li>
                    
                    <!-- Search form only for desktop view -->
                    <li class="mx-2 my-6 md:my-0 hidden md:block">
                        <form action="" class="relative mx-auto w-max">
                            <input type="search" 
                                  class="peer cursor-pointer relative z-10 h-12 w-12 rounded-full border bg-transparent pl-12 outline-none focus:w-full focus:cursor-text focus:border-current focus:pl-16 focus:pr-4" />
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute inset-y-0 my-auto h-8 w-12 border-r border-transparent px-3.5 peer-focus:border-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
            // Navbar dropdown functionality
            const ecommerceContainer = document.getElementById('ecommerce-container');
            const ecommerceToggle = document.getElementById('ecommerce-toggle');
            const desktopEcommerceDropdown = document.getElementById('desktop-ecommerce-dropdown');
            const mobileEcommerceDropdown = document.getElementById('mobile-ecommerce-dropdown');
            const ecommerceArrow = document.getElementById('ecommerce-arrow');
            const navbarContent = document.getElementById('navbarContent');
            
            // Profile dropdown functionality
            const profileToggle = document.getElementById('profile-toggle');
            const profileDropdown = document.getElementById('profile-dropdown');
            let isProfileDropdownOpen = false;
            
            // Profile dropdown toggle
            if (profileToggle && profileDropdown) {
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
            
            // Skip if elements don't exist
            if (ecommerceContainer && ecommerceToggle) {
                // Track dropdown state
                let isDropdownOpen = false;
                
                // Toggle dropdown on click
                ecommerceToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    if (window.innerWidth >= 768) { // Desktop view
                        if (isDropdownOpen) {
                            desktopEcommerceDropdown.classList.add('hidden');
                            ecommerceArrow.classList.remove('rotate-180');
                        } else {
                            desktopEcommerceDropdown.classList.remove('hidden');
                            ecommerceArrow.classList.add('rotate-180');
                        }
                    } else { // Mobile view
                        if (isDropdownOpen) {
                            mobileEcommerceDropdown.classList.add('hidden');
                            ecommerceArrow.classList.remove('rotate-180');
                        } else {
                            mobileEcommerceDropdown.classList.remove('hidden');
                            ecommerceArrow.classList.add('rotate-180');
                        }
                    }
                    
                    isDropdownOpen = !isDropdownOpen;
                });
                
                // Keep dropdown open when interacting with items inside
                if (desktopEcommerceDropdown) {
                    desktopEcommerceDropdown.addEventListener('click', function(e) {
                        // Only if clicking on a link, allow it to propagate
                        if (!e.target.closest('a')) {
                            e.stopPropagation();
                        }
                    });
                }
                
                if (mobileEcommerceDropdown) {
                    mobileEcommerceDropdown.addEventListener('click', function(e) {
                        // Only if clicking on a link, allow it to propagate
                        if (!e.target.closest('a')) {
                            e.stopPropagation();
                        }
                    });
                }
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (isDropdownOpen) {
                        if (!ecommerceContainer.contains(e.target)) {
                            if (window.innerWidth >= 768) {
                                desktopEcommerceDropdown.classList.add('hidden');
                            } else {
                                mobileEcommerceDropdown.classList.add('hidden');
                            }
                            ecommerceArrow.classList.remove('rotate-180');
                            isDropdownOpen = false;
                        }
                    }
                });
                
                // Handle window resize
                window.addEventListener('resize', function() {
                    // Close any open dropdowns when resizing
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

            // Dynamic navbar color detection
            function updateNavbarColor() {
                const contentSection = document.querySelector('section#content');
                const navbarContent = document.getElementById('navbarContent');
                
                if (contentSection && navbarContent) {
                    // Set up the IntersectionObserver
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                // Get the background color of the content section
                                const backgroundColor = window.getComputedStyle(contentSection).backgroundColor;
                                const rgb = backgroundColor.match(/\d+/g);
                                
                                if (rgb) {
                                    // Calculate luminance (perceived brightness)
                                    // Formula: 0.299*R + 0.587*G + 0.114*B
                                    const brightness = (0.299 * parseInt(rgb[0]) + 
                                                        0.587 * parseInt(rgb[1]) + 
                                                        0.114 * parseInt(rgb[2])) / 255;
                                    
                                    // If brightness is higher than 0.5, background is considered light
                                    if (brightness > 0.5) {
                                        navbarContent.classList.remove('navbar-dark');
                                        navbarContent.classList.add('navbar-light');
                                    } else {
                                        navbarContent.classList.remove('navbar-light');
                                        navbarContent.classList.add('navbar-dark');
                                    }
                                }
                            }
                        });
                    }, { threshold: 0.1 });

                    // Start observing
                    observer.observe(contentSection);
                }
            }

            // Initial call
            updateNavbarColor();
            
            // Update on scroll
            window.addEventListener('scroll', function() {
                updateNavbarColor();
            });
            
            // Update on window resize
            window.addEventListener('resize', function() {
                updateNavbarColor();
            });
            
            // Also check when DOM content might change (helps with dynamic content)
            const observer = new MutationObserver(function() {
                updateNavbarColor();
            });
            
            // Observe changes in the entire document body
            observer.observe(document.body, { 
                childList: true,
                subtree: true,
                attributeFilter: ['style', 'class']
            });
        });
    </script>
</body>