@extends('layouts.Member.master-white')

@section('content')
<style>
    body {
        background: linear-gradient(to right, 
            #dfefff 0%, 
            #dfefff 15%, 
            white 35%, 
            white 65%, 
            #dfefff 85%, 
            #dfefff 100%);
        background-attachment: fixed;
        min-height: 100vh;
    }
    
    /* Footer styling */
    footer {
        background-color: transparent;
    }
    
    /* Common section styling */
     /* Add these styles to your existing CSS */
     .view-more-card {
        background-color: #f2f2f2;
        background-image: linear-gradient(135deg, #e6e6e6 25%, #f2f2f2 25%, #f2f2f2 50%, #e6e6e6 50%, #e6e6e6 75%, #f2f2f2 75%, #f2f2f2 100%);
        background-size: 40px 40px;
    }
    
    .view-more-overlay {
        background-color: rgba(255, 255, 255, 0.6);
    }
    
    .view-more-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    
    .view-more-text {
        font-size: 32px;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
    }
    
    .view-more-content .highlight-btn {
        position: static;
        background-color: #4a90e2;
        border-color: #4a90e2;
        color: white;
        padding: 12px 30px;
        font-weight: 600;
    }
    
    .view-more-content .highlight-btn:hover {
        background-color: #357dcb;
        border-color: #357dcb;
    }
    .section-title-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 50px;
        padding: 0 20px;
    }
    
    .section-line {
        height: 1px;
        background-color: #c0d0e0;
        flex-grow: 1;
    }
    
    .upcoming-section h2, 
    .highlights-section h2, 
    .article-section h2 {
        font-size: 40px;
        font-weight: 800;
        color: #000;
        position: relative;
        margin: 0 30px;
        padding-bottom: 10px;
    }
    
    .upcoming-section h2::after {
        content: "";
        position: absolute;
        bottom: -5px;
        left: calc(50% - 25px);
        width: 50px;
        height: 3px;
        background-color: #000;
    }
    
    /* Activities Header Section */
    .activities-header {
        position: relative;
        width: 100%;
        height: 744px;
        top: 34px;
        margin: 0 auto;
    }
    
    .activities-header-overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }
    
    .activities-header-bg {
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: url('{{ asset("assets/img/our activities.png") }}');
        background-size: cover;
        background-position: center;
        z-index: 1;
    }
    
    .activities-header h1 {
        font-size: 48px;
        font-weight: 700;
        color: white;
        z-index: 3;
    }
    
    /* Upcoming Events Section */
    .upcoming-section {
        text-align: center;
        padding: 40px 0 80px 0;
        background-color: transparent;
        margin-top: 60px;
        position: relative;
    }
    
    .events-container {
        display: flex;
        justify-content: center;
        gap: 30px;
        padding: 0 40px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .event-card {
        width: 300px;
        height: 339px;
        border-radius: 40px;
        position: relative;
        overflow: hidden;
        background-size: cover;
        background-position: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        background-image: url('{{ asset("assets/img/upcoming.png") }}');
    }
    
    .event-overlay {
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(77, 67, 58, 0.85), rgba(77, 67, 58, 0.85));
        position: absolute;
        top: 0;
        left: 0;
    }
    
    .event-content {
        padding: 30px;
        color: white;
        text-align: left;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        position: relative;
        z-index: 2;
    }
    
    .event-date {
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 5px;
    }
    
    .event-year {
        font-size: 38px;
        font-weight: 700;
        margin-bottom: 15px;
    }
    
    .event-description {
        font-size: 14px;
        line-height: 1.4;
        margin-bottom: 20px;
    }
    
    .coming-soon-text {
        font-size: 26px;
        font-weight: 600;
        margin-top: 30px;
    }
    
    .event-btn {
        position: absolute;
        bottom: 30px;
        right: 30px;
        display: inline-block;
        padding: 10px 30px;
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid white;
        border-radius: 25px;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .event-btn:hover {
        background-color: rgba(255, 255, 255, 0.3);
        color: white;
        text-decoration: none;
    }

    /* Current date information */
    .current-date {
        position: absolute;
        bottom: 20px;
        right: 20px;
        font-size: 12px;
        color: #777;
    }
    
    /* Event Highlights Section */
    .highlights-section {
        text-align: center;
        padding: 40px 0 80px 0;
        background-color: transparent;
        position: relative;
    }
    
    /* Year Tabs */
    .year-tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
        gap: 40px;
    }
    
    .year-tab {
        font-size: 22px;
        font-weight: 600;
        color: #888;
        cursor: pointer;
        transition: all 0.3s;
        padding: 5px 10px;
        border-bottom: 3px solid transparent;
    }
    
    .year-tab:hover {
        color: #333;
    }
    
    .year-tab.active {
        color: #000;
        border-bottom: 3px solid #000;
    }
    
    /* Highlights Container */
    .highlights-container {
        max-width: 1200px;
        margin: 0 auto;
        display: none;
    }
    
    .highlights-container.active {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 20px;
        padding: 0 30px;
    }
    
    /* Updated CSS as per your specifications */
    .highlight-card {
        width: 582px;
        height: 397px;
        border-radius: 40px;
        position: relative; 
        overflow: hidden;
        background-size: cover;
        background-position: center;
        margin-bottom: 20px;
    }

    .highlight-overlay {
        background-color: rgba(255, 255, 255, 0.32);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

    .highlight-content {
        position: absolute;
        top: 0;
        left: 0;
        padding: 30px;
        color: white;
        width: 100%;
        height: 100%;
        text-align: left;
        z-index: 2; /* Above the overlay */
    }
    
    .highlight-type {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 0;
    }
    
    .highlight-year {
        font-size: 60px;
        font-weight: 800;
        line-height: 1;
        margin-top: 0;
        margin-bottom: 10px;
    }
    
    .highlight-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .highlight-location {
        font-size: 16px;
        margin-top: 5px;
        font-weight: 400;
    }
    
    .highlight-btn {
        position: absolute;
        bottom: 30px;
        right: 30px;
        display: inline-block;
        padding: 10px 30px;
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid white;
        border-radius: 30px;
        text-decoration: none;
        font-size: 16px;
        transition: all 0.3s;
    }
    
    .highlight-btn:hover {
        background-color: rgba(255, 255, 255, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .empty-card {
        background-color: rgba(200, 200, 200, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .empty-card p {
        color: #888;
        font-style: italic;
    }
    
    /* Article Section */
    .article-section {
        text-align: center;
        padding: 40px 0 80px 0;
        background-color: transparent;
        position: relative;
    }
    
    .article-container {
        position: relative;
        max-width: 1200px;
        height: 600px;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    /* Featured article - Large central article */
    .featured-article {
        position: relative;
        width: 500px;
        height: 580px;
        background-color: white;
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        z-index: 3;
        overflow: hidden;
        transition: all 0.5s ease;
        padding: 15px;
        cursor: pointer;
    }
    
    .featured-article:hover {
        transform: translateY(-10px);
    }
    
    .featured-article img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
        opacity: 1; /* Full opacity for featured article */
    }
    
    /* Side articles - Smaller articles on the sides */
    .side-article {
        position: absolute;
        width: 350px;
        height: 450px;
        background-color: white;
        border-radius: 20px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: all 0.5s ease;
        padding: 12px;
        cursor: pointer;
    }
    
    .side-article:hover {
        transform: translateY(-5px) scale(1.02);
    }
    
    .side-article img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
        opacity: 0.5; /* 50% opacity for side articles */
    }
    
    /* Positioning the side articles */
    .side-article.left {
        left: 50px;
        z-index: 2;
    }
    
    .side-article.right {
        right: 50px;
        z-index: 2;
    }
    
    /* Navigation dots */
    .article-dots {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    
    .article-dot {
        width: 40px;
        height: 6px;
        background-color: #ccc;
        border-radius: 3px;
        margin: 0 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .article-dot.active {
        background-color: #64aeff;
        width: 50px;
    }

    /* Add the blur effect background for article section */
    .article-section {
        position: relative;
    }

    .article-bg-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
    }

    .article-bg {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 100%;
        filter: blur(30px);
        opacity: 0.2;
        background-size: cover;
        background-position: center;
    }

    .article-content-wrapper {
        position: relative;
        z-index: 1;
    }
    
    /* Article Modal - Improved Carousel Display */
    .article-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.85);
        z-index: 9999;
        overflow: hidden;
    }
    
    .article-modal-content {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    
    .article-modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 28px;
        color: #fff;
        cursor: pointer;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        z-index: 10;
    }
    
    .article-modal-close:hover {
        background-color: rgba(255, 255, 255, 0.4);
        transform: scale(1.1);
    }
    
    /* Modal Background Blur */
    .modal-bg-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    
    .modal-bg {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 100%;
        filter: blur(30px);
        opacity: 0.15;
        background-size: cover;
        background-position: center;
    }
    
    /* Modal Carousel Container */
    .modal-carousel {
        position: relative;
        width: 100%;
        max-width: 1200px;
        height: 600px;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 2;
    }
    
    /* Modal Articles */
    .modal-article {
        position: absolute;
        background-color: white;
        border-radius: 20px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.2);
        overflow: hidden;
        transition: all 0.5s ease;
        cursor: pointer;
    }
    
    .modal-article img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }
    
    .modal-article.center {
        width: 500px;
        height: 580px;
        padding: 15px;
        z-index: 3;
    }
    
    .modal-article.center img {
        opacity: 1;
    }
    
    .modal-article.left, .modal-article.right {
        width: 350px;
        height: 450px;
        padding: 12px;
        z-index: 2;
    }
    
    .modal-article.left {
        left: 150%;
    }
    
    .modal-article.right {
        right: 150%;
    }
    
    .modal-article.left img, .modal-article.right img {
        opacity: 0.7;
    }
    
    /* Article hover effects */
    .modal-article.left:hover, .modal-article.right:hover {
        transform: translateY(-5px) scale(1.02);
    }
    
    .modal-article.center:hover {
        transform: translateY(-10px);
    }
    
    /* Modal Navigation dots */
    .modal-dots {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        position: relative;
        z-index: 4;
    }
    
    .modal-dot {
        width: 40px;
        height: 6px;
        background-color: #ccc;
        border-radius: 3px;
        margin: 0 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .modal-dot.active {
        background-color: #64aeff;
        width: 50px;
    }

    /* Alert styling */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    
    .alert-info {
        color: #0c5460;
        background-color: #d1ecf1;
        border-color: #bee5eb;
    }
    
    /* Spinner styling */
    .spinner-border {
        display: inline-block;
        width: 2rem;
        height: 2rem;
        vertical-align: text-bottom;
        border: .25em solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        animation: spinner-border .75s linear infinite;
    }
    
    @keyframes spinner-border {
        to { transform: rotate(360deg); }
    }
    
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0,0,0,0);
        white-space: nowrap;
        border: 0;
    }
    
    .text-center {
        text-align: center;
        color: #fff;
    }
    
    /* Responsive styles */
    @media (max-width: 1200px) {
        .highlight-card {
            width: 100%;
            height: 350px;
        }
        
        .highlights-container.active {
            grid-template-columns: 1fr;
        }
        
        .article-container {
            height: 500px;
        }
        
        .featured-article {
            width: 400px;
            height: 450px;
        }
        
        .side-article {
            width: 280px;
            height: 380px;
        }
        
        .side-article.left {
            left: 20px;
        }
        
        .side-article.right {
            right: 20px;
        }
        
        .modal-carousel {
            height: 500px;
        }
        
        .modal-article.center {
            width: 400px;
            height: 450px;
        }
        
        .modal-article.left, .modal-article.right {
            width: 280px;
            height: 380px;
        }
        
        .modal-article.left {
            left: 20px;
        }
        
        .modal-article.right {
            right: 20px;
        }
    }
    
    @media (max-width: 992px) {
        .events-container {
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        
        .event-card {
            width: 80%;
            max-width: 400px;
        }
    }
    
    @media (max-width: 768px) {
        .article-container {
            height: 450px;
        }
        
        .featured-article {
            width: 320px;
            height: 400px;
        }
        
        .side-article {
            width: 220px;
            height: 320px;
        }
        
        .side-article.left {
            left: 0;
        }
        
        .side-article.right {
            right: 0;
        }
        
        .year-tabs {
            gap: 20px;
        }
        
        .year-tab {
            font-size: 18px;
        }
        
        .modal-carousel {
            height: 450px;
        }
        
        .modal-article.center {
            width: 320px;
            height: 400px;
        }
        
        .modal-article.left, .modal-article.right {
            width: 220px;
            height: 320px;
        }
        
        .modal-article.left {
            left: 0;
        }
        
        .modal-article.right {
            right: 0;
        }
    }
    
    @media (max-width: 576px) {
        .activities-header {
            height: 500px;
        }
        
        .activities-header h1 {
            font-size: 36px;
        }
        
        .section-title-container {
            margin-bottom: 30px;
        }
        
        .upcoming-section h2, 
        .highlights-section h2, 
        .article-section h2 {
            font-size: 32px;
            margin: 0 15px;
        }
        
        .event-card {
            width: 90%;
            height: 300px;
        }
        
        .event-content {
            padding: 20px;
        }
        
        .event-year {
            font-size: 32px;
        }
        
        .event-description {
            font-size: 13px;
        }
        
        .event-btn {
            bottom: 20px;
            right: 20px;
            padding: 8px 20px;
            font-size: 13px;
        }
        
        .coming-soon-text {
            font-size: 22px;
        }
        
        .year-tabs {
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .year-tab {
            font-size: 16px;
            padding: 3px 8px;
        }
        
        .modal-carousel {
            height: 400px;
        }
        
        .modal-article.center {
            width: 280px;
            height: 340px;
        }
        
        .modal-article.left, .modal-article.right {
            width: 180px;
            height: 240px;
        }
        
        .modal-article.left {
            left: 5px;
        }
        
        .modal-article.right {
            right: 5px;
        }
    }
</style>

<!-- Activities Header Section -->
<div class="activities-header">
    <div class="activities-header-bg"></div>
    <div class="activities-header-overlay">
        <h1>Our Activities.</h1>
    </div>
</div>

<!-- Upcoming Events Section -->
<div class="upcoming-section">
    <div class="section-title-container">
        <div class="section-line"></div>
        <h2>Upcoming.</h2>
        <div class="section-line"></div>
    </div>
    
    @php
    // Get upcoming events with status "akan datang"
    $upcomingEvents = DB::table('activities')
                     ->where('status', 'akan datang')
                     ->orderBy('created_at', 'desc')
                     ->limit(3)
                     ->get();
    @endphp
    
    <div class="events-container">
        @if(count($upcomingEvents) > 0)
        @foreach($upcomingEvents as $event)
    @php
    // Get first image for this event to use as background
    $image = DB::table('activity_images')
            ->where('activity_id', $event->id)
            ->first();
            
    $backgroundImage = $image ? 'assets/img/about/' . $image->image : 'assets/img/upcoming.png';
    
    // Format date range if tanggal_mulai and tanggal_selesai exist
    $dateDisplay = '';
    if(isset($event->tanggal_mulai) && isset($event->tanggal_selesai)) {
        $startDate = \Carbon\Carbon::parse($event->tanggal_mulai);
        $endDate = \Carbon\Carbon::parse($event->tanggal_selesai);
        // Format as DD-DD MONTH if in the same month and year
        if($startDate->format('m Y') == $endDate->format('m Y')) {
            $dateDisplay = $startDate->format('d') . '-' . $endDate->format('d') . ' ' . $startDate->locale('id')->isoFormat('MMMM');
        } else {
            $dateDisplay = $startDate->format('d M') . '-' . $endDate->format('d M');
        }
        $yearDisplay = $startDate->format('Y');
    } elseif(isset($event->event_date)) {
        // Fallback to existing event_date if available
        $dateDisplay = \Carbon\Carbon::parse($event->event_date)->format('d-m');
        $yearDisplay = \Carbon\Carbon::parse($event->event_date)->format('Y');
    } else {
        // Default to year only if no dates available
        $dateDisplay = '';
        $yearDisplay = $event->year;
    }
    @endphp
    
    <div class="event-card" style="background-image: url('{{ asset($backgroundImage) }}')">
        <div class="event-overlay"></div>
        <div class="event-content">
            @if(!empty($dateDisplay))
                <div class="event-date">{{ $dateDisplay }}</div>
            @endif
            <div class="event-year">{{ $yearDisplay }}</div>
            <div class="event-description">{{ $event->title }}
                @if(isset($event->location))
                <br>{{ $event->location }}
                @endif
            </div>
            <a href="{{ route('activity.show', $event->id) }}" class="event-btn">Read More</a>
        </div>
    </div>
@endforeach

<!-- Fill with empty "Coming Soon" cards if less than 3 upcoming events -->
@for($i = count($upcomingEvents); $i < 3; $i++)
    <div class="event-card">
        <div class="event-overlay"></div>
        <div class="event-content">
            <div class="coming-soon-text">Coming Soon.</div>
            <a href="#" class="event-btn">Read More</a>
        </div>
    </div>
@endfor
        @else
            <!-- If no upcoming events, show 3 "Coming Soon" cards -->
            @for($i = 0; $i < 3; $i++)
                <div class="event-card">
                    <div class="event-overlay"></div>
                    <div class="event-content">
                        <div class="coming-soon-text">Coming Soon.</div>
                        <a href="#" class="event-btn">Read More</a>
                    </div>
                </div>
            @endfor
        @endif
    </div>
</div>

<!-- Event Highlights Section -->
<div class="highlights-section">
    <div class="section-title-container">
        <div class="section-line"></div>
        <h2>Event Highlights.</h2>
        <div class="section-line"></div>
    </div>
    
    @php
    // Get all years that have events with status "Sudah terlaksana"
    $years = DB::table('activities')
              ->select('year')
              ->where('status', 'Sudah terlaksana')
              ->orderByDesc('year')
              ->distinct()
              ->pluck('year')
              ->toArray();

    // If no years found, show default years
    if(empty($years)) {
        $years = ['2025', '2024', '2023', '2022'];
    }

    // Get current year to set active tab
    $currentYear = date('Y');
    $activeYear = in_array($currentYear, $years) ? $currentYear : $years[0];
    
    // Maximum number of events to display per year
    $maxEventsPerYear = 6;
    @endphp
    
    <!-- Year Tabs -->
    <div class="year-tabs">
        @foreach($years as $year)
            <div class="year-tab {{ ($year == $activeYear) ? 'active' : '' }}" data-year="{{ $year }}">{{ $year }}</div>
        @endforeach
    </div>
    
    @foreach($years as $year)
        @php
        // Get total event count for this year
        $totalEvents = DB::table('activities')
                      ->where('status', 'Sudah terlaksana')
                      ->where('year', $year)
                      ->count();
                      
        // Get limited events for this year
        $events = DB::table('activities')
                  ->where('status', 'Sudah terlaksana')
                  ->where('year', $year)
                  ->limit($maxEventsPerYear)
                  ->get();
                  
        $hasEvents = count($events) > 0;
        $hasMoreEvents = $totalEvents > $maxEventsPerYear;
        @endphp
    
        <!-- {{ $year }} Highlights -->
        <div class="highlights-container {{ ($year == $activeYear) ? 'active' : '' }}" id="highlights-{{ $year }}">
            @if($hasEvents)
                @foreach($events as $event)
                    @php
                    // Get first image for this event to use as background
                    $image = DB::table('activity_images')
                            ->where('activity_id', $event->id)
                            ->first();
                            
                    $backgroundImage = $image ? 'assets/img/about/' . $image->image : 'assets/img/default-event.jpg';
                    @endphp
                    
                    <div class="highlight-card" style="background-image: url('{{ asset($backgroundImage) }}')">
                        <div class="highlight-overlay"></div>
                        <div class="highlight-content">
                            <div class="highlight-type">Exhibition.</div>
                            <div class="highlight-year">{{ $event->year }}</div>
                            <div class="highlight-title">{{ $event->title }}</div>
                            <div class="highlight-location">{{ $event->location }}</div>
                            <a href="{{ route('activity.show', $event->id) }}" class="highlight-btn">Read More</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="highlight-card empty-card">
                    <p>No events available for {{ $year }} yet</p>
                </div>
            @endif
        </div>
    @endforeach
</div>

<!-- Article Section -->
<div class="article-section">
    @php
        // Get meta content from database - limit to 3 items
        $metaItems = DB::table('meta')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        // Get the featured article for the background blur effect
        $featuredArticleImage = isset($metaItems[1]) ? asset($metaItems[1]->image) : '';
    @endphp
    
    <!-- Background blur effect container -->
    <div class="article-bg-container">
        <div class="article-bg" style="background-image: url('{{ $featuredArticleImage }}')"></div>
    </div>
    
    <div class="article-content-wrapper">
        <div class="section-title-container">
            <div class="section-line"></div>
            <h2>Our Article.</h2>
            <div class="section-line"></div>
        </div>
        
        <div class="article-container">
            @foreach($metaItems as $index => $item)
                @php
                    // Determine the appropriate class based on the index
                    $classes = "";
                    if($index == 0) {
                        $classes = "side-article left";
                    } elseif($index == 1) {
                        $classes = "featured-article";
                    } else {
                        $classes = "side-article right";
                    }
                @endphp
                
                <div class="{{ $classes }}" data-index="{{ $index }}" data-id="{{ $item->id }}">
                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                </div>
            @endforeach
        </div>
        
        <!-- Navigation dots -->
        <div class="article-dots">
            @foreach($metaItems as $index => $item)
                <div class="article-dot {{ $index == 1 ? 'active' : '' }}" data-index="{{ $index }}"></div>
            @endforeach
        </div>
    </div>
</div>

<!-- Article Modal with Carousel -->
<div id="article-modal" class="article-modal">
    <div class="article-modal-content">
        <div class="article-modal-close">&times;</div>
        <div id="article-modal-inner">
            <!-- Content will be loaded dynamically with AJAX -->
            <div class="text-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p>Loading article details...</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Year tabs for Event Highlights
        const yearTabs = document.querySelectorAll('.year-tab');
        const highlightContainers = document.querySelectorAll('.highlights-container');
        
        yearTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const year = this.getAttribute('data-year');
                
                // Remove active class from all tabs and containers
                yearTabs.forEach(t => t.classList.remove('active'));
                highlightContainers.forEach(c => c.classList.remove('active'));
                
                // Add active class to selected tab and container
                this.classList.add('active');
                document.getElementById(`highlights-${year}`).classList.add('active');
            });
        });
        
        // Article slider functionality
        const articles = document.querySelectorAll('.side-article, .featured-article');
        const dots = document.querySelectorAll('.article-dot');
        
        // Add click event to all articles
        articles.forEach(article => {
            article.addEventListener('click', function() {
                const clickedIndex = parseInt(this.getAttribute('data-index'));
                const articleId = parseInt(this.getAttribute('data-id'));
                
                // Show modal with article details
                showArticleModal(articleId);
            });
        });
        
        // Add click event to dots
        dots.forEach(dot => {
            dot.addEventListener('click', function() {
                const clickedIndex = parseInt(this.getAttribute('data-index'));
                rotateArticles(clickedIndex);
            });
        });
        
        function rotateArticles(newCenterIndex) {
            // Get current indexes
            let leftIndex, centerIndex, rightIndex;
            
            articles.forEach(article => {
                if (article.classList.contains('left')) {
                    leftIndex = parseInt(article.getAttribute('data-index'));
                } else if (article.classList.contains('featured-article')) {
                    centerIndex = parseInt(article.getAttribute('data-index'));
                } else if (article.classList.contains('right')) {
                    rightIndex = parseInt(article.getAttribute('data-index'));
                }
            });
            
            // Skip if clicked on the already centered article
            if (newCenterIndex === centerIndex) return;
            
            // Remove all position classes
            articles.forEach(article => {
                article.classList.remove('left', 'right');
                if (article.classList.contains('featured-article')) {
                    article.classList.remove('featured-article');
                    article.classList.add('side-article');
                }
            });
            
            // Set new positions
            articles.forEach(article => {
                const index = parseInt(article.getAttribute('data-index'));
                const img = article.querySelector('img');
                
                if (index === newCenterIndex) {
                    article.classList.remove('side-article');
                    article.classList.add('featured-article');
                    img.style.opacity = '1'; // Set full opacity for featured article
                    
                    // Update the background blur effect with the new featured image
                    const imgSrc = img.src;
                    document.querySelector('.article-bg').style.backgroundImage = `url('${imgSrc}')`;
                } else if ((index === leftIndex && newCenterIndex === rightIndex) || 
                          (index === centerIndex && newCenterIndex === leftIndex) ||
                          (index === rightIndex && newCenterIndex === centerIndex)) {
                    article.classList.add('left');
                    img.style.opacity = '0.5'; // Set 50% opacity for side article
                } else {
                    article.classList.add('right');
                    img.style.opacity = '0.5'; // Set 50% opacity for side article
                }
            });
            
            // Update dots
            dots.forEach((dot, index) => {
                if (index === newCenterIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }
        
        // Initialize opacity for images on page load
        articles.forEach(article => {
            const img = article.querySelector('img');
            if (article.classList.contains('featured-article')) {
                img.style.opacity = '1'; // Featured article is fully visible
            } else {
                img.style.opacity = '0.5'; // Side articles are semi-transparent
            }
        });
        
        // Auto-rotate articles every 5 seconds
        let autoRotateInterval = setInterval(() => {
            let currentCenterIndex;
            articles.forEach(article => {
                if (article.classList.contains('featured-article')) {
                    currentCenterIndex = parseInt(article.getAttribute('data-index'));
                }
            });
            
            let nextIndex = (currentCenterIndex + 1) % 3;
            rotateArticles(nextIndex);
        }, 5000);
        
        // Stop auto-rotation when user interacts with the slider
        document.querySelector('.article-container').addEventListener('mouseenter', () => {
            clearInterval(autoRotateInterval);
        });
        
        // Resume auto-rotation when user leaves the slider
        document.querySelector('.article-container').addEventListener('mouseleave', () => {
            autoRotateInterval = setInterval(() => {
                let currentCenterIndex;
                articles.forEach(article => {
                    if (article.classList.contains('featured-article')) {
                        currentCenterIndex = parseInt(article.getAttribute('data-index'));
                    }
                });
                
                let nextIndex = (currentCenterIndex + 1) % 3;
                rotateArticles(nextIndex);
            }, 5000);
        });
        
        // Modal functionality
        const modal = document.getElementById('article-modal');
        const modalClose = document.querySelector('.article-modal-close');
        
        modalClose.addEventListener('click', function() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto'; // Enable scrolling on body
            clearInterval(window.modalAutoRotateInterval); // Stop auto-rotation
        });
        
        // Close modal when clicking outside of content
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto'; // Enable scrolling on body
                clearInterval(window.modalAutoRotateInterval); // Stop auto-rotation
            }
        });
        
        // Function to show modal with article detail
        function showArticleModal(articleId) {
            // Show modal
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Disable scrolling on body
            
            // Display loading spinner
            document.getElementById('article-modal-inner').innerHTML = `
                <div class="text-center">
                    <div class="spinner-border" role="status" style="color: #fff;">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p>Loading article details...</p>
                </div>
            `;
            
            // Load article content using AJAX
            fetch(`/get-article-detail/${articleId}`)
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.error || 'Network response was not ok');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Article data:', data);
                    
                    // Create slide data array
                    let slides = [];
                    
                    // Add main article
                    slides.push({
                        id: data.article.id,
                        title: data.article.title,
                        image: data.article.image
                    });
                    
                    // Add sub-articles if available
                    if (data.subArticles && data.subArticles.length > 0) {
                        data.subArticles.forEach(subArticle => {
                            slides.push({
                                id: subArticle.id,
                                title: subArticle.title,
                                image: subArticle.image
                            });
                            
                            // Add additional images from sub-articles if available
                            if (subArticle.images && subArticle.images.length > 0) {
                                subArticle.images.forEach(img => {
                                    slides.push({
                                        id: img.id || `img-${Math.random().toString(36).substr(2, 9)}`,
                                        title: subArticle.title,
                                        image: img.image
                                    });
                                });
                            }
                        });
                    }
                    
                    // Ensure we have at least 3 slides for the carousel
                    if (slides.length < 3) {
                        // Duplicate slides if we have less than 3
                        const additionalSlidesNeeded = 3 - slides.length;
                        for (let i = 0; i < additionalSlidesNeeded; i++) {
                            slides.push({...slides[i % slides.length]});
                        }
                    }
                    
                    // Store slides in window object for access in the rotation function
                    window.modalSlides = slides;
                    
                    // Create background blur with the featured article image
                    const modalContent = `
                        <div class="modal-bg-container">
                            <div class="modal-bg" style="background-image: url('${slides[0].image}')"></div>
                        </div>
                        
                        <div class="modal-carousel">
                            <div class="modal-article center" data-slide-index="0">
                                <img src="${slides[0].image}" alt="${slides[0].title}">
                            </div>
                            <div class="modal-article left" data-slide-index="1">
                                <img src="${slides[1].image}" alt="${slides[1].title}">
                            </div>
                            <div class="modal-article right" data-slide-index="2">
                                <img src="${slides[2].image}" alt="${slides[2].title}">
                            </div>
                        </div>
                        
                        <div class="modal-dots">
                            ${slides.map((slide, index) => `
                                <div class="modal-dot ${index === 0 ? 'active' : ''}" data-slide-index="${index}"></div>
                            `).join('')}
                        </div>
                    `;
                    
                    document.getElementById('article-modal-inner').innerHTML = modalContent;
                    
                    // Add event listeners to modal elements
                    setupModalInteractions();
                })
                .catch(error => {
                    console.error('Error fetching article detail:', error);
                    document.getElementById('article-modal-inner').innerHTML = `
                        <div class="text-center">
                            <div class="alert alert-danger">
                                <p>Error loading article details: ${error.message}</p>
                                <p>Please try again later.</p>
                            </div>
                        </div>
                    `;
                });
        }
        
        // Set up all modal interactions
        function setupModalInteractions() {
            const modalArticles = document.querySelectorAll('.modal-article');
            const modalDots = document.querySelectorAll('.modal-dot');
            
            // Add click events for articles
            modalArticles.forEach(article => {
                article.addEventListener('click', function() {
                    if (!this.classList.contains('center')) {
                        const slideIndex = parseInt(this.getAttribute('data-slide-index'));
                        rotateModalCarousel(slideIndex);
                    }
                });
            });
            
            // Add click events for dots
            modalDots.forEach(dot => {
                dot.addEventListener('click', function() {
                    const slideIndex = parseInt(this.getAttribute('data-slide-index'));
                    rotateModalCarousel(slideIndex);
                });
            });
            
            // Add keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (modal.style.display !== 'block') return;
                
                const currentSlideIndex = parseInt(document.querySelector('.modal-article.center').getAttribute('data-slide-index'));
                const totalSlides = window.modalSlides.length;
                
                if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                    // Previous slide
                    rotateModalCarousel((currentSlideIndex - 1 + totalSlides) % totalSlides);
                } else if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                    // Next slide
                    rotateModalCarousel((currentSlideIndex + 1) % totalSlides);
                } else if (e.key === 'Escape') {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
            
            // Add touch swipe support
            addSwipeSupport();
            
            // Start auto-rotation
            startModalAutoRotation();
        }
        
        // Add swipe support for mobile
        function addSwipeSupport() {
            const carousel = document.querySelector('.modal-carousel');
            let startX, moveX;
            const threshold = 50; // Min distance for swipe
            
            carousel.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
            }, false);
            
            carousel.addEventListener('touchend', function(e) {
                if (!startX) return;
                
                moveX = e.changedTouches[0].clientX;
                const diff = startX - moveX;
                
                if (Math.abs(diff) > threshold) {
                    const currentSlideIndex = parseInt(document.querySelector('.modal-article.center').getAttribute('data-slide-index'));
                    const totalSlides = window.modalSlides.length;
                    
                    if (diff > 0) {
                        // Swipe left - next slide
                        rotateModalCarousel((currentSlideIndex + 1) % totalSlides);
                    } else {
                        // Swipe right - previous slide
                        rotateModalCarousel((currentSlideIndex - 1 + totalSlides) % totalSlides);
                    }
                }
                
                startX = null;
            }, false);
        }
        
        // Auto-rotate modal carousel
        function startModalAutoRotation() {
            if (window.modalAutoRotateInterval) {
                clearInterval(window.modalAutoRotateInterval);
            }
            
            window.modalAutoRotateInterval = setInterval(() => {
                if (modal.style.display !== 'block') {
                    clearInterval(window.modalAutoRotateInterval);
                    return;
                }
                
                const currentSlideIndex = parseInt(document.querySelector('.modal-article.center').getAttribute('data-slide-index'));
                const totalSlides = window.modalSlides.length;
                rotateModalCarousel((currentSlideIndex + 1) % totalSlides);
            }, 5000);
            
            // Stop auto-rotation on hover or touch
            const carousel = document.querySelector('.modal-carousel');
            carousel.addEventListener('mouseenter', () => clearInterval(window.modalAutoRotateInterval));
            carousel.addEventListener('touchstart', () => clearInterval(window.modalAutoRotateInterval), { passive: true });
            
            // Resume auto-rotation when leaving
            carousel.addEventListener('mouseleave', startModalAutoRotation);
            carousel.addEventListener('touchend', () => {
                setTimeout(startModalAutoRotation, 1000);
            });
        }
        
        // Function to rotate modal carousel
        function rotateModalCarousel(newCenterIndex) {
            if (!window.modalSlides) return;
            
            const slides = window.modalSlides;
            const currentCenterElement = document.querySelector('.modal-article.center');
            const currentCenterIndex = parseInt(currentCenterElement.getAttribute('data-slide-index'));
            
            // Skip if already centered
            if (newCenterIndex === currentCenterIndex) return;
            
            // Calculate adjacent indices
            const totalSlides = slides.length;
            const leftIndex = (newCenterIndex - 1 + totalSlides) % totalSlides;
            const rightIndex = (newCenterIndex + 1) % totalSlides;
            
            // Update article positions
            document.querySelectorAll('.modal-article').forEach(article => {
                const index = parseInt(article.getAttribute('data-slide-index'));
                
                // Remove all position classes
                article.classList.remove('center', 'left', 'right');
                
                // Set new positions
                if (index === newCenterIndex) {
                    article.classList.add('center');
                    article.querySelector('img').style.opacity = '1';
                } else if (index === leftIndex) {
                    article.classList.add('left');
                    article.querySelector('img').style.opacity = '0.5';
                } else if (index === rightIndex) {
                    article.classList.add('right');
                    article.querySelector('img').style.opacity = '0.5';
                } else {
                    // Hide other articles
                    article.style.display = 'none';
                }
            });
            
            // Create articles for indices that don't have elements yet
            const existingIndices = Array.from(document.querySelectorAll('.modal-article')).map(
                article => parseInt(article.getAttribute('data-slide-index'))
            );
            
            [newCenterIndex, leftIndex, rightIndex].forEach(index => {
                if (!existingIndices.includes(index)) {
                    const slide = slides[index];
                    const carousel = document.querySelector('.modal-carousel');
                    let position = '';
                    
                    if (index === newCenterIndex) {
                        position = 'center';
                    } else if (index === leftIndex) {
                        position = 'left';
                    } else {
                        position = 'right';
                    }
                    
                    const newArticle = document.createElement('div');
                    newArticle.className = `modal-article ${position}`;
                    newArticle.setAttribute('data-slide-index', index);
                    newArticle.innerHTML = `<img src="${slide.image}" alt="${slide.title}" style="opacity: ${position === 'center' ? '1' : '0.5'}">`;
                    
                    newArticle.addEventListener('click', function() {
                        if (!this.classList.contains('center')) {
                            const slideIndex = parseInt(this.getAttribute('data-slide-index'));
                            rotateModalCarousel(slideIndex);
                        }
                    });
                    
                    carousel.appendChild(newArticle);
                }
            });
            
            // Update background with new center image
            document.querySelector('.modal-bg').style.backgroundImage = `url('${slides[newCenterIndex].image}')`;
            
            // Update dot indicators
            document.querySelectorAll('.modal-dot').forEach((dot, index) => {
                if (index === newCenterIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
            
            // Make sure visible articles are displayed
            document.querySelectorAll('.modal-article.center, .modal-article.left, .modal-article.right').forEach(article => {
                article.style.display = 'block';
            });
        }
    });
</script>
@endsection