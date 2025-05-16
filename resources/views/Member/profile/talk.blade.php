@extends('layouts.Member.master-black')

@section('content')

<style>
    .page-title {
        text-align: center;
        font-size: clamp(24px, 6vw, 32px);
        font-weight: 700;
        margin-bottom: 20px;
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
    
    .specialist-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .specialist-header h2 {
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .blue-text {
        color: #2786F0;
    }
    
    .red-text {
        color: #ED184B;
    }
    
    .specialist-header p {
        max-width: 800px;
        margin: 0 auto;
        color: #555;
    }
    
    .contact-form {
        background-color: #4a90e2;
        border-radius: 15px;
        padding: 25px;
        max-width: 600px;
        margin: 0 auto 40px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .form-title {
        color: white;
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
        font-weight: 600;
    }
    
    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        margin-bottom: 15px;
        border: none;
    }
    
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }
    
    .btn-send {
        background-color: white;
        color: #4a90e2;
        font-weight: 600;
        border-radius: 25px;
        padding: 10px 30px;
        border: none;
        display: block;
        margin: 0 auto;
        transition: all 0.3s;
    }
    
    .btn-send:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
    }
    
    .quick-call {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 15px auto 0;
        background-color: #25D366;
        border-radius: 20px;
        width: 201px;
        height: 59px;
        color: white;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .quick-call:hover {
        background-color: #128C7E;
        transform: translateY(-2px);
    }
    
    .quick-call img {
        width: 24px;
        height: 24px;
        margin-right: 8px;
    }
    
    .tab-links {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }
    
    .tab-links a {
        margin: 0 15px;
        padding: 5px 0;
        text-decoration: none;
        color: #666;
    }
    
    .tab-links a.active {
        color: #000;
        border-bottom: 2px solid #000;
        font-weight: 500;
    }
    
    @media (max-width: 767.98px) {
        .container {
            margin-top: 8rem !important;
            padding: 0 15px;
        }
        
        .contact-form {
            padding: 20px 15px;
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
    }
</style>

<div class="container" style="margin-top: 15rem;">
    <h1 class="page-title">Talk to our Product Specialist</h1>
    
    <div class="tab-links">
        <a href="{{ route('profile.show') }}">Profile User</a>
        <a href="#">Products</a>
        <a href="{{ route('profile.talk') }}" class="active">Talk to our Product Specialist</a>
    </div>
    
    <div class="specialist-header">
        <h2><span class="blue-text">Need Expert Advice?</span> <span class="red-text">Talk to Our Product Specialist!</span></h2>
        <p>Get personalized recommendations and detailed product explanations tailored to your needs.</p>
    </div>
    
    <div class="contact-form">
        <h2 class="form-title">Leave Message</h2>
        <form action="{{ route('specialist.message') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Full Name*" required>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email*" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="company" name="company" placeholder="Company">
                </div>
                <div class="col-md-6">
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone*" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <textarea class="form-control" id="message" name="message" placeholder="Your Message*" required></textarea>
                </div>
            </div>
            
            <button type="submit" class="btn btn-send">Send Message</button>
            
            <a href="https://wa.me/6282272018609" class="quick-call" target="_blank">
                <img src="{{ asset('assets/img/whatsapp-icon.png') }}" alt="WhatsApp">
                <span>Quick Call</span>
            </a>
        </form>
    </div>
</div>
<!-- Tambahkan SweetAlert2 & Animate.css CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<!-- SweetAlert untuk Session Success -->
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            confirmButtonColor: '#4CAF50',
            confirmButtonText: 'OK',
            customClass: {
                popup: 'animate_animated animate_fadeInDown'
            }
        });
    </script>
@endif

<!-- SweetAlert untuk Session Error -->
@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session("error") }}',
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK',
            customClass: {
                popup: 'animate_animated animate_shakeX'
            }
        });
    </script>
@endif

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
            (currentUrl.includes('/profile-user') && link.textContent.includes('Profile User')) ||
            (currentUrl.includes('/talk') && link.textContent.includes('Talk to our Product Specialist'))) {
            link.classList.add('active');
        }
    });
    
    // Also handle tab links
    const tabLinks = document.querySelectorAll('.tab-links a');
    tabLinks.forEach(link => {
        link.classList.remove('active');
        
        if (link.getAttribute('href') === currentUrl || 
            (currentUrl.includes('/talk') && link.textContent.includes('Talk to our Product Specialist')) ||
            (currentUrl.includes('/profile-user') && link.textContent.includes('Profile User'))) {
            link.classList.add('active');
        }
    });
});
</script>
@endsection