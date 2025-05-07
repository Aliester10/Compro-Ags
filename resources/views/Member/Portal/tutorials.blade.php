@extends('layouts.Member.master')

@section('content')

<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Tutorial Video</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/portal') }}">Portal Member</a></li>
            <li class="breadcrumb-item active text-primary">Tutorial Video</li>
        </ol>
    </div>
</div>

<div class="container-fluid team py-5">
    <div class="container py-5">
        <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s"></div>
        <div class="container">
            <div class="row g-4 justify-content-center">
                @forelse($uniqueProduks as $produk)
                <div class="col-md-4 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-img rounded-top border border-secondary" style="border-radius: 10px;">
                            <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}" class="img-fluid rounded-top w-100" alt="{{ $produk->nama }}">
                            <div class="service-content-inner p-4" style="border-radius: 0 0 10px 10px;">
                                <h5>{{ $produk->nama }}</h5>
                                <p class="mb-4">{{ Str::limit($produk->kegunaan, 100) }}</p>
                                
                                @forelse($produk->videos as $video)
                                    <div class="mb-3">
                                        <h6 class="mb-2">Video {{ $loop->iteration }}</h6>
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="{{ asset($video->video) }}" download="{{ $produk->nama }}_{{ $loop->iteration }}_tutorial.mp4" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-fill">Download</a>
                                            <button class="btn btn-secondary rounded-pill text-white py-2 px-4 flex-fill" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="{{ asset($video->video) }}">View</button>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">No video tutorial available</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">You don't have any products associated with your account.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">Video Tutorial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <video id="modalVideo" class="w-100" controls>
                    <source src="" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var videoModal = document.getElementById('videoModal');
        
        videoModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var videoSrc = button.getAttribute('data-video');
            var modalVideo = videoModal.querySelector('#modalVideo');
            var videoSource = modalVideo.querySelector('source');

            if (videoSrc) {
                videoSource.src = videoSrc;
                modalVideo.load();
            }
        });

        videoModal.addEventListener('hide.bs.modal', function () {
            var modalVideo = videoModal.querySelector('#modalVideo');
            modalVideo.pause();
            modalVideo.currentTime = 0;
        });
    });
</script>


@endsection

