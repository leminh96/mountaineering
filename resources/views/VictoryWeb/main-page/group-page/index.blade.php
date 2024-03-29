@extends('VictoryWeb.main-page.layout.mainLayout')

@section('head')
    <meta charset="utf-8">
    <title>VicTory Group - Mountaineering</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">


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
        .l-section-video {
            position: relative;
            /* overflow: hidden; */
            width: 100%;
            height: 670px;
        }

        .l-section-video video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .truncate-text {
            color: #ffffff;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Số dòng tối đa bạn muốn hiển thị cho tin tức chính*/
            -webkit-box-orient: vertical;
        }

        .truncate-text img {
            display: none;
        }

        .truncate-text1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            /* Số dòng tối đa bạn muốn hiển thị cho tin tức phụ*/
            -webkit-box-orient: vertical;
        }
        .truncate-text1 img {
            display: none !important;
        }

        .truncate-text1 figure {
            display: none !important;

        }

        .truncate-text1 table {
            display: none !important;
        }

        .truncate-text1 figcaption {
            display: none !important;
        }

        .truncate-text1 .hero-container {
            display: none !important;
        }

        .home-title-text-1 {
            text-shadow: rgb(155, 110, 42) 2px 0px 0px, rgb(155, 110, 42) 1.75517px 0.958851px 0px, rgb(155, 110, 42) 1.0806px 1.68294px 0px, rgb(155, 110, 42) 0.141474px 1.99499px 0px, rgb(155, 110, 42) -0.832294px 1.81859px 0px, rgb(155, 110, 42) -1.60229px 1.19694px 0px, rgb(155, 110, 42) -1.97998px 0.28224px 0px, rgb(155, 110, 42) -1.87291px -0.701566px 0px, rgb(155, 110, 42) -1.30729px -1.5136px 0px, rgb(155, 110, 42) -0.421592px -1.95506px 0px, rgb(155, 110, 42) 0.567324px -1.91785px 0px, rgb(155, 110, 42) 1.41734px -1.41108px 0px, rgb(155, 110, 42) 1.92034px -0.558831px 0px;
        }

        .home-title-text-2 {
            text-shadow: rgb(155, 110, 42) 2px 0px 0px, rgb(155, 110, 42) 1.75517px 0.958851px 0px, rgb(155, 110, 42) 1.0806px 1.68294px 0px, rgb(155, 110, 42) 0.141474px 1.99499px 0px, rgb(155, 110, 42) -0.832294px 1.81859px 0px, rgb(155, 110, 42) -1.60229px 1.19694px 0px, rgb(155, 110, 42) -1.97998px 0.28224px 0px, rgb(155, 110, 42) -1.87291px -0.701566px 0px, rgb(155, 110, 42) -1.30729px -1.5136px 0px, rgb(155, 110, 42) -0.421592px -1.95506px 0px, rgb(155, 110, 42) 0.567324px -1.91785px 0px, rgb(155, 110, 42) 1.41734px -1.41108px 0px, rgb(155, 110, 42) 1.92034px -0.558831px 0px;
        }

        .secondary-news {
            overflow: auto;
            height: 100%;
        }

        .news-area {
            height: 700px;
            width: 100%;
            /* overflow-y: scroll; */
            overflow-x: hidden;

        }

        .news-area::-webkit-scrollbar {
            display: none;
            /* Safari and Chrome */
        }

        .read-more {
            --animate-duration: 2.0s;
        }

        .mountains-title {
            background-color: hsl(0, 0%, 91%);

        }

        .mountains-title img {
            border-radius: 300px 10px 10px 300px;
        }

        .searchBar {
            box-shadow: 0 0 45px rgba(240, 198, 9, 0.596);

        }


        .testimonial-item {
            height: 350px;
        }

        .heart-icon1:hover {
            font-size: 30px;
            transition: 0.3s;
        }

        .heart-icon1 {

            font-size: 25px;
            color: rgb(255, 63, 63);
            text-shadow: rgb(80, 80, 80) 0.1px 0px 0px, rgb(80, 80, 80) 0.540302px 0.841471px 0px, rgb(80, 80, 80) -0.416147px 0.909297px 0px, rgb(80, 80, 80) -0.989992px 0.14112px 0px, rgb(80, 80, 80) -0.653644px -0.756802px 0px, rgb(80, 80, 80) 0.283662px -0.958924px 0px, rgb(80, 80, 80) 0.96017px -0.279416px 0px;
        }

        /*mon custom */
        /*khi màn hình lớn hơn 980px thì kích hoạt relative */
        @media (min-width: 980px) {
            #custom {
                position: relative;
            }
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper overflow-hidden">


        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control bg-transparent p-3" placeholder="keywords"
                                aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->


        <!-- About Start -->
        <div class="container-fluid  overflow-hidden px-0 rounded-bottom mountains-title">
            <div class="row g-0 mx-lg-0 d-flex justify-content-betwween">

                <div class="col-lg-5 about-text py-5 wow fadeIn align-items-center" data-wow-delay="0.5s">
                    <div class="py-lg-5 px-lg-2 pe-lg-0 d-flex flex-column align-items-center justify-content-around">
                        <div class="section-title text-start">
                            <h1 class="display-5 mb-4 fs-3 text-center px-2">"Every member of the team is a precious brick,
                                and only when we all build together can we reach the top."

                            </h1>
                        </div>
                        <div class="row g-4 mb-4 pb-2">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex flex-shrink-0 align-items-center justify-content-center bg-white"
                                        style="width: 60px; height: 60px;">
                                        <i class="fa fa-users fa-2x text-primary"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h2 class="text-primary mb-1" data-toggle="counter-up">{{$groupCount}}</h2>
                                        <p class="fw-medium mb-0">Organizations</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex flex-shrink-0 align-items-center justify-content-center bg-white"
                                        style="width: 60px; height: 60px;">
                                        <i class="fa-regular fa-heart  fa-2x text-primary"></i>

                                    </div>
                                    <div class="ms-3">
                                        <h2 class="text-primary mb-1" data-toggle="counter-up">{{$groupAlllike}}</h2>
                                        <p class="fw-medium mb-0">Favorites</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#group-list" class="scrollButton btn btn-primary text-light py-3 px-5">Explore More</a>
                    </div>
                </div>
                <div class="col-lg-7 ps-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100 w-100">
                        <img class="position-absolute img-fluid w-100 h-100 " src="{{ asset('/') }}AdminLte/dist/img/groupBanner.gif"
                            alt="">
                    </div>
                </div>
            </div>

        </div>
        <!-- About End -->
        <!-- Team Start -->
        <div class="container-fluid team organization-featured py-4">
            <div class="mx-3    animate__animated animate__bounceInUp">
                <div class="text-center ">
                    <small
                        class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Rating</small>
                    <h1 class="display-5 mb-5">Top Rated Organizations On Our Platform</h1>
                </div>
                <div class="row g-4 border border-5 border-primary rounded">
                    <div class="owl-carousel  py-2  owl-theme testimonial-carousel  mb-4 wow tada" data-wow-delay="0.1s">
                        @foreach ($topRates as $group)
                            <div class="h-100 wow  animate__animated animate__bounceInRight " data-wow-delay="0.1s">

                                <div class="team-item rounded-pill  h-100">
                                    <div class="h-100 d-flex align-items-center" href="#">
                                        @if (
                                            $group->photo == null ||
                                                $group->photo == '' ||
                                                !File::exists(public_path('img/groups/' . $group->id . '/' . $group->photo)))
                                            <img class="img-fluid rounded-circle h-100"
                                                src="{{ asset('/img/groups/unknown.png') }}" alt="">
                                        @else
                                            <img class="img-fluid rounded-circle h-100"
                                                src="{{ asset('/img/groups/' . $group->id . '/' . $group->photo) }}"
                                                alt="">
                                        @endif




                                        <span class="fs-6 fw-bold ">
                                            <a href="{{ url('/organizations/detail?id=' . $group->id) }}">
                                                {{ $group->name }}
                                            </a>
                                            <div class="d-flex justify-content-start star-rating-result ">
                                                <span class="fa-regular fa-star text-warning " data-rating="1"></span>
                                                <span class="fa-regular fa-star text-warning" data-rating="2"></span>
                                                <span class="fa-regular fa-star text-warning" data-rating="3"></span>
                                                <span class="fa-regular fa-star text-warning" data-rating="4"></span>
                                                <span class="fa-regular fa-star text-warning" data-rating="5"></span>
                                                <input type="hidden" name="whatever1" class="rating-value-result"
                                                    value="{{ $group->avg_score }}">

                                            </div>
                                        </span>


                                        <div class="team-icon bg-primary rounded-circle d-flex flex-column justify-content-center text-center "
                                            style="width:40px;height:40px">


                                            @if (session()->has('user'))
                                                @if ($groupLikeList->contains('group_id', $group->id) == true)
                                                    <i class="fa-solid heart-icon1 fa-heart">
                                                        <input type="hidden" class="group-id"
                                                            value="{{ $group->id }}">
                                                    </i>
                                                @else
                                                    <i class="fa-regular heart-icon1 fa-heart">
                                                        <input type="hidden" class="group-id"
                                                            value="{{ $group->id }}">
                                                    </i>
                                                @endif
                                            @else
                                                <i class="fa-regular heart-icon1 fa-heart">
                                                    <input type="hidden" class="group-id" value="{{ $group->id }}">
                                                </i>
                                            @endif


                                        </div>
                                    </div>

                                </div>

                            </div>
                        @endforeach


                    </div>




                </div>
            </div>
        </div>
        <!-- Team End -->



        <!-- About Satrt -->
        <div class="container-fluid  ">
            <div id="group-list" class="row g-5 align-items-top justify-content-around">
                <div
                    class=" d-flex justify-content-center  col-lg-3 animate__fadeInLeft animate__animated animate__fadeInLeft d-flex align-items-top">


                    <nav class="searchBar  border border-5 border-primary w-75 rounded" id="custom" style="min-height: 600px">
                        <ul class="nav nav-pills nav-sidebar flex-column mt-1 w-100" id="scroll"
                            data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item overflow-hidden menu-open">
                                <a href="#"
                                    class="click border border-2 border-dark mx-2 dropdown-button nav-link rounded-end bg-warning py-2 d-flex align-items-center justify-content-center">
                                    <span class="mx-2 text-light">
                                        <i class="fa-solid fa-globe"></i>
                                        <span class="hidden-lg">Locations</span>
                                        <i class=" dropdown-icon fa-solid fa-chevron-down"></i>
                                    </span>


                                </a>
                                <ul class="nav nav-treeview btn-group-vertical locationList mt-1" style="height: 550px; overflow-y:auto; overflow-x:hidden">
                                    @foreach ($cityList as $city)
                                        <li class="nav-item px-2 py-1" role="group"
                                            aria-label="Basic checkbox toggle button group ">


                                            <input type="checkbox" class="btn-check w-100 location-search"
                                                id="location{{ $city->id }}" value="{{ $city->id }}"
                                                name='cityFilter[]' autocomplete="off">
                                            <label class="btn btn-outline-primary w-100"
                                                for="location{{ $city->id }}">{{ $city->name }}</label>

                                        </li>
                                    @endforeach


                                </ul>
                            </li>
                        </ul>
                    </nav>




                </div>
                <div class=" col-lg-9   animate__animated animate__fadeInUp">
                    <div class="container mt-3 ">
                        <div class="text-center ">
                            <small
                                class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Organizations</small>
                            <h1 class="display-5 mb-5">Find a place to start your journey</h1>
                        </div>
                        <div class="group-list">
                            @foreach ($groupList as $group)
                                <div
                                    class="row p-1 align-items-center  border border-3 border-success rounded bg-gray my-3">
                                    <div class="col-lg-3 d-flex justify-content-center">
                                        @if (
                                            $group->photo == null ||
                                                $group->photo == '' ||
                                                !File::exists(public_path('img/groups/' . $group->id . '/' . $group->photo)))
                                            <img class=" w-100 rounded-circle"
                                                src="{{ asset('/img/groups/unknown.png') }}" alt="User profile picture">
                                        @else
                                            <img class=" w-100 rounded-circle"
                                                src="{{ asset('/img/groups/' . $group->id . '/' . $group->photo) }}"
                                                alt="User profile picture">
                                        @endif

                                    </div>
                                    <div class="col-lg-9 py-5 py-lg-3">
                                        <div class="d-flex justify-content-start star-rating-result ">
                                            <span class="fa-regular fa-star text-warning " data-rating="1"></span>
                                            <span class="fa-regular fa-star text-warning" data-rating="2"></span>
                                            <span class="fa-regular fa-star text-warning" data-rating="3"></span>
                                            <span class="fa-regular fa-star text-warning" data-rating="4"></span>
                                            <span class="fa-regular fa-star text-warning" data-rating="5"></span>
                                            @php
                                                $hasScore = false;
                                            @endphp
                                            @foreach ($scoreList as $score)
                                                @if ($score->group_id == $group->id)
                                                    <input type="hidden" name="whatever1" class="rating-value-result"
                                                        value="{{ $score->avg_score }}">
                                                    @php
                                                        $hasScore = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($hasScore == false)
                                                <input type="hidden" name="whatever1" class="rating-value-result"
                                                    value="0">
                                            @endif


                                        </div>
                                        <span class="mb-4 fs-2 text-dark fw-bold">{{ $group->name }}
                                            &nbsp;


                                            @if (session()->has('user'))
                                                @if ($groupLikeList->contains('group_id', $group->id) == true)
                                                    <i class="fa-solid heart-icon1 fa-heart">
                                                        <input type="hidden" class="group-id"
                                                            value="{{ $group->id }}">
                                                    </i>
                                                @else
                                                    <i class="fa-regular heart-icon1 fa-heart">
                                                        <input type="hidden" class="group-id"
                                                            value="{{ $group->id }}">
                                                    </i>
                                                @endif
                                            @else
                                                <i class="fa-regular heart-icon1 fa-heart">
                                                    <input type="hidden" class="group-id" value="{{ $group->id }}">
                                                </i>
                                            @endif


                                            {{-- <i class="fa-regular heart-icon1 fa-heart"></i> --}}
                                        </span>
                                        <span class="mb-4 text-secondary truncate-text1">
                                            {!! html_entity_decode($group->description) !!}</span>
                                        <ul class="list-inline">
                                            <li>
                                                <h6><i class="far fa-dot-circle text-primary mr-3"></i>Leader:
                                                    {{ $group->leader_name }}</h6>
                                            <li>
                                                <h6><i class="far fa-dot-circle text-primary mr-3"></i>Location (City):
                                                    @if ($group->city_name == null)
                                                        &nbsp;updating...
                                                    @else
                                                        {{ $group->city_name }}
                                                    @endif
                                                </h6>
                                            </li>

                                        </ul>
                                        <a href="{{ url('/organizations/detail?id=' . $group->id) }}"
                                            class="btn btn-primary mt-3 py-2 px-4">Learn More</a>

                                    </div>
                                </div>
                            @endforeach
                        </div>






                    </div>
                </div>
            </div>

        </div>
        <!-- About End -->

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
            $('.menu-organization').addClass('active')
            $('.dropdown-button').on('click', function() {

                if ($('.nav-item').hasClass('menu-open')) {
                    $('.dropdown-icon').removeClass('fa-chevron-down');
                    $('.dropdown-icon').addClass('fa-angle-right');
                } else {
                    $('.dropdown-icon').removeClass('fa-angle-right');
                    $('.dropdown-icon').addClass('fa-chevron-down');
                }
            })

            $('ul.locationList').each(function() {
                var $ul = $(this),
                    $lis = $ul.find('li:gt(7)'),
                    isExpanded = $ul.hasClass('expanded');
                $lis[isExpanded ? 'show' : 'hide']();

                if ($lis.length > 0) {
                    $ul
                        .append($('<a class="showmore "><li class="click expand mx-3 fw-bold text-dark">' +
                                (
                                    isExpanded ? '  Show Less' : '  Show More') + '</li></a>')
                            .click(function(event) {
                                var isExpanded = $ul.hasClass('expanded');
                                event.preventDefault();
                                var html =
                                    '<a class="showmore "><li class="click expand mx-3 fw-bold text-dark">' +
                                    (isExpanded ? '  Show Less' : '  Show More') + '</li></a>'
                                $(this).html(isExpanded ?
                                    '<a class="showmore "><li class="click expand mx-3 fw-bold text-dark">' +
                                    'Show More' + '</li></a>' :
                                    '<a class="showmore "><li class="click expand mx-3 fw-bold text-dark">' +
                                    'Show Less' + '</li></a>');
                                $ul.toggleClass('expanded');
                                $lis.toggle();
                            }));
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

            $('.heart-icon1').on('mouseleave', function() {
                $(this).css({
                    "transition": "0.3s"
                }, {
                    "font-size": "25px"
                });
            });

            $('.heart-icon1').on('click', function() {

                if (!{!! json_encode(session()->has('user')) !!}) {

                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success ms-1",
                            cancelButton: "btn btn-danger me-1"
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: "Login required !",
                        text: "You need to log in to be able to add items to your favorites list !",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, let me log in ",
                        cancelButtonText: "Close",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ url('/login') }}";
                        }
                    });


                } else {

                    if ($(this).hasClass('fa-regular')) {

                        $.ajax({
                            type: 'GET',

                            url: "{{ route('addGroup') }}",
                            data: {
                                groupID: $(this).find('.group-id').val(),
                                action: 'add'
                            },
                            success: function(data) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Added to favorite list',
                                    text: 'View your list in account detail'
                                });

                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Action Failed !'
                                });
                            }
                        })
                        $(this).removeClass('fa-regular')
                        $(this).addClass('fa-solid')

                    } else {
                        $.ajax({
                            type: 'GET',
                            url: "{{ route('addGroup') }}",
                            data: {
                                groupID: $(this).find('.group-id').val(),
                                action: 'remove'
                            },
                            success: function(data) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Removed from favorite list',
                                    text: 'View your list in account detail'
                                });

                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Action Failed !'
                                });
                            }
                        })
                        $(this).removeClass('fa-solid');
                        $(this).addClass('fa-regular');

                    }
                }

            });

            // $('.heart-icon1').on('click', function() {
            //     if ($(this).hasClass('fa-regular')) {
            //         $(this).removeClass('fa-regular');
            //         $(this).addClass('fa-solid');
            //         Swal.fire({
            //             icon: 'success',
            //             title: 'Added to favorite list',
            //             text: 'View your list in account detail'
            //         });

            //     } else {
            //         $(this).removeClass('fa-solid');
            //         $(this).addClass('fa-regular');
            //         Swal.fire({
            //             icon: 'success',
            //             title: 'Removed from favorite list',
            //             text: 'View your list in account detail'
            //         });
            //     }
            // });

            $('.star-rating-result').each(function() {
                var $star_rating_result = $(this).find('.fa-star');

                var SetRatingStarResult = function() {
                    return $star_rating_result.each(function() {
                        var value = parseInt($star_rating_result.siblings(
                                'input.rating-value-result')
                            .val());

                        if (value >= parseInt($(this).data('rating'))) {
                            return $(this).removeClass('fa-regular').addClass('fa-solid');
                        } else {
                            return $(this).removeClass('fa-solid').addClass('fa-regular');
                        }
                    });
                };



                SetRatingStarResult();
            });

