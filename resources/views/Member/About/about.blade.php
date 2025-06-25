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
    
    /* Animation keyframes */
    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }
    
    @keyframes fadeInUp {
        0% { 
            opacity: 0; 
            transform: translateY(30px); 
        }
        100% { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
    
    @keyframes fadeInDown {
        0% { 
            opacity: 0; 
            transform: translateY(-30px); 
        }
        100% { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
    
    @keyframes fadeInLeft {
        0% { 
            opacity: 0; 
            transform: translateX(-30px); 
        }
        100% { 
            opacity: 1; 
            transform: translateX(0); 
        }
    }
    
    @keyframes fadeInRight {
        0% { 
            opacity: 0; 
            transform: translateX(30px); 
        }
        100% { 
            opacity: 1; 
            transform: translateX(0); 
        }
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    
    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }
    
    @keyframes textGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Header animation */
    .header-content-animated {
        animation: fadeInDown 1.2s ease-out;
    }
    
    /* MODIFIED: Consistent section padding and alignment */
    .section-container {
        padding: 60px 0;
        margin-bottom: 50px;
    }
    
    /* About Company section with strict left alignment */
    .about-company-container {
        text-align: left !important;
        display: block !important;
        width: 100% !important;
    }
    
    .about-company-content {
        text-align: left !important;
        margin-left: 0 !important;
        padding-left: 0 !important;
    }
    
    /* MODIFIED: Left-aligned section title with no padding */
    .section-title {
        font-weight: 700; 
        font-size: 64px; 
        color: #000; 
        margin-bottom: 0; 
        margin-left: 0 !important;
        line-height: 1.1; 
        font-family: 'Work Sans', sans-serif;
        padding-left: 0 !important; 
        text-align: left !important;
        text-shadow: 0px 2px 2px rgba(0, 0, 0);
    }
    
    /* MODIFIED: Left-aligned section text with no padding */
    .section-text {
        font-weight: 600; 
        font-size: 24px; 
        color: #000; 
        max-width: 100%; 
        font-family: 'Work Sans', sans-serif;
        padding-left: 0 !important; 
        margin-top: 25px;
        margin-left: 0 !important;
        text-align: left !important;
    }
    
    /* MODIFIED: Vision-mission styling with overlay */
    .vision-mission-container {
        background: url('{{ asset('assets/img/About Us.png') }}') no-repeat top center; 
        background-size: cover;
        padding: 60px 0;
        margin-bottom: 80px;
        position: relative;
        height: 550px; /* Added fixed height to accommodate the gradient properly */
    }
    

    
    .vision-mission-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        position: relative;
        z-index: 2;
        padding-top: 200px; /* INCREASED: Move text down by 150px (was 90px) */
    }
    
    .vision-column, .mission-column {
        width: 45%;
    }
    
    .vision-title, .mission-title {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 20px;
        font-family: 'Work Sans', sans-serif;
        line-height: 1.1;
        padding-left: 0 !important;
        margin-left: 0 !important;
        text-align: left !important;
        text-shadow: 0px 2px 2px rgba(0, 0, 0);
    }
    
    .vision-text, .mission-text {
        font-size: 18px;
        line-height: 1.6;
        font-weight: 600;
        margin-bottom: 20px;
        font-family: 'Work Sans', sans-serif;
        color: #000;
        padding-left: 0 !important;
        margin-left: 0 !important;
        text-align: left !important;
    }
    
    /* MODIFIED: About Values Section Styling with overlay and adjusted positioning */
    .about-values-container {
        background: url('{{ asset('assets/img/About Us_2.png') }}') no-repeat center center;
        background-size: cover;
        padding: 60px 0;
        margin-bottom: 15%;
        position: relative;
        height: 700px; /* Added fixed height for proper gradient display */
    }
    
    /* ADDED: White gradient overlay for About Values section */
    .about-values-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(255,255,255,1) 0%, rgba(255, 0, 0, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0) 75%, rgba(255,255,255,0) 100%);
        z-index: 1;
    }

    .about-values-content {
        position: relative;
        z-index: 2;
    }

    .about-values-title {
        font-size: 48px;
        font-weight: 700;
        color: #000;
        line-height: 1.1;
        font-family: 'Work Sans', sans-serif;
        margin-bottom: 40px;
        padding-left: 0 !important;
        margin-left: 0 !important;
        text-align: left !important;
        padding-top: 25%; /* INCREASED: Move text down by 180px (was 90px) */
        text-shadow: 0px 2px 2px rgba(0, 0, 0);
    }
    
    .values-sections {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 0;
    }
    
    /* MODIFIED: Removed hover effects */
    .value-block {
        width: 48%;
        margin-bottom: 30px;
    }
    
    .value-title-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    
    .value-title-container img {
        width: 30px;
        height: 30px;
        margin-right: 10px;
    }
    
    .value-title-container h3 {
        font-size: 24px;
        font-weight: 900;
        margin: 0;
        font-family: 'Work Sans', sans-serif;
    }
    
    .value-list {
        list-style-type: none;
        padding-left: 0;
        margin: 0;
    }
    
    .value-list li {
        position: relative;
        padding-left: 20px;
        margin-bottom: 8px;
        font-size: 16px;
        font-family: 'Work Sans', sans-serif;
        line-height: 1.4;
        color: #000;
        font-weight: 700;
    }
    
    /* SVG-based Level-Up Circle Styling */
    .level-up-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 80px 0;
        position: relative;
        margin: 180px 0px -100px 0px;
        perspective: 1000px;
    }

    .svg-container {
        position: relative;
        width: 460px;
        height: 460px;
        display: flex;
        justify-content: center;
        align-items: center;
        transform-style: preserve-3d;
        transition: transform 0.5s ease;
    }
    
    .svg-container:hover {
        transform: rotateY(10deg) rotateX(5deg);
    }

    .svg-container svg {
        position: absolute;
        width: 100%;
        height: 100%;
        animation: rotate 30s linear infinite;
        filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.2));
    }
    
    .level-up-circle {
        width: 370px;
        height: 370px;
        background-color: #000;
        border-radius: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
        position: relative;
        z-index: 1;
        transition: all 0.5s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        overflow: hidden;
    }
    
    .level-up-circle::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        transform: rotate(45deg);
        animation: shimmer 4s linear infinite;
        pointer-events: none;
    }
    
    .level-up-circle:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        background-color: #111;
    }

    .level-up-text {
        font-family: 'Work Sans', sans-serif;
        font-weight: 700;
        font-size: 40px;
        line-height: 1.6;
        letter-spacing: 0.5px;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .level-up-circle:hover .level-up-text {
        text-shadow: 0 0 15px rgba(255,255,255,0.5);
        letter-spacing: 1px;
    }

    .rotating-text {
        font-family: 'Work Sans', sans-serif;
        font-size: 24px;
        font-weight: 500;
        fill: #000;
        letter-spacing: 5.3px;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    
    /* Our Brand Section Styling */
    .our-brand-container {
        padding: 60px 0;
        margin: 50px 0;
        text-align: center;
        position: relative;
    }
    
    .our-brand-title {
        position: relative;
        font-family: 'Work Sans', sans-serif;
        font-weight: 900;
        font-size: 48px;
        color: #000;
        margin-bottom: 40px;
        display: inline-block;
        transition: all 0.5s ease;
    }
    
    .our-brand-title::before,
    .our-brand-title::after {
        content: "";
        position: absolute;
        top: 50%;
        height: 1px;
        background-color: #000;
        width: 300px;
        transition: all 0.5s ease;
    }
    
    .our-brand-title::before {
        right: 100%;
        margin-right: 15px;
    }
    
    .our-brand-title::after {
        left: 100%;
        margin-left: 15px;
    }
    
    .brand-logos {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
        margin-top: 30px;
    }
    
    .brand-logo {
        padding: 1px;
        max-width: 320px;
        height: auto;
        margin: 15px;
        position: relative;
        overflow: hidden;
        transition: all 0.5s ease;
        background-color: transparent;
    }
    
    .brand-logo img {
        max-width: 100%;
        height: auto;
        transition: transform 0.5s ease, filter 0.5s ease;
    }
    
    .brand-logo:hover {
        transform: translateY(-5px);
        background-color: transparent;
    }
    
    .brand-logo:hover img {
        transform: scale(1.1);
        filter: brightness(1.1);
    }
    
    .brand-logo::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: transparent;
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }
    
    .brand-logo:hover::after {
        transform: translateX(100%);
    }
    
    /* Media queries for better responsiveness */
    @media (max-width: 1200px) {
        .vision-title, .mission-title {
            font-size: 42px;
        }
        
        .our-brand-title::before,
        .our-brand-title::after {
            width: 200px;
        }
    }
    
    @media (max-width: 992px) {
        .vision-title, .mission-title {
            font-size: 38px;
        }
        
        .vision-text, .mission-text {
            font-size: 16px;
        }
        
        .vision-column, .mission-column {
            width: 48%;
        }
        
        .svg-container {
            width: 400px;
            height: 400px;
        }
        
        .level-up-circle {
            width: 320px;
            height: 320px;
        }
        
        .level-up-text {
            font-size: 32px;
        }
        
        .our-brand-title::before,
        .our-brand-title::after {
            width: 150px;
        }
        
        .vision-mission-row {
            padding-top: 120px; /* Adjusted for medium screens */
        }
        
        .about-values-title {
            padding-top: 140px; /* Adjusted for medium screens */
        }
    }
    
    @media (max-width: 768px) {
        .section-title {
            font-size: 48px;
        }
        
        .section-text {
            font-size: 18px;
        }
        
        .vision-mission-container {
            padding: 40px 0;
            height: 600px; /* Adjusted for mobile */
        }
        
        .vision-mission-row {
            flex-direction: column;
            padding-top: 100px; /* Adjusted for smaller screens */
        }
        
        .vision-column, .mission-column {
            width: 100%;
            padding: 0;
            margin-bottom: 40px;
        }
        
        .vision-title, .mission-title {
            font-size: 36px;
        }
        
        .about-values-container {
            padding: 40px 0;
            height: 850px; /* Adjusted for mobile to fit all content */
        }
        
        .about-values-title {
            font-size: 36px;
            padding-top: 120px; /* Adjusted for smaller screens */
        }
        
        .values-sections {
            padding: 0;
        }
        
        .value-block {
            width: 100%;
        }
        
        .svg-container {
            width: 360px;
            height: 360px;
        }
        
        .level-up-circle {
            width: 280px;
            height: 280px;
        }
        
        .level-up-text {
            font-size: 28px;
        }
        
        .rotating-text {
            font-size: 24px;
        }
        
        .our-brand-title {
            font-size: 36px;
        }
        
        .our-brand-title::before,
        .our-brand-title::after {
            width: 100px;
        }
    }
    
    @media (max-width: 576px) {
        .section-title {
            font-size: 40px;
            padding-left: 0 !important;
        }
        
        .section-text {
            font-size: 16px;
            padding-left: 0 !important;
        }
        
        .vision-title, .mission-title {
            font-size: 32px;
            padding-left: 0 !important;
        }
        
        .vision-text, .mission-text {
            font-size: 14px;
            padding-left: 0 !important;
        }
        
        .about-values-title {
            font-size: 32px;
            padding-left: 0 !important;
            padding-top: 100px; /* Adjusted for smaller screens */
        }
        
        .values-sections {
            padding: 0;
        }
        
        .value-title-container h3 {
            font-size: 20px;
        }
        
        .value-list li {
            font-size: 14px;
        }
        
        .svg-container {
            width: 280px;
            height: 280px;
        }
        
        .level-up-circle {
            width: 220px;
            height: 220px;
        }
        
        .level-up-text {
            font-size: 24px;
        }
        
        .rotating-text {
            font-size: 24px;
        }
        
        .our-brand-title {
            font-size: 32px;
        }
        
        .our-brand-title::before,
        .our-brand-title::after {
            width: 60px;
        }
    }
    
    @media (max-width: 480px) {
        .section-title {
            font-size: 32px;
        }
        
        .section-text {
            font-size: 14px;
        }
        
        .vision-title, .mission-title {
            font-size: 28px;
        }
        
        .vision-mission-row {
            padding-top: 80px; /* Adjusted for smaller screens */
        }
        
        .about-values-title {
            padding-top: 80px; /* Adjusted for smaller screens */
        }
        
        .svg-container {
            width: 260px;
            height: 260px;
        }
        
        .level-up-circle {
            width: 200px;
            height: 200px;
        }
        
        .level-up-text {
            font-size: 20px;
        }
        
        .our-brand-title {
            font-size: 28px;
        }
        
        .our-brand-title::before,
        .our-brand-title::after {
            width: 40px;
        }
    }
</style>

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb p-0" style="position: relative; overflow: hidden; height: 740px; width: 100%;">
        <!-- Background Image with normal positioning -->
        <div style="background: url('{{ asset('assets/img/About Us header.png') }}') no-repeat center center; background-size: cover; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
        
        <!-- Overlay Hitam Transparan with animation -->
        <div style="background-image: linear-gradient(to top, #ffffff,rgba(217, 217, 217, 0)); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2; animation: fadeIn 1.5s ease-out;"></div>        

    <!-- Konten Header yang Diposisikan di Tengah Secara Vertikal dan Horizontal -->
    <div class="d-flex flex-column justify-content-center align-items-center h-100 header-content-animated" style="position: relative; z-index: 3;">
    <h1 class="display-2 text-center fw-bold mb-3" data-aos="fade-down" data-aos-delay="300" data-aos-duration="800" style="line-height: 120%; letter-spacing: -0.022em; font-size: 64px; font-family: 'Work Sans', sans-serif; color: black; font-weight: 900; text-shadow: 0px 4px 4px rgb(0, 0, 0);">{{ __('messages.about_us') }}.</h1>
         <p data-aos="fade-up" data-aos-delay="600" data-aos-duration="800" style="line-height: 120%; letter-spacing: -0.022em; font-family: 'Work Sans', sans-serif; color: black; font-weight: 600; font-size: 24px; text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">{{ __('messages.company_name') }}</p>
    </div>
</div>

<!-- About Company Start - Properly left-aligned -->
<div class="section-container about-company-container">
    <div class="container">
        <!-- Fix: Added text-start class and custom styling to force left alignment -->
        <div class="about-company-content text-start" data-aos="fade-up" data-aos-duration="1000" style="text-align: left !important;">
            <h1 class="section-title" style="text-align: left !important; margin-left: 0 !important;">About</h1>
            <h1 class="section-title" style="text-align: left !important; margin-left: 0 !important;">Company.</h1>
            <p class="section-text" style="text-align: left !important; margin-left: 0 !important;">{{ $company->sejarah_singkat ?? 'AGS Group is born to be the technology start-up that empowered by innovation. We provide new solutions that will definitely solve your problem, understand your needs, identify your pain points, and deliver the right stage of tech ready-to-use to give the value added into your business, not just another solution.' }}</p>
        </div>
    </div>
</div>
<!-- About Company End -->

<div class="vision-mission-container">

    <div class="container">
        <!-- Added padding-top to move content down -->
        <div class="vision-mission-row">
            <!-- Vision Section (Left) - FIXED: Added proper vision text -->
            <div class="vision-column" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
                <h1 class="vision-title">Our<br>Vision.</h1>
                <!-- FIXED: Ensure the vision text is properly displayed and not a URL -->
                <p class="vision-text">The technology start-up that provide any innovative solutions for growing up and give the value added your industry.</p>
            </div>

            <!-- Mission Section (Right) -->
            <div class="mission-column" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400">
                <h1 class="mission-title">Our<br>Mission.</h1>
                <p class="mission-text">{{ $company->misi ?? 'By providing the best service through innovation so that you get the right solution in meeting every need in detail orientation and also a reliable guarantee.' }}</p>
            </div>
        </div>
    </div>
</div>
<!-- Vision Mission End -->

<!-- About Values Start - With white gradient overlay and pushed down text -->
<div class="about-values-container">
    <!-- Added white gradient overlay -->
    <div class="about-values-overlay"></div>
    
    <div class="container">
        <div class="about-values-content">
            <!-- Title with proper alignment and pushed down by padding-top -->
            <h1 class="about-values-title" data-aos="fade-right" data-aos-duration="800" style="text-align: left !important; margin-left: 0 !important;">About<br>Values.</h1>
            
            <!-- Values section with hover effects removed -->
            <div class="values-sections">
                <!-- Innovation Section -->
                <div class="value-block" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="value-title-container">
                        <img src="{{ asset('assets/icons/Icon About/lamp-icon.png') }}" alt="Innovation">
                        <h3>Innovation</h3>
                    </div>
                    <ul class="value-list">
                        <li>Create value through product innovation and improvements.</li>
                        <li>Seek innovative ways to introduce new ideas and approaches to solve existing and new challenges.</li>
                        <li>Develop new ideas—and run with them.</li>
                        <li>Build mutually successful relationships with customers to better understand their needs</li>
                    </ul>
                </div>
                
                <!-- Move Quickly Section -->
                <div class="value-block" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="value-title-container">
                        <img src="{{ asset('assets/icons/Icon About/forward-all-arrow-icon.png') }}" alt="Move Quickly">
                        <h3>Move Quickly</h3>
                    </div>
                    <ul class="value-list">
                        <li>Acting with urgency while removing obstacles that get in the way of high priority initiatives. We are not waiting until next week to do something that will help you today.</li>
                        <li>Continuously working to increase the velocity of our highest priority initiatives by methodically removing barriers that get in the way</li>
                    </ul>
                </div>
                
                <!-- Quality Section -->
                <div class="value-block" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="value-title-container">
                        <img src="{{ asset('assets/icons/Icon About/thumbs-up-line-icon.png') }}" alt="Quality">
                        <h3>Quality</h3>
                    </div>
                    <ul class="value-list">
                        <li>We take pride in providing high value products and services that we stand behind.</li>
                        <li>We ensures customer satisfaction, profitability and the future of our employees and our growth</li>
                    </ul>
                </div>
                
                <!-- Customer Satisfaction Section -->
                <div class="value-block" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="value-title-container">
                        <img src="{{ asset('assets/icons/Icon About/employees-icon.png') }}" alt="Customer Satisfaction">
                        <h3>Customer Satisfaction</h3>
                    </div>
                    <ul class="value-list">
                        <li>We take pride in providing high value products and services that we stand behind.</li>
                        <li>We ensures customer satisfaction, profitability and the future of our employees and our growth</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Values End -->

<!-- Level-Up Circle with SVG Start -->
<div class="level-up-container" data-aos="zoom-in" data-aos-duration="1200">
    <div class="svg-container">
        <svg viewBox="0 0 500 500">
            <!-- Background circle with rotating text -->
            <circle cx="250" cy="250" r="230" fill="transparent" stroke="transparent"/>
            
            <text>
                <textPath href="#textcircle" startOffset="0%" class="rotating-text">
                    Independence • Quality • Customer Satisfaction • Respect • Move Quickly • Innovation •
                </textPath>
            </text>
            
            <!-- Path for text to follow -->
            <path id="textcircle" d="M 250,25 A 225,225 0 1,1 249,25 A 225,225 0 1,1 250,25" fill="none"/>
        </svg>
        
        <!-- Black center circle -->
        <div class="level-up-circle">
            <div class="level-up-text">LEVEL-UP<br>YOUR OUTPUT<br>WITH US</div>
        </div>
    </div>
</div>
<!-- Level-Up Circle End -->

<!-- Our Brand Start -->
<div class="our-brand-container" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <h2 class="our-brand-title" data-aos="fade-up" data-aos-duration="800">Our Brand.</h2>
        
        <div class="brand-logos">
            <!-- Brand Logo 1 -->
            <div class="brand-logo" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <img src="{{ asset('assets/img/Logo Brand AGS/labtek logo_.png') }}" alt="LABTEK Logo">
            </div>
            
            <!-- Brand Logo 2 -->
            <div class="brand-logo" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                <img src="{{ asset('assets/img/Logo Brand AGS/logo labverse2.png') }}" alt="LABVERSE Logo">
            </div>
            
            <!-- Brand Logo 3 -->
            <div class="brand-logo" data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
                <img src="{{ asset('assets/img/Logo Brand AGS/microme logo.png') }}" alt="MICROME Logo">
            </div>
            
            <!-- Brand Logo 4 -->
            <div class="brand-logo" data-aos="fade-up" data-aos-duration="800" data-aos-delay="700">
                <img src="{{ asset('assets/img/Logo Brand AGS/Vulcan Logo.png') }}" alt="VULCAN Logo">
            </div>
        </div>
    </div>
</div>
<!-- Our Brand End -->

<!-- Include Leaflet.js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<!-- Include AOS library for scroll animations -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    // Initialize AOS animations
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            once: false,
            mirror: true,
            offset: 120,
            easing: 'ease-out-cubic'
        });
        
        // Animation for text elements when they come into view
        const animatedTextElements = document.querySelectorAll('.animated-text');
        
        // Add floating animation to specific elements
        const floatingElements = document.querySelectorAll('.about-logo');
        floatingElements.forEach(element => {
            element.style.animation = 'float 4s ease-in-out infinite';
        });
    });
</script>

@endsection