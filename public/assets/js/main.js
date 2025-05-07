    (function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);


    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });


    // Hero Header carousel
    $(".header-carousel").owlCarousel({
        animateOut: 'slideOutDown',
        items: 1,
        autoplay: true,
        smartSpeed: 1000,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
    });


    // International carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        items: 1,
        smartSpeed: 1500,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ]
    });


    // Modal Video
    $(document).ready(function () {
        var $videoSrc;
        $('.btn-play').click(function () {
            $videoSrc = $(this).data("src");
        });
        console.log($videoSrc);

        $('#videoModal').on('shown.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })

        $('#videoModal').on('hide.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc);
        })
    });

    // International carousel
        $(".testimonials-carousel").owlCarousel({
            autoplay: true,
            items: 1,
            smartSpeed: 1500,
            dots: true,
            loop: true,
            margin: 25,
            nav : true,
            navText : [
                '<i class="bi bi-arrow-left"></i>',
                '<i class="bi bi-arrow-right"></i>'
            ]
        });

    // Testimonial's carousel
        $(".testimonial-carousel").owlCarousel({
            autoplay: true,
            smartSpeed: 1000,
            center: true,
            dots: true,
            loop: true,
            margin: 25,
            nav : true,
            navText : [
                '<i class="bi bi-arrow-left"></i>',
                '<i class="bi bi-arrow-right"></i>'
            ],
            responsiveClass: true,
            responsive: {
                0:{
                    items:1
                },
                576:{
                    items:1
                },
                768:{
                    items:1
                },
                992:{
                    items:1
                },
                1200:{
                    items:1
                }
            }
        });

    // // testimonial carousel
    // $(".testimonial-carousel").owlCarousel({
    //     autoplay: true,
    //     smartSpeed: 1000,
    //     center: true,
    //     dots: true,
    //     loop: true,
    //     margin: 25,
    //     nav : true,
    //     navText : [
    //         '<i class="bi bi-arrow-left"></i>',
    //         '<i class="bi bi-arrow-right"></i>'
    //     ],
    //     responsiveClass: true,
    //     responsive: {
    //         0:{
    //             items:1
    //         },
    //         576:{
    //             items:1
    //         },
    //         768:{
    //             items:1
    //         },
    //         992:{
    //             items:1
    //         },
    //         1200:{
    //             items:1
    //         }
    //     }
    // });



   // Back to top button
   $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $('.back-to-top').fadeIn('slow');
    } else {
        $('.back-to-top').fadeOut('slow');
    }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


})(jQuery);

// Image Arrow
document.querySelectorAll('.arrow').forEach(function(arrow) {
    arrow.addEventListener('mouseover', function() {
        this.textContent = '—-->';
    });
    arrow.addEventListener('mouseout', function() {
        this.textContent = '->';
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const totalCards = 100;
    const cardTemplate = `
        <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
            <div class="blog-item rounded">
                <div class="blog-img">
                    <img src="https://via.placeholder.com/300" class="img-fluid w-100" alt="Image">
                </div>
                <div class="blog-centent p-4">
                    <div class="d-flex justify-content-between mb-4">
                        <p class="mb-0 text-muted"><i class="fa fa-calendar-alt text-primary"></i> Date</p>
                    </div>
                    <a href="#" class="h4">Exhibition</a>
                    <p class="my-4">Description of the event.</p>
                    <a href="#" class="btn btn-primary rounded-pill text-white py-2 px-4 mb-1">Read More</a>
                </div>
            </div>
        </div>
    `;

    let currentPage = 1;
    let cardsPerPage = 8;

    const updateCards = () => {
        const content = document.getElementById('activity-content');
        content.innerHTML = '';

        const start = (currentPage - 1) * cardsPerPage;
        const end = Math.min(start + cardsPerPage, totalCards);

        for (let i = start; i < end; i++) {
            content.innerHTML += cardTemplate;
        }

        document.getElementById('showing-info').textContent = `Showing ${start + 1} - ${end} of ${totalCards}`;
    };

    const updatePagination = () => {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        const totalPages = Math.ceil(totalCards / cardsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const pageItem = document.createElement('li');
            pageItem.classList.add('page-item');
            if (i === currentPage) {
                pageItem.classList.add('active');
            }

            const pageLink = document.createElement('a');
            pageLink.classList.add('page-link');
            pageLink.href = '#';
            pageLink.textContent = i;
            pageLink.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = i;
                updateCards();
                updatePagination();
            });

            pageItem.appendChild(pageLink);
            pagination.appendChild(pageItem);
        }
    };

    document.getElementById('show-per-page').addEventListener('change', (e) => {
        cardsPerPage = parseInt(e.target.value, 10);
        currentPage = 1;
        updateCards();
        updatePagination();
    });

    updateCards();
    updatePagination();
});
