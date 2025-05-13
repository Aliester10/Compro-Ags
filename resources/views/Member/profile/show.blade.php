@extends('layouts.Member.master')

@section('content')
<style>
    .custom-form-control {
        width: 100%;
        height: 73px;
        border-radius: 10px;
        padding: 0 15px;
        border: 1px solid #ddd;
    }
    
    .section-heading {
        font-size: clamp(20px, 5vw, 24px);
        font-weight: 600;
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
    }
    
    .required-field {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
    }
    
    .nav-tabs-container {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
        border-bottom: 1px solid #dee2e6;
    }
    
    .nav-tabs {
        border-bottom: none;
        margin-bottom: 0;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .nav-tabs .nav-link {
        color: #666;
        border: none;
        padding: 12px 15px;
        font-size: clamp(14px, 3vw, 16px);
        text-align: center;
    }
    
    .nav-tabs .nav-link.active {
        color: #000;
        font-weight: 500;
        border-bottom: 2px solid #0d6efd;
    }
    
    .main-heading {
        text-align: center;
        font-size: clamp(24px, 6vw, 32px);
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .btn-edit {
        background-color: #0d6efd;
        color: white;
        height: 50px;
        border-radius: 5px;
        font-weight: 500;
        padding: 0 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 30px auto;
        width: 200px;
        max-width: 90%;
        text-align: center;
    }
    
    .phone-input-group {
        display: flex;
        flex-wrap: wrap;
    }
    
    .phone-prefix {
        width: 80px;
        height: 73px;
        border: 1px solid #ddd;
        border-radius: 10px 0 0 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }
    
    .phone-input {
        flex: 1;
        border-radius: 0 10px 10px 0;
    }
    
    @media (max-width: 767.98px) {
        .container {
            margin-top: 8rem !important;
            padding: 0 15px;
        }
        
        .custom-form-control {
            height: 60px;
        }
        
        .phone-prefix {
            height: 60px;
        }
        
        .nav-tabs {
            overflow-x: auto;
            justify-content: flex-start;
            padding-bottom: 5px;
        }
        
        .nav-tabs-container {
            overflow-x: auto;
        }
    }
    
    @media (max-width: 575.98px) {
        .container {
            margin-top: 5rem !important;
        }
        
        .nav-tabs .nav-link {
            padding: 10px 8px;
            font-size: 14px;
        }
        
        .btn-edit {
            height: 45px;
            width: 180px;
        }
    }
</style>

<div class="container" style="margin-top: 15rem;">
    <h1 class="main-heading">User Account</h1>
    
    <div class="nav-tabs-container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">Profile User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('product.index') }}">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Talk to our Product Specialist</a>
            </li>
        </ul>
    </div>
    
    <div class="row">
        <div class="col-lg-6 col-md-12 mb-4">
            <h2 class="section-heading">General Information</h2>
            <p class="required-field">*Required field</p>
            
            <div class="mb-4">
                <label class="form-label">Full Name *</label>
                <input type="text" class="custom-form-control" value="{{ $user->name }}" readonly>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Gender *</label>
                <input type="text" class="custom-form-control" value="{{ $user->gender }}" readonly>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Phone Number</label>
                <div class="phone-input-group">
                    <div class="phone-prefix">
                        +62
                    </div>
                    <input type="text" class="custom-form-control phone-input" value="{{ $user->no_telp ?? 'N/A' }}" readonly>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Email *</label>
                <input type="email" class="custom-form-control" value="{{ $user->email }}" readonly>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Date of Birth *</label>
                <input type="text" class="custom-form-control" value="{{ $user->date_of_birth }}" readonly>
                <small class="text-muted">Format DD/MM/YY</small>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Alamat</label>
                <input type="text" class="custom-form-control" value="{{ $user->alamat ?? 'N/A' }}" readonly>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-12">
            <h2 class="section-heading">User Profile Details</h2>
            <p class="required-field">*Required field</p>
            
            <div class="mb-4">
                <label class="form-label">Account Type</label>
                <input type="text" class="custom-form-control" value="{{ ucfirst($user->type ?? 'Member') }}" readonly>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Account Status</label>
                <input type="text" class="custom-form-control" value="Active" readonly>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Member Since</label>
                <input type="text" class="custom-form-control" value="{{ $user->created_at->format('d M Y') }}" readonly>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Last Updated</label>
                <input type="text" class="custom-form-control" value="{{ $user->updated_at->format('d M Y') }}" readonly>
            </div>
        </div>
    </div>
    
    @if (auth()->check())
        <a href="{{ auth()->user()->type === 'member' ? route('profile.edit') : route('distributor.profile.edit') }}" 
           class="btn btn-edit">Edit Profile</a>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add active class based on current URL
    const currentUrl = window.location.pathname;
    
    const navLinks = document.querySelectorAll('.nav-tabs .nav-link');
    navLinks.forEach(link => {
        // Remove active class from all links
        link.classList.remove('active');
        
        // Check if link href matches current URL
        if (link.getAttribute('href') === currentUrl || 
            (currentUrl.includes('/product') && link.textContent.includes('Product') && !link.textContent.includes('Specialist')) ||
            (currentUrl.includes('/profile-user') && link.textContent.includes('Profile User'))) {
            link.classList.add('active');
        }
    });
});
</script>
@endsection