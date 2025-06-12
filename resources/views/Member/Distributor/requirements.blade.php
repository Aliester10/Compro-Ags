@extends('layouts.Member.master-white')

@section('content')

@php
// Ambil data brands dari database berdasarkan data yang sebenarnya
$brands = DB::table('brand_partner')->where('type', 'brand')->get();

// === ARKAMAYA ENGINEERING PRODUCT ===
// House Brands untuk Engineering
$engineeringBrandNames = ['Labverse', 'Labtek', 'Vulcan']; // Sesuaikan dengan brand engineering Anda
$engineeringBrands = DB::table('brand_partner')
    ->where('type', 'brand')
    ->whereIn('nama', $engineeringBrandNames)
    ->get();

// Principal Brands untuk Engineering - sesuai urutan yang Anda minta
$engineeringPrincipalNames = ['Trident', 'Zls', 'Besmak', 'Prolab', 'Labomed', 'Ika', 'Pce', 'Bdo', 'Ciqtek', 'Trimble', 'Wingtra', 'Yellow'];
$engineeringPrincipals = collect(); // Buat collection kosong

// Ambil data sesuai urutan yang diminta untuk Engineering
foreach($engineeringPrincipalNames as $principalName) {
    $principal = DB::table('brand_partner')
        ->where('type', 'principal')
        ->where('nama', $principalName)
        ->first();
    
    if($principal) {
        $engineeringPrincipals->push($principal);
    }
}

// === ARKAMAYA SCIENCE AND HEALTH PRODUCT ===
// House Brands untuk Science (MICROME)
$scienceBrands = DB::table('brand_partner')
    ->where('type', 'brand')
    ->where('nama', 'microme')
    ->get();

// Principal Brands untuk Science - sesuai urutan yang Anda minta
$sciencePrincipalNames = ['Indoray', 'Poly', 'IKA', 'Sinbe', 'Nabei', 'Hanon', 'Neo', 'Tex', 'Cryste', 'Labfreeze', 'Labspray', 'Bioreactek'];
$sciencePrincipals = collect(); // Buat collection kosong

// Ambil data sesuai urutan yang diminta untuk Science
foreach($sciencePrincipalNames as $principalName) {
    $principal = DB::table('brand_partner')
        ->where('type', 'principal') // atau 'principal' sesuai dengan type di database Anda
        ->where('nama', $principalName)
        ->first();
    
    if($principal) {
        $sciencePrincipals->push($principal);
    }
}

// Brand MICROME khusus
$micromeBrand = DB::table('brand_partner')
    ->where('type', 'brand')
    ->where('nama', 'microme')
    ->first();

// Ambil data tier dari database
$tiers = DB::table('distributorship_tiers')
    ->where('is_active', 1)
    ->orderBy('tier_level', 'asc')
    ->get();
