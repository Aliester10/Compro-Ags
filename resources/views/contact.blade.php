@extends('layouts.Member.master-white')

@section('content')
<style>
    /* Font import */
    @import url('/assets/css/fonts.css');
    
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
    
    /* Reset dan base styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    
    /* Enhanced Header Styles */
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
        transition: all 0.3s ease;
    }

    .scroll-indicator:hover {
        color: rgba(255, 255, 255, 1);
        transform: translateX(-50%) scale(1.1);
    }

    /* Contact Section Styles */
    .contact-section {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        position: relative;
    }

    .contact-overlay {
        background: rgba(255, 255, 255, 0.9);
        min-height: 100vh;
        padding: 6rem 0;
    }

    /* Custom form styles untuk konsistensi */
    .form-input-custom {
        transition: all 0.3s ease;
    }

    .form-input-custom:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    .submit-button-custom {
        transition: all 0.3s ease;
    }

    .submit-button-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
    }

    /* Social media hover effects */
    .social-link {
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
    }

    .social-link:hover {
        transform: translateY(-3px);
    }

    .social-link img {
        width: 33px;
        height: 33px;
        border-radius: 8px;
    }

    /* Header and subtitle container */
    .contact-header-container {
        margin-bottom: 4rem;
    }

    /* Custom font sizes */
    .contact-title {
        font-size: 40px;
        font-weight: 700;
        color: #000000;
        margin-bottom: 1rem;
        border-left: 4px solid #000000;
        padding-left: 8px;
    }

    .contact-subtitle {
        font-size: 18px;
        color: #000000;
        max-width: 100%;
        line-height: 1.5;
    }

    .form-labels {
        font-size: 16px;
        font-weight: 600;
        color: #000000;
    }

    .company-name {
        font-size: 20px;
        font-weight: 700;
        color: #000000;
        margin-bottom: 1.5rem;
        margin-top: 1rem;
    }

    /* Contact details dengan alignment yang rapi */
    .contact-details {
        font-size: 16px;
        color: #000000;
    }

    .contact-details .contact-item {
        display: flex;
        margin-bottom: 0.25rem;
    }

    .contact-details .contact-label {
        font-weight: 700;
        width: 90px;
        flex-shrink: 0;
    }

    .contact-details .contact-colon {
        width: 20px;
        flex-shrink: 0;
    }

    .contact-details .contact-value {
        flex: 1;
    }

    /* Address styling tanpa spacing - perbaikan */
    .address-container {
        margin-bottom: 0.25rem;
    }

    .address-label {
        font-weight: 700;
        margin-bottom: 0;
        display: inline-block;
        width: 90px;
    }

    .address-content {
        display: inline-block;
        line-height: 1.4;
        margin-bottom: 0;
        margin-left: 20px;
        max-width: calc(100% - 110px);
        vertical-align: top;
    }

    /* Social Media styling */
    .social-media-title {
        font-size: 20px;
        font-weight: 700;
        color: #000000;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

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
    
    /* Enhanced Media queries */
    @media (max-width: 768px) {
        .hero-header {
            min-height: 500px;
            border-radius: 0 0 15px 15px;
        }
        
        .hero-content {
            padding: 1rem;
        }
        
        .scroll-indicator {
            bottom: 1rem;
        }

        .contact-title {
            font-size: 32px;
        }

        .contact-subtitle {
            font-size: 16px;
        }

        .form-labels {
            font-size: 14px;
        }

        .company-name {
            font-size: 18px;
        }

        .contact-details {
            font-size: 14px;
        }

        .contact-details .contact-label {
            width: 80px;
        }

        .address-label {
            width: 80px;
        }

        .address-content {
            margin-left: 15px;
            max-width: calc(100% - 95px);
        }

        .social-media-title {
            font-size: 18px;
        }

        .social-link img {
            width: 28px;
            height: 28px;
        }
    }
    
    @media (max-width: 576px) {
        .hero-header {
            min-height: 450px;
            border-radius: 0 0 10px 10px;
        }
        
        .hero-title {
            margin-bottom: 0.75rem;
        }

        .contact-title {
            font-size: 28px;
        }

        .contact-subtitle {
            font-size: 14px;
        }

        .address-label {
            display: block;
            width: 100%;
            margin-bottom: 0.25rem;
        }

        .address-content {
            display: block;
            margin-left: 0;
            max-width: 100%;
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

<!-- External CSS/JS Libraries -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
    <div class="contact-overlay">
        <div class="max-w-6xl mx-auto px-6 py-10">
            <!-- Header section untuk keseluruhan contact -->
            <div class="contact-header-container" data-aos="fade-up" data-aos-delay="100">
                <h1 class="contact-title">Contact.</h1>
                <p class="contact-subtitle">
                    Should you have any queries or need information, please contact us or fill in the form below:
                </p>
            </div>

            <!-- Content area dengan form dan info -->
            <div class="md:flex md:space-x-20">
                <!-- Contact Form -->
                <div class="md:w-1/2" data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ route('guest-messages.store') }}" method="POST" class="space-y-4 max-w-md">
                        @csrf
                        <div>
                            <label for="nama" class="form-labels block mb-1">Name</label>
                            <input id="nama" name="nama" type="text" 
                                   class="form-input-custom w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm" 
                                   value="{{ old('nama') }}" required />
                            @error('nama')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="perusahaan" class="form-labels block mb-1">Company</label>
                            <input id="perusahaan" name="perusahaan" type="text" 
                                   class="form-input-custom w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm" 
                                   value="{{ old('perusahaan') }}" />
                            @error('perusahaan')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="form-labels block mb-1">Email</label>
                            <input id="email" name="email" type="email" 
                                   class="form-input-custom w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm" 
                                   value="{{ old('email') }}" required />
                            @error('email')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="no_wa" class="form-labels block mb-1">Phone</label>
                            <input id="no_wa" name="no_wa" type="tel" 
                                   class="form-input-custom w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm" 
                                   value="{{ old('no_wa') }}" required />
                            @error('no_wa')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="city" class="form-labels block mb-1">City</label>
                            <input id="city" name="city" type="text" 
                                   class="form-input-custom w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm" 
                                   value="{{ old('city') }}" />
                            @error('city')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="subject" class="form-labels block mb-1">Subject</label>
                            <input id="subject" name="subject" type="text" 
                                   class="form-input-custom w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm" 
                                   value="{{ old('subject') }}" />
                            @error('subject')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="categories" class="form-labels block mb-1">Categories Message</label>
                            <select id="categories" name="categories" 
                                    class="form-input-custom w-full rounded-md border border-gray-300 px-3 py-1.5 text-xs text-gray-500">
                                <option value="" selected>- Please Choose an Option -</option>
                                <option value="users" {{ old('categories') == 'users' ? 'selected' : '' }}>Users</option>
                                <option value="distributors" {{ old('categories') == 'distributors' ? 'selected' : '' }}>Distributors</option>
                                <option value="customer_services" {{ old('categories') == 'customer_services' ? 'selected' : '' }}>Customer Services</option>
                                <option value="other" {{ old('categories') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('categories')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="pesan" class="form-labels block mb-1">Message</label>
                            <textarea id="pesan" name="pesan" rows="6" 
                                      class="form-input-custom w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm resize-none" 
                                      required>{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="submit-button-custom w-full bg-blue-700 text-white text-xs font-bold py-1.5 rounded-md hover:bg-blue-800">
                            Send
                        </button>
                    </form>
                </div>
                
                <!-- Contact Information -->
                <div class="md:w-1/2 mt-10 md:mt-0 max-w-md" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="company-name">
                        {{ $companyInfo->nama_perusahaan ?? 'PT Arkamaya Guna Saharsa' }}
                    </h2>
                    
                    <div class="contact-details">
                        @if($companyInfo && $companyInfo->email)
                            <div class="contact-item">
                                <span class="contact-label">Email</span>
                                <span class="contact-colon">:</span>
                                <span class="contact-value">{{ $companyInfo->email }}</span>
                            </div>
                        @endif
                        
                        @if($companyInfo && $companyInfo->no_telepon)
                            <div class="contact-item">
                                <span class="contact-label">Phone</span>
                                <span class="contact-colon">:</span>
                                <span class="contact-value">{{ $companyInfo->no_telepon }}</span>
                            </div>
                        @endif
                        
                        @if($companyInfo && ($companyInfo->whatsapp_1 || $companyInfo->no_wa))
                            <div class="contact-item">
                                <span class="contact-label">Whatsapp</span>
                                <span class="contact-colon">:</span>
                                <span class="contact-value">{{ $companyInfo->whatsapp_1 ?? $companyInfo->no_wa }}</span>
                            </div>
                        @endif
                        
                        @if($companyInfo && $companyInfo->alamat)
                            <div class="address-container">
                                <span class="address-label">Address</span>
                                <span class="address-content">
                                    {{ $companyInfo->alamat }}
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <h3 class="social-media-title">Social Media.</h3>
                    <div class="flex space-x-3">
                        <!-- LinkedIn -->
                            <a href="https://www.linkedin.com/company/arkamaya-for-education" target="_blank" aria-label="LinkedIn" class="social-link">
                                <img src="{{ asset('assets/icons/Asset Icon Social Media/real/linkedin.png') }}" alt="LinkedIn">
                            </a>
                        
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/people/Arkamaya-Guna-Saharsa/pfbid02FCpiUrJjhA61WJYtWEksdMrLnQPUFJsPJv7KGQntio6XP2hiTjAkyL49Ps2AWg8l/" target="_blank" aria-label="Facebook" class="social-link">
                            <img src="{{ asset('assets/icons/Asset Icon Social Media/real/facebook.png') }}" alt="Facebook">
                        </a>
                        
                            <a href="https://www.instagram.com/lifeatags" target="_blank" aria-label="Instagram" class="social-link">
                                <img src="{{ asset('assets/icons/Asset Icon Social Media/real/instagram.png') }}" alt="Instagram">
                            </a>
                        
                        <!-- TikTok -->
                        <a href="https://www.tiktok.com/@lifeatags?_t=ZS-8xH6DCzSKjY&_r=1" target="_blank" aria-label="TikTok" class="social-link">
                            <img src="{{ asset('assets/icons/Asset Icon Social Media/real/tiktok.png') }}" alt="TikTok">
                        </a>
                        
                        <!-- YouTube -->
                        <a href="https://www.youtube.com/@arkamayagunasaharsa" target="_blank" aria-label="YouTube" class="social-link">
                            <img src="{{ asset('assets/icons/Asset Icon Social Media/real/youtube.png') }}" alt="YouTube">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Section End -->

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50" id="successAlert">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    </div>
@endif

@if($errors->any())
    <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50" id="errorAlert">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            @if($errors->has('error'))
                {{ $errors->first('error') }}
            @else
                Terdapat kesalahan dalam pengisian form.
            @endif
        </div>
    </div>
@endif

<!-- Include AOS library -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

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

    // Optional: Add parallax effect on scroll
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelector('.hero-background');
        const speed = scrolled * 0.5;
        
        if (parallax) {
            parallax.style.transform = `translateY(${speed}px)`;
        }
    });

    // Enhanced form validation
    document.querySelectorAll('.form-input-custom').forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.classList.add('border-red-500');
            } else {
                this.classList.remove('border-red-500');
            }
        });
    });

    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        const successAlert = document.getElementById('successAlert');
        const errorAlert = document.getElementById('errorAlert');
        
        if (successAlert) {
            successAlert.style.display = 'none';
        }
        if (errorAlert) {
            errorAlert.style.display = 'none';
        }
    }, 5000);
</script>
@endsection