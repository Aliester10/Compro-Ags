@extends('layouts.Member.master')

@section('content')
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