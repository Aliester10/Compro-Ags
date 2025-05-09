@extends('layouts.Member.master')

@section('content')
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