@extends('layouts.Member.master-white')

@section('content')

<style>
    /* Font import */
    @import url('/assets/css/fonts.css');
    /* Import AOS CSS for scroll animations */
    @import url('https://unpkg.com/aos@2.3.1/dist/aos.css');
    
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
    
    /* Reset body dan html untuk menghindari overlap */
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }
    
    /* Enhanced Header Styles - Updated for Contact Us */
    .hero-header {
        position: relative;
        height: 100vh;
        min-height: 600px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    
    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset('assets/img/contact us.jpg') }}') no-repeat center center;
        background-size: cover;
        z-index: 1;
        filter: brightness(0.8) contrast(1.1);
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            135deg,
            rgba(0, 0, 0, 0.5) 0%,
            rgba(0, 0, 0, 0.4) 50%,
            rgba(0, 0, 0, 0.6) 100%
        );
        z-index: 2;
    }
    
    /* Company name at top */
    .company-header {
        position: absolute;
        top: 2rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 4;
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: 0.875rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.9);
        text-align: center;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }
    
    .hero-content {
        position: relative;
        z-index: 3;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 2rem;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .hero-title {
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: clamp(3rem, 10vw, 5rem);
        font-weight: 900;
        line-height: 1.1;
        letter-spacing: -0.02em;
        color: #ffffff;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
        margin-bottom: 0.5rem;
        text-align: center;
    }
    
    .hero-subtitle {
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: clamp(1.25rem, 4vw, 1.75rem);
        font-weight: 600;
        line-height: 1.3;
        color: rgba(255, 255, 255, 0.95);
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
        margin-bottom: 0.5rem;
    }
    
    .hero-year {
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: clamp(1rem, 3vw, 1.375rem);
        font-weight: 500;
        color: rgba(255, 255, 255, 0.8);
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }
    
    .scroll-indicator {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 4;
        color: rgba(255, 255, 255, 0.8);
        animation: bounce 2s infinite;
        cursor: pointer;
    }

    /* Contact Section Styles */
    .contact-section {
        padding: 6rem 0;
        background-color: #f8fafc;
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    
    .contact-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: start;
    }
    
    .contact-form-wrapper {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .contact-form-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    .contact-form-subtitle {
        color: #64748b;
        font-size: 1rem;
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .form-input {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 0.875rem;
        font-family: 'Work Sans', sans-serif;
        transition: all 0.3s ease;
        background-color: #ffffff;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        background-color: #ffffff;
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }
    
    .submit-button {
        width: 100%;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        font-family: 'Work Sans', sans-serif;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    
    .submit-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
    }
    
    .submit-button:active {
        transform: translateY(0);
    }
    
    /* Contact Info Styles */
    .contact-info {
        padding: 2rem 0;
    }
    
    .company-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 2rem;
    }
    
    .info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .info-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .info-icon {
        color: #3b82f6;
        font-size: 1.25rem;
        margin-right: 1rem;
        margin-top: 0.25rem;
        flex-shrink: 0;
    }
    
    .info-content {
        flex: 1;
    }
    
    .info-title {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
    }
    
    .info-text {
        color: #64748b;
        line-height: 1.6;
        font-size: 0.875rem;
    }
    
    .info-text a {
        color: #3b82f6;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .info-text a:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }
    
    /* Social Media Styles */
    .social-section {
        margin-top: 3rem;
    }
    
    .social-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1rem;
    }
    
    .social-links {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        border-radius: 12px;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    
    .social-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }
    
    .social-facebook { background: linear-gradient(135deg, #1877f2 0%, #0d47a1 100%); }
    .social-twitter { background: linear-gradient(135deg, #1da1f2 0%, #0d47a1 100%); }
    .social-youtube { background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%); }
    .social-linkedin { background: linear-gradient(135deg, #0077b5 0%, #004182 100%); }
    .social-instagram { background: linear-gradient(135deg, #e4405f 0%, #833ab4 100%); }

    /* Animation keyframes */
    @keyframes fadeInUp {
        0% { 
            opacity: 0; 
            transform: translateY(60px); 
        }
        100% { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
    
    @keyframes fadeInDown {
        0% { 
            opacity: 0; 
            transform: translateY(-60px); 
        }
        100% { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateX(-50%) translateY(0);
        }
        40% {
            transform: translateX(-50%) translateY(-10px);
        }
        60% {
            transform: translateX(-50%) translateY(-5px);
        }
    }
    
    .header-content-animated {
        animation: fadeInUp 1.2s ease-out;
    }
    
    /* Alert Styles */
    .alert {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        color: white;
        font-weight: 600;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        max-width: 400px;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
    
    .alert-error {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }
    
    /* Enhanced Media queries for better responsiveness */
    @media (max-width: 768px) {
        .hero-header {
            min-height: 500px;
            border-radius: 0 0 15px 15px;
        }
        
        .company-header {
            top: 1.5rem;
            font-size: 0.75rem;
        }
        
        .hero-content {
            padding: 1rem;
        }
        
        .scroll-indicator {
            bottom: 1rem;
        }
        
        .contact-section {
            padding: 3rem 0;
        }
        
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .contact-form-wrapper {
            padding: 2rem;
            margin: 0 1rem;
        }
        
        .form-row {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .contact-info {
            margin: 0 1rem;
        }
        
        .alert {
            bottom: 1rem;
            right: 1rem;
            left: 1rem;
            max-width: none;
        }
    }
    
    @media (max-width: 576px) {
        .hero-header {
            min-height: 450px;
            border-radius: 0 0 10px 10px;
        }
        
        .company-header {
            top: 1rem;
            font-size: 0.7rem;
        }
        
        .hero-title {
            margin-bottom: 0.75rem;
        }
        
        .contact-form-wrapper {
            padding: 1.5rem;
        }
        
        .contact-form-title {
            font-size: 1.5rem;
        }
    }
    
    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }
    
    /* Performance optimizations */
    .hero-background {
        will-change: transform;
    }
    
    .hero-content-animated {
        will-change: opacity, transform;
    }
</style>

<!-- Enhanced Header Start -->
<div class="hero-header">
    
    <!-- Background Image -->
    <div class="hero-background"></div>
    
    <!-- Enhanced Overlay -->
    <div class="hero-overlay"></div>
    
    <!-- Enhanced Header Content -->
    <div class="hero-content header-content-animated">
        <h1 class="hero-title" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
            Contact Us.
        </h1>
        <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000">
            We'd love to hear from you
        </p>
        <p class="hero-year" data-aos="fade-up" data-aos-delay="700" data-aos-duration="1000">
            {{ date('Y') }}
        </p>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="scroll-indicator" data-aos="fade-in" data-aos-delay="1200" onclick="scrollToContent()">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M7.41 8.84L12 13.42L16.59 8.84L18 10.25L12 16.25L6 10.25L7.41 8.84Z"/>
        </svg>
    </div>
</div>
<!-- Enhanced Header End -->

<!-- Contact Section Start -->
<div class="contact-section" id="contact-content">
    <div class="contact-container">
        <div class="contact-grid">
            <!-- Contact Form -->
            <div class="contact-form-wrapper" data-aos="fade-up" data-aos-delay="200">
                <h2 class="contact-form-title">Contact.</h2>
                <p class="contact-form-subtitle">Ready to take the next step? Let's build something great together!</p>
                
                <form action="{{ route('guest-messages.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="company" class="form-label">Company</label>
                            <input type="text" id="company" name="company" class="form-input">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" id="phone" name="phone" class="form-input">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" name="message" class="form-input form-textarea" required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-button">
                        Send Message
                    </button>
                </form>
            </div>
            
            <!-- Contact Information - Updated untuk menggunakan data dari database -->
            <div class="contact-info" data-aos="fade-up" data-aos-delay="400">
                <h3 class="company-title">
                    {{ $companyInfo->nama_perusahaan ?? 'PT Advancya Cipta Solution' }}
                </h3>
                
                @if($companyInfo && $companyInfo->alamat)
                <div class="info-item">
                    <i class="fas fa-map-marker-alt info-icon"></i>
                    <div class="info-content">
                        <p class="info-title">Head Office:</p>
                        <p class="info-text">{{ $companyInfo->alamat }}</p>
                    </div>
                </div>
                @endif
                
                @if($companyInfo && ($companyInfo->whatsapp_1 || $companyInfo->no_wa))
                <div class="info-item">
                    <i class="fas fa-phone info-icon"></i>
                    <div class="info-content">
                        <p class="info-title">WhatsApp:</p>
                        <p class="info-text">
                            <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $companyInfo->whatsapp_1 ?? $companyInfo->no_wa) }}" target="_blank">
                                {{ $companyInfo->whatsapp_1 ?? $companyInfo->no_wa }}
                            </a>
                        </p>
                    </div>
                </div>
                @endif
                
                @if($companyInfo && $companyInfo->email)
                <div class="info-item">
                    <i class="fas fa-envelope info-icon"></i>
                    <div class="info-content">
                        <p class="info-title">Email:</p>
                        <p class="info-text">
                            <a href="mailto:{{ $companyInfo->email }}">{{ $companyInfo->email }}</a>
                        </p>
                    </div>
                </div>
                @endif
                
                @if($companyInfo && $companyInfo->no_telepon)
                <div class="info-item">
                    <i class="fas fa-phone-alt info-icon"></i>
                    <div class="info-content">
                        <p class="info-title">Phone:</p>
                        <p class="info-text">
                            <a href="tel:{{ str_replace(['+', '-', ' '], '', $companyInfo->no_telepon) }}">
                                {{ $companyInfo->no_telepon }}
                            </a>
                        </p>
                    </div>
                </div>
                @endif
                
                @if($companyInfo && $companyInfo->whatsapp_2)
                <div class="info-item">
                    <i class="fas fa-phone info-icon"></i>
                    <div class="info-content">
                        <p class="info-title">WhatsApp 2:</p>
                        <p class="info-text">
                            <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $companyInfo->whatsapp_2) }}" target="_blank">
                                {{ $companyInfo->whatsapp_2 }}
                            </a>
                        </p>
                    </div>
                </div>
                @endif
                
                @if($companyInfo && $companyInfo->website)
                <div class="info-item">
                    <i class="fas fa-globe info-icon"></i>
                    <div class="info-content">
                        <p class="info-title">Website:</p>
                        <p class="info-text">
                            <a href="{{ $companyInfo->website }}" target="_blank">
                                {{ $companyInfo->website }}
                            </a>
                        </p>
                    </div>
                </div>
                @endif
                
                @if($companyInfo && $companyInfo->maps)
                <div class="info-item">
                    <i class="fas fa-map info-icon"></i>
                    <div class="info-content">
                        <p class="info-title">Location Map:</p>
                        <p class="info-text">
                            <a href="{{ $companyInfo->maps }}" target="_blank">View on Maps</a>
                        </p>
                    </div>
                </div>
                @endif
                
                @if($companyInfo && $companyInfo->nomor_induk_berusaha)
                <div class="info-item">
                    <i class="fas fa-building info-icon"></i>
                    <div class="info-content">
                        <p class="info-title">Business Registration Number:</p>
                        <p class="info-text">{{ $companyInfo->nomor_induk_berusaha }}</p>
                    </div>
                </div>
                @endif
                
                <!-- Social Media -->
                <div class="social-section">
                    <h4 class="social-title">Social Media</h4>
                    <div class="social-links">
                        @if($companyInfo && $companyInfo->instagram)
                        <a href="{{ $companyInfo->instagram }}" class="social-link social-instagram" target="_blank" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        @endif
                        
                        @if($companyInfo && $companyInfo->linkedin)
                        <a href="{{ $companyInfo->linkedin }}" class="social-link social-linkedin" target="_blank" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        @endif
                        
                        @if($companyInfo && $companyInfo->ekatalog)
                        <a href="{{ $companyInfo->ekatalog }}" class="social-link social-facebook" target="_blank" title="E-Katalog">
                            <i class="fas fa-store"></i>
                        </a>
                        @endif
                        
                        <!-- Tambahkan social media lain jika diperlukan -->
                        @if(!$companyInfo || (!$companyInfo->instagram && !$companyInfo->linkedin && !$companyInfo->ekatalog))
                        <!-- Default social media jika tidak ada data -->
                        <a href="#" class="social-link social-facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link social-twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link social-youtube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="social-link social-linkedin">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-link social-instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Section End -->

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function() {
            document.querySelector('.alert-success').style.display = 'none';
        }, 5000);
    </script>
@endif

@if(session('error'))
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
    <script>
        setTimeout(function() {
            document.querySelector('.alert-error').style.display = 'none';
        }, 5000);
    </script>
@endif

<!-- Include AOS library for scroll animations -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<script>
    // Enhanced AOS initialization
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            once: true,
            mirror: false,
            offset: 100,
            duration: 800,
            easing: 'ease-out-cubic',
            disable: function() {
                return window.innerWidth < 768;
            }
        });
    });
    
    // Function to scroll to main content
    function scrollToContent() {
        const contactContent = document.getElementById('contact-content');
        if (contactContent) {
            contactContent.scrollIntoView({
                behavior: 'smooth'
            });
        }
    }
</script>

@endsection