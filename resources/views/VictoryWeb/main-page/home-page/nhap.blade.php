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
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link href="{{asset('VictoryWeb')}}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="{{asset('VictoryWeb')}}/lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('VictoryWeb')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('VictoryWeb')}}/css/style.css" rel="stylesheet">
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
            display: none;
        }
        .truncate-text1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Số dòng tối đa bạn muốn hiển thị cho tin tức phụ*/
            -webkit-box-orient: vertical;
        }
        .home-title-text-1{
            text-shadow: rgb(155, 110, 42) 2px 0px 0px, rgb(155, 110, 42) 1.75517px 0.958851px 0px, rgb(155, 110, 42) 1.0806px 1.68294px 0px, rgb(155, 110, 42) 0.141474px 1.99499px 0px, rgb(155, 110, 42) -0.832294px 1.81859px 0px, rgb(155, 110, 42) -1.60229px 1.19694px 0px, rgb(155, 110, 42) -1.97998px 0.28224px 0px, rgb(155, 110, 42) -1.87291px -0.701566px 0px, rgb(155, 110, 42) -1.30729px -1.5136px 0px, rgb(155, 110, 42) -0.421592px -1.95506px 0px, rgb(155, 110, 42) 0.567324px -1.91785px 0px, rgb(155, 110, 42) 1.41734px -1.41108px 0px, rgb(155, 110, 42) 1.92034px -0.558831px 0px;
        }
        .home-title-text-2{
            text-shadow: rgb(155, 110, 42) 2px 0px 0px, rgb(155, 110, 42) 1.75517px 0.958851px 0px, rgb(155, 110, 42) 1.0806px 1.68294px 0px, rgb(155, 110, 42) 0.141474px 1.99499px 0px, rgb(155, 110, 42) -0.832294px 1.81859px 0px, rgb(155, 110, 42) -1.60229px 1.19694px 0px, rgb(155, 110, 42) -1.97998px 0.28224px 0px, rgb(155, 110, 42) -1.87291px -0.701566px 0px, rgb(155, 110, 42) -1.30729px -1.5136px 0px, rgb(155, 110, 42) -0.421592px -1.95506px 0px, rgb(155, 110, 42) 0.567324px -1.91785px 0px, rgb(155, 110, 42) 1.41734px -1.41108px 0px, rgb(155, 110, 42) 1.92034px -0.558831px 0px;
        } 
        .secondary-news{
            overflow: auto;
            height: 100%;
        }
        .news-area{
            height:700px; width:100%;
            /* overflow-y: scroll; */
            overflow-x: hidden;
            
        } 
        .news-area::-webkit-scrollbar { 
    display: none;  /* Safari and Chrome */
}   
.read-more{
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
                <div class="col-lg-7 col-md-12 text-center p-3 rounded"  style="backdrop-filter: blur(1px); ">
                    
                  
                    <small
                        class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-4 animate__animated  animate__bounceInDown ">Welcome
                        to Victory Mountaineering </small>
                    <h1 class="home-title-text-1 display-1 mb-4 animate__animated  animate__bounceInDown text-light">Let's <span
                            class="text-primary home-title-text-2">Begin</span>Your
                            <span
                            class="text-primary  home-title-text-2">Journey</span>
                        </h1>
                   
                    <a href="#aboutus"
                        class="btn btn-primary border-0 rounded-pill py-3 px-4 px-md-5 animate__animated  animate__tada
                        animate__infinite animate__delay-1s" style=" --animate-duration: 1.3s;">Over View</a>
                </div>
                {{-- <div class="col-lg-5 col-md-12">
                    <img src="{{asset('/')}}VictoryWeb/img/hero.png" class="img-fluid rounded animated zoomIn" alt="">
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- About Satrt -->
    <div class="container-fluid py-4">
        <div id="aboutus" class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow animate__animated animate__bounceInUp " data-wow-delay="0.1s">
                    <img src="{{asset('/')}}VictoryWeb/img/victory/VICTORY3.png" class="img-fluid rounded" alt="">
                </div>
                <div class="col-lg-7 wow animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                    <small
                        class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">About
                        Us</small>
                    <h1 class="display-5 mb-4">Victory Mountaineering</h1>
                    <p class="mb-4">Welcome to Victory Mountaineering, your ultimate destination for exploring the world's highest peaks and experiencing thrilling adventures.

                        At Victory Mountaineering, we are passionate about connecting people with nature and helping them achieve their dreams of conquering majestic mountains. Whether you are an experienced climber or a novice adventurer, we offer a range of guided expeditions and customized trips tailored to your skill level and interests.
                        
                        Our team of experienced guides and outdoor enthusiasts are dedicated to providing you with a safe, memorable, and exhilarating mountain climbing experience. With our expertise and local knowledge, we ensure that every journey with us is filled with excitement, discovery, and breathtaking views.</p>
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
                            <i class="fas fa-share text-primary me-2"></i>The Ideal Place For Those Who Love Mountaineering
                        </div>
                    </div>
                    <a href="" class="btn btn-primary py-3 px-5 rounded-pill">About Us<i
                            class="fas fa-arrow-right ps-2"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    <div class="container-fluid service py-6">
        <div class="container">
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 col-sm-12 wow animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded service-item">
                        <div class="service-content d-flex align-items-center justify-content-between h-100 p-3">
                            <div class="service-content-icon text-center d-flex flex-column align-items-center justify-content-between h-100">
                                <img class="img-fluid mb-4" src="{{asset('/')}}VictoryWeb/img/victory/groups.webp" width="60%" alt="">
                                
                                <h4 class="mb-3">Adventure with people like you</h4>
                                <p class="mb-4">75% join our group trips solo, with most in their 30s-50s. It works: 95% give our group dynamic 5 stars.</p>
                                <a href="#" class="btn  btn-primary px-4 py-2 rounded-pill">Read More</a>

                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 wow animate__animated animate__bounceInUp" data-wow-delay="0.2s">
                    <div class="bg-light rounded service-item">
                        <div class="service-content d-flex align-items-center justify-content-between h-100 p-3">
                            <div class="service-content-icon text-center d-flex flex-column align-items-center justify-content-between h-100">
                                <img class="img-fluid mb-4" src="{{asset('/')}}VictoryWeb/img/victory/world.svg" width="60%" alt="">

                                <h4 class="mb-3">Active outdoor specialists</h4>
                                <p class="mb-4">We have the best choice of active outdoor adventures in wild places, whatever your mood.</p>
                                <a href="#" class="btn btn-primary px-4 py-2 rounded-pill">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 wow animate__animated animate__bounceInUp" data-wow-delay="0.3s">
                    <div class="bg-light rounded service-item">
                        <div class="service-content d-flex align-items-center justify-content-between h-100 p-3">
                            <div class="service-content-icon text-center d-flex flex-column align-items-center justify-content-between h-100">
                                <img class="img-fluid mb-4" src="{{asset('/')}}VictoryWeb/img/victory/adventurer_icon.webp" width="60%" alt="">
                                <h4 class="mb-3">Get places you couldn't yourself</h4>
                                <p class="mb-4">Our award-winning trips are led by expert guides, unlocking life experiences in places most travellers never see.</p>
                                <a href="#" class="btn btn-primary px-4 py-2 rounded-pill">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 wow animate__animated animate__bounceInUp" data-wow-delay="0.4s">
                    <div class="bg-light rounded service-item">
                        <div class="service-content d-flex align-items-center justify-content-between h-100 p-3">
                            <div class="service-content-icon text-center d-flex flex-column align-items-center justify-content-between h-100">
                                <img class="img-fluid mb-4" src="{{asset('/')}}VictoryWeb/img/victory/Fill_1__1_.webp" width="60%" alt="">
                                <h4 class="mb-3">Hassle-Free From Start to Finish</h4>
                                <p class="mb-4">We've sorted the logistics, so you can just rock up and have a blast in the wild.</p>
                                <a href="#" class="btn btn-primary px-4 py-2 rounded-pill">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <!-- Team Start -->
    <div class="container-fluid wow animate__animated animate__lightSpeedInLeft  border border-2 border-primary rounded  py-5 mb-5  team mountain-featured d-flex flex-column align-items-center justify-content-between overflow-hidden  " style="width:95%">
        <div class="container ">
            <div class="text-center mx-auto pb-5 wow animate__animated animate__fadeIn " data-wow-delay=".1s" style="max-width: 600px;">
                
                <small
                        class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Trending</small>
                <h1>Most view mountain</h1>
            </div>
            <div class="owl-carousel team-carousel wow animate__animated animate__fadeIn " data-wow-delay=".2s" >
                <div class="rounded team-item">
                    <div class="team-content rounded">
                        <div class="team-img-icon">
                            <div class="team-img rounded overflow-hidden">
                                <img src="{{asset('/')}}img/mountains/1/1.jpg" class="img-fluid w-100  rounded-bottom" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">Full Name1</h4>
                                <p class="m-0">Designation</p>
                            </div>
                            <div class="team-icon d-flex justify-content-end pb-4">
                                <a class="btn btn-square btn-primary text-white rounded-circle m-1 w-50 text-left" href=""><i class="fa-solid fa-paper-plane"></i></a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded team-item">
                    <div class="team-content rounded">
                        <div class="team-img-icon">
                            <div class="team-img rounded overflow-hidden">
                                <img src="{{asset('/')}}img/mountains/1/1.jpg" class="img-fluid w-100  rounded-bottom" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">Full Name2</h4>
                                <p class="m-0">Designation</p>
                            </div>
                            <div class="team-icon d-flex justify-content-end pb-4">
                                <a class="btn btn-square btn-primary text-white rounded-circle m-1 w-50 text-left" href=""><i class="fa-solid fa-paper-plane"></i></a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded team-item">
                    <div class="team-content rounded">
                        <div class="team-img-icon">
                            <div class="team-img rounded  overflow-hidden">
                                <img src="{{asset('/')}}img/mountains/1/1.jpg" class="img-fluid w-100 rounded-bottom" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">Full Name3</h4>
                                <p class="m-0">Designation</p>
                            </div>
                            <div class="team-icon d-flex justify-content-end pb-4">
                                <a class="btn btn-square btn-primary text-white rounded-circle m-1 w-50 text-left" href=""><i class="fa-solid fa-paper-plane"></i></a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded team-item">
                    <div class="team-content rounded">
                        <div class="team-img-icon">
                            <div class="team-img rounded  overflow-hidden">
                                <img src="{{asset('/')}}img/mountains/1/1.jpg" class="img-fluid w-100 rounded-bottom" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">Full Name4</h4>
                                <p class="m-0">Designation</p>
                            </div>
                            <div class="team-icon d-flex justify-content-end pb-4">
                                <a class="btn btn-square btn-primary text-white rounded-circle m-1 w-50 text-left" href=""><i class="fa-solid fa-paper-plane"></i></a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded team-item">
                    <div class="team-content rounded">
                        <div class="team-img-icon">
                            <div class="team-img rounded overflow-hidden">
                                <img src="{{asset('/')}}img/mountains/1/1.jpg" class="img-fluid w-100 rounded-bottom" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">Full Name5</h4>
                                <p class="m-0">Designation</p>
                            </div>
                            <div class="team-icon d-flex justify-content-end pb-4">
                                <a class="btn btn-square btn-primary text-white rounded-circle m-1 w-50 text-left" href=""><i class="fa-solid fa-paper-plane"></i></a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded team-item">
                    <div class="team-content rounded">
                        <div class="team-img-icon " >
                            <div class="team-img rounded overflow-hidden">
                                <img src="{{asset('/')}}img/mountains/1/1.jpg" class="img-fluid w-100 rounded-bottom" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">Full Name6</h4>
                                <p class="m-0">Designation</p>
                            </div>
                            <div class="team-icon d-flex justify-content-end pb-4">
                                <a class="btn btn-square btn-primary text-white rounded-circle m-1 w-50 text-left" href=""><i class="fa-solid fa-paper-plane"></i></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-primary px-4 py-2 my-4 rounded-pill read-more animate__animated animate__rubberBand animate__infinite">Find your trip</a>
        <div class="owl-carousel owl-theme testimonial-carousel testimonial-carousel-2 mb-4 wow tada"
        data-wow-delay="0.1s">
        <div class="testimonial-item rounded bg-light">
            <div class="d-flex mb-3">
                <img src="{{asset('/')}}VictoryWeb/img/testimonial-1.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
                <div class="position-absolute" style="top: 15px; right: 20px;">
                    <i class="fa fa-quote-right fa-2x"></i>
                </div>
                <div class="ps-3 my-auto">
                    <h4 class="mb-0">Person Name</h4>
                    <p class="m-0">Profession</p>
                </div>
            </div>
            <div class="testimonial-content">
                <div class="d-flex">
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                </div>
                <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore et
                    dolore magna aliqua.</p>
            </div>
        </div>
        <div class="testimonial-item rounded bg-light">
            <div class="d-flex mb-3">
                <img src="{{asset('/')}}VictoryWeb/img/testimonial-2.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
                <div class="position-absolute" style="top: 15px; right: 20px;">
                    <i class="fa fa-quote-right fa-2x"></i>
                </div>
                <div class="ps-3 my-auto">
                    <h4 class="mb-0">Person Name</h4>
                    <p class="m-0">Profession</p>
                </div>
            </div>
            <div class="testimonial-content">
                <div class="d-flex">
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                </div>
                <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore et
                    dolore magna aliqua.</p>
            </div>
        </div>
        <div class="testimonial-item rounded bg-light">
            <div class="d-flex mb-3">
                <img src="{{asset('/')}}VictoryWeb/img/testimonial-3.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
                <div class="position-absolute" style="top: 15px; right: 20px;">
                    <i class="fa fa-quote-right fa-2x"></i>
                </div>
                <div class="ps-3 my-auto">
                    <h4 class="mb-0">Person Name</h4>
                    <p class="m-0">Profession</p>
                </div>
            </div>
            <div class="testimonial-content">
                <div class="d-flex">
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                </div>
                <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore et
                    dolore magna aliqua.</p>
            </div>
        </div>
        <div class="testimonial-item rounded bg-light">
            <div class="d-flex mb-3">
                <img src="{{asset('/')}}VictoryWeb/img/testimonial-4.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
                <div class="position-absolute" style="top: 15px; right: 20px;">
                    <i class="fa fa-quote-right fa-2x"></i>
                </div>
                <div class="ps-3 my-auto">
                    <h4 class="mb-0">Person Name</h4>
                    <p class="m-0">Profession</p>
                </div>
            </div>
            <div class="testimonial-content">
                <div class="d-flex">
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                    <i class="fas fa-star text-primary"></i>
                </div>
                <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore et
                    dolore magna aliqua.</p>
            </div>
        </div>
    </div>
    </div>
    <!-- Team End -->

<!--News start-->
<div class="container-fluid blog py-3 w-100 bg-light">
    <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
        <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our Blog</small>
        <h1 class="display-5 mb-5">Featured News</h1>
    </div>
    <div class=" news-area m-0 " >
        
        <div class="row h-100 ">
            
            <div class="col-lg-9 d-flex flex-column justify-content-between h-100 border-end">
                <!-- 1 Tin chính, lấy cái mới nhất theo id-->
                
                
                <div class="card  wow bounceInUp w-100" style="height:49%" data-wow-delay="0.2s">
                    <div class="row  overflow-auto">
                        <div class=" col-lg-5 d-flex align-items-center justify-content-center h-100" >
                            <img src="{{ asset('/img/articles/' . $featuredNews->id . '/' . $featuredNews->photo) }}" class="img-fluid rounded h-100" alt="">
                        </div>
                        <div class=" col-lg-7 h-100">
                            <div class="card-body h-100">
                                <h5 class="card-title"><a href="#">{{ $featuredNews->name }}</a></h5>
                                <span class="card-text truncate-text text-secondary">
                                    {!!html_entity_decode($featuredNews->description )!!}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card  wow bounceInUp w-100  d-flex flex-column justify-content-center" style="height:49%" data-wow-delay="0.2s">
                    <div class="row overflow-auto ">
                        
                        <div class="col-lg  border-end h-100">
                            <div class="card-body  h-100">
                                <h5 class="card-title"><a href="#">{{ $featuredNews->name }}</a></h5>
                                <p class="card-text truncate-text text-secondary">K2, also known as Mount Godwin-Austen or Chhogori, is the second-highest mountain in the world, following Mount Everest. It has an elevation of 8,611 meters (28,251 feet) above sea level. K2 is located on the China-Pakistan border, between the Baltistan region in the Gilgit-Baltistan province of northern Pakistan and the Taxkorgan Tajik Autonomous County of Xinjiang, China. The mountain is part of the Karakoram Range and is known for its sheer difficulty and has the second-highest fatality rate among the eight-thousanders for those who climb it. Unlike Everest, it is not visible from any inhabited place, adding to its mystique and challenge. Its northern face is known for its steepness and technical difficulty, making it a coveted climb for serious mountaineers. The first successful ascent was made in 1954 by an Italian expedition led by Ardito Desio. The mountain's extreme weather conditions, including high winds and low temperatures, contribute to its reputation as one of the most challenging peaks for climbers.</p>
                            </div>
                        </div>
                        <div class=" col-lg  border-end h-100" >
                            <div class="card-body  h-100">
                                <h5 class="card-title"><a href="#">{{ $featuredNews->name }}</a></h5>
                                <p class="card-text truncate-text text-secondary">K2, also known as Mount Godwin-Austen or Chhogori, is the second-highest mountain in the world, following Mount Everest. It has an elevation of 8,611 meters (28,251 feet) above sea level. K2 is located on the China-Pakistan border, between the Baltistan region in the Gilgit-Baltistan province of northern Pakistan and the Taxkorgan Tajik Autonomous County of Xinjiang, China. The mountain is part of the Karakoram Range and is known for its sheer difficulty and has the second-highest fatality rate among the eight-thousanders for those who climb it. Unlike Everest, it is not visible from any inhabited place, adding to its mystique and challenge. Its northern face is known for its steepness and technical difficulty, making it a coveted climb for serious mountaineers. The first successful ascent was made in 1954 by an Italian expedition led by Ardito Desio. The mountain's extreme weather conditions, including high winds and low temperatures, contribute to its reputation as one of the most challenging peaks for climbers.</p>
                            </div>
                        </div>
                        <div class=" col-lg  ">
                            <div class="card-body  h-100">
                                <h5 class="card-title"><a href="#">{{ $featuredNews->name }}</a></h5>
                                <p class="card-text truncate-text text-secondary">K2, also known as Mount Godwin-Austen or Chhogori, is the second-highest mountain in the world, following Mount Everest. It has an elevation of 8,611 meters (28,251 feet) above sea level. K2 is located on the China-Pakistan border, between the Baltistan region in the Gilgit-Baltistan province of northern Pakistan and the Taxkorgan Tajik Autonomous County of Xinjiang, China. The mountain is part of the Karakoram Range and is known for its sheer difficulty and has the second-highest fatality rate among the eight-thousanders for those who climb it. Unlike Everest, it is not visible from any inhabited place, adding to its mystique and challenge. Its northern face is known for its steepness and technical difficulty, making it a coveted climb for serious mountaineers. The first successful ascent was made in 1954 by an Italian expedition led by Ardito Desio. The mountain's extreme weather conditions, including high winds and low temperatures, contribute to its reputation as one of the most challenging peaks for climbers.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3  secondary-news   wow bounceInUp" data-wow-delay="0.3s" >
                <!-- 3 Tin phụ, controller skip (1) take(3) theo id mới nhất-->
                <span class="pt-2">Newest News</span>
                @foreach($otherNews as $news)
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title truncate-text1 "><a href="#">{{ $news->name }}</a></h5>
                        <p class="card-text truncate-text1">{{ $news->description }}</p>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title truncate-text1 "><a href="#">{{ $news->name }}</a></h5>
                        <p class="card-text truncate-text1">{{ $news->description }}</p>
                    </div>
                </div>
                
                @endforeach
            </div>
            
        </div>
        
    </div>
    <div class="text-center wow bounceInUp">
        <a href="{{ url('/article') }}" class="btn read-more btn-primary py-3 my-2 px-5 rounded-pill animate__animated animate__rubberBand animate__infinite">Read More<i class="fas fa-arrow-right ps-2"></i></a>
    </div>
</div>
<!--News end-->

<!-- Team Start -->
<div class="container-fluid team organization-featured py-6">
    <div class="mx-3">
        <div class="text-center wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
            <small
                class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">our partner organizations</small>
            <h1 class="display-5 mb-5">Find a community of companions</h1>
        </div>
        <div class="row g-4 border border-5 border-primary rounded">
            <div class="owl-carousel  py-2  owl-theme testimonial-carousel testimonial-carousel-3 mb-4 wow tada" data-wow-delay="0.1s">
            
            <div class=" wow  animate__animated animate__bounceInUp h-100" data-wow-delay="0.1s">
               
                <div class="team-item rounded-pill  h-100">
                    <a class="h-100" href="#">
                    <img class="img-fluid rounded-top h-100" src="{{asset('/')}}VictoryWeb/img/victory/austrian-alpine-club-logo.png" alt="">
                    {{-- <div class="team-content text-center py-3 bg-dark rounded-bottom">
                        
                            <h4 class="text-primary">Indian Mountaineering Foundation</h4>
        
                    </div> --}}
                    <div class="team-icon d-flex flex-column justify-content-center m-4">
                        <a class="share btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fas fa-share-alt"></i></a>
                        <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </a>
                </div>
                
            </div>
            <div class=" wow  animate__animated animate__bounceInUp h-100" data-wow-delay="0.1s">
               
                <div class="team-item rounded-pill h-100">
                    <a class="h-100" href="#">
                    <img class="img-fluid rounded-top h-100" src="{{asset('/')}}VictoryWeb/img/victory/mountaineering-scotland-logo.png" alt="">
                    {{-- <div class="team-content text-center py-3 bg-dark rounded-bottom">
                        
                            <h4 class="text-primary">Indian Mountaineering Foundation</h4>
        
                    </div> --}}
                    <div class="team-icon d-flex flex-column justify-content-center m-4">
                        <a class="share btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fas fa-share-alt"></i></a>
                        <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </a>
                </div>
                
            </div>
            <div class=" wow  animate__animated animate__bounceInUp h-100" data-wow-delay="0.1s">
               
                <div class="team-item rounded-pill overflow-hidden h-100">
                    <a class="h-100" href="#">
                    <img class="img-fluid rounded-top h-100" src="{{asset('/')}}VictoryWeb/img/victory/mountaineering-scotland-logo.png" alt="">
                    {{-- <div class="team-content text-center py-3 bg-dark rounded-bottom">
                        
                            <h4 class="text-primary">Indian Mountaineering Foundation</h4>
        
                    </div> --}}
                    <div class="team-icon d-flex flex-column justify-content-center m-4">
                        <a class="share btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fas fa-share-alt"></i></a>
                        <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </a>
                </div>
                
            </div>
            <div class=" wow  animate__animated animate__bounceInUp h-100" data-wow-delay="0.1s">
               
                <div class="team-item rounded-pill overflow-hidden h-100">
                    <a class="h-100" href="#">
                    <img class="img-fluid rounded-top h-100" src="{{asset('/')}}VictoryWeb/img/victory/mountaineering-scotland-logo.png" alt="">
                    {{-- <div class="team-content text-center py-3 bg-dark rounded-bottom">
                        
                            <h4 class="text-primary">Indian Mountaineering Foundation</h4>
        
                    </div> --}}
                    <div class="team-icon d-flex flex-column justify-content-center m-4">
                        <a class="share btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fas fa-share-alt"></i></a>
                        <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </a>
                </div>
                
            </div>
            
            
            
            </div>
            <div class="w-100 d-flex justify-content-center">
                <a href="{{ url('/article') }}" class=" read-more btn btn-primary py-3 my-2 px-5 rounded-pill animate__animated animate__rubberBand animate__infinite"  >Read More<i class="fas fa-arrow-right ps-2"></i></a>

            </div>
          
           
            
        </div>
    </div>
</div>
<!-- Team End -->

    <!-- Fact Start-->
    <div class="container-fluid faqt py-6 ">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-7">
                    <div class="row g-4">
                        <div class="col-sm-4 wow   animate__animated animate__bounceInUp" data-wow-delay="0.3s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="fas fa-users fa-4x mb-4 text-white"></i>
                                <h1 class="display-4 fw-bold" data-toggle="counter-up">689</h1>
                                <p class="text-dark text-uppercase fw-bold mb-0">Happy Customers</p>
                            </div>
                        </div>
                        <div class="col-sm-4 wow  animate__animated animate__bounceInUp" data-wow-delay="0.5s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="fas fa-users-cog fa-4x mb-4 text-white"></i>
                                <h1 class="display-4 fw-bold" data-toggle="counter-up">107</h1>
                                <p class="text-dark text-uppercase fw-bold mb-0">Expert Chefs</p>
                            </div>
                        </div>
                        <div class="col-sm-4 wow  animate__animated animate__bounceInUp" data-wow-delay="0.7s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="fas fa-check fa-4x mb-4 text-white"></i>
                                <h1 class="display-4 fw-bold" data-toggle="counter-up">253</h1>
                                <p class="text-dark text-uppercase fw-bold mb-0">Events Complete</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                    <div class="video">
                        <button type="button" class="btn btn-play" data-bs-toggle="modal"
                            data-src="https://youtu.be/nXB4xBnP22o?list=RDMMnXB4xBnP22o"
                            data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Video -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                            allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact End -->


    <!-- Service Start -->
    <div class="container-fluid service py-6">
        <div class="container">
            <div class="text-center wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                <small
                    class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our
                    Services</small>
                <h1 class="display-5 mb-5">What We Offer</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 col-sm-12 wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded service-item">
                        <div class="service-content d-flex align-items-center justify-content-center p-4">
                            <div class="service-content-icon text-center">
                                <i class="fas fa-cheese fa-7x text-primary mb-4"></i>
                                <h4 class="mb-3">Wedding Services</h4>
                                <p class="mb-4">Contrary to popular belief, ipsum is not simply random.</p>
                                <a href="#" class="btn btn-primary px-4 py-2 rounded-pill">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 wow  animate__animated animate__bounceInUp" data-wow-delay="0.3s">
                    <div class="bg-light rounded service-item">
                        <div class="service-content d-flex align-items-center justify-content-center p-4">
                            <div class="service-content-icon text-center">
                                <i class="fas fa-pizza-slice fa-7x text-primary mb-4"></i>
                                <h4 class="mb-3">Corporate Catering</h4>
                                <p class="mb-4">Contrary to popular belief, ipsum is not simply random.</p>
                                <a href="#" class="btn btn-primary px-4 py-2 rounded-pill">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 wow  animate__animated animate__bounceInUp" data-wow-delay="0.5s">
                    <div class="bg-light rounded service-item">
                        <div class="service-content d-flex align-items-center justify-content-center p-4">
                            <div class="service-content-icon text-center">
                                <i class="fas fa-hotdog fa-7x text-primary mb-4"></i>
                                <h4 class="mb-3">Cocktail Reception</h4>
                                <p class="mb-4">Contrary to popular belief, ipsum is not simply random.</p>
                                <a href="#" class="btn btn-primary px-4 py-2 rounded-pill">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 wow  animate__animated animate__bounceInUp" data-wow-delay="0.7s">
                    <div class="bg-light rounded service-item">
                        <div class="service-content d-flex align-items-center justify-content-center p-4">
                            <div class="service-content-icon text-center">
                                <i class="fas fa-hamburger fa-7x text-primary mb-4"></i>
                                <h4 class="mb-3">Bento Catering</h4>
                                <p class="mb-4">Contrary to popular belief, ipsum is not simply random.</p>
                                <a href="#" class="btn btn-primary px-4 py-2 rounded-pill">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded service-item">
                        <div class="service-content d-flex align-items-center justify-content-center p-4">
                            <div class="service-content-icon text-center">
                                <i class="fas fa-wine-glass-alt fa-7x text-primary mb-4"></i>
                                <h4 class="mb-3">Pub Party</h4>
                                <p class="mb-4">Contrary to popular belief, ipsum is not simply random.</p>
                                <a href="#" class="btn btn-primary px-4 py-2 rounded-pill">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 wow  animate__animated animate__bounceInUp" data-wow-delay="0.3s">
                    <div class="bg-light rounded service-item">
                        <div class="service-content d-flex align-items-center justify-content-center p-4">
                            <div class="service-content-icon text-center">
                                <i class="fas fa-walking fa-7x text-primary mb-4"></i>
                                <h4 class="mb-3">Home Delivery</h4>
                                <p class="mb-4">Contrary to popular belief, ipsum is not simply random.</p>
                                <a href="#" class="btn btn-primary px-4 py-2 rounded-pill">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 wow  animate__animated animate__bounceInUp" data-wow-delay="0.5s">
                    <div class="bg-light rounded service-item">
                        <div class="service-content d-flex align-items-center justify-content-center p-4">
                            <div class="service-content-icon text-center">
                                <i class="fas fa-wheelchair fa-7x text-primary mb-4"></i>
                                <h4 class="mb-3">Sit-down Catering</h4>
                                <p class="mb-4">Contrary to popular belief, ipsum is not simply random.</p>
                                <a href="#" class="btn btn-primary px-4 py-2 rounded-pill">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 wow  animate__animated animate__bounceInUp" data-wow-delay="0.7s">
                    <div class="bg-light rounded service-item">
                        <div class="service-content d-flex align-items-center justify-content-center p-4">
                            <div class="service-content-icon text-center">
                                <i class="fas fa-utensils fa-7x text-primary mb-4"></i>
                                <h4 class="mb-3">Buffet Catering</h4>
                                <p class="mb-4">Contrary to popular belief, ipsum is not simply random.</p>
                                <a href="#" class="btn btn-primary px-4 py-2 rounded-pill">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Events Start -->
    <div class="container-fluid event py-6">
        <div class="container">
            <div class="text-center wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                <small
                    class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Latest
                    Events</small>
                <h1 class="display-5 mb-5">Our Social & Professional Events Gallery</h1>
            </div>
            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center mb-5 wow  animate__animated animate__bounceInUp"
                    data-wow-delay="0.1s">
                    <li class="nav-item p-2">
                        <a class="d-flex mx-2 py-2 border border-primary bg-light rounded-pill active"
                            data-bs-toggle="pill" href="#tab-1">
                            <span class="text-dark" style="width: 150px;">All Events</span>
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="d-flex py-2 mx-2 border border-primary bg-light rounded-pill"
                            data-bs-toggle="pill" href="#tab-2">
                            <span class="text-dark" style="width: 150px;">Wedding</span>
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="d-flex mx-2 py-2 border border-primary bg-light rounded-pill"
                            data-bs-toggle="pill" href="#tab-3">
                            <span class="text-dark" style="width: 150px;">Corporate</span>
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="d-flex mx-2 py-2 border border-primary bg-light rounded-pill"
                            data-bs-toggle="pill" href="#tab-4">
                            <span class="text-dark" style="width: 150px;">Cocktail</span>
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="d-flex mx-2 py-2 border border-primary bg-light rounded-pill"
                            data-bs-toggle="pill" href="#tab-5">
                            <span class="text-dark" style="width: 150px;">Buffet</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-3 wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-1.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Wedding</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/event-1.jpg" data-lightbox="event-1" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 wow  animate__animated animate__bounceInUp" data-wow-delay="0.3s">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-2.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Corporate</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/event-2.jpg" data-lightbox="event-2" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 wow  animate__animated animate__bounceInUp" data-wow-delay="0.5s">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-3.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Wedding</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/event-3.jpg" data-lightbox="event-3" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 wow  animate__animated animate__bounceInUp" data-wow-delay="0.7s">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-4.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Buffet</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/event-4.jpg" data-lightbox="event-4" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-5.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Cocktail</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/event-5.jpg" data-lightbox="event-5" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 wow  animate__animated animate__bounceInUp" data-wow-delay="0.3s">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-6.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Wedding</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/event-6.jpg" data-lightbox="event-6" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 wow  animate__animated animate__bounceInUp" data-wow-delay="0.5s">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-7.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Buffet</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/event-7.jpg" data-lightbox="event-7" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 wow  animate__animated animate__bounceInUp" data-wow-delay="0.7s">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-8.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Corporate</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/event-8.jpg" data-lightbox="event-17"
                                                    class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-3">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-1.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Wedding</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/01.jpg" data-lightbox="event-8" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-2.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Wedding</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/01.jpg" data-lightbox="event-9" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-3">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-3.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Corporate</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/01.jpg" data-lightbox="event-10" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-4.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Corporate</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/01.jpg" data-lightbox="event-11" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-3">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-5.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Cocktail</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/01.jpg" data-lightbox="event-12" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-6.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Cocktail</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/01.jpg" data-lightbox="event-13" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-5" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-3">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-7.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Buffet</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/01.jpg" data-lightbox="event-14" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="event-img position-relative">
                                            <img class="img-fluid rounded w-100" src="{{asset('/')}}VictoryWeb/img/event-8.jpg" alt="">
                                            <div class="event-overlay d-flex flex-column p-4">
                                                <h4 class="me-auto">Buffet</h4>
                                                <a href="{{asset('/')}}VictoryWeb/img/01.jpg" data-lightbox="event-15" class="my-auto"><i
                                                        class="fas fa-search-plus text-dark fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Events End -->


    <!-- Menu Start -->
    <div class="container-fluid menu bg-light py-6 my-6">
        <div class="container">
            <div class="text-center wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                <small
                    class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our
                    Menu</small>
                <h1 class="display-5 mb-5">Most Popular Food in the World</h1>
            </div>
            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center mb-5 wow  animate__animated animate__bounceInUp"
                    data-wow-delay="0.1s">
                    <li class="nav-item p-2">
                        <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill active"
                            data-bs-toggle="pill" href="#tab-6">
                            <span class="text-dark" style="width: 150px;">Starter</span>
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill"
                            data-bs-toggle="pill" href="#tab-7">
                            <span class="text-dark" style="width: 150px;">Main Course</span>
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill"
                            data-bs-toggle="pill" href="#tab-8">
                            <span class="text-dark" style="width: 150px;">Drinks</span>
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill"
                            data-bs-toggle="pill" href="#tab-9">
                            <span class="text-dark" style="width: 150px;">Offers</span>
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill"
                            data-bs-toggle="pill" href="#tab-10">
                            <span class="text-dark" style="width: 150px;">Our Spesial</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-6" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-6 wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-01.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Paneer</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 wow  animate__animated animate__bounceInUp" data-wow-delay="0.2s">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-02.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Sweet Potato</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 wow  animate__animated animate__bounceInUp" data-wow-delay="0.3s">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-03.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Sabudana Tikki</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 wow  animate__animated animate__bounceInUp" data-wow-delay="0.4s">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-04.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Pizza</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 wow  animate__animated animate__bounceInUp" data-wow-delay="0.5s">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-05.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Bacon</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 wow  animate__animated animate__bounceInUp" data-wow-delay="0.6s">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-06.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Chicken</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 wow  animate__animated animate__bounceInUp" data-wow-delay="0.7s">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-07.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Blooming</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 wow  animate__animated animate__bounceInUp" data-wow-delay="0.8s">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-08.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Sweet</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-7" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-01.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Argentinian</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-03.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Crispy</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-05.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Sabudana Tikki</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-07.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Blooming</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-08.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Argentinian</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-03.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Lemon</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-02.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Water Drink</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-01.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Salty lemon</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-8" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-01.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Crispy water</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-02.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Juice</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-03.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Orange</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-04.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Apple Juice</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-05.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Banana</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-06.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Sweet Water</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-07.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Hot Coffee</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-08.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Sweet Potato</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-9" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-06.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Sabudana Tikki</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-07.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Crispy</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-09.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Pizza</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-02.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Bacon</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-03.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Chicken</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-05.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Blooming</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-07.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Sweet</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-09.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Argentinian</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-10" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-06.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Sabudana Tikki</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-07.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Crispy</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-09.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Pizza</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-02.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Bacon</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-03.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Chicken</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-05.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Blooming</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-07.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Sweet</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu-item d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded-circle" src="{{asset('/')}}VictoryWeb/img/menu-09.jpg"
                                        alt="">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <div
                                            class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                            <h4>Argentinian</h4>
                                            <h4 class="text-primary">$90</h4>
                                        </div>
                                        <p class="mb-0">Consectetur adipiscing elit sed dwso eiusmod tempor
                                            incididunt
                                            ut labore.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu End -->


    <!-- Book Us Start -->
    <div class="container-fluid contact py-6 wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-0">
                <div class="col-1">
                    <img src="{{asset('/')}}VictoryWeb/img/background-site.jpg" class="img-fluid h-100 w-100 rounded-start"
                        style="object-fit: cover; opacity: 0.7;" alt="">
                </div>
                <div class="col-10">
                    <div class="border-bottom border-top border-primary bg-light py-5 px-4">
                        <div class="text-center">
                            <small
                                class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Book
                                Us</small>
                            <h1 class="display-5 mb-5">Where you want Our Services</h1>
                        </div>
                        <div class="row g-4 form">
                            <div class="col-lg-4 col-md-6">
                                <select class="form-select border-primary p-2" aria-label="Default select example">
                                    <option selected>Select Country</option>
                                    <option value="1">USA</option>
                                    <option value="2">UK</option>
                                    <option value="3">India</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <select class="form-select border-primary p-2" aria-label="Default select example">
                                    <option selected>Select City</option>
                                    <option value="1">Depend On Country</option>
                                    <option value="2">UK</option>
                                    <option value="3">India</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <select class="form-select border-primary p-2" aria-label="Default select example">
                                    <option selected>Select Palace</option>
                                    <option value="1">Depend On Country</option>
                                    <option value="2">UK</option>
                                    <option value="3">India</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <select class="form-select border-primary p-2" aria-label="Default select example">
                                    <option selected>Small Event</option>
                                    <option value="1">Event Type</option>
                                    <option value="2">Big Event</option>
                                    <option value="3">Small Event</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <select class="form-select border-primary p-2" aria-label="Default select example">
                                    <option selected>No. Of Palace</option>
                                    <option value="1">100-200</option>
                                    <option value="2">300-400</option>
                                    <option value="3">500-600</option>
                                    <option value="4">700-800</option>
                                    <option value="5">900-1000</option>
                                    <option value="6">1000+</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <select class="form-select border-primary p-2" aria-label="Default select example">
                                    <option selected>Vegetarian</option>
                                    <option value="1">Vegetarian</option>
                                    <option value="2">Non Vegetarian</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="mobile" class="form-control border-primary p-2"
                                    placeholder="Your Contact No.">
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="date" class="form-control border-primary p-2"
                                    placeholder="Select Date">
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="email" class="form-control border-primary p-2"
                                    placeholder="Enter Your Email">
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary px-5 py-3 rounded-pill">Submit
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <img src="{{asset('/')}}VictoryWeb/img/background-site.jpg" class="img-fluid h-100 w-100 rounded-end"
                        style="object-fit: cover; opacity: 0.7;" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Book Us End -->


    <!-- Team Start -->
    <div class="container-fluid team py-6">
        <div class="container">
            <div class="text-center wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                <small
                    class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our
                    Team</small>
                <h1 class="display-5 mb-5">We have experienced chef Team</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                    <div class="team-item rounded">
                        <img class="img-fluid rounded-top " src="{{asset('/')}}VictoryWeb/img/team-1.jpg" alt="">
                        <div class="team-content text-center py-3 bg-dark rounded-bottom">
                            <h4 class="text-primary">Henry</h4>
                            <p class="text-white mb-0">Decoration Chef</p>
                        </div>
                        <div class="team-icon d-flex flex-column justify-content-center m-4">
                            <a class="share btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fas fa-share-alt"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow  animate__animated animate__bounceInUp" data-wow-delay="0.3s">
                    <div class="team-item rounded">
                        <img class="img-fluid rounded-top " src="{{asset('/')}}VictoryWeb/img/team-2.jpg" alt="">
                        <div class="team-content text-center py-3 bg-dark rounded-bottom">
                            <h4 class="text-primary">Jemes Born</h4>
                            <p class="text-white mb-0">Executive Chef</p>
                        </div>
                        <div class="team-icon d-flex flex-column justify-content-center m-4">
                            <a class="share btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fas fa-share-alt"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow  animate__animated animate__bounceInUp" data-wow-delay="0.5s">
                    <div class="team-item rounded">
                        <img class="img-fluid rounded-top " src="{{asset('/')}}VictoryWeb/img/team-3.jpg" alt="">
                        <div class="team-content text-center py-3 bg-dark rounded-bottom">
                            <h4 class="text-primary">Martin Hill</h4>
                            <p class="text-white mb-0">Kitchen Porter</p>
                        </div>
                        <div class="team-icon d-flex flex-column justify-content-center m-4">
                            <a class="share btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fas fa-share-alt"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow  animate__animated animate__bounceInUp" data-wow-delay="0.7s">
                    <div class="team-item rounded">
                        <img class="img-fluid rounded-top " src="{{asset('/')}}VictoryWeb/img/team-4.jpg" alt="">
                        <div class="team-content text-center py-3 bg-dark rounded-bottom">
                            <h4 class="text-primary">Adam Smith</h4>
                            <p class="text-white mb-0">Head Chef</p>
                        </div>
                        <div class="team-icon d-flex flex-column justify-content-center m-4">
                            <a class="share btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fas fa-share-alt"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-6">
        <div class="container">
            <div class="text-center wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                <small
                    class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Testimonial</small>
                <h1 class="display-5 mb-5">What Our Customers says!</h1>
            </div>
            <div class="owl-carousel owl-theme testimonial-carousel testimonial-carousel-1 mb-4 wow tada"
                data-wow-delay="0.1s">
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="{{asset('/')}}VictoryWeb/img/testimonial-1.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
                        <div class="position-absolute" style="top: 15px; right: 20px;">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore et
                            dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="{{asset('/')}}VictoryWeb/img/testimonial-2.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
                        <div class="position-absolute" style="top: 15px; right: 20px;">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore et
                            dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="{{asset('/')}}VictoryWeb/img/testimonial-3.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
                        <div class="position-absolute" style="top: 15px; right: 20px;">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore et
                            dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="{{asset('/')}}VictoryWeb/img/testimonial-4.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
                        <div class="position-absolute" style="top: 15px; right: 20px;">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore et
                            dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div class="owl-carousel testimonial-carousel testimonial-carousel-2 wow tada" data-wow-delay="0.3s">
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="{{asset('/')}}VictoryWeb/img/testimonial-1.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
                        <div class="position-absolute" style="top: 15px; right: 20px;">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore et
                            dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="{{asset('/')}}VictoryWeb/img/testimonial-2.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
                        <div class="position-absolute" style="top: 15px; right: 20px;">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore et
                            dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="{{asset('/')}}VictoryWeb/img/testimonial-3.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
                        <div class="position-absolute" style="top: 15px; right: 20px;">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore et
                            dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="{{asset('/')}}VictoryWeb/img/testimonial-4.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
                        <div class="position-absolute" style="top: 15px; right: 20px;">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore et
                            dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Blog Start -->
    <div class="container-fluid blog py-6">
        <div class="container">
            <div class="text-center wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                <small
                    class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our
                    Blog</small>
                <h1 class="display-5 mb-5">Be First Who Read News</h1>
            </div>
            <div class="row gx-4 justify-content-center">
                <div class="col-md-6 col-lg-4 wow  animate__animated animate__bounceInUp" data-wow-delay="0.1s">
                    <div class="blog-item">
                        <div class="overflow-hidden rounded">
                            <img src="{{asset('/')}}VictoryWeb/img/blog-1.jpg" class="img-fluid w-100" alt="">
                        </div>
                        <div class="blog-content mx-4 d-flex rounded bg-light">
                            <div class="text-dark bg-primary rounded-start">
                                <div class="h-100 p-3 d-flex flex-column justify-content-center text-center">
                                    <p class="fw-bold mb-0">16</p>
                                    <p class="fw-bold mb-0">Sep</p>
                                </div>
                            </div>
                            <a href="#" class="h5 lh-base my-auto h-100 p-3">How to get more test in your food
                                from</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow  animate__animated animate__bounceInUp" data-wow-delay="0.3s">
                    <div class="blog-item">
                        <div class="overflow-hidden rounded">
                            <img src="{{asset('/')}}VictoryWeb/img/blog-2.jpg" class="img-fluid w-100" alt="">
                        </div>
                        <div class="blog-content mx-4 d-flex rounded bg-light">
                            <div class="text-dark bg-primary rounded-start">
                                <div class="h-100 p-3 d-flex flex-column justify-content-center text-center">
                                    <p class="fw-bold mb-0">16</p>
                                    <p class="fw-bold mb-0">Sep</p>
                                </div>
                            </div>
                            <a href="#" class="h5 lh-base my-auto h-100 p-3">How to get more test in your food
                                from</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow  animate__animated animate__bounceInUp" data-wow-delay="0.5s">
                    <div class="blog-item">
                        <div class="overflow-hidden rounded">
                            <img src="{{asset('/')}}VictoryWeb/img/blog-3.jpg" class="img-fluid w-100" alt="">
                        </div>
                        <div class="blog-content mx-4 d-flex rounded bg-light">
                            <div class="text-dark bg-primary rounded-start">
                                <div class="h-100 p-3 d-flex flex-column justify-content-center text-center">
                                    <p class="fw-bold mb-0">16</p>
                                    <p class="fw-bold mb-0">Sep</p>
                                </div>
                            </div>
                            <a href="#" class="h5 lh-base my-auto h-100 p-3">How to get more test in your food
                                from</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->
</div>

@endsection



@section('script')
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- wow.min.js: hiệu ứng khi cuộn tương tự như aos, nhưng aos đơn giản dễ sử dụng và wow js sẽ phụ thuộc nhiều vào Animate.css , config trong main.js -->
    <script src="{{asset('/')}}VictoryWeb/lib/wow/wow.min.js"></script>

    <script src="{{asset('/')}}VictoryWeb/lib/easing/easing.min.js"></script>

    <!-- waypoints.min.js: hiệu ứng được cài đặt khi kéo lên xuống trong trang, tại mỗi vị trí 1 nào đó hiệu ứng được quy định sẽ được chạy , config trong main.js -->
    <script src="{{asset('/')}}VictoryWeb/lib/waypoints/waypoints.min.js"></script>

    <!-- counterup.min.js: hiệu ứng số đếm tăng dần trong js, config trong main.js -->
    <script src="{{asset('/')}}VictoryWeb/lib/counterup/counterup.min.js"></script>

    <!-- lightbox.min.js: hiệu ứng ui liên quan đến chỉnh và xem các image trong web , config trong main.js -->
    <script src="{{asset('/')}}VictoryWeb/lib/lightbox/js/lightbox.min.js"></script>

    <!-- owl.carousel.min.js: hiệu ứng slide bar nằm ngang, config trong main.js -->
    <script src="{{asset('/')}}VictoryWeb/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{asset('/')}}VictoryWeb/js/main.js"></script>

    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

@endsection