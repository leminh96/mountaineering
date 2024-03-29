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
    <link href="{{ asset('VictoryWeb') }}/lib/splide/splide.min.css" rel="stylesheet">
    <style>
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
            -webkit-line-clamp: 3;
            /* Số dòng tối đa bạn muốn hiển thị cho tin tức phụ*/
            -webkit-box-orient: vertical;
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
            border-radius: 10px 300px 300px 10px;
        }

        .searchBar {
            box-shadow: 0 0 45px rgba(240, 198, 9, 0.596);

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

        .heart-icon:hover {
            font-size: 30px;
            transition: 0.3s;
        }

        .heart-icon {

            font-size: 25px;
            color: rgb(255, 63, 63);
            text-shadow: rgb(80, 80, 80) 0.1px 0px 0px, rgb(80, 80, 80) 0.540302px 0.841471px 0px, rgb(80, 80, 80) -0.416147px 0.909297px 0px, rgb(80, 80, 80) -0.989992px 0.14112px 0px, rgb(80, 80, 80) -0.653644px -0.756802px 0px, rgb(80, 80, 80) 0.283662px -0.958924px 0px, rgb(80, 80, 80) 0.96017px -0.279416px 0px;
        }

        .testimonial-item {
            height: 350px;
        }

        .slide1 img {
            width: 100px;
            height: auto;
            object-fit: cover;
        }

        .slide2 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .splide__slide {
            opacity: 0.6;
        }

        .splide__slide.is-active {
            opacity: 1;
            border: red
        }

        .iframe-rwd {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }

        .iframe-rwd iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            
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




        <!-- About Satrt -->
        <div class="container-fluid  pt-2 d-flex flex-column align-items-center">
            <div class="text-center w-100">
                <small
                    class=" text-center d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Mountain</small>
                <h1>{{ $mountain->name }}

                </h1>

            </div>
            <div class="d-flex justify-content-start star-rating-result mb-3 mt-1">
                <span class="fa-regular fa-star text-warning " data-rating="1"></span>
                <span class="fa-regular fa-star text-warning" data-rating="2"></span>
                <span class="fa-regular fa-star text-warning" data-rating="3"></span>
                <span class="fa-regular fa-star text-warning" data-rating="4"></span>
                <span class="fa-regular fa-star text-warning" data-rating="5"></span>
                @if ($scoreList == null)
                    <input type="hidden" name="whatever1" class="rating-value-result" value="0">
                @else
                    <input type="hidden" name="whatever1" class="rating-value-result" value="{{ $scoreList->avg_score }}">
                @endif
            </div>
            <div class="container container-xl   animate__animated  animate__fadeIn" style=" --animate-duration: 0.9s;">
                <div class="splide w-100  " id="main-slider">
                    <div class="splide__track ">
                        <ul class="splide__list '">
                            <li class="splide__slide rounded slide1 p-lg-5"><img
                                    src="{{ asset('/') }}img/mountains/{{ $mountain->id }}/{{ $mountain->photo_main }}"
                                    alt="Slide 1"></li>
                            @foreach ($photoList as $photo)
                                @if ($photo->name != $mountain->photo_main)
                                    <li class="splide__slide rounded slide1 p-lg-5"><img
                                            src="{{ asset('/') }}img/mountains/{{ $mountain->id }}/{{ $photo->name }}"
                                            alt="Slide 1"></li>
                                @endif
                            @endforeach
                            @foreach ($videoList as $video)
                                <li class="splide__slide rounded slide1 p-lg-5 ratio ratio-16x9">
                                    <video muted loop autoplay playsinline preload="auto" allowfullscreen>
                                        <source type="video/mp4"
                                            src="{{ asset('/') }}img/mountains/{{ $mountain->id }}/{{ $video->name }}" />
                                    </video>
                                </li>
                                <!-- Thêm các slide cần hiển thị -->
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="splide pt-1 wow animate__animated  animate__bounceInLeft " style=" --animate-duration: 0.5s;"
                    id="thumbnail-slider">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide rounded border slide2 "><img class="rounded"
                                    src="{{ asset('/') }}img/mountains/{{ $mountain->id }}/{{ $mountain->photo_main }}"
                                    alt="Thumbnail 1"></li>
                            @foreach ($photoList as $photo)
                                @if ($photo->name != $mountain->photo_main)
                                    <li class="splide__slide rounded border slide2"><img class="rounded"
                                            src="{{ asset('/') }}img/mountains/{{ $mountain->id }}/{{ $photo->name }}"
                                            alt="Thumbnail 2"></li>
                                @endif
                            @endforeach
                            @foreach ($videoList as $video)
                                <li class="splide__slide rounded border slide2 ratio ratio-16x9">

                                    <video muted loop>
                                        <source type="video/mp4"
                                            src="{{ asset('/') }}img/mountains/{{ $mountain->id }}/{{ $video->name }}" />
                                    </video>
                                </li>
                            @endforeach

                            <!-- Thêm các thumbnail tương ứng -->
                        </ul>
                    </div>
                </div>
            </div>


        </div>
        <!-- About End -->

        <!-- Menu Start -->
        <div class="container-fluid menu bg-light py-6 my-3">
            <div class="container">
                <div class="text-center animate__animated animate__bounceInUp  ">
                    <small
                        class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Infomation</small>
                    <h1 class="display-5 mb-5 d-flex justify-content-between">
                        Infomation
                        <a
                            class="add-to-favorite bg-primary px-4 py-2 rounded-pill d-flex align-items-center fs-5 text-light">
                            Add to favorites list &nbsp;


                            <i class="fa-regular fa-hand-point-right"></i> &nbsp;

                            @if (session()->has('user'))
                                {{-- @foreach ($mountainLikeList as $like)

                            @endforeach --}}
                                @if ($mountainLikeList->contains('mountain_id', $mountain->id) == true)
                                    <i class="fa-solid heart-icon1 fa-heart">
                                        <input type="hidden" class="mountain-id" value="{{ $mountain->id }}">
                                    </i>
                                @else
                                    <i class="fa-regular heart-icon1 fa-heart">
                                        <input type="hidden" class="mountain-id" value="{{ $mountain->id }}">
                                    </i>
                                @endif
                            @else
                                <i class="fa-regular heart-icon1 fa-heart">
                                    <input type="hidden" class="mountain-id" value="{{ $mountain->id }}">
                                </i>
                            @endif




                        </a>
                    </h1>
                </div>
                <div class="tab-class text-center">
                    <ul class="nav nav-pills d-inline-flex justify-content-center mb-5  bounceInUp">
                        <li class="nav-item p-2  animate__animated animate__bounceInLeft ">
                            <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill active"
                                data-bs-toggle="pill" href="#description">
                                <span class="text-dark" style="width: 150px;">Description</span>
                            </a>
                        </li>
                        <li class="nav-item p-2  animate__animated animate__bounceInLeft --animate-delay-100ms">
                            <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill"
                                href="#history">
                                <span class="text-dark" style="width: 150px;">History</span>
                            </a>
                        </li>
                        <li class="nav-item p-2 animate__animated animate__bounceInLeft --animate-delay-300ms">
                            <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill"
                                href="#guides">
                                <span class="text-dark" style="width: 150px;">Guides</span>
                            </a>
                        </li>
                        <li class="nav-item p-2 animate__animated animate__bounceInLeft --animate-delay-500ms">
                            <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill"
                                href="#shelterings">
                                <span class="text-dark" style="width: 150px;">Sheltering</span>
                            </a>
                        </li>
                        <li class="nav-item p-2 animate__animated animate__bounceInLeft --animate-delay-700ms">
                            <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill"
                                href="#dangers">
                                <span class="text-dark" style="width: 150px;">Danger</span>
                            </a>
                        </li>
                        <li class="nav-item p-2 animate__animated animate__bounceInLeft --animate-delay-900ms">
                            <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill"
                                href="#articles">
                                <span class="text-dark" style="width: 150px;">Article</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="description" class="tab-pane fade show p-0 active">
                            <div class="row g-4  animate__animated  animate__fadeInUp">

                                <div class="menu-item  text-start">
                                    {!! html_entity_decode($mountain->description) !!}
                                </div>



                            </div>
                        </div>
                        <div id="history" class="tab-pane fade show p-0">
                            <div class="row g-4  animate__animated  animate__fadeInUp">

                                <div class="menu-item  text-start">

                                    {!! html_entity_decode($mountain->history) !!}
                                </div>



                            </div>
                        </div>
                        <div id="guides" class="tab-pane fade show p-0">
                            <div class="row g-4  animate__animated  animate__fadeInUp">

                                <div class="menu-item  text-start">

                                    {!! html_entity_decode($mountain->guides) !!}
                                </div>



                            </div>
                        </div>
                        <div id="shelterings" class="tab-pane fade show p-0">
                            <div class="row g-4 animate__animated  animate__fadeInUp">

                                <div class="menu-item  text-start">

                                    {!! html_entity_decode($mountain->sheltering) !!}
                                </div>



                            </div>
                        </div>
                        <div id="dangers" class="tab-pane fade show p-0">
                            <div class="row g-4 animate__animated  animate__fadeInUp">

                                <div class="menu-item  text-start">

                                    {!! html_entity_decode($mountain->dangers) !!}
                                </div>



                            </div>
                        </div>
                        <div id="articles" class="tab-pane fade show p-0">
                            <div class="row g-4 overflow-auto" style="height: 700px">
                                @foreach ($articleList as $article)
                                    <div class="col-lg-6 animate__animated  animate__lightSpeedInLeft">
                                        <div class="menu-item d-flex align-items-center">
                                            <div class="card   bounceInUp w-100 d" style="height:49%">
                                                <div class="row  overflow-auto d-flex align-items-center">
                                                    <div
                                                        class=" col-lg-5 d-flex align-items-center justify-content-center h-100">
                                                        @if (
                                                            $article->photo == null ||
                                                                $article->photo == '' ||
                                                                !File::exists(public_path('img/articles/' . $article->id . '/' . $article->photo)))
                                                            <img src="{{ asset('/img/articles/unknown.png') }}"
                                                                class="img-fluid rounded h-100" alt="">
                                                        @else
                                                            <img src="{{ asset('/img/articles/' . $article->id . '/' . $article->photo) }}"
                                                                class="img-fluid rounded h-100" alt="">
                                                        @endif

                                                    </div>
                                                    <div class=" col-lg-7 h-100">
                                                        <div class="card-body h-100">
                                                            <h5 class="card-title"><a
                                                                    href="{{ url('/blogs/detail?id=' . $article->id) }}">{{ $article->name }}</a>
                                                            </h5>
                                                            <span class="card-text truncate-text text-secondary">
                                                                {!! html_entity_decode($article->description) !!}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- <div class="col-lg-6 animate__animated  animate__lightSpeedInLeft">
                                    <div class="menu-item d-flex align-items-center">
                                        <div class="card   bounceInUp w-100 d" style="height:49%">
                                            <div class="row  overflow-auto d-flex align-items-center">
                                                <div
                                                    class=" col-lg-5 d-flex align-items-center justify-content-center h-100">
                                                    <img src="{{ asset('/img/articles/' . $featuredNews->id . '/' . $featuredNews->photo) }}"
                                                        class="img-fluid rounded h-100" alt="">
                                                </div>
                                                <div class=" col-lg-7 h-100">
                                                    <div class="card-body h-100">
                                                        <h5 class="card-title"><a
                                                                href="#">{{ $featuredNews->name }}</a></h5>
                                                        <span class="card-text truncate-text text-secondary">
                                                            {!! html_entity_decode($featuredNews->description) !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 animate__animated  animate__lightSpeedInLeft">
                                    <div class="menu-item d-flex align-items-center">
                                        <div class="card   bounceInUp w-100 d" style="height:49%">
                                            <div class="row  overflow-auto d-flex align-items-center">
                                                <div
                                                    class=" col-lg-5 d-flex align-items-center justify-content-center h-100">
                                                    <img src="{{ asset('/img/articles/' . $featuredNews->id . '/' . $featuredNews->photo) }}"
                                                        class="img-fluid rounded h-100" alt="">
                                                </div>
                                                <div class=" col-lg-7 h-100">
                                                    <div class="card-body h-100">
                                                        <h5 class="card-title"><a
                                                                href="#">{{ $featuredNews->name }}</a></h5>
                                                        <span class="card-text truncate-text text-secondary">
                                                            {!! html_entity_decode($featuredNews->description) !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 animate__animated  animate__lightSpeedInLeft">
                                    <div class="menu-item d-flex align-items-center">
                                        <div class="card   bounceInUp w-100 d" style="height:49%">
                                            <div class="row  overflow-auto d-flex align-items-center">
                                                <div
                                                    class=" col-lg-5 d-flex align-items-center justify-content-center h-100">
                                                    <img src="{{ asset('/img/articles/' . $featuredNews->id . '/' . $featuredNews->photo) }}"
                                                        class="img-fluid rounded h-100" alt="">
                                                </div>
                                                <div class=" col-lg-7 h-100">
                                                    <div class="card-body h-100">
                                                        <h5 class="card-title"><a
                                                                href="#">{{ $featuredNews->name }}</a></h5>
                                                        <span class="card-text truncate-text text-secondary">
                                                            {!! html_entity_decode($featuredNews->description) !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 animate__animated  animate__lightSpeedInLeft">
                                    <div class="menu-item d-flex align-items-center">
                                        <div class="card   bounceInUp w-100 d" style="height:49%">
                                            <div class="row  overflow-auto d-flex align-items-center">
                                                <div
                                                    class=" col-lg-5 d-flex align-items-center justify-content-center h-100">
                                                    <img src="{{ asset('/img/articles/' . $featuredNews->id . '/' . $featuredNews->photo) }}"
                                                        class="img-fluid rounded h-100" alt="">
                                                </div>
                                                <div class=" col-lg-7 h-100">
                                                    <div class="card-body h-100">
                                                        <h5 class="card-title"><a
                                                                href="#">{{ $featuredNews->name }}</a></h5>
                                                        <span class="card-text truncate-text text-secondary">
                                                            {!! html_entity_decode($featuredNews->description) !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 animate__animated  animate__lightSpeedInLeft">
                                    <div class="menu-item d-flex align-items-center">
                                        <div class="card   bounceInUp w-100 d" style="height:49%">
                                            <div class="row  overflow-auto d-flex align-items-center">
                                                <div
                                                    class=" col-lg-5 d-flex align-items-center justify-content-center h-100">
                                                    <img src="{{ asset('/img/articles/' . $featuredNews->id . '/' . $featuredNews->photo) }}"
                                                        class="img-fluid rounded h-100" alt="">
                                                </div>
                                                <div class=" col-lg-7 h-100">
                                                    <div class="card-body h-100">
                                                        <h5 class="card-title"><a
                                                                href="#">{{ $featuredNews->name }}</a></h5>
                                                        <span class="card-text truncate-text text-secondary">
                                                            {!! html_entity_decode($featuredNews->description) !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 animate__animated  animate__lightSpeedInLeft">
                                    <div class="menu-item d-flex align-items-center">
                                        <div class="card   bounceInUp w-100 d" style="height:49%">
                                            <div class="row  overflow-auto d-flex align-items-center">
                                                <div
                                                    class=" col-lg-5 d-flex align-items-center justify-content-center h-100">
                                                    <img src="{{ asset('/img/articles/' . $featuredNews->id . '/' . $featuredNews->photo) }}"
                                                        class="img-fluid rounded h-100" alt="">
                                                </div>
                                                <div class=" col-lg-7 h-100">
                                                    <div class="card-body h-100">
                                                        <h5 class="card-title"><a
                                                                href="#">{{ $featuredNews->name }}</a></h5>
                                                        <span class="card-text truncate-text text-secondary">
                                                            {!! html_entity_decode($featuredNews->description) !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 animate__animated  animate__lightSpeedInLeft">
                                    <div class="menu-item d-flex align-items-center">
                                        <div class="card   bounceInUp w-100 d" style="height:49%">
                                            <div class="row  overflow-auto d-flex align-items-center">
                                                <div
                                                    class=" col-lg-5 d-flex align-items-center justify-content-center h-100">
                                                    <img src="{{ asset('/img/articles/' . $featuredNews->id . '/' . $featuredNews->photo) }}"
                                                        class="img-fluid rounded h-100" alt="">
                                                </div>
                                                <div class=" col-lg-7 h-100">
                                                    <div class="card-body h-100">
                                                        <h5 class="card-title"><a
                                                                href="#">{{ $featuredNews->name }}</a></h5>
                                                        <span class="card-text truncate-text text-secondary">
                                                            {!! html_entity_decode($featuredNews->description) !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 animate__animated  animate__lightSpeedInLeft">
                                    <div class="menu-item d-flex align-items-center">
                                        <div class="card   bounceInUp w-100 d" style="height:49%">
                                            <div class="row  overflow-auto d-flex align-items-center ">
                                                <div
                                                    class=" col-lg-5 d-flex align-items-center justify-content-center h-100">
                                                    <img src="{{ asset('/img/articles/' . $featuredNews->id . '/' . $featuredNews->photo) }}"
                                                        class="img-fluid rounded h-100" alt="">
                                                </div>
                                                <div class=" col-lg-7 h-100">
                                                    <div class="card-body h-100">
                                                        <h5 class="card-title"><a
                                                                href="#">{{ $featuredNews->name }}</a></h5>
                                                        <span class="card-text truncate-text text-secondary">
                                                            {!! html_entity_decode($featuredNews->description) !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 animate__animated  animate__lightSpeedInLeft">
                                    <div class="menu-item d-flex align-items-center">
                                        <div class="card   bounceInUp w-100 d" style="height:49%">
                                            <div class="row  overflow-auto d-flex align-items-center ">
                                                <div
                                                    class=" col-lg-5 d-flex align-items-center justify-content-center h-100">
                                                    <img src="{{ asset('/img/articles/' . $featuredNews->id . '/' . $featuredNews->photo) }}"
                                                        class="img-fluid rounded h-100" alt="">
                                                </div>
                                                <div class=" col-lg-7 h-100">
                                                    <div class="card-body h-100">
                                                        <h5 class="card-title"><a
                                                                href="#">{{ $featuredNews->name }}</a></h5>
                                                        <span class="card-text truncate-text text-secondary">
                                                            {!! html_entity_decode($featuredNews->description) !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End -->

        <!-- Menu Start -->
        <div class="container-fluid menu bg-white py-6 my-3">
            <div class="container">

                <div class="tab-class-location text-start">

                    <ul class="text-center nav nav-pills d-inline-flex justify-content-center mb-5 wow bounceInUp"
                        data-wow-delay="0.1s">
                        <h1 class="display-5  d-flex justify-content-between">
                            Location: &nbsp;

                        </h1>
                        <li class="nav-item p-2 animate__animated animate__bounceInLeft --animate-delay-100ms">
                            <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill active "
                                data-bs-toggle="pill" href="#location">
                                <span class="text-dark" style="width: 150px;">Info &nbsp; <i
                                        class=" fa-solid fa-circle-info"></i></span>

                            </a>
                        </li>
                        <h1
                            class="display-5  d-flex align-items-center fs-3  text-center animate__animated animate__bounceInLeft --animate-delay-300ms">
                            <i class="fa-solid fa-arrows-left-right text-success"></i>
                        </h1>

                        <li class="nav-item p-2 animate__animated animate__bounceInLeft --animate-delay-500ms">
                            <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill  "
                                data-bs-toggle="pill" href="#map">
                                <span class="text-dark" style="width: 150px;">Map &nbsp;<i
                                        class="fa-solid fa-map-location-dot"></i>
                                </span>

                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div id="location" class="tab-pane fade show p-0 active">
                            <div class="row g-4  animate__animated  animate__fadeInUp">

                                <div class="menu-item  text-start">
                                    {!! html_entity_decode($mountain->location) !!}
                                </div>



                            </div>
                        </div>
                        <div id="map" class="tab-pane fade show p-0">
                            <div class="row g-4  animate__animated  animate__fadeInUp">

                                <div class="menu-item">

                                    <div class="iframe-rwd rounded">
                                        {!! html_entity_decode($mountain->api) !!}
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End -->

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
                    <div class="owl-carousel  py-2  owl-theme testimonial-carousel  mb-4 wow tada" data-wow-delay="0.1s">
                        @if ($groupList->isEmpty())
                            <span class="fs-6 fw-bold ">Information about relevant organizations is in the process of being
                                updated</span>
                        @else
                            @foreach ($groupList as $group)
                                <div class=" wow  animate__animated animate__bounceInRight h-100" data-wow-delay="0.1s">

                                    <div class="team-item rounded-pill  h-100">
                                        <div class="h-100 d-flex align-items-center">
                                            @if (
                                                $group->photo == null ||
                                                    $group->photo == '' ||
                                                    !File::exists(public_path('img/groups/' . $group->id . '/' . $group->photo)))
                                                <img class="img-fluid rounded-circle h-100 me-1"
                                                    src="{{ asset('/') }}img/groups/unknown.png" alt="">
                                            @else
                                                <img class="img-fluid rounded-circle h-100 me-1"
                                                    src="{{ asset('/') }}img/groups/{{ $group->id }}/{{ $group->photo }}"
                                                    alt="">
                                            @endif
                                            <span class="fs-6 fw-bold ">
                                                <a
                                                    href="{{ url('/organizations/detail?id=' . $group->id) }}">{{ $group->name }}</a>

                                            </span>

                                            <div class="team-icon bg-primary rounded-circle d-flex flex-column justify-content-center text-center "
                                                style="width:40px;height:40px">
                                                @if (session()->has('user'))
                                                    @if ($groupLikeList->contains('group_id', $group->id) == true)
                                                        <i class="fa-solid heart-icon fa-heart">
                                                            <input type="hidden" class="group-id"
                                                                value="{{ $group->id }}">
                                                        </i>
                                                    @else
                                                        <i class="fa-regular heart-icon fa-heart">
                                                            <input type="hidden" class="group-id"
                                                                value="{{ $group->id }}">
                                                        </i>
                                                    @endif
                                                @else
                                                    <i class="fa-regular heart-icon fa-heart">
                                                        <input type="hidden" class="group-id"
                                                            value="{{ $group->id }}">
                                                    </i>
                                                @endif



                                            </div>
                                        </div>

                                    </div>

                                </div>
                            @endforeach
                        @endif



                    </div>




                </div>
            </div>
        </div>
        <!-- Team End -->

        <div class="bg-primary py-3 px-5 rounded-pill  d-flex " style="width:fit-content">
            <span class="fw-bold fs-5 text-dark">Rating: &nbsp;</span>
            <div class="star-rating ">
                <span class="fa-regular fa-star  " data-rating="1"></span>
                <span class="fa-regular fa-star " data-rating="2"></span>
                <span class="fa-regular fa-star " data-rating="3"></span>
                <span class="fa-regular fa-star " data-rating="4"></span>
                <span class="fa-regular fa-star " data-rating="5"></span>


                @if (session()->has('user'))
                    @if ($score != null)
                        <input type="hidden" name="whatever1" class="rating-value" value="{{ $score->rate_score }}">
                    @else
                        <input type="hidden" name="whatever1" class="rating-value" value="0">
                    @endif
                @else
                    <input type="hidden" name="whatever1" class="rating-value" value="0">
                @endif
            </div>


        </div>

        <!-- Testimonial Start -->
        <input type="hidden" id="mountain-id" value="{{ $mountain->id }}">


        <!-- Menu Start -->
        <div class="container-fluid menu bg-white py-6 my-3">
            <div class="container">
                <div class="card card-widget ">
                    <div class="card-header bg-light">
                        <div class="user-block ">

                            <h1 class="display-5 ">COMMENTS</h1>
                        </div>
                        <!-- /.user-block -->

                    </div>
                    <!-- /.card-header -->

                    <div class="card-footer card-comments px-1 d-flex flex-column-reverse" style="max-height: 800px;overflow:auto">

                        @foreach ($commentList as $comment)
                            <div class="card-comment my-3 d-flex flex-column align-items-end">
                                <div class="rounded  bg-primary px-1 pt-1 w-100">
                                    <span class="username d-flex align-items-center justify-content-between w-100">
                                        <!-- User image -->
                                        <span class="username text-dark fw-bold d-flex align-items-center">
                                            @if (
                                                $comment->photo == null ||
                                                    $comment->photo == '' ||
                                                    !File::exists(public_path('img/accounts/' . $comment->id . '/' . $comment->photo)))
                                                
                                                    <img class="img-thumbnail rounded-circle " height="40px" width="40px"
                                                src="{{ asset('/img/accounts/unknown.png') }}"
                                                alt="User Image">
                                            @else
                                               
                                                    <img class="img-thumbnail rounded-circle " height="40px" width="40px"
                                                src="{{ asset('/img/accounts/' . $comment->id . '/' . $comment->photo) }}"
                                                alt="User Image">
                                            @endif

                                            
                                            &nbsp;
                                            {{$comment->fullname}}
                                        </span>

                                        <small class="text-dark">{{ \Carbon\Carbon::parse($comment->created)->format('H:i d/m/Y') }}</small>
                                    </span><!-- /.username -->
                                    <div class="comment-text text-light ps-5 fst-italic">

                                        - {{$comment->comment_text}}
                                    </div>
                                    <!-- /.comment-text -->
                                </div>


                            </div>
                        @endforeach


                        {{-- <div class="card-comment my-3 d-flex flex-column align-items-end">
                            <div class="rounded  bg-primary px-1 pt-1 w-100">
                                <span class="username d-flex align-items-center justify-content-between w-100">
                                    <!-- User image -->
                                    <span class="username text-dark fw-bold d-flex align-items-center">
                                        <img class="img-thumbnail rounded-circle " height="40px" width="40px"
                                            src="{{ asset('/') }}img/accounts/9/1709454751_main.jpg" alt="User Image">
                                        &nbsp;
                                        Maria Gonzales
                                    </span>

                                    <small>8:03 11/11/2011</small>
                                </span><!-- /.username -->
                                <div class="comment-text text-light">

                                    It is a long established fact that a reader will be distracted
                                    by the readable content of a page when looking at its layout.f
                                </div>
                                <!-- /.comment-text -->
                            </div>
                            <i class="fa-solid fa-circle-down"></i>
                            <div class="rounded bg-secondary px-1 pt-1 d-flex flex-column w-75">
                                <span class="username  w-100 text-dark text-end">


                                    <small>admin reply <i class="fa-regular fa-comment-dots"></i></small>
                                </span><!-- /.username -->
                                <div class="comment-text text-light w-100">

                                    It is a long established fact that a reader will be distracted
                                    by the readable content of a page when looking at its layout.f
                                </div>
                                <!-- /.comment-text -->
                            </div>

                        </div>
                        <div class="card-comment my-3 d-flex flex-column align-items-end">
                            <div class="rounded  bg-primary px-1 pt-1 w-100">
                                <span class="username d-flex align-items-center justify-content-between w-100">
                                    <!-- User image -->
                                    <span class="username text-dark fw-bold d-flex align-items-center">
                                        <img class="img-thumbnail rounded-circle " height="40px" width="40px"
                                            src="{{ asset('/') }}img/accounts/9/1709454751_main.jpg" alt="User Image">
                                        &nbsp;
                                        Maria Gonzales
                                    </span>

                                    <small>8:03 11/11/2011</small>
                                </span><!-- /.username -->
                                <div class="comment-text text-light">

                                    It is a long established fact that a reader will be distracted
                                    by the readable content of a page when looking at its layout.f
                                </div>
                                <!-- /.comment-text -->
                            </div>
                            <i class="fa-solid fa-circle-down"></i>
                            <div class="rounded bg-secondary px-1 pt-1 d-flex flex-column w-75">
                                <span class="username  w-100 text-dark text-end">


                                    <small>admin reply <i class="fa-regular fa-comment-dots"></i></small>
                                </span><!-- /.username -->
                                <div class="comment-text text-light w-100">

                                    It is a long established fact that a reader will be distracted
                                    by the readable content of a page when looking at its layout.f
                                </div>
                                <!-- /.comment-text -->
                            </div>

                        </div>
                        <div class="card-comment my-3 d-flex flex-column align-items-end">
                            <div class="rounded  bg-primary px-1 pt-1 w-100">
                                <span class="username d-flex align-items-center justify-content-between w-100">
                                    <!-- User image -->
                                    <span class="username text-dark fw-bold d-flex align-items-center">
                                        <img class="img-thumbnail rounded-circle " height="40px" width="40px"
                                            src="{{ asset('/') }}img/accounts/9/1709454751_main.jpg" alt="User Image">
                                        &nbsp;
                                        Maria Gonzales
                                    </span>

                                    <small>8:03 11/11/2011</small>
                                </span><!-- /.username -->
                                <div class="comment-text text-light">

                                    It is a long established fact that a reader will be distracted
                                    by the readable content of a page when looking at its layout.f
                                </div>
                                <!-- /.comment-text -->
                            </div>


                        </div>
                        <div class="card-comment my-3 d-flex flex-column align-items-end">
                            <div class="rounded  bg-primary px-1 pt-1 w-100">
                                <span class="username d-flex align-items-center justify-content-between w-100">
                                    <!-- User image -->
                                    <span class="username text-dark fw-bold d-flex align-items-center">
                                        <img class="img-thumbnail rounded-circle " height="40px" width="40px"
                                            src="{{ asset('/') }}img/accounts/9/1709454751_main.jpg" alt="User Image">
                                        &nbsp;
                                        Maria Gonzales
                                    </span>

                                    <small>8:03 11/11/2011</small>
                                </span><!-- /.username -->
                                <div class="comment-text text-light">

                                    It is a long established fact that a reader will be distracted
                                    by the readable content of a page when looking at its layout.f
                                </div>
                                <!-- /.comment-text -->
                            </div>
                            <i class="fa-solid fa-circle-down"></i>
                            <div class="rounded bg-secondary px-1 pt-1 d-flex flex-column w-75">
                                <span class="username  w-100 text-dark text-end">


                                    <small>admin reply <i class="fa-regular fa-comment-dots"></i></small>
                                </span><!-- /.username -->
                                <div class="comment-text text-light w-100">

                                    It is a long established fact that a reader will be distracted
                                    by the readable content of a page when looking at its layout.f
                                </div>
                                <!-- /.comment-text -->
                            </div>

                        </div> --}}


                    </div>
                    <!-- /.card-footer -->
                    <div class="card-footer">
                        {{-- <form action="{{ url('') }}" method="post" class="d-flex align-items-center"> --}}
                        <div class="d-flex align-items-center">
                            <input type="hidden" id="comment-mountain-id" value="{{ $mountain->id }}">
                            @if (session()->has('user'))
                                @php
                                    $account = session()->get('user');
                                @endphp
                                @if (
                                    $account->photo == null ||
                                        $account->photo == '' ||
                                        !File::exists(public_path('img/accounts/' . $account->id . '/' . $account->photo)))
                                    <img class="img-thumbnail rounded-circle " height="40px" width="40px"
                                        src="{{ asset('/img/accounts/unknown.png') }}" alt="User Image">
                                @else
                                    <img class="img-thumbnail rounded-circle " height="40px" width="40px"
                                        src="{{ asset('/img/accounts/' . $account->id . '/' . $account->photo) }}"
                                        alt="User Image">
                                @endif
                            @else
                                <img class="img-thumbnail rounded-circle " height="40px" width="40px"
                                    src="{{ asset('/img/accounts/unknown.png') }}" class="" alt="User Image">
                            @endif

                            <!-- .img-push is used to add margin to elements next to floating images -->
                            <div class="img-push w-75 px-1">
                                <input type="text" class="form-control form-control-sm" id="comment-text"
                                    name="comment-text" placeholder="Press enter to post comment">
                            </div>
                            <button type="button"
                                class="d-flex align-items-center justify-content-center rouded btn btn-secondary  text-light "
                                id="submit-comment" style="width:60px; height:30px">
                                <i class="fa-solid fa-location-arrow"></i>
                            </button>
                        </div>

                        {{-- </form> --}}
                    </div>
                    <!-- /.card-footer -->
                </div>

            </div>
        </div>
        <!-- Menu End -->






        <!-- Testimonial End -->


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
    <script src="{{ asset('/') }}VictoryWeb/lib/splide/splide.min.js"></script>
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
            $('.menu-mountain').addClass('active')


           // $('.card-comments').scrollTop(container.prop("scrollHeight"));

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
                    "font-size": "25px"
                });
            });

            $('.heart-icon').on('click', function() {

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
                        confirmButtonText: "Yes, let me log in !",
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

                            url: "{{ url('/account/MountainFavoriteList') }}",
                            data: {
                                mountainID: $(this).find('.mountain-id').val(),
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
                            url: "{{ url('/account/MountainFavoriteList') }}",
                            data: {
                                mountainID: $(this).find('.mountain-id').val(),
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

            $('#submit-comment').on('click', function(event) {
                if (!{!! json_encode(session()->has('user')) !!}) {
                    event.preventDefault();
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success ms-1",
                            cancelButton: "btn btn-danger me-1"
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: "Login required !",
                        text: "You need to log in to be able comment !",
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
                    var comment = $('#comment-text').val().trim();
                    if (comment === '') {
                        event.preventDefault();
                    } else {
                        $.ajax({
                            type: 'GET',
                            data: {
                                type: 'mountain',
                                comment_text: comment,
                                id: $('#comment-mountain-id').val()

                            },
                            url: "{{ route('comment') }}",
                            success: function(data) {
                                location.reload();

                            },
                            error: function(xhr, status, error) {
                                alert(xhr.responseText);
                            }


                        });
                    }
                }

            });



            var $star_rating = $('.star-rating .fa-star');

            var SetRatingStar = function() {
                return $star_rating.each(function() {
                    var value = parseInt($star_rating.siblings('input.rating-value').val());

                    if (value >= parseInt($(this).data('rating'))) {
                        return $(this).removeClass('fa-regular').addClass('fa-solid');
                    } else {
                        return $(this).removeClass('fa-solid').addClass('fa-regular');
                    }
                });
            };

            $star_rating.on('click', function() {
                $star_rating.siblings('input.rating-value').val($(this).data('rating'));
                //alert($(this).data('rating'))

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
                        text: "You need to log in to be able to rate this mountain !",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, let me log in !",
                        cancelButtonText: "Close",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ url('/login') }}";
                        }
                    });

                } else {
                    var score = $(this).data('rating');
                    $.ajax({
                        type: 'GET',

                        url: "{{ route('rateMountain') }}",
                        data: {
                            mountainID: $('#mountain-id').val(),
                            score: score
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thank you for your feedback !'
                            });

                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Action Failed !'
                            });
                        }
                    });

                    return SetRatingStar();
                }


            });

            SetRatingStar();




            var $star_rating_result = $('.star-rating-result .fa-star');

            var SetRatingStarResult = function() {
                return $star_rating_result.each(function() {
                    var value = parseInt($star_rating_result.siblings('input.rating-value-result')
                        .val());

                    if (value >= parseInt($(this).data('rating'))) {
                        return $(this).removeClass('fa-regular').addClass('fa-solid');
                    } else {
                        return $(this).removeClass('fa-solid').addClass('fa-regular');
                    }
                });
            };



            SetRatingStarResult();




        })
        document.addEventListener('DOMContentLoaded', function() {
            var mainSlider = new Splide('#main-slider', {
                type: 'loop', // Kiểu hiển thị (ở đây là fade)
                heightRatio: 0.5,
                pagination: false, // Tắt thanh pagination
                arrows: true, // Hiển thị các nút điều hướng
                rewind: true,
                fixedWidth: '100%',
                // Đồng bộ thumbnail
                cover: true, // Hiển thị ảnh đầy đủ trong thumbnail
                breakpoints: {
                    640: {
                        heightRatio: 0.5, // Khi màn hình nhỏ hơn 640px, tỉ lệ là 70%
                    },
                },
            }).mount();

            var thumbnailSlider = new Splide('#thumbnail-slider', {
                fixedWidth: 150, // Chiều rộng cố định của thumbnail
                fixedHeight: 80, // Chiều cao cố định của thumbnail
                isNavigation: true, // Đánh dấu đây là slider thumbnail
                gap: 10, // Khoảng cách giữa các thumbnail
                focus: 'start',
                rewind: true,
                pagination: false, // Tắt thanh pagination
                breakpoints: {
                    640: {
                        fixedWidth: 66, // Khi màn hình nhỏ hơn 640px, chiều rộng là 66px
                        fixedHeight: 40, // Khi màn hình nhỏ hơn 640px, chiều cao là 40px
                    },
                },
            }).mount();

            // Đồng bộ main slider với thumbnail slider
            mainSlider.sync(thumbnailSlider);
        });
    </script>
@endsection
