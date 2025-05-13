<!-- Add Animation CSS in head section -->
<style>
    /* Animation Keyframes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes dividerGlow {
        0% {
            background: linear-gradient(90deg, rgba(25, 108, 166, 0.1) 0%, rgba(25, 108, 166, 0.5) 50%, rgba(25, 108, 166, 0.1) 100%);
            background-size: 200% 100%;
            background-position: 0% 0%;
        }
        100% {
            background: linear-gradient(90deg, rgba(25, 108, 166, 0.1) 0%, rgba(25, 108, 166, 0.5) 50%, rgba(25, 108, 166, 0.1) 100%);
            background-size: 200% 100%;
            background-position: 100% 0%;
        }
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-5px);
        }
    }
    
    /* Animation Classes */
    .footer-divider {
        height: 2px;
        background-color: rgba(230, 230, 230, 0.5);
        margin-top: 20px;
        margin-bottom: 0;
        position: relative;
        overflow: hidden;
    }
    
    .footer-divider::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, rgba(25, 108, 166, 0.1) 0%, rgba(25, 108, 166, 0.5) 50%, rgba(25, 108, 166, 0.1) 100%);
        background-size: 200% 100%;
        animation: dividerGlow 3s ease-in-out infinite alternate;
    }
    
    .footer-item {
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
    }
    
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    
    .footer-link {
        position: relative;
        color: #000;
        text-decoration: none;
        font-size: 16px;
        transition: color 0.3s ease;
    }
    
    .footer-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 1px;
        bottom: -2px;
        left: 0;
        background-color: #196CA6;
        transition: width 0.3s ease;
    }
    
    .footer-link:hover {
        color: #196CA6;
    }
    
    .footer-link:hover::after {
        width: 100%;
    }
    
    .social-icon {
        transition: transform 0.3s ease, filter 0.3s ease;
    }
    
    .social-icon-container:hover .social-icon {
        transform: scale(1.15);
    }
    
    .float-animation {
        animation: float 3s ease-in-out infinite;
    }
    
    .float-animation-delay-1 {
        animation-delay: 0.2s;
    }
    
    .float-animation-delay-2 {
        animation-delay: 0.4s;
    }
    
    .float-animation-delay-3 {
        animation-delay: 0.6s;
    }
    
    .contact-link {
        transition: color 0.3s ease, transform 0.3s ease;
    }
    
    .contact-link:hover {
        color: #196CA6 !important;
        transform: translateX(3px);
    }
</style>

<!-- Divider between content and footer -->
<div class="container-fluid">
    <hr style="height: 2px; background-color:rgb(#E6E6E6); opacity: 0.5; margin-top: 20px; margin-bottom: 0;">
</div>

