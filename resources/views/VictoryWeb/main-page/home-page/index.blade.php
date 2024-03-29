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
            -webkit-line-clamp: 8;
            /* Số dòng tối đa bạn muốn hiển thị cho tin tức chính*/
            -webkit-box-orient: vertical;
        }

        .truncate-text img {
            display: none !important;
        }

        .truncate-text figure {
            display: none !important;

        }

        .truncate-text table {
            display: none !important;
        }

        .truncate-text figcaption {
            display: none !important;
        }

        .truncate-text .hero-container {
            display: none !important;
        }


        .truncate-text1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
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
    </style>
@endsection
@section('content')
    <div class="content-wrapper">


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


        <!-- Hero Start -->
        <div class="container-fluid bg-light py-6 my-6 mt-0 l-section-video d-flex align-items-center">
            <video class="w-100" muted loop autoplay playsinline preload="auto">
                <source type="video/mp4" src="https://www.theuiaa.org/wp-content/uploads/2024/01/Mini-Reel-15.mp4" />
            </video>
            <div class="container">
                <div class="row g-5 d-flex justify-content-center align-items-center">
                    <div class="col-lg-7 col-md-12 text-center p-3 rounded" style="backdrop-filter: blur(1px); ">


                        <small
                            class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-4 animate__animated  animate__bounceInDown ">Welcome
                            to Victory Mountaineering </small>
                        <h1 class="home-title-text-1 display-1 mb-4 animate__animated  animate__bounceInDown text-light">
                            Let's <span class="text-primary home-title-text-2">Begin</span>Your
                            <span class="text-primary  home-title-text-2">Journey</span>
                        </h1>

                        <a href="#aboutus"
                            class="scrollButton btn btn-primary border-0 rounded-pill py-3 px-4 px-md-5 animate__animated  animate__tada
                        animate__infinite animate__delay-1s"
                            style=" --animate-duration: 1.3s;">Over View</a>
                    </div>
                    {{-- <div class="col-lg-5 col-md-12">
                    <img src="{{asset('/')}}VictoryWeb/img/hero.png" class="img-fluid rounded animated zoomIn" alt="">
                </div> --}}
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- About Satrt -->
        <div class="container-fluid py-3">
            <div id="aboutus" class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5 wow animate__animated animate__bounceInUp " data-wow-delay="0.1s">
                        <img src="{{ asset('/') }}VictoryWeb/img/VICTORY3.png" class="img-fluid rounded" alt="">
                    </div>
                    <div class="col-lg-7 wow animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                        <small
                            class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">About
                            Us</small>
                        <h1 class="display-5 mb-4">Victory Mountaineering</h1>
                        <p class="mb-4">Welcome to Victory Mountaineering, your ultimate destination for exploring the
                            world's highest peaks and experiencing thrilling adventures.

                            At Victory Mountaineering, we are passionate about connecting people with nature and helping
                            them achieve their dreams of conquering majestic mountains. Whether you are an experienced
                            climber or a novice adventurer, we offer a range of guided expeditions and customized trips
                            tailored to your skill level and interests.

                            Our team of experienced guides and outdoor enthusiasts are dedicated to providing you with a
                            safe, memorable, and exhilarating mountain climbing experience. With our expertise and local
                            knowledge, we ensure that every journey with us is filled with excitement, discovery, and
                            breathtaking views.</p>
                        <div class="row g-4 text-dark mb-5">
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>Created By Geniuses Grom Aptech Academy
                            </div>
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>24/7 Customer Support
                            </div>
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>Continuously Updated And Latest Information
                            </div>
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>The Ideal Place For Those Who Love
                                Mountaineering
                            </div>
                        </div>
                        <a href="{{ url('/aboutus') }}" class="btn btn-primary py-3 px-5 rounded-pill">About Us<i
                                class="fas fa-arrow-right ps-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
        <div class="container-fluid service py-6">
            <div class="container">

                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 col-sm-12 wow animate__animated animate__bounceInUp"
                        data-wow-delay="0.1s">
                        <div class="bg-light rounded service-item">
                            <div class="service-content d-flex align-items-center justify-content-between h-100 p-3">
                                <div
                                    class="service-content-icon text-center d-flex flex-column align-items-center justify-content-between h-100">
                                    <img class="img-fluid mb-4" src="{{ asset('/') }}VictoryWeb/img/groups.webp"
                                        width="60%" alt="">

                                    <h4 class="mb-3">Adventure with people like you</h4>
                                    <p class="mb-4">75% join our group trips solo, with most in their 30s-50s. It works:
                                        95% give our group dynamic 5 stars.</p>

                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 wow animate__animated animate__bounceInUp"
                        data-wow-delay="0.2s">
                        <div class="bg-light rounded service-item">
                            <div class="service-content d-flex align-items-center justify-content-between h-100 p-3">
                                <div
                                    class="service-content-icon text-center d-flex flex-column align-items-center justify-content-between h-100">
                                    <img class="img-fluid mb-4" src="{{ asset('/') }}VictoryWeb/img/world.svg"
                                        width="60%" alt="">

                                    <h4 class="mb-3">Active outdoor specialists</h4>
                                    <p class="mb-4">We have the best choice of active outdoor adventures in wild places,
                                        whatever your mood.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 wow animate__animated animate__bounceInUp"
                        data-wow-delay="0.3s">
                        <div class="bg-light rounded service-item">
                            <div class="service-content d-flex align-items-center justify-content-between h-100 p-3">
                                <div
                                    class="service-content-icon text-center d-flex flex-column align-items-center justify-content-between h-100">
                                    <img class="img-fluid mb-4"
                                        src="{{ asset('/') }}VictoryWeb/img/adventurer_icon.webp" width="60%"
                                        alt="">
                                    <h4 class="mb-3">Get places you couldn't yourself</h4>
                                    <p class="mb-4">Our award-winning trips are led by expert guides, unlocking life
                                        experiences in places most travellers never see.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 wow animate__animated animate__bounceInUp"
                        data-wow-delay="0.4s">
                        <div class="bg-light rounded service-item">
                            <div class="service-content d-flex align-items-center justify-content-between h-100 p-3">
                                <div
                                    class="service-content-icon text-center d-flex flex-column align-items-center justify-content-between h-100">
                                    <img class="img-fluid mb-4" src="{{ asset('/') }}VictoryWeb/img/Fill_1__1_.webp"
                                        width="60%" alt="">
                                    <h4 class="mb-3">Hassle-Free From Start to Finish</h4>
                                    <p class="mb-4">We've sorted the logistics, so you can just rock up and have a blast
                                        in the wild.</p>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- Team Start -->
        <div class="container-fluid wow animate__animated animate__lightSpeedInLeft  border border-2 border-primary rounded  py-5 mb-5  team mountain-featured d-flex flex-column align-items-center justify-content-between overflow-hidden  "
            style="width:95%">
            <div class="container ">
                <div class="text-center mx-auto pb-5 wow animate__animated animate__fadeIn " data-wow-delay=".1s"
                    style="max-width: 600px;">

                    <small
                        class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Trending</small>
                    <h1>Most view mountain</h1>
                </div>
                <div class="owl-carousel team-carousel wow animate__animated animate__fadeIn " data-wow-delay=".2s">
                    @foreach ($mountainList as $mountain)
                        <div class="rounded team-item">
                            <div class="team-content rounded">
                                <div class="team-img-icon">
                                    <div class="team-img rounded overflow-hidden">
                                        <img src="{{ asset('/') }}img/mountains/{{ $mountain->id }}/{{ $mountain->photo_main }}"
                                            class="img-fluid w-100  rounded-bottom" alt="">
                                    </div>
                                    <div class="team-name text-center py-3">
                                        <h4 class="">{{ $mountain->name }}</h4>
                                        <p class="m-0">{{ $mountain->country_name }}</p>
                                    </div>
                                    <div class="team-icon d-flex justify-content-end pb-4">
                                        <a class="btn btn-square btn-primary text-white rounded-circle m-1 w-50 text-left"
                                            href="{{ url('/mountains/detail?id=' . $mountain->id) }}"><i
                                                class="fa-solid fa-paper-plane"></i></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <a href="{{ url('/mountains') }}"
                class="btn btn-primary px-4 py-2 my-4 rounded-pill read-more animate__animated animate__rubberBand animate__infinite">Find
                your trip</a>
            <div class="owl-carousel owl-theme testimonial-carousel  mb-4 wow tada"
                data-wow-delay="0.1s">
                @foreach ($accountRateList as $account)
                    <div class="testimonial-item rounded bg-light">
                        <div class="d-flex mb-3">

                            @if (
                                $account->photo == null ||
                                    $account->photo == '' ||
                                    !File::exists(public_path('img/accounts/' . $account->id . '/' . $account->photo)))
                            
                                    <img src="{{ asset('/img/accounts/unknown.png') }}"
                                class="img-fluid rounded-circle flex-shrink-0" alt="">
                            @else
                                
                                    <img src="{{ asset('/img/accounts/' . $account->id . '/' . $account->photo) }}"
                                class="img-fluid rounded-circle flex-shrink-0" alt="">
                            @endif
                            
                            <div class="position-absolute" style="top: 15px; right: 20px;">
                                <i class="fa fa-quote-right fa-2x"></i>
                            </div>
                            <div class="ps-3 my-auto">
                                <h4 class="mb-0">{{ $account->fullname }}</h4>
                                <p class="m-0">Rate for: {{ $account->mountainName }}</p>
                                <div class="d-flex justify-content-start star-rating-result ">
                                    <span class="fa-regular fa-star text-warning " data-rating="1"></span>
                                    <span class="fa-regular fa-star text-warning" data-rating="2"></span>
                                    <span class="fa-regular fa-star text-warning" data-rating="3"></span>
                                    <span class="fa-regular fa-star text-warning" data-rating="4"></span>
                                    <span class="fa-regular fa-star text-warning" data-rating="5"></span>
                                    <input type="hidden" name="whatever1" class="rating-value-result"
                                        value="{{ $account->avg_score }}">
    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                @endforeach
                
             
            </div>
        </div>
        <!-- Team End -->

        <!--News start-->
        <div class="container-fluid blog py-3 w-100 bg-light">
            <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
                <small
                    class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our
                    Blog</small>
                <h1 class="display-5 mb-5">Featured Blogs</h1>
            </div>
            <div class=" news-area m-0 ">

                <div class="row h-100  ">

                    <div class="col-lg-9 d-flex flex-column justify-content-between h-100 border-end">
                        <!-- 1 Tin chính, lấy cái mới nhất theo id-->


                        <div class="card  wow bounceInUp w-100  d-flex align-items-center " style="height:49%"
                            data-wow-delay="0.2s">
                            <div class="row  overflow-auto ">
                                <div class=" col-lg-5 d-flex align-items-center justify-content-center h-100">
                                    <img src="{{ asset('/img/articles/' . $articleFirst->id . '/' . $articleFirst->photo) }}"
                                        class="img-fluid rounded h-100" alt="">
                                </div>
                                <div class=" col-lg-7 h-100">
                                    <div class="card-body h-100 ">
                                        <h5 class="card-title"><a
                                                href="{{ url('/blogs/detail?id=' . $articleFirst->id) }}">{{ $articleFirst->name }}</a>
                                        </h5>
                                        <span class="card-text truncate-text text-secondary">
                                            {!! html_entity_decode($articleFirst->description) !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card  wow bounceInUp w-100  d-flex flex-column justify-content-center overflow-hidden"
                            style="height:49%" data-wow-delay="0.2s">
                            <div class="row overflow-auto ">
                                @foreach ($articleSecond as $article)
                                    <div class="col-lg-4  border-end h-100">
                                        <div class="card-body  h-100 overflow-hidden">
                                            <h5 class="card-title"><a
                                                    href="{{ url('/blogs/detail?id=' . $article->id) }}">{{ $article->name }}</a>
                                            </h5>
                                            <span class="card-text truncate-text text-secondary">
                                                {!! html_entity_decode($article->description) !!}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3  secondary-news   wow bounceInUp" data-wow-delay="0.3s">
                        <!-- 3 Tin phụ, controller skip (1) take(3) theo id mới nhất-->
                        <span class="pt-2">Newest News</span>
                        @foreach ($articleThird as $article)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h5 class="card-title truncate-text1 "><a
                                            href="{{ url('/blogs/detail?id=' . $article->id) }}">{{ $article->name }}</a>
                                    </h5>
                                    <span class="card-text truncate-text1">{!! html_entity_decode($article->description) !!}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

            </div>
            <div class="text-center wow bounceInUp">
                <a href="{{ url('/blogs') }}"
                    class="btn read-more btn-primary py-3 my-2 px-5 rounded-pill animate__animated animate__rubberBand animate__infinite">Read
                    More<i class="fas fa-arrow-right ps-2"></i></a>
            </div>
        </div>
        <!--News end-->

        <!-- Team Start -->
        <div class="container-fluid team organization-featured py-6">
            <div class="mx-3">
                <div class="text-center wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                    <small
                        class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">our
                        partner organizations</small>
                    <h1 class="display-5 mb-5">Find a community of companions</h1>
                </div>
                <div class="row g-4 border border-5 border-primary rounded">
                    <div class="owl-carousel  py-2  owl-theme testimonial-carousel mb-4 wow tada" data-wow-delay="0.1s">

                        @foreach ($groupList as $group)
                            <div class=" wow  animate__animated animate__bounceInRight h-100" data-wow-delay="0.1s">

                                <div class="team-item rounded-pill  h-100">
                                    <a class="h-100 d-flex align-items-center"
                                        href="{{ url('/organizations/detail?id=' . $group->id) }}">


                                        @if (
                                            $group->photo == null ||
                                                $group->photo == '' ||
                                                !File::exists(public_path('img/groups/' . $group->id . '/' . $group->photo)))
                                            <img class=" img-fluid rounded-circle h-100"
                                                src="{{ asset('/img/groups/unknown.png') }}" alt="User profile picture">
                                        @else
                                            <img class=" img-fluid rounded-circle h-100"
                                                src="{{ asset('/img/groups/' . $group->id . '/' . $group->photo) }}"
                                                alt="User profile picture">
                                        @endif


                                        <span class="fs-6 fw-bold ">{{ $group->name }}</span>

                                        <div class="team-icon bg-primary rounded-circle d-flex flex-column justify-content-center text-center "
                                            style="width:40px;height:40px">


                                            <i class="fas fa-share-alt text-dark"></i>


                                        </div>
                                    </a>

                                </div>

                            </div>
                        @endforeach









                    </div>




                </div>
            </div>
        </div>
        <!-- Team End -->


        <!-- Service Start -->
        <div class="container-xxl service py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <small
                        class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">our
                        featured</small>
                    <h1 class="mb-5">Explore Our Services</h1>
                </div>
                <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="col-lg-4">
                        <div class="nav w-100 nav-pills me-4">
                            <button class="nav-link w-100 d-flex align-items-center text-start p-3 mb-4 active"
                                data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                                <i class="fa-2x me-3 fa-solid fa-hourglass"></i>
                                <h4 class="m-0">Historical Insights</h4>
                            </button>
                            <button class="nav-link w-100 d-flex align-items-center text-start p-3 mb-4"
                                data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                                <i class="fa-2x me-3 fa-solid fa-mountain"></i>

                                <h4 class="m-0">Mountaineering Types</h4>
                            </button>
                            <button class="nav-link w-100 d-flex align-items-center text-start p-3 mb-4"
                                data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                                <i class="fa-2x me-3 fa-solid fa-map"></i>

                                <h4 class="m-0">Guidance Information</h4>
                            </button>
                            <button class="nav-link w-100 d-flex align-items-center text-start p-3 mb-4"
                                data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                                <i class="fa-2x me-3 fa-solid fa-house"></i>

                                <h4 class="m-0">Shelter Details</h4>
                            </button>
                            <button class="nav-link w-100 d-flex align-items-center text-start p-3 mb-0"
                                data-bs-toggle="pill" data-bs-target="#tab-pane-5" type="button">
                                <i class="fa-2x me-3 fa-solid fa-exclamation-triangle"></i>

                                <h4 class="m-0">Mountain Hazards</h4>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab-content w-100 h-100">
                            <div class="tab-pane fade show active" id="tab-pane-1">
                                <div class="row g-4">
                                    <div class="col-md-6 " style="min-height: 416px;">
                                        <div class="position-relative h-100 ">
                                            <img class="position-absolute img-fluid w-100 h-100 rounded-3"
                                                src="{{ asset('VictoryWeb/img/history.jpg') }}"
                                                style="object-fit: cover;" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3">Journey Through Time</h3>
                                        <p class="mb-4">Discover the epic saga of mountaineering, tracing its roots from
                                            ancient exploits to contemporary achievements. This historical perspective
                                            illuminates the relentless human quest for summit conquests, highlighting
                                            pivotal moments and legendary figures whose bravery and determination have
                                            sculpted the face of mountaineering.</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Epochal Achievements</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Legendary Explorers</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Cultural Impact</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-2">
                                <div class="row g-4">
                                    <div class="col-md-6" style="min-height: 416px;">
                                        <div class="position-relative h-100">
                                            <img class="position-absolute img-fluid w-100 h-100 rounded-3"
                                                src="{{ asset('VictoryWeb/img/style.jpg') }}" style="object-fit: cover;"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3">Climbing Varieties Explored</h3>
                                        <p class="mb-4">Mountaineering encompasses a broad spectrum of climbing styles,
                                            from the serene beauty of trekking across verdant trails to the
                                            adrenaline-pumping challenge of scaling sheer ice walls. Each style offers a
                                            distinct encounter with nature's magnificence, inviting climbers of all
                                            preferences and skill levels to find their niche in the vastness of the
                                            mountains.t</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Alpine Ventures</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Ice Climbing</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Rock Challenges</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-3">
                                <div class="row g-4">
                                    <div class="col-md-6" style="min-height: 416px;">
                                        <div class="position-relative h-100">
                                            <img class="position-absolute img-fluid w-100 h-100 rounded-3"
                                                src="{{ asset('VictoryWeb/img/guides.jpg') }}" style="object-fit: cover;"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3">Essential Insights for Climbers</h3>
                                        <p class="mb-4">Tap into a wealth of knowledge designed to enrich your climbing
                                            experience, covering crucial topics such as route planning, weather
                                            considerations, and safety protocols. This repository of guidance information
                                            serves as an invaluable tool for both novice climbers and seasoned veterans,
                                            ensuring well-informed and prepared adventures.</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Route Planning</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Safety Protocols</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Weather Tips</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-4">
                                <div class="row g-4">
                                    <div class="col-md-6" style="min-height: 416px;">
                                        <div class="position-relative h-100">
                                            <img class="position-absolute img-fluid w-100 h-100 rounded-3"
                                                src="{{ asset('VictoryWeb/img/shelter.jpg') }}"
                                                style="object-fit: cover;" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3">Sanctuaries Amidst the Peaks</h3>
                                        <p class="mb-4">In the embrace of the mountains, our shelters provide a crucial
                                            refuge from the elements, offering climbers a place to rest, recover, and
                                            prepare for the journey ahead. These shelters, ranging from basic bivouacs to
                                            more equipped refuges, are strategically situated to support climbers, embodying
                                            a commitment to safety and comfort in the wilderness.</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Strategic Locations</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Comfort Amenities</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Emergency Supplies</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-5">
                                <div class="row g-4">
                                    <div class="col-md-6" style="min-height: 416px;">
                                        <div class="position-relative h-100">
                                            <img class="position-absolute img-fluid w-100 h-100 rounded-3"
                                                src="{{ asset('VictoryWeb/img/hazards.jpg') }}"
                                                style="object-fit: cover;" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3">Vigilance Against the Elements</h3>
                                        <p class="mb-4">Understanding and respecting the hazards inherent in mountain
                                            environments are paramount for safe climbing. This includes navigating
                                            unpredictable weather, potential avalanches, and challenging terrain. Armed with
                                            the right knowledge and a respect for nature's power, climbers can mitigate
                                            risks and embrace the exhilarating experience of mountaineering with confidence.
                                        </p>
                                        <p><i class="fa fa-check text-success me-3"></i>Weather Awareness</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Avalanche Safety</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Terrain Navigation</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

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

    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
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

            $('.menu-home').addClass('active')
            // Testimonial carousel
            $(".testimonial-carousel").owlCarousel({

                center: true,


                loop: true,
                dots: false,

                margin: 25,
                autoplay: true,
                autoplayTimeout: 0,
                autoplaySpeed: 5000,

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
        })
    </script>
@endsection
