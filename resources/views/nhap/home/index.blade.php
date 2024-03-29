@extends('nhap.layout.user')

@section('content')
<!--Mountain start-->
<div class="container-fluid bg-light py-6 my-6 mt-0 l-section-video" id="us_bg_video_qca5">
    <video muted loop autoplay playsinline preload="auto">
        <source type="video/mp4" src="https://www.theuiaa.org/wp-content/uploads/2024/01/Mini-Reel-15.mp4" />
    </video>
    <div class="container">
        <div class="row g-5 justify-content-center align-items-center">
            <div class="col-lg-7 col-md-12">
                <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-4 animated bounceInDown">Welcome to Mountaineering Adventures</small>
                <h1 class="display-1 mb-4 animated bounceInDown">Let<span class="text-primary">'s </span>begin the journey.</h1>
                <a href="{{url('/mountain')}}" class="btn btn-primary border-0 rounded-pill py-3 px-4 px-md-5 me-4 animated bounceInLeft">Start Now</a>
            </div>
        </div>
    </div>
</div>
<!--Mountain end-->

<!--About start-->
<div class="container-fluid py-6">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 wow bounceInUp" data-wow-delay="0.1s">
                <img src="{{asset('user/img/mountains/1/1.jpg')}}" class="img-fluid rounded" alt="">
            </div>
            <div class="col-lg-7 wow bounceInUp " data-wow-delay="0.3s">
                <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">About Us</small>
                <h1 class="display-5 mb-4">Mountaineering Adventures</h1>
                <p class="mb-4">Welcome to Mountaineering Adventures, your ultimate destination for exploring the world's highest peaks and experiencing thrilling adventures.</p>
                <p class="mb-4">At Mountaineering Adventures, we are passionate about connecting people with nature and helping them achieve their dreams of conquering majestic mountains. Whether you are an experienced climber or a novice adventurer, we offer a range of guided expeditions and customized trips tailored to your skill level and interests.</p>
                <p class="mb-4">Our team of experienced guides and outdoor enthusiasts are dedicated to providing you with a safe, memorable, and exhilarating mountain climbing experience. With our expertise and local knowledge, we ensure that every journey with us is filled with excitement, discovery, and breathtaking views.</p>
                <a href="{{url('/aboutus')}}" class="btn btn-primary py-3 px-5 rounded-pill">Read More<i class="fas fa-arrow-right ps-2"></i></a>
            </div>
        </div>
    </div>
</div>
<!--About end-->

<!--News start-->
<div class="container-fluid blog py-6">
    <div class="container">
        <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
            <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our Blog</small>
            <h1 class="display-5 mb-5">Featured News</h1>
        </div>
        <div class="row">
            <div class="col-md-9">
                <!-- 1 Tin chính, lấy cái mới nhất theo id-->
                <div class="card mb-4 wow bounceInUp" data-wow-delay="0.2s">
                    <div class="row g-0 ">
                        <div class="col-md-5 ">
                            <img src="{{asset('/img/article/'.$featuredNews->id.'/'.$featuredNews->photo)}}" class="img-fluid rounded-start w-100 h-100" alt="">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title"><a href="#">{{ $articleFirst->name }}</a></h5>
                                <p class="card-text truncate-text">{{ $articleFirst->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 wow bounceInUp" data-wow-delay="0.3s">
                <!-- 3 Tin phụ, controller skip (1) take(3) theo id mới nhất-->
                @foreach($articleSecond as $article)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title truncate-text1 "><a href="#">{{ $article->name }}</a></h5>
                        <p class="card-text truncate-text1">{{ $article->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center wow bounceInUp">
                <a href="{{ url('/article') }}" class="btn btn-primary py-3 px-5 rounded-pill">Read More<i class="fas fa-arrow-right ps-2"></i></a>
            </div>
        </div>
    </div>
</div>
<!--News end-->

<!--Review start-->
<div class="container-fluid py-6">
    <div class="container">
        <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
            <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Reviews</small>
            <h1 class="display-5 mb-5">What Our Member Says!</h1>
        </div>
        <h4 class="text-center ">About Organization</h4>  <!--Hiện ra các đánh giá sao của nhóm-->
        <div class="owl-carousel owl-theme testimonial-carousel testimonial-carousel-1 mb-4 wow tada" data-wow-delay="0.1s">
            <div class="testimonial-item rounded bg-light">

                <div class="d-flex mb-3">
                    <img src="img/testimonial-1.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
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
                    <img src="img/testimonial-2.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
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
                    <img src="img/testimonial-3.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
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
                    <img src="img/testimonial-4.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
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
        <h4 class="text-center ">About Mountains</h4> <!--Hiện ra các đánh giá sao của núi-->
        <div class="owl-carousel testimonial-carousel testimonial-carousel-2 wow tada" data-wow-delay="0.3s">
            <div class="testimonial-item rounded bg-light">
                <div class="d-flex mb-3">
                    <img src="img/testimonial-1.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
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
                    <img src="img/testimonial-2.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
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
                    <img src="img/testimonial-3.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
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
                    <img src="img/testimonial-4.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="">
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
<!--Review end-->


@endsection


<style>
    .l-section-video {
        position: relative;
        overflow: hidden;
        width: 100%;
        height: 70%; 
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
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 10;
        /* Số dòng tối đa bạn muốn hiển thị cho tin tức chính*/
        -webkit-box-orient: vertical;
    }

    .truncate-text1 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        /* Số dòng tối đa bạn muốn hiển thị cho tin tức phụ*/
        -webkit-box-orient: vertical;
    }
</style>