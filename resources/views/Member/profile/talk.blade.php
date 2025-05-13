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
    
    .breadcrumb-nav {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
    }
    
    .breadcrumb-nav a {
        color: #666;
        text-decoration: none;
        margin: 0 5px;
    }
    
    .breadcrumb-nav span {
        color: #666;
        margin: 0 5px;
    }
    
    .specialist-info {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 40px;
    }
    
    .specialist-title {
        color: #0d6efd;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .specialist-description {
        color: #666;
        font-size: 16px;
    }
    
    .contact-form-container {
        background-color: #4a90e2;
        border-radius: 15px;
        padding: 30px;
        max-width: 600px;
        margin: 0 auto 60px;
    }
    
    .contact-form-heading {
        color: white;
        font-size: 28px;
        font-weight: 600;
        text-align: center;
        margin-bottom: 25px;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-control {
        border-radius: 5px;
        padding: 12px 15px;
        border: none;
        width: 100%;
    }
    
    .message-textarea {
        height: 120px;
        resize: none;
    }
    
    .send-message-btn {
        background-color: white;
        color: #333;
        border: none;
        border-radius: 25px;
        padding: 10px 30px;
        font-weight: 500;
        font-size: 16px;
        cursor: pointer;
        display: block;
        margin: 20px auto 0;
    }
    
    .quick-call-btn {
        background-color: #25d366;
        color: white;
        border: none;
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: 500;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 15px auto 0;
        width: fit-content;
    }
    
    .quick-call-btn img {
        margin-right: 8px;
    }
    
    .footer-container {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        padding: 20px 0;
        border-top: 1px solid #eee;
    }
    
    .company-info {
        flex: 1;
    }
    
    .company-logo {
        margin-bottom: 15px;
        max-width: 120px;
    }
    
    .company-address {
        font-size: 14px;
        color: #666;
        margin-top: 10px;
    }
    
    .explore-section, .contact-section {
        flex: 1;
        padding: 0 20px;
    }
    
    .section-title {
        font-size: 20px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
    
    .section-title i {
        margin-right: 10px;
        color: #0d6efd;
    }
    
    .explore-links, .contact-links {
        list-style: none;
        padding: 0;
    }
    
    .explore-links li, .contact-links li {
        margin-bottom: 10px;
    }
    
    .explore-links a, .contact-links a {
        color: #666;
        text-decoration: none;
    }
    
    .social-icons {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }
    
    .social-icons a {
        color: #333;
        text-decoration: none;
    }
    
    .float-whatsapp {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #25d366;
        color: white;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    
    @media (max-width: 767.98px) {
        .footer-container {
            flex-direction: column;
        }
        
        .explore-section, .contact-section {
            margin-top: 30px;
            padding: 0;
        }
        
        .contact-form-container {
            padding: 20px;
        }
    }
</style>

<div class="container" style="margin-top: 15rem;">
    <h1 class="main-heading">Talk to our Product Specialist</h1>
    
    <div class="nav-tabs-container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.user') }}">Profile User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('product.index') }}">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Talk to our Product Specialist</a>
            </li>
        </ul>
    </div>
    
    <div class="breadcrumb-nav">
        <a href="{{ route('profile.user') }}">Profile User</a>
        <span>></span>
        <a href="{{ route('product.index') }}">Product History</a>
        <span>></span>
        <span>Talk to our Product Specialist</span>
    </div>
    
    <div class="specialist-info">
        <h2 class="specialist-title">Need Expert Advice? Talk to Our Product Specialist!</h2>
        <p class="specialist-description">Get personalized recommendations and detailed product explanations tailored to your needs.</p>
    </div>
    
    <div class="contact-form-container">
        <h3 class="contact-form-heading">Leave Message</h3>
        <form action="{{ route('specialist.contact') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="full_name" placeholder="Full Name *" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email *" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="company" placeholder="Company">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="tel" class="form-control" name="phone" placeholder="Phone *" required>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <textarea class="form-control message-textarea" name="message" placeholder="Your Message *" required></textarea>
            </div>
            
            <button type="submit" class="send-message-btn">Send Message</button>
        </form>
        
        <a href="https://wa.me/+6281855840913" class="quick-call-btn">
            <img src="{{ asset('images/whatsapp-icon.png') }}" alt="WhatsApp" width="24" height="24">
            Quick Call
        </a>
    </div>
    
    <div class="footer-container">
        <div class="company-info">
            <img src="{{ asset('images/ags-logo.png') }}" alt="AGS Logo" class="company-logo">
            <h4>PT. Arkamaya Guna Saharsa</h4>
            <p class="company-address">
                Perumahan Mira Mataram<br>
                Jl. Mataram Raya-HB Blok A2 No. 3, Kb. Manggis,<br>
                Kec. Matraman, Daerah Khusus Ibukota Jakarta 13150
            </p>
        </div>
        
        <div class="explore-section">
            <h4 class="section-title">
                <i class="fas fa-compass"></i> Explore
            </h4>
            <ul class="explore-links">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Our Activities</a></li>
                <li><a href="#">Product</a></li>
                <li><a href="#">E-Commerce</a></li>
            </ul>
        </div>
        
        <div class="contact-section">
            <h4 class="section-title">
                <i class="fas fa-phone-alt"></i> Contact Information
            </h4>
            <ul class="contact-links">
                <li><i class="fas fa-phone"></i> +62 855-5716-5039</li>
                <li><i class="fas fa-phone"></i> (021) 85840913</li>
                <li><i class="fas fa-envelope"></i> info@arkamaya-tata.com</li>
            </ul>
            <div class="social-icons">
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    
    <a href="https://wa.me/+6281855840913" class="float-whatsapp">
        <i class="fab fa-whatsapp fa-2x"></i>
    </a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add active class based on current URL
    const currentUrl = window.location.pathname;
    
    const navLinks = document.querySelectorAll('.nav-tabs .nav-link');
    navLinks.forEach(link => {
        // Remove active class from all links
        link.classList.remove('active');
        
        // Check if link href matches current URL or contains "specialist"
        if (link.getAttribute('href') === currentUrl || 
            (currentUrl.includes('/specialist') && link.textContent.includes('Specialist')) ||
            (currentUrl.includes('/product') && link.textContent.includes('Product') && !link.textContent.includes('Specialist')) ||
            (currentUrl.includes('/profile-user') && link.textContent.includes('Profile User'))) {
            link.classList.add('active');
        }
    });
});
</script>
@endsection