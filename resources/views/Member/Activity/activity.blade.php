@extends('layouts.Member.master')

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
        opacity: 0.8; /* 50% opacity for side articles */
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
    }
    
    @media (max-width: 992px) {
        .events-container {
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        
        .event-card {
            width: 80%;  /* Make cards wider on medium screens */
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
            width: 90%;  /* Make cards even wider on small screens */
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
        $featuredArticleImage = isset($metaItems[1]) ? asset('assets/img/konten/' . $metaItems[1]->image) : '';
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
                
                <div class="{{ $classes }}" data-index="{{ $index }}">
                    <img src="{{ asset('assets/img/konten/' . $item->image) }}" alt="{{ $item->title }}">
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
        
        // Add click event to side articles
        articles.forEach(article => {
            article.addEventListener('click', function() {
                const clickedIndex = parseInt(this.getAttribute('data-index'));
                rotateArticles(clickedIndex);
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
    });
</script>
@endsection 