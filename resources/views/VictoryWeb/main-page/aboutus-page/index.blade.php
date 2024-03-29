@extends('VictoryWeb.main-page.layout.mainLayout')

@section('head')
    <meta charset="utf-8">
    <title>VicTory Group - Mountaineering</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    {{-- <link rel="stylesheet" href="{{asset('/')}}VictoryWeb/lib/fontawesome/all.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="{{ asset('VictoryWeb') }}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="{{ asset('VictoryWeb') }}/lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('VictoryWeb') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('VictoryWeb') }}/css/style.css" rel="stylesheet">
    <style>
        .container-custom {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
@section('content')
<div class="content-wrapper overflow-hidden">
    <div class="container-fluid mt-3 blog ">
        <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
            <small
                class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">About
                Us</small>
            <h1 class="display-5 mb-3 ">Victory Mountaineering</h1>
            <h6 class="text-center mb-5">Every thing you need to know about mountaineeing</h6>
        </div>
        <div class="container">

            <section class="pt-0">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-md-start text-center py-6">
                            <h1 class="mb-4 fs-9 fw-bold text-primary">Tales of mountaineering </h1>
                            <p class="mb-6 lead text-secondary">Inspire and excite enthusiasts, each a journey from
                                challenge to triumph, motivating personal growth. Explore history to fuel passion and
                                understand past mountaineers' feats.</p><br>
                            <p class="mb-6 lead text-secondary">They encapsulate human determination, resilience, and the
                                relentless pursuit of conquering the unconquerable. Exploring mountaineering history offers
                                insights into past feats, fostering connections with legendary climbers. These stories serve
                                as guides for personal growth, reminding us of the transformative power of perseverance.
                                Mountaineering narratives are more than physical conquests; they symbolize the human
                                spirit's will to soar to new heights, inspiring us to embrace the unknown and strive for
                                greatness in all aspects of life.</p>
                        </div>
                        <div class="col-md-6 text-end"><img class="pt-7 pt-md-0 img-fluid"
                                src="{{asset('/')}}VictoryWeb/img/aboutus/1.jpg" alt="" /></div>
                    </div>
                </div>
            </section>


            <section class="pt-7">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-end"><img class="pt-7 pt-md-0 img-fluid"
                                src="{{asset('/')}}VictoryWeb/img/aboutus/2.jpg" alt="" /></div>
                        <div class="col-md-6 text-md-start text-center py-6">
                            <h1 class="mb-4 fs-9 fw-bold text-primary">Type & Style </h1>
                            <p class="mb-6 lead text-secondary">Each style has its own characteristics and challenges,
                                providing different experiences for mountaineers. We offer guidance on choosing a suitable
                                style based on your goals, preferences, and technical proficiency, ensuring a safe and
                                memorable mountain adventure.</p><br>
                            <p class="mb-6 lead text-secondary">Mountaineering offers varied styles, each with unique
                                challenges. Choosing wisely ensures a fulfilling adventure. We provide personalized guidance
                                based on your goals, preferences, and skills. Whether you prefer alpine solitude,
                                fast-and-light efficiency, or guided security, we tailor your journey. With our expertise,
                                embark confidently, ready to conquer mountains and create lasting memories. We support you
                                every step of the way, ensuring a safe and memorable experience, regardless of your chosen
                                style.</p>
                        </div>
                    </div>
                </div>
            </section>


            <section class="pt-7">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-md-start text-center py-6">
                            <h1 class="mb-4 fs-9 fw-bold text-primary">Guides</h1>
                            <p class="mb-6 lead text-secondary">We creating safe and enjoyable adventures. Additionally, we
                                foster a collaborative environment and provide encouragement, helping everyone overcome
                                challenges and achieve their goals on the mountain.</p><br>
                            <p class="mb-6 lead text-secondary">Our guides ensure safe, enjoyable adventures, fostering
                                collaboration and providing encouragement. With expert guidance, climbers overcome
                                challenges and achieve mountain goals. Prioritizing safety, we create a supportive
                                environment for pushing limits, exploring new heights, and forging lasting memories. Our
                                commitment goes beyond leading; we inspire and empower individuals to grow, fostering
                                camaraderie and personal triumph amidst the majesty of the mountains.</p>
                        </div>
                        <div class="col-md-6 text-end"><img class="pt-7 pt-md-0 img-fluid"
                                src="{{asset('/')}}VictoryWeb/img/aboutus/3.jpg" alt="" /></div>
                    </div>
                </div>
            </section>


            <section class="pt-7">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-end"><img class="pt-7 pt-md-0 img-fluid"
                                src="{{asset('/')}}VictoryWeb/img/aboutus/4.jpg" alt="" /></div>
                        <div class="col-md-6 text-md-start text-center py-6">
                            <h1 class="mb-4 fs-9 fw-bold text-primary">Safe location </h1>
                            <p class="mb-6 lead text-secondary">We provide information about shelters, including stopping
                                points, camping sites, and other safe areas along the mountain ascent. This helps
                                mountaineers with additional preparation and safe choices during their exploration.</p><br>
                            <p class="mb-6 lead text-secondary">We provides comprehensive information on shelters, including
                                strategic stopping points, camping sites, and safe areas throughout the mountain ascent.
                                This assists mountaineers in thorough preparation and making informed decisions for a secure
                                journey. With our guidance, adventurers can navigate the terrain confidently, knowing where
                                to find refuge and rest along the way, ensuring a safer and more enjoyable exploration of
                                the mountainous landscape.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="pt-7">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-md-start text-center py-6">
                            <h1 class="mb-4 fs-9 fw-bold text-primary">Caution!!! </h1>
                            <p class="mb-6 lead text-secondary">We provide detailed and comprehensive information on common
                                dangers encountered by mountaineers. This includes the risk of slipping due to challenging
                                terrain, harsh weather such as snowstorms or cold winds, the danger of getting lost in
                                unclear directions, oxygen deficiency at high altitudes leading to health issues, the risk
                                of avalanches in mountain ranges, as well as treacherous rocky terrain. Additionally, we
                                also offer information on health issues like sunburn, seizures, and dehydration, aiming to
                                help you prepare thoroughly and feel more confident when undertaking a mountainous journey.
                            </p>
                        </div>
                        <div class="col-md-6 text-end"><img class="pt-7 pt-md-0 img-fluid"
                                src="{{asset('/')}}VictoryWeb/img/aboutus/5.jpg" alt="" /></div>
                    </div>
                </div>
            </section>



        </div>


    </div>
</div>

    
@endsection



@section('script')
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- wow.min.js: hiệu ứng khi cuộn tương tự như aos, nhưng aos đơn giản dễ sử dụng và wow js sẽ phụ thuộc nhiều vào Animate.css , config trong main.js -->
    <script src="{{ asset('/') }}VictoryWeb/lib/wow/wow.min.js"></script>

    <script src="{{ asset('/') }}VictoryWeb/lib/easing/easing.min.js"></script>

    <!-- waypoints.min.js: hiệu ứng được cài đặt khi kéo lên xuống trong trang, tại mỗi vị trí 1 nào đó hiệu ứng được quy định sẽ được chạy , config trong main.js -->
    <script src="{{ asset('/') }}VictoryWeb/lib/waypoints/waypoints.min.js"></script>

    <!-- counterup.min.js: hiệu ứng số đếm tăng dần trong js, config trong main.js -->
    <script src="{{ asset('/') }}VictoryWeb/lib/counterup/counterup.min.js"></script>

    <!-- lightbox.min.js: hiệu ứng ui liên quan đến chỉnh và xem các image trong web , config trong main.js -->
    <script src="{{ asset('/') }}VictoryWeb/lib/lightbox/js/lightbox.min.js"></script>

    <!-- owl.carousel.min.js: hiệu ứng slide bar nằm ngang, config trong main.js -->
    <script src="{{ asset('/') }}VictoryWeb/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('/') }}VictoryWeb/js/main.js"></script>

    <script src="{{ asset('/') }}AdminLte/dist/js/adminlte.min.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            window.addEventListener("pageshow", function(event) {
                var historyTraversal = event.persisted ||
                    (typeof window.performance != "undefined" &&
                        window.performance.navigation.type === 2);
                if (historyTraversal) {
                    // Handle page restore.
                    window.location.reload();
                }
            });
            $('.dropdown-button').click()

            @if (session()->has('mess'))
                var mess = {!! json_encode(session()->get('mess')) !!};


                Swal.fire({
                    icon: {!! json_encode(session()->get('icon')) !!},
                    title: mess,
                    text: {!! json_encode(session()->get('text')) !!}
                });
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: "{{ url('/admin/removeMessSession') }}",

                });
            @endif

            $('.menu').removeClass('active')
            $('.menu-aboutus').addClass('active')
            $('.dropdown-button').on('click', function() {

                if ($('.nav-item').hasClass('menu-open')) {
                    $('.dropdown-icon').removeClass('fa-chevron-down');
                    $('.dropdown-icon').addClass('fa-angle-right');
                } else {
                    $('.dropdown-icon').removeClass('fa-angle-right');
                    $('.dropdown-icon').addClass('fa-chevron-down');
                }
            })


            $('.heart-icon').on('mouseleave', function() {
                $(this).css({
                    "transition": "0.3s"
                }, {
                    "font-size": "40px"
                });
            });
            $('.heart-icon').on('click', function() {
                if ($(this).hasClass('fa-regular')) {
                    $(this).removeClass('fa-regular');
                    $(this).addClass('fa-solid');
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to favorite list',
                        text: 'View your list in account detail'
                    });
                } else {
                    $(this).removeClass('fa-solid');
                    $(this).addClass('fa-regular');
                    Swal.fire({
                        icon: 'success',
                        title: 'Removed from favorite list',
                        text: 'View your list in account detail'
                    });
                }
            });

            // Testimonial carousel
            $(".testimonial-carousel").owlCarousel({
                autoplay: true,
                smartSpeed: 1000,
                center: true,
                margin: 25,
                dots: true,
                loop: true,
                nav: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    }
                }
            });
        })
    </script>
@endsection
