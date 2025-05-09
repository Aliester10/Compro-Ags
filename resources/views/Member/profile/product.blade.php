@extends('layouts.Member.master5')

@section('content')
<!-- Product Header & Title -->
<div class="product-header-section">
    <h1 class="product-main-title">Product</h1>
    
    <div class="product-navigation">
        <ul class="product-nav-menu">
            <li><a href="{{ route('profile.user') }}">Profile User</a></li>
            <li class="active"><a href="{{ route('product.index') }}">Product</a></li>
            <li><a href="{{ route('product.specialist') }}">Talk to our Product Specialist</a></li>
        </ul>
    </div>
</div>

<!-- Filter Section -->
<div class="product-filter-section">
    <div class="filter-category">
        <h2 class="category-title">{{ isset($categoryName) ? $categoryName : 'Mechanical Engine - Lab. Fluida' }}</h2>
    </div>
    <div class="filter-options">
        <div class="dropdown-filter">
            <select class="form-select category-select" aria-label="Category filter">
                <option value="">{{ isset($selectedCategory) ? $selectedCategory : 'Mechanical Engineering' }}</option>
                @foreach ($categories ?? [] as $category)
                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="search-filter">
            <form action="{{ route('products.search') }}" method="GET" id="search-form">
                <input type="text" class="form-control" name="query" placeholder="Search Product" aria-label="Search" value="{{ request()->query('query') ?? '' }}">
                <button class="search-button" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Product Listing -->
<div class="product-listing">
    @forelse ($products ?? [] as $product)
    <div class="product-item" data-product-id="{{ $product->id }}">
        <div class="product-thumbnail">
            @if(isset($product->images) && count($product->images) > 0)
                <img src="{{ asset($product->images[0]->gambar) }}" alt="{{ $product->nama }}">
            @else
                <img src="{{ asset('assets/img/no-image.png') }}" alt="No Image Available">
            @endif
        </div>
        <div class="product-info">
            <h3 class="product-name">{{ $product->nama }}</h3>
            <p class="product-code">{{ $product->kode }}</p>
        </div>
    </div>
    @empty
    <!-- Empty product placeholders for demonstration (based on the screenshot) -->
    <div class="product-item">
        <div class="product-thumbnail">
            <img src="{{ asset('assets/img/products/hyd-22-008.jpg') }}" alt="Basic Hydraulic Bench">
        </div>
        <div class="product-info">
            <h3 class="product-name">Basic Hydraulic Bench with Hydrostatic Pressure and Bernoulli's Theorem</h3>
            <p class="product-code">HYD-22-008</p>
        </div>
    </div>
    
    <div class="product-item">
        <div class="product-thumbnail">
            <img src="{{ asset('assets/img/products/hyd-22-004.jpg') }}" alt="Bernoulli's">
        </div>
        <div class="product-info">
            <h3 class="product-name">Bernoulli's</h3>
            <p class="product-code">HYD-22-004</p>
        </div>
    </div>
    
    <div class="product-item">
        <div class="product-thumbnail">
            <img src="{{ asset('assets/img/products/hyd-22-005.jpg') }}" alt="Drainage & Seepage Tank">
        </div>
        <div class="product-info">
            <h3 class="product-name">Drainage & Seepage Tank</h3>
            <p class="product-code">HYD-22-005</p>
        </div>
    </div>
    
    <div class="product-item">
        <div class="product-thumbnail">
            <img src="{{ asset('assets/img/products/hyd-22-007.jpg') }}" alt="Impact of Jet">
        </div>
        <div class="product-info">
            <h3 class="product-name">Impact of Jet</h3>
            <p class="product-code">HYD-22-007</p>
        </div>
    </div>
    
    <div class="product-item">
        <div class="product-thumbnail">
            <img src="{{ asset('assets/img/products/adv-hyd-22-001.jpg') }}" alt="Advance Flume Test">
        </div>
        <div class="product-info">
            <h3 class="product-name">Advance Flume Test Open Channel 12.5 M</h3>
            <p class="product-code">ADV- HYD-22-001 12.5 M</p>
        </div>
    </div>
    
    <div class="product-item">
        <div class="product-thumbnail">
            <img src="{{ asset('assets/img/products/hyd-22-006.jpg') }}" alt="Orifice Discharge">
        </div>
        <div class="product-info">
            <h3 class="product-name">Orifice Discharge</h3>
            <p class="product-code">HYD-22-006</p>
        </div>
    </div>
    
    <div class="product-item">
        <div class="product-thumbnail">
            <img src="{{ asset('assets/img/products/hyd-22-003.jpg') }}" alt="Osborne Reynold">
        </div>
        <div class="product-info">
            <h3 class="product-name">Osborne Reynold</h3>
            <p class="product-code">HYD-22-003</p>
        </div>
    </div>
    @endforelse
    
    <!-- Empty product placeholders -->
    @for ($i = 0; $i < 7; $i++)
    <div class="product-item empty-product">
        <div class="product-thumbnail">
            <!-- Empty placeholder -->
        </div>
        <div class="product-info">
            <h3 class="product-name">Product Name</h3>
            <p class="product-code">Type</p>
        </div>
    </div>
    @endfor
</div>