/////////////////////
            $('.location-search').change(function() {

                var checkedLocations = [];
                $('.location-search:checked').each(function() {
                    checkedLocations.push($(this).val());
                    //alert($(this).val());

                });
                
                // Gửi mảng checkedLocations qua Ajax
                $.ajax({
                    type: 'GET',
                    url: "{{ route('searchGroup') }}",
                    data: {
                        checkedLocations: checkedLocations
                    },
                    success: function(data) {
                        $('.group-list').empty();

                        // Duyệt qua mảng mountainList và tạo HTML tương ứng
                        $.each(data.groupList, function(index, group) {
                            var imageUrl = group.photo ?
                                '{{ asset('/img/groups/') }}/' + group.id + '/' + group
                                .photo : '{{ asset('/img/groups/unknown.png') }}';

                            var hasScore = false;
                            var scoreHtml = '';
                            for (var i = 0; i < data.scoreList.length; i++) {
                                if (data.scoreList[i].group_id === group.id) {
                                    scoreHtml =
                                        '<input type="hidden" name="whatever1" class="rating-value-result" value="' +
                                        data.scoreList[i].avg_score + '">';
                                    hasScore = true;
                                    break;
                                }
                            }
                            if (!hasScore) {
                                scoreHtml =
                                    '<input type="hidden" name="whatever1" class="rating-value-result" value="0">';
                            }

                            var likeIconHtml = '';
                            if ({!! json_encode(session()->has('user')) !!}) {
                                var likeClass = data.groupLikeList.some(like => like
                                        .group_id === group.id) ? 'fa-solid' :
                                    'fa-regular';
                                likeIconHtml = '<i class="' + likeClass +
                                    ' heart-icon1 fa-heart"><input type="hidden" class="group-id" value="' +
                                    group.id + '"></i>';
                            } else {
                                likeIconHtml =
                                    '<i class="fa-regular heart-icon1 fa-heart"><input type="hidden" class="group-id" value="' +
                                    group.id + '"></i>';
                            }


                            var html = '';
                            html += '<div class="row p-1 align-items-center border border-3 border-success rounded bg-gray my-3">';
                html += '    <div class="col-lg-3 d-flex justify-content-center">';
                html += '        <img class="w-100 rounded-circle" src="' + imageUrl + '" alt="Group photo">';
                html += '    </div>';
                html += '    <div class="col-lg-9 py-5 py-lg-3">';
                html += '        <div class="d-flex justify-content-start star-rating-result">';
                html += '            <span class="fa-regular fa-star text-warning" data-rating="1"></span>';
                html += '            <span class="fa-regular fa-star text-warning" data-rating="2"></span>';
                html += '            <span class="fa-regular fa-star text-warning" data-rating="3"></span>';
                html += '            <span class="fa-regular fa-star text-warning" data-rating="4"></span>';
                html += '            <span class="fa-regular fa-star text-warning" data-rating="5"></span>';
                html += '            ' + scoreHtml;
                html += '        </div>';
                html += '        <span class="mb-4 fs-2 text-dark fw-bold">' + group.name + ' &nbsp; ' + likeIconHtml + '</span>';
                html += '        <span class="mb-4 text-secondary truncate-text1">' + group.description + '</span>';
                html += '        <ul class="list-inline">';
                html += '            <li>';
                html += '                <h6><i class="far fa-dot-circle text-primary mr-3"></i>Leader: ' + group.leader_name + '</h6>';
                html += '            </li>';
                html += '            <li>';
                html += '                <h6><i class="far fa-dot-circle text-primary mr-3"></i>Location (City): ' + (group.city_name ? group.city_name : '&nbsp;updating...') + '</h6>';
                html += '            </li>';
                html += '        </ul>';
                html += '        <a href="{{ url('/organizations/detail?id=') }}' + group.id + '" class="btn btn-primary mt-3 py-2 px-4">Learn More</a>';
                html += '    </div>';
                html += '</div>';

                            // Thêm HTML vào .mountain-list
                            $('.group-list').append(html);


                        });
                        setTimeout(function() {

                            $('.star-rating-result').each(function() {
                var $star_rating_result = $(this).find('.fa-star');

                var SetRatingStarResult = function() {
                    return $star_rating_result.each(function() {
                        var value = parseInt($star_rating_result.siblings(
                                'input.rating-value-result')
                            .val());

                        if (value >= parseInt($(this).data('rating'))) {
                            return $(this).removeClass('fa-regular').addClass('fa-solid');
                        } else {
                            return $(this).removeClass('fa-solid').addClass('fa-regular');
                        }
                    });
                };



                SetRatingStarResult();
            });


                            $('.heart-icon1').on('mouseleave', function() {
                                $(this).css({
                                    "transition": "0.3s"
                                }, {
                                    "font-size": "25px"
                                });
                            });

                            $('.heart-icon1').on('click', function() {

                                if (!{!! json_encode(session()->has('user')) !!}) {

                                    const swalWithBootstrapButtons = Swal
                                .mixin({
                                        customClass: {
                                            confirmButton: "btn btn-success ms-1",
                                            cancelButton: "btn btn-danger me-1"
                                        },
                                        buttonsStyling: false
                                    });
                                    swalWithBootstrapButtons.fire({
                                        title: "Login required !",
                                        text: "You need to log in to be able to add items to your favorites list !",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonText: "Yes, let me log in ",
                                        cancelButtonText: "Close",
                                        reverseButtons: true
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href =
                                                "{{ url('/login') }}";
                                        }
                                    });


                                } else {

                                    if ($(this).hasClass('fa-regular')) {

                                        $.ajax({
                                            type: 'GET',

                                            url: "{{ route('addGroup') }}",
                                            data: {
                                                groupID: $(this).find(
                                                        '.group-id')
                                                    .val(),
                                                action: 'add'
                                            },
                                            success: function(data) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Added to favorite list',
                                                    text: 'View your list in account detail'
                                                });

                                            },
                                            error: function(xhr, status,
                                                error) {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Action Failed !'
                                                });
                                            }
                                        })
                                        $(this).removeClass('fa-regular')
                                        $(this).addClass('fa-solid')

                                    } else {
                                        $.ajax({
                                            type: 'GET',
                                            url: "{{ route('addGroup') }}",
                                            data: {
                                                groupID: $(this).find(
                                                        '.group-id')
                                                    .val(),
                                                action: 'remove'
                                            },
                                            success: function(data) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Removed from favorite list',
                                                    text: 'View your list in account detail'
                                                });

                                            },
                                            error: function(xhr, status,
                                                error) {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Action Failed !'
                                                });
                                            }
                                        })
                                        $(this).removeClass('fa-solid');
                                        $(this).addClass('fa-regular');

                                    }
                                }

                            });
                        }, 40);
                        // Swal.fire({
                        //     icon: 'success',
                        //     title: 'Removed from favorite list',
                        //     text: 'View your list in account detail'
                        // });



                    },
                    error:function(xhr, status, error){
                        
                        var err = eval("(" + xhr.responseText + ")");
                        alert(xhr.responseText)
                        Swal.fire({
                            icon: 'error',
                            title: xhr.responseText
                        });
                    // $.each(error.errors, function (index, value) {
                    //     Swal.fire({
                    //         icon: 'error',
                    //         title: value
                    //     });
                    // });
                }

                });
            });
        })
    </script>
    <!--mon-->

    <script>
        $(document).ready(function() {
            var $window = $(window); //có thể thay bằng thẻ div cố định đầu trang
            var $scroll = $("#scroll");
            var $click = $(".click");
            var $parent = $scroll.parent();
            var originalTop = $scroll.offset().top - $parent.offset().top;
            var movementStart = 75;

            function onWindowScroll() {
                var windowTop = $window.scrollTop();
                var parentOffsetTop = $parent.offset().top;
                var parentBottom = parentOffsetTop + $parent.height();
                var scrollHeight = $scroll.height();
                var maxTop = parentBottom - parentOffsetTop - scrollHeight;

                if (windowTop + movementStart > parentOffsetTop - originalTop) {
                    var newTop = windowTop + movementStart - parentOffsetTop + originalTop;
                    newTop = newTop > maxTop ? maxTop : newTop;
                    $scroll.css({
                        position: 'absolute',
                        top: newTop
                    });
                } else {
                    $scroll.css({
                        position: 'absolute',
                        top: originalTop
                    });
                }
            }

            function onLinkClick() {
                var scrollDistance = 1; // độ lớn cuộn trang 1px
                $('html, body').animate({
                    scrollTop: $window.scrollTop() - scrollDistance
                }, 600);
            }

            function checkAndSetup() {
                if ($(window).width() > 980) {
                    $window.on('scroll', onWindowScroll);
                    $click.on('click', onLinkClick);
                } else {
                    $window.off('scroll', onWindowScroll);
                    $click.off('click', onLinkClick);
                    // Reset $scroll to default state if needed
                    $scroll.css({
                        position: '',
                        top: ''
                    });
                }
            }

            // Initial check
            checkAndSetup();

            // Check on window resize
            $window.resize(checkAndSetup);
        });
    </script>
@endsection
