@extends('layouts.Member.master')

@section('content')
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
            font-weight: 900;
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
            margin-bottom: 3px;
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

        /* Responsive adjustments */
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