<!-- Footer Start -->
<div id="footer-section" class="container-fluid py-5" style="background-color:rgba(32, 32, 32, 0); font-family: 'Work Sans', sans-serif;">
    <div class="container py-4">
        <div class="row">
            <!-- Logo and Address Column -->
            <div class="col-md-4">
                <div class="footer-item">
                    <img src="{{ asset('assets/img/AGS-logo.png') }}" alt="AGS Logo" style="height: 110px; margin-bottom: 3px;">
                    <h5 class="mb-3" style="color: #196CA6; font-weight: bold; font-family: 'Work Sans', sans-serif;">PT. Arkamaya Guna Saharsa</h5>
                    <p class="mb-1" style="color: #000; font-size: 14px;">Perkantoran Mitra Matraman</p>
                    <p class="mb-1" style="color: #000; font-size: 14px;">Jl. Matraman Raya.148 Blok A2 No. 3, Kb. Manggis,</p>
                    <p class="mb-4" style="color: #000; font-size: 14px;">Kec. Matraman, Daerah Khusus Ibukota Jakarta 13150.</p>
                </div>
            </div>
            
            <!-- Explore Column -->
            <div class="col-md-4">
                <div class="footer-item">
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('assets/icons/Icon Contact Information/5.png') }}" alt="Explore" style="width: 40px; height: 40px; margin-right: 10px;">
                            <h4 style="color: #196CA6; font-weight: bold; font-size: 24px; margin-bottom: 0; font-family: 'Work Sans', sans-serif;">Explore</h4>
                        </div>
                        <div class="ms-0 ps-0"> <!-- Removed padding/margin to align with heading -->
                            <a href="{{ route('about') }}" class="d-block mb-2" style="color: #000; text-decoration: none; font-size: 16px; margin-left: 50px;">About Us</a>
                            <a href="{{ route('activity') }}" class="d-block mb-2" style="color: #000; text-decoration: none; font-size: 16px; margin-left: 50px;">Our Activities</a>
                            <a href="{{ route('product.index') }}" class="d-block mb-2" style="color: #000; text-decoration: none; font-size: 16px; margin-left: 50px;">Product</a>
                            <a href="#" class="d-block mb-2" style="color: #000; text-decoration: none; font-size: 16px; margin-left: 50px;">E-Commerce</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info Column -->
            <div class="col-md-4">
                <div class="footer-item">
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('assets/icons/Icon Contact Information/4.png') }}" alt="Contact Information" style="width: 40px; height: 40px; margin-right: 10px;">
                            <h4 style="color: #196CA6; font-weight: bold; font-size: 24px; margin-bottom: 0; font-family: 'Work Sans', sans-serif;">Contact Information</h4>
                        </div>
                        <div class="ms-0 ps-0"> <!-- Removed padding/margin to align with heading -->
                            <!-- WhatsApp -->
                            <div class="d-flex align-items-center mb-2" style="margin-left: 50px;">
                                <img src="{{ asset('assets/icons/Icon Contact Information/1.png') }}" alt="WhatsApp" style="width: 32px; height: 32px; margin-right: 10px;">
                                <a href="https://wa.me/6285217911213" style="color: #000; text-decoration: none; font-size: 16px;">+62 852-1947-8205</a>
                            </div>
                            
                            <!-- Phone -->
                            <div class="d-flex align-items-center mb-2" style="margin-left: 50px;">
                                <img src="{{ asset('assets/icons/Icon Contact Information/2.png') }}" alt="Phone" style="width: 32px; height: 32px; margin-right: 10px;">
                                <a href="tel:02185850913" style="color: #000; text-decoration: none; font-size: 16px;">(021) 85850913</a>
                            </div>
                            
                            <!-- Email -->
                            <div class="d-flex align-items-center mb-3" style="margin-left: 50px;">
                                <img src="{{ asset('assets/icons/Icon Contact Information/3.png') }}" alt="Email" style="width: 32px; height: 32px; margin-right: 10px;">
                                <a href="mailto:Info@arkamaya-labs.com" style="color: #000; text-decoration: none; font-size: 16px;">Info@arkamaya-labs.com</a>
                            </div>
                            
                            <!-- Social Media Icons -->
                            <div class="d-flex" style="margin-left: 50px;">
                                <!-- Added Facebook Icon -->
                                <a href="#" class="me-2"><img src="{{ asset('assets/icons/Asset Icon Social Media/real/linkedin.png') }}" alt="LinkedIn" style="width: 32px; height: 32px;"></a>
                                <a href="#" class="me-2"><img src="{{ asset('assets/icons/Asset Icon Social Media/real/facebook.png') }}" alt="Facebook" style="width: 32px; height: 32px;"></a>
                                <a href="#" class="me-2"><img src="{{ asset('assets/icons/Asset Icon Social Media/real/instagram.png') }}" alt="Instagram" style="width: 32px; height: 32px;"></a>
                                <a href="#" class="me-2"><img src="{{ asset('assets/icons/Asset Icon Social Media/real/tiktok.png') }}" alt="TikTok" style="width: 32px; height: 32px;"></a>
                                <a href="#"><img src="{{ asset('assets/icons/Asset Icon Social Media/real/youtube.png') }}" alt="YouTube" style="width: 32px; height: 32px;"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->