@endphp

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
    
    /* Enhanced Header Styles - Updated to match the image */
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
        background: url('{{ asset('assets/img/distributor-program.png') }}') no-repeat center center;
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
    
    /* Content section styling */
    .main-content {
        position: relative;
        z-index: 1;
        background: white;
        margin-top: 0;
        padding-top: 0;
        min-height: 100vh;
    }
    
    /* Distributor Program Section Styles */
    .distributor-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }
    
    .distributor-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23000" opacity="0.02"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grain)"/></svg>');
        z-index: 1;
    }
    
    .distributor-content {
        position: relative;
        z-index: 2;
    }
    
    .section-title {
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: clamp(2rem, 5vw, 2.5rem);
        font-weight: 800;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 2rem;
        line-height: 1.2;
        letter-spacing: -0.02em;
        position: relative;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
    }
    
    .section-description {
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: clamp(1rem, 2.5vw, 1.125rem);
        font-weight: 400;
        color: #555;
        text-align: center;
        line-height: 1.6;
        max-width: 700px;
        margin: 0 auto 5rem auto;
    }
    
    /* About Section Styles */
    .about-section {
        background: #ffffff;
        padding: 100px 0;
        position: relative;
    }
    
    .about-content {
        position: relative;
        z-index: 2;
    }
    
    .about-text {
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: clamp(1rem, 2.5vw, 1.125rem);
        font-weight: 400;
        color: #444;
        text-align: center;
        line-height: 1.7;
        max-width: 900px;
        margin: 0 auto;
    }
    
    .company-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        border-bottom: 1px solid transparent;
        transition: all 0.3s ease;
    }
    
    .company-link:hover {
        color: #764ba2;
        border-bottom-color: #764ba2;
        text-decoration: none;
    }
    
    /* Brand Section Styles */
    .brand-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }
    
    .brand-content {
        position: relative;
        z-index: 2;
    }
    
    .brand-title {
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: clamp(2rem, 5vw, 2.5rem);
        font-weight: 800;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 2rem;
        line-height: 1.2;
        letter-spacing: -0.02em;
        position: relative;
    }
    
    .brand-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
    }
    
    .brand-description {
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: clamp(1rem, 2.5vw, 1.125rem);
        font-weight: 400;
        color: #555;
        text-align: center;
        line-height: 1.6;
        max-width: 800px;
        margin: 0 auto 4rem auto;
    }
    
    .engineering-section {
        margin-bottom: 4rem;
    }
    
    .science-section {
        margin-bottom: 4rem;
        padding-top: 3rem;
        border-top: 2px solid rgba(102, 126, 234, 0.1);
    }
    
    .division-title {
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: clamp(1.5rem, 4vw, 1.75rem);
        font-weight: 700;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 1.5rem;
    }
    
    .brand-badge {
        display: inline-block;
        background: #196CA6;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        font-family: 'Work Sans', sans-serif;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
        transition: all 0.3s ease;
    }
    
    .brand-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(74, 144, 226, 0.4);
    }
    
    /* Science badge with different color */
    .science-badge {
        background: #196CA6;
        box-shadow: 0 4px 15px #196CA6;
    }
    
    .science-badge:hover {
        box-shadow: 0 6px 20px #196CA6;
    }
    
    /* House Brands Grid - Updated untuk tampilan tanpa border dan logo lebih besar */
    .house-brands-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 3rem;
        margin-bottom: 4rem;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
    }
    
    /* Science House Brand - Single item centered */
    .science-house-brands-grid {
        display: flex;
        justify-content: center;
        margin-bottom: 4rem;
        max-width: 350px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .brand-item {
        background: transparent; /* Hilangkan background */
        padding: 2rem 1rem; /* Kurangi padding */
        border-radius: 0; /* Hilangkan border radius */
        box-shadow: none; /* Hilangkan shadow */
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 120px;
        transition: all 0.3s ease;
        border: none; /* Hilangkan border */
    }
    
    .brand-item:hover {
        transform: translateY(-5px);
        box-shadow: none; /* Tetap tidak ada shadow saat hover */
        background: transparent; /* Tetap transparent */
    }
    
    .brand-logo {
        max-width: 100%;
        max-height: 120px; /* Perbesar dari 60px ke 120px */
        width: auto;
        height: auto;
        object-fit: contain;
        filter: brightness(1) contrast(1.1);
        transition: all 0.3s ease;
    }
    
    .brand-item:hover .brand-logo {
        transform: scale(1.05);
    }
    
    /* Principal Brands Section */
    .principal-brands-title {
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: clamp(1.25rem, 3vw, 1.5rem);
        font-weight: 700;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 3rem;
    }
    
    /* Engineering Principal Brands Grid - Layout sesuai gambar (4-4-3) */
    .principal-brands-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 3rem 2rem;
        max-width: 1000px;
        margin: 0 auto;
        align-items: center;
    }
    
    /* Science Principal Brands Grid - Layout sesuai gambar (4-4-4) */
    .science-principal-brands-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 3rem 2rem;
        max-width: 1000px;
        margin: 0 auto;
        align-items: center;
    }
    
    .principal-brand-item {
        background: transparent; /* Hilangkan background */
        padding: 1rem 0.5rem; /* Kurangi padding */
        border-radius: 0; /* Hilangkan border radius */
        box-shadow: none; /* Hilangkan shadow */
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 80px;
        transition: all 0.3s ease;
        border: none; /* Hilangkan border */
    }
    
    .principal-brand-item:hover {
        transform: translateY(-3px);
        box-shadow: none; /* Tetap tidak ada shadow saat hover */
        background: transparent; /* Tetap transparent */
    }
    
    .principal-brand-logo {
        max-width: 100%;
        max-height: 80px; /* Perbesar dari 50px ke 80px */
        width: auto;
        height: auto;
        object-fit: contain;
        filter: brightness(1) contrast(1.05);
        transition: all 0.3s ease;
    }
    
    .principal-brand-item:hover .principal-brand-logo {
        transform: scale(1.05);
    }
    
    /* Target Market Section Styles */
    .target-market-section {
        background: #ffffff;
        padding: 100px 0;
        position: relative;
    }
    
    .target-market-content {
        position: relative;
        z-index: 2;
    }
    
    .target-market-title {
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: clamp(2rem, 5vw, 2.5rem);
        font-weight: 800;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 4rem;
        line-height: 1.2;
        letter-spacing: -0.02em;
        position: relative;
    }
    
    .target-market-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
    }
    
    .sector-row {
        display: flex;
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto 3rem auto;
        align-items: stretch;
    }
    
    .sector-label {
        width: 200px;
        background: linear-gradient(135deg, #a8c8ec, #7fb3d3);
        color: #2c3e50;
        padding: 2rem 1.5rem;
        border-radius: 15px;
        text-align: center;
        font-family: 'Work Sans', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1.3;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .sector-items {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        align-items: start;
    }
    
    .market-item {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .market-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        background: white;
    }
    
    .market-icon {
        width: 40px;
        height: 40px;
        margin: 0 auto 1rem auto;
        display: block;
        filter: brightness(0.2);
    }
    
    .market-name {
        font-family: 'Work Sans', sans-serif;
        font-size: 0.875rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }
    
    .market-description {
        font-family: 'Work Sans', sans-serif;
        font-size: 0.75rem;
        color: #666;
        line-height: 1.4;
        margin: 0;
    }
    
    /* Special styling for private sector education */
    .private-education-item {
        grid-column: 1 / -1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        text-align: left;
    }
    
    .private-education-content {
        flex: 1;
    }
    
    .private-education-icon {
        width: 35px;
        height: 35px;
        margin-left: 1rem;
        flex-shrink: 0;
    }
    
    /* Levels of Distributorship Section Styles - With large background number icons */
    .levels-section {
        background: linear-gradient(135deg, #e8f2ff 0%, #f0f8ff 100%);
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }
    
    .levels-content {
        position: relative;
        z-index: 2;
    }
    
    .levels-title {
        font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: clamp(2rem, 5vw, 2.5rem);
        font-weight: 800;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 4rem;
        line-height: 1.2;
        letter-spacing: -0.02em;
        position: relative;
    }
    
    .levels-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
    }
    
    .levels-grid {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        max-width: 1200px;
        margin: 0 auto 4rem auto;
        flex-wrap: wrap;
    }
    
    .level-card {
        width: 300px;
        height: 220px;
        border-radius: 30px;
        padding: 2rem;
        text-align: left;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 200px 200px;
        cursor: pointer;
    }
    
    .level-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
    }
    
    /* Tier 1 - with large background number 1 */
    .tier-1 {
        background-color: #F2B2D7;
        background-image: url('{{ asset("assets/icons/ANGKA/1.svg") }}');
    }
    
    /* Tier 2 - with large background number 2 */
    .tier-2 {
        background-color: #D0E957;
        background-image: url('{{ asset("assets/icons/ANGKA/2.svg") }}');
    }
    
    /* Tier 3 - with large background number 3 */
    .tier-3 {
        background-color: #FFBC01;
        background-image: url('{{ asset("assets/icons/ANGKA/3.svg") }}');
    }
    
    /* Overlay for background number - to make it more subtle */
    .level-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.15);
        z-index: 1;
        border-radius: 30px;
    }
    
    .level-header-section {
        margin-bottom: 1.5rem;
        z-index: 2;
        position: relative;
    }
    
    .level-header {
        font-family: 'Work Sans', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.25rem;
        line-height: 1.2;
    }
    
    .level-subtitle {
        font-family: 'Work Sans', sans-serif;
        font-size: 1.125rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
        line-height: 1.2;
    }
    
    .level-description {
        font-family: 'Work Sans', sans-serif;
        font-size: 1rem;
        color: #2c3e50;
        line-height: 1.5;
        margin: 0;
        font-weight: 400;
        z-index: 2;
        position: relative;
    }
    
    .level-description em {
        font-style: italic;
        color: #444;
    }
    
    .register-button {
        display: inline-block;
        background: #e91e63;
        color: white;
        padding: 1rem 3rem;
        border-radius: 50px;
        font-family: 'Work Sans', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 8px 25px rgba(233, 30, 99, 0.3);
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .register-button:hover {
        background: #c2185b;
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(233, 30, 99, 0.4);
        text-decoration: none;
        color: white;
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

    /* Popup Styles - Updated for full content display without scrolling */
    .popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    .popup-overlay.active {
        display: flex;
    }
    
    .popup-content {
        background: white;
        border-radius: 20px;
        width: 100%;
        max-width: 900px;
        max-height: 95vh;
        overflow-y: auto;
        position: relative;
        animation: popupSlideIn 0.3s ease;
    }
    
    @keyframes popupSlideIn {
        from {
            opacity: 0;
            transform: translateY(-50px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    .close-btn {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 30px;
        cursor: pointer;
        color: #7f8c8d;
        z-index: 1001;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .close-btn:hover {
        color: #2c3e50;
        background: rgba(255, 255, 255, 1);
    }
    
    .popup-tier1 {
        background: linear-gradient(135deg, #F2B2D7 0%, #e098c5 100%);
    }
    
    .popup-tier2 {
        background: linear-gradient(135deg, #D0E957 0%, #c1da4a 100%);
    }
    
    .popup-tier3 {
        background: linear-gradient(135deg, #FFBC01 0%, #e6a801 100%);
    }
    
    .popup-header {
        padding: 40px 40px 30px;
        text-align: center;
    }
    
    .popup-header h2 {
        font-size: 2.25rem;
        margin-bottom: 10px;
        color: #2c3e50;
        font-family: 'Work Sans', sans-serif;
        font-weight: 700;
    }
    
    .popup-body {
        padding: 0 40px 40px;
    }
    
    .section {
        margin-bottom: 35px;
    }
    
    .section h3 {
        font-size: 1.75rem;
        margin-bottom: 20px;
        color: #2c3e50;
        font-family: 'Work Sans', sans-serif;
        font-weight: 700;
    }
    
    .section ol {
        padding-left: 25px;
        margin: 0;
    }
    
    .section li {
        margin-bottom: 18px;
        line-height: 1.7;
        color: #2c3e50;
        font-family: 'Work Sans', sans-serif;
        font-size: 1rem;
    }
    
    .highlight {
        font-weight: bold;
    }
    
    .italic {
        font-style: italic;
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
    
    /* Enhanced Media queries for better responsiveness */
    @media (max-width: 1024px) {
        .level-card {
            width: 280px;
            height: 200px;
            padding: 1.75rem;
            background-size: 160px 160px;
        }
        
        .level-header {
            font-size: 1.125rem;
        }
        
        .level-subtitle {
            font-size: 1rem;
        }
        
        .level-description {
            font-size: 0.9rem;
        }

        .popup-content {
            max-width: 800px;
        }
        
        .popup-header h2 {
            font-size: 2rem;
        }
        
        .section h3 {
            font-size: 1.5rem;
        }
        
        .principal-brands-grid,
        .science-principal-brands-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem 1.5rem;
        }
    }
    
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
        
        .distributor-section,
        .about-section,
        .brand-section,
        .target-market-section,
        .levels-section {
            padding: 60px 0;
        }
        
        .section-description {
            margin-bottom: 3rem;
        }
        
        .house-brands-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }
        
        .science-principal-brands-grid,
        .principal-brands-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem 1rem;
        }
        
        .brand-item,
        .principal-brand-item {
            padding: 1rem 0.5rem;
            min-height: 80px;
        }
        
        .brand-logo {
            max-height: 100px;
        }
        
        .principal-brand-logo {
            max-height: 70px;
        }
        
        .sector-row {
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .sector-label {
            width: 100%;
            padding: 1.5rem;
        }
        
        .sector-items {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .private-education-item {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }
        
        .private-education-icon {
            margin-left: 0;
        }
        
        .levels-grid {
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
        
        .level-card {
            width: 320px;
            height: 180px;
            padding: 1.5rem;
            text-align: center;
            background-size: 120px 120px;
        }

        .popup-overlay {
            padding: 10px;
        }
        
        .popup-content {
            max-width: 100%;
            max-height: 90vh;
        }
        
        .popup-header,
        .popup-body {
            padding: 25px 20px;
        }
        
        .popup-header h2 {
            font-size: 1.75rem;
        }
        
        .section h3 {
            font-size: 1.375rem;
        }
        
        .section li {
            font-size: 0.9rem;
            margin-bottom: 15px;
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
        
        .distributor-section,
        .about-section,
        .brand-section,
        .target-market-section,
        .levels-section {
            padding: 40px 0;
        }
        
        .house-brands-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        
        .science-principal-brands-grid,
        .principal-brands-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem 0.75rem;
        }
        
        .brand-item,
        .principal-brand-item {
            padding: 0.5rem;
            min-height: 70px;
        }
        
        .brand-logo {
            max-height: 80px;
        }
        
        .principal-brand-logo {
            max-height: 60px;
        }
        
        .market-item {
            padding: 1rem;
        }
        
        .market-name {
            font-size: 0.8rem;
        }
        
        .market-description {
            font-size: 0.7rem;
        }
        
        .level-card {
            width: 280px;
            height: 160px;
            padding: 1.25rem;
            border-radius: 25px;
            background-size: 100px 100px;
        }
        
        .level-header {
            font-size: 1rem;
        }
        
        .level-subtitle {
            font-size: 0.9rem;
        }
        
        .level-description {
            font-size: 0.85rem;
        }
        
        .register-button {
            padding: 0.875rem 2rem;
            font-size: 0.875rem;
        }

        .popup-header h2 {
            font-size: 1.5rem;
        }
        
        .section h3 {
            font-size: 1.25rem;
        }
        
        .section li {
            font-size: 0.85rem;
            margin-bottom: 12px;
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
            Program Distributor
        </h1>
        <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000">
            PT Arkamaya Guna Saharsa
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

<!-- Main Content Section -->
<div class="main-content">
    
    <!-- Join Our Distributor Program Section -->
    <section class="distributor-section">
        <div class="container">
            <div class="distributor-content">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-8">
                        <h2 class="section-title" data-aos="fade-up" data-aos-duration="800">
                            Join Our Distributor Program
                        </h2>
                        <p class="section-description" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                            Become part of our distribution network and enjoy exclusive benefits along with full support for your business success.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Our Distributor Program Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-9">
                        <h2 class="section-title" data-aos="fade-up" data-aos-duration="800">
                            About Our Distributor Program
                        </h2>
                        <div class="about-text" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                            <p>
                                PT. Arkamaya Guna Saharsa proudly operates two specialized business divisions: Arkamaya Engineering Product, offering high-quality technical laboratory equipment 
                                (<a href="https://www.arkamaya-reka.com" target="_blank" rel="noopener noreferrer" class="company-link">www.arkamaya-reka.com</a>), 
                                and Arkamaya Science and Health Product, providing advanced science and healthcare solutions 
                                (<a href="https://www.arkamaya-labs.com" target="_blank" rel="noopener noreferrer" class="company-link">www.arkamaya-labs.com</a>).
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Section -->
    <section class="brand-section">
        <div class="container">
            <div class="brand-content">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h2 class="brand-title" data-aos="fade-up" data-aos-duration="800">
                            Brand
                        </h2>
                        <p class="brand-description" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                            Each of our business divisions, Arkamaya Engineering Product and Arkamaya Science and Health Product, proudly offers industry-leading brands, representing the highest quality in their respective fields.
                        </p>
                        
                        <!-- Arkamaya Engineering Product Section -->
                        <div class="engineering-section" data-aos="fade-up" data-aos-delay="400" data-aos-duration="800">
                            <h3 class="division-title">Arkamaya Engineering Product</h3>
                            <div class="text-center">
                                <span class="brand-badge">Managing {{ $engineeringBrands->count() }} House Brands</span>
                            </div>
                            
                            <!-- House Brands Grid -->
                            <div class="house-brands-grid">
                                @foreach($engineeringBrands->take(3) as $brand)
                                <div class="brand-item" data-aos="zoom-in" data-aos-delay="{{ 600 + $loop->index * 100 }}" data-aos-duration="600">
                                    <a href="{{ $brand->url ?? '#' }}" class="partner-item" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset($brand->gambar) }}" alt="{{ $brand->nama }}" title="{{ $brand->nama }}" class="brand-logo">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            
                            <!-- Principal Brands Section -->
                            <div data-aos="fade-up" data-aos-delay="900" data-aos-duration="800">
                                <h4 class="principal-brands-title">Principal Brands</h4>
                                <div class="principal-brands-grid">
                                    @foreach($engineeringPrincipals as $principal)
                                    <div class="principal-brand-item" data-aos="fade-up" data-aos-delay="{{ 1000 + $loop->index * 50 }}" data-aos-duration="500">
                                        <a href="{{ $principal->url ?? '#' }}" class="distributor-link">
                                            <img 
                                                src="{{ asset($principal->gambar) }}" 
                                                alt="{{ $principal->nama ?? 'Principal Brand Logo' }}" 
                                                class="principal-brand-logo distributor-logo"
                                                loading="lazy"
                                            >
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <!-- Arkamaya Science and Health Product Section -->
                        <div class="science-section" data-aos="fade-up" data-aos-delay="1600" data-aos-duration="800">
                            <h3 class="division-title">Arkamaya Science and Health Product</h3>
                            <div class="text-center">
                                <span class="brand-badge science-badge">Managing {{ $scienceBrands->count() }} House Brands</span>
                            </div>
                            
                            <!-- Science House Brands Grid -->
                            <div class="science-house-brands-grid">
                                @foreach($scienceBrands as $brand)
                                <div class="brand-item" data-aos="zoom-in" data-aos-delay="1700" data-aos-duration="600">
                                    <a href="{{ $brand->url ?? '#' }}" class="partner-item" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset($brand->gambar) }}" alt="{{ $brand->nama }}" title="{{ $brand->nama }}" class="brand-logo">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            
                            <!-- Science Principal Brands Section -->
                            <div data-aos="fade-up" data-aos-delay="1800" data-aos-duration="800">
                                <h4 class="principal-brands-title">Principal Brands</h4>
                                <div class="science-principal-brands-grid">
                                    @foreach($sciencePrincipals->take(12) as $distributor)
                                    <div class="principal-brand-item" data-aos="fade-up" data-aos-delay="{{ 1900 + $loop->index * 100 }}" data-aos-duration="500">
                                        <a href="{{ $distributor->url ?? '#' }}" class="distributor-link">
                                            <img 
                                                src="{{ asset($distributor->gambar) }}" 
                                                alt="{{ $distributor->nama ?? 'Science Principal Brand Logo' }}" 
                                                class="principal-brand-logo distributor-logo"
                                                loading="lazy"
                                            >
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Target Market Section -->
    <section class="target-market-section">
        <div class="container">
            <div class="target-market-content">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h2 class="target-market-title" data-aos="fade-up" data-aos-duration="800">
                            Target Market
                        </h2>
                        
                        <!-- Sector Government Row -->
                        <div class="sector-row" data-aos="fade-up" data-aos-delay="400" data-aos-duration="800">
                            <div class="sector-label">
                                Sector<br>Government
                            </div>
                            
                            <div class="sector-items">
                                <!-- Instansi Pemerintahan -->
                                <div class="market-item" data-aos="zoom-in" data-aos-delay="600" data-aos-duration="600">
                                    <img src="{{ asset('assets/icons/Sector Government/Instansi Pemerintahan.svg') }}" alt="Instansi Pemerintahan" class="market-icon">
                                    <div class="market-name">Instansi Pemerintahan</div>
                                    <div class="market-description">
                                        Kementerian Pusat, Badan, Pemerintah Provinsi, Pemerintah Daerah/Kota, Lembaga Lainnya
                                    </div>
                                </div>
                                
                                <!-- Lembaga Pendidikan Negeri -->
                                <div class="market-item" data-aos="zoom-in" data-aos-delay="700" data-aos-duration="600">
                                    <img src="{{ asset('assets/icons/Sector Government/Lembaga Pendidikan Negeri.svg') }}" alt="Lembaga Pendidikan Negeri" class="market-icon">
                                    <div class="market-name">Lembaga Pendidikan Negeri</div>
                                    <div class="market-description">
                                        Universitas, Sekolah Tinggi, Politeknik, SMK, BLK
                                    </div>
                                </div>
                                
                                <!-- Badan Layanan Umum -->
                                <div class="market-item" data-aos="zoom-in" data-aos-delay="800" data-aos-duration="600">
                                    <img src="{{ asset('assets/icons/Sector Government/Badan Layanan Umum.svg') }}" alt="Badan Layanan Umum" class="market-icon">
                                    <div class="market-name">Badan Layanan Umum</div>
                                    <div class="market-description">
                                        Rumah Sakit, Laboratorium Kesehatan, BLU Lainnya
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sector Swasta Row -->
                        <div class="sector-row" data-aos="fade-up" data-aos-delay="900" data-aos-duration="800">
                            <div class="sector-label">
                                Sector<br>Swasta
                            </div>
                            
                            <div class="sector-items">
                                <!-- Row 1 -->
                                <div class="market-item" data-aos="zoom-in" data-aos-delay="1000" data-aos-duration="600">
                                    <img src="{{ asset('assets/icons/Sector Swasta/pabrik.svg') }}" alt="Pabrik" class="market-icon">
                                    <div class="market-name">Pabrik</div>
                                </div>
                                
                                <div class="market-item" data-aos="zoom-in" data-aos-delay="1100" data-aos-duration="600">
                                    <img src="{{ asset('assets/icons/Sector Swasta/bengkel.svg') }}" alt="Bengkel/Workshop" class="market-icon">
                                    <div class="market-name">Bengkel/Workshop</div>
                                </div>
                                
                                <div class="market-item" data-aos="zoom-in" data-aos-delay="1200" data-aos-duration="600">
                                    <img src="{{ asset('assets/icons/Sector Swasta/bumn.svg') }}" alt="BUMN" class="market-icon">
                                    <div class="market-name">BUMN</div>
                                </div>
                                
                                <!-- Row 2 -->
                                <div class="market-item" data-aos="zoom-in" data-aos-delay="1300" data-aos-duration="600">
                                    <img src="{{ asset('assets/icons/Sector Swasta/kesehatan swasta.svg') }}" alt="Lembaga Kesehatan Swasta" class="market-icon">
                                    <div class="market-name">Lembaga Kesehatan Swasta</div>
                                    <div class="market-description">
                                        Rumah Sakit, Klinik, Lab. Kesehatan
                                    </div>
                                </div>
                                
                                <div class="market-item" data-aos="zoom-in" data-aos-delay="1400" data-aos-duration="600">
                                    <img src="{{ asset('assets/icons/Sector Swasta/lembaga sertifikasi.svg') }}" alt="Lembaga Sertifikasi" class="market-icon">
                                    <div class="market-name">Lembaga Sertifikasi</div>
                                </div>
                                
                                <div class="market-item" data-aos="zoom-in" data-aos-delay="1500" data-aos-duration="600">
                                    <img src="{{ asset('assets/icons/Sector Swasta/lablatorium .svg') }}" alt="Laboratorium Pengujian" class="market-icon">
                                    <div class="market-name">Laboratorium Pengujian</div>
                                </div>
                                
                                <!-- Full width education item -->
                                <div class="market-item private-education-item" data-aos="zoom-in" data-aos-delay="1600" data-aos-duration="600">
                                    <div class="private-education-content">
                                        <div class="market-name">Lembaga Pendidikan Swasta</div>
                                        <div class="market-description">
                                            Universitas, Sekolah Tinggi, Politeknik, SMK, LPK
                                        </div>
                                    </div>
                                    <img src="{{ asset('assets/icons/Sector Swasta/lembaga pendidikan swasta.svg') }}" alt="Lembaga Pendidikan Swasta" class="private-education-icon">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Levels of Distributorship Section -->
    <section class="levels-section">
        <div class="container">
            <div class="levels-content">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h2 class="levels-title" data-aos="fade-up" data-aos-duration="800">
                            Levels of Distributorship
                        </h2>
                        
                        <div class="levels-grid">
                            <!-- Loop through the tiers from the database -->
                            @foreach($tiers as $tier)
                                <div class="level-card tier-{{ $tier->tier_level }}" data-aos="zoom-in" data-aos-delay="{{ 400 + $loop->index * 100 }}" data-aos-duration="600" onclick="showPopup('tier{{ $tier->tier_level }}')">
                                    <div class="level-header-section">
                                        <div class="level-header">Tier {{ intToRoman($tier->tier_level) }}</div>
                                        <div class="level-subtitle">{{ $tier->tier_name }}</div>
                                    </div>
                                    <div class="level-description">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($tier->description), 100) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="text-center" data-aos="fade-up" data-aos-delay="700" data-aos-duration="800">
                            <a href="{{ route('distributors.register') }}" class="register-button">Register as Distributor</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- Popup Overlay -->
<div id="popup-overlay" class="popup-overlay" onclick="closePopup()">
    <div class="popup-content" onclick="event.stopPropagation()">
        <span class="close-btn" onclick="closePopup()">&times;</span>
        <div id="popup-body"></div>
    </div>
</div>

<!-- Include AOS library for scroll animations -->
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
        const mainContent = document.querySelector('.distributor-section');
        if (mainContent) {
            mainContent.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }
    }

    // Store tiers data from database
    const tierData = {
        @foreach($tiers as $tier)
        tier{{ $tier->tier_level }}: {
            title: "Tier {{ intToRoman($tier->tier_level) }} - {{ $tier->tier_name }}",
            bgClass: "popup-tier{{ $tier->tier_level }}",
            content: {
                hak: {!! json_encode(explode("\n", $tier->rights)) !!},
                kewajiban: {!! json_encode(explode("\n", $tier->obligations)) !!}
            }
        },
        @endforeach
    };

    // Function to show popup
    function showPopup(tierId) {
        const popup = document.getElementById('popup-overlay');
        const popupBody = document.getElementById('popup-body');
        const tierInfo = tierData[tierId];
        
        // Remove existing background classes
        const popupContent = document.querySelector('.popup-content');
        popupContent.classList.remove('popup-tier1', 'popup-tier2', 'popup-tier3');
        
        // Add the appropriate background class
        popupContent.classList.add(tierInfo.bgClass);
        
        // Generate the popup content
        const content = `
            <div class="popup-header">
                <h2>${tierInfo.title}</h2>
            </div>
            <div class="popup-body">
                <div class="section">
                    <h3>Hak:</h3>
                    <ol>
                        ${tierInfo.content.hak.map(item => `<li>${item}</li>`).join('')}
                    </ol>
                </div>
                <div class="section">
                    <h3>Kewajiban:</h3>
                    <ol>
                        ${tierInfo.content.kewajiban.map(item => `<li>${item}</li>`).join('')}
                    </ol>
                </div>
            </div>
        `;
        
        popupBody.innerHTML = content;
        popup.classList.add('active');
        
        // Prevent body scroll when popup is open
        document.body.style.overflow = 'hidden';
    }

    // Function to close popup
    function closePopup() {
        const popup = document.getElementById('popup-overlay');
        popup.classList.remove('active');
        
        // Restore body scroll
        document.body.style.overflow = 'auto';
    }

    // Close popup when pressing Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closePopup();
        }
    });
</script>

@php
// Helper function to convert integer to Roman numeral
function intToRoman($num) {
    $romans = [
        1 => 'I',
        2 => 'II',
        3 => 'III',
        4 => 'IV',
        5 => 'V'
    ];
    
    return $romans[$num] ?? $num;
}
@endphp

@endsection