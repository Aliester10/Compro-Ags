@extends('layouts.Member.master5')

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
    
    /* Event Feature Styling */
    .event-feature {
        max-width: 1200px;
        margin: 80px auto 0;
        padding-top: 100px;
        font-family: 'Helvetica Neue', Arial, sans-serif;
    }
    
    /* Event Header Styling */
    .event-header {
        margin-bottom: 30px;
    }
    
    .event-title {
        font-size: 44px;
        font-weight: 900;
        color: #000;
        line-height: 1.1;
        margin: 0 0 5px 0;
    }
    
    .event-venue {
        font-size: 18px;
        font-weight: 400;
        color: #000;
        margin: 0;
    }
    
    /* Event Gallery Styling */
    .event-gallery {
        display: grid;
        gap: 15px;
        margin-bottom: 40px;
    }
    
    /* Grid layouts based on image count */
    .event-gallery.one-image {
        grid-template-columns: 1fr;
    }
    
    .event-gallery.two-images {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .event-gallery.three-images {
        grid-template-columns: repeat(3, 1fr);
    }
    
    .event-gallery.four-images {
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 1fr);
    }
    
    .event-gallery.many-images {
        grid-template-columns: repeat(3, 1fr);
    }
    
    .gallery-image {
        border-radius: 6px;
        overflow: hidden;
        height: 280px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .event-gallery.one-image .gallery-image {
        height: 400px;
    }
    
    .event-gallery.four-images .gallery-image {
        height: 250px;
    }
    
    .gallery-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .gallery-image img:hover {
        transform: scale(1.03);
    }
    
    /* Event Description Styling */
    .event-description {
        font-size: 16px;
        line-height: 1.6;
        color: #000;
        text-align: justify;
    }
    
    /* Navigation buttons */
    .activity-nav {
        display: flex;
        justify-content: space-between;
        margin-top: 60px;
        padding-bottom: 60px;
    }
    
    .nav-btn {
        display: inline-block;
        padding: 12px 24px;
        background-color: white;
        color: #333;
        border: 1px solid #d0d0d0;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .nav-btn:hover {
        background-color: #4a90e2;
        color: white;
        border-color: #4a90e2;
        text-decoration: none;
    }
    
    .nav-btn i {
        margin: 0 5px;
    }
    
    /* Responsive styles */
    @media (max-width: 992px) {
        .event-title {
            font-size: 36px;
        }
    }
    
    @media (max-width: 768px) {
        .event-gallery {
            grid-template-columns: 1fr !important;
        }
        
        .gallery-image {
            height: 220px;
        }
    }
    
    @media (max-width: 480px) {
        .event-title {
            font-size: 28px;
        }
    }
</style>

<div class="event-feature">
    <div class="event-header">
        <h1 class="event-title">{{ $activity->title }}</h1>
        <p class="event-venue">{{ $activity->location }}</p>
    </div>
    
    @php
    $galleryImages = DB::table('activity_images')
                    ->where('activity_id', $activity->id)
                    ->get();
    
    $imageCount = count($galleryImages);
    
    // Determine gallery class based on number of images
    $galleryClass = '';
    if($imageCount == 1) {
        $galleryClass = 'one-image';
    } elseif($imageCount == 2) {
        $galleryClass = 'two-images';
    } elseif($imageCount == 3) {
        $galleryClass = 'three-images';
    } elseif($imageCount == 4) {
        $galleryClass = 'four-images';
    } else {
        $galleryClass = 'many-images';
    }
    @endphp
    
    @if($imageCount > 0)
        <div class="event-gallery {{ $galleryClass }}">
            @foreach($galleryImages as $image)
                <div class="gallery-image">
                    <img src="{{ asset('assets/img/about/' . $image->image) }}" alt="{{ $activity->title }} image">
                </div>
            @endforeach
        </div>
    @else
        <div class="event-gallery one-image">
            <div class="gallery-image">
                <img src="{{ asset('assets/img/default-event.jpg') }}" alt="Default image">
            </div>
        </div>
    @endif
    
    <div class="event-description">
        <p>{{ $activity->description }}</p>
    </div>
    
    <div class="activity-nav">
        {{-- You can add navigation buttons here if needed --}}
        {{-- Example:
        <a href="#" class="nav-btn"><i class="fas fa-arrow-left"></i> Previous Event</a>
        <a href="#" class="nav-btn">Next Event <i class="fas fa-arrow-right"></i></a>
        --}}
    </div>
</div>
@endsection