<!-- Pagination -->
@if(isset($products) && $products instanceof \Illuminate\Pagination\LengthAwarePaginator)
<div class="pagination-container">
    {{ $products->links() }}
</div>
@else
<div class="pagination-container">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo; Previous</span>
                </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">01</a></li>
            <li class="page-item"><a class="page-link" href="#">02</a></li>
            <li class="page-item"><a class="page-link" href="#">03</a></li>
            <li class="page-item"><a class="page-link" href="#">04</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">Next &raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
@endif

<style>
/* Main Product Page Styling */
.product-header-section {
    text-align: center;
    padding: 30px 0 20px;
}

.product-main-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 20px;
}

/* Product Navigation Menu */
.product-navigation {
    border-bottom: 1px solid #e1e1e1;
    margin-bottom: 20px;
}

.product-nav-menu {
    list-style: none;
    display: flex;
    justify-content: center;
    padding: 0;
    margin: 0;
}

.product-nav-menu li {
    margin: 0 15px;
    padding: 10px 5px;
    position: relative;
}

.product-nav-menu li.active:after {
    content: "";
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #333;
}

.product-nav-menu a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    font-size: 16px;
}

/* Filter Section */
.product-filter-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 50px;
    margin-bottom: 30px;
}

.filter-category h2 {
    font-size: 22px;
    font-weight: 600;
    margin: 0;
}

.filter-options {
    display: flex;
    align-items: center;
}

.dropdown-filter {
    margin-right: 15px;
}

.form-select {
    padding: 10px 15px;
    border-radius: 25px;
    border: 1px solid #ddd;
    min-width: 200px;
    appearance: none;
    background-image: url('data:image/svg+xml;utf8,<svg fill="black" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 20px;
    padding-right: 30px;
}

.search-filter {
    position: relative;
}

.search-filter input {
    padding: 10px 15px;
    padding-right: 40px; 
    border-radius: 25px;
    border: 1px solid #ddd;
    min-width: 250px;
}

.search-button {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
}

/* Product Listing */
.product-listing {
    padding: 0 50px;
    margin-bottom: 50px;
}

.product-item {
    display: flex;
    border-bottom: 1px solid #e1e1e1;
    padding: 20px 0;
    transition: background-color 0.3s ease;
    cursor: pointer;
}

.product-item:hover {
    background-color: #f9f9f9;
}

.product-thumbnail {
    width: 75px;
    height: 75px;
    margin-right: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #eee;
    border-radius: 5px;
    overflow: hidden;
    background-color: #fff;
}

.product-thumbnail img {
    max-width: 90%;
    max-height: 90%;
    object-fit: contain;
}

.product-info {
    flex: 1;
}

.product-name {
    font-size: 16px;
    font-weight: 600;
    margin: 0 0 5px 0;
    color: #333;
}

.product-code {
    font-size: 14px;
    color: #777;
    margin: 0;
}

.empty-product .product-thumbnail {
    background-color: #f5f5f5;
}

/* Pagination */
.pagination-container {
    display: flex;
    justify-content: center;
    margin-bottom: 50px;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination .page-item {
    margin: 0 5px;
}

.pagination .page-link {
    padding: 8px 12px;
    border: 1px solid #ddd;
    color: #333;
    text-decoration: none;
    border-radius: 4px;
    display: block;
    transition: all 0.3s ease;
}

.pagination .page-item.active .page-link {
    background-color: #333;
    color: white;
    border-color: #333;
}

.pagination .page-link:hover:not(.active) {
    background-color: #f5f5f5;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .product-filter-section {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .filter-options {
        margin-top: 15px;
        width: 100%;
    }
    
    .dropdown-filter, .search-filter {
        width: 100%;
        margin-right: 0;
        margin-bottom: 10px;
    }
    
    .search-filter input {
        width: 100%;
    }
}

@media (max-width: 768px) {
    .product-nav-menu {
        flex-wrap: wrap;
    }
    
    .product-nav-menu li {
        margin: 0 10px 10px;
    }
    
    .product-listing {
        padding: 0 20px;
    }
    
    .product-filter-section {
        padding: 20px;
    }
}

@media (max-width: 576px) {
    .product-item {
        flex-direction: column;
    }
    
    .product-thumbnail {
        width: 100%;
        height: 100px;
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .pagination .page-link {
        padding: 6px 10px;
        font-size: 14px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Product item click handler - navigate to product detail page
    const productItems = document.querySelectorAll('.product-item:not(.empty-product)');
    productItems.forEach(item => {
        item.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id') || '1';
            window.location.href = `{{ route('product.show', '') }}/${productId}`;
        });
    });

    // Category dropdown handler
    const categoryDropdown = document.querySelector('.category-select');
    if (categoryDropdown) {
        categoryDropdown.addEventListener('change', function() {
            const categoryId = this.value;
            if (categoryId) {
                window.location.href = `{{ route('member.product.category', '') }}/${categoryId}`;
            }
        });
    }

    // Search handler
    const searchForm = document.getElementById('search-form');
    const searchInput = document.querySelector('.search-filter input');
    const searchButton = document.querySelector('.search-button');
    
    if (searchButton && searchInput) {
        searchButton.addEventListener('click', function(e) {
            e.preventDefault();
            if (searchInput.value.trim()) {
                searchForm.submit();
            }
        });
    }
});
</script>
@endsection