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
            -webkit-line-clamp: 2;
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
            border-radius: 10px 300px 300px 10px;
        }

        .searchBar {
            box-shadow: 0 0 45px rgba(240, 198, 9, 0.596);

        }


        .testimonial-item {
            height: 350px;
        }
        svg {
        width: 50px;
        /* Điều chỉnh chiều rộng của SVG */
        height: 50px;
        /* Điều chỉnh chiều cao của SVG */
    }
    .link-list nav{
        display: flex;
        flex-direction: column;
        align-items: center;
    } 
    .link-list .flex-1{
        display: none;
    }
    .link-list p{
        display: none;
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
                <div class="col-lg-7 ps-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100 w-100">
                        <img class="position-absolute img-fluid w-100 h-100 " src="{{ asset('/') }}AdminLte/dist/img/mountainBanner.gif"
                            alt="">
                    </div>
                </div>
                <div class="col-lg-5 about-text py-5 wow fadeIn align-items-center" data-wow-delay="0.5s">
                    <div class="py-lg-5 px-lg-2 pe-lg-0 d-flex flex-column align-items-center justify-content-around">
                        <div class="section-title text-start">
                            <h1 class="display-5 mb-4 fs-3 text-center px-2">"Remember that your path to the summit will
                                never be
                                reached if you don’t start taking your first steps."</h1>
                        </div>
                        <div class="row g-4 mb-4 pb-2">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex flex-shrink-0 align-items-center justify-content-center bg-white"
                                        style="width: 60px; height: 60px;">
                                        <i class=" fa fa-solid fa-mountain-sun fa-2x text-primary"></i>
                                        {{-- <i class=" fa-users "></i> --}}
                                    </div>
                                    <div class="ms-3">
                                        <h2 class="text-primary mb-1" data-toggle="counter-up">{{$mountainsCount}}</h2>
                                        <p class="fw-medium mb-0">Mountains</p>
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
                                        <h2 class="text-primary mb-1" data-toggle="counter-up">{{$mountainAlllike}}</h2>
                                        <p class="fw-medium mb-0">Favorites</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#mountain-list" class="scrollButton btn btn-primary text-light py-3 px-5">Explore More</a>
                    </div>
                </div>
            </div>

        </div>
        <!-- About End -->


        <!-- About Satrt -->
        <div class="container-fluid  ">

            <div id="mountain-list" class="row g-5 align-items-top justify-content-around">
                <div class=" d-flex justify-content-center  col-lg-3  animate__animated animate__fadeInLeft d-flex align-items-top overflow-hidden"
                    data-wow-delay="0.1s">



                    <!-- mon edit   -->
                    <nav class="searchBar mt-2 border border-5 border-primary w-75 rounded " id="custom" style="min-height: 600px">
                        <ul class="nav nav-pills nav-sidebar flex-column mt-1 w-100 " id="scroll"
                            data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item overflow-hidden menu-open  ">
                                <a href="#"
                                    class="click border border-2 border-dark mx-2 dropdown-button nav-link rounded-end bg-warning py-2 d-flex align-items-center justify-content-center">
                                    <span class="mx-2 text-light">
                                        <i class="fa-solid fa-globe"></i>
                                        <span class="hidden-lg">Locations</span>
                                        <i class=" dropdown-icon fa-solid fa-chevron-down"></i>
                                    </span>


                                </a>
                                <ul class="nav nav-treeview btn-group-vertical locationList "
                                    style="height: 550px; overflow-y:auto; overflow-x:hidden">

                                    @foreach ($countryList as $country)
                                        <li class="nav-item px-2 py-1" role="group"
                                            aria-label="Basic checkbox toggle button group">


                                            <input type="checkbox" class="btn-check w-100 location-search"
                                                id="location{{ $country->id }}" name='countryFilter[]'
                                                autocomplete="off" value="{{ $country->id }}">
                                            <label class="btn btn-outline-primary w-100 "
                                                for="location{{ $country->id }}">{{ $country->name }}</label>

                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </nav>



                </div>
                <div class=" col-lg-9   animate__animated animate__fadeInUp">
                    <div class="container mt-3">
                        <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
                            <small
                                class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Mountains</small>
                            <h1 class="display-5 mb-5">Find a place to start your journey</h1>
                        </div>
                        <div class="row gx-4 justify-content-center mountain-list">
                            @foreach ($mountainList as $mountain)
                                <div class="col-md-6 col-lg-6 wow bounceInUp" data-wow-delay="0.1s">
                                    <div class="blog-item">
                                        <div class="overflow-hidden rounded">
                                            <img src="{{ asset('/') }}img/mountains/{{ $mountain->id }}/{{ $mountain->photo_main }}"
                                                class="img-fluid w-100" alt="">
                                        </div>
                                        <div class="blog-content mx-4 d-flex rounded bg-light">
                                            <div class="text-dark bg-primary rounded-start overflow-auto">
                                                <div
                                                    class="h-100 p-3 d-flex flex-column justify-content-center text-center">

                                                    <i class="fa-solid fa-mountain"></i>
                                                </div>
                                            </div>
                                            <a href="{{ url('/mountains/detail?id=' . $mountain->id) }}"
                                                class="h5 lh-base my-auto h-100 p-3 fs-5">{{ $mountain->name }}</a>
                                        </div>
                                        @if (session()->has('user'))
                                            
                                            @if ($mountainLikeList->contains('mountain_id', $mountain->id) == true)
                                                <i class="fa-solid heart-icon fa-heart">
                                                    <input type="hidden" class="mountain-id"
                                                        value="{{ $mountain->id }}">
                                                </i>
                                            @else
                                                <i class="fa-regular heart-icon fa-heart">
                                                    <input type="hidden" class="mountain-id"
                                                        value="{{ $mountain->id }}">
                                                </i>
                                            @endif
                                        @else
                                            <i class="fa-regular heart-icon fa-heart">
                                                <input type="hidden" class="mountain-id" value="{{ $mountain->id }}">
                                            </i>
                                        @endif

                                    </div>
                                </div>
                            @endforeach
                            
                            

                        </div>
                        <div class="link-list">
                            {{ $mountainList->links()}} 
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- About End -->

        <!-- Testimonial Start -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="text-center">
                    <small
                        class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Blogs</small>
                    <h1 class="mb-5">Articles you can refer to</h1>
                </div>
                <div class="owl-carousel testimonial-carousel position-relative">
                    @foreach ($articleList as $article)
                        <div class="testimonial-item text-center rounded wow  animate__animated animate__bounceInRight h-100"
                            data-wow-delay="0.1s">

                            @if (
                                $article->photo == null ||
                                    $article->photo == '' ||
                                    !File::exists(public_path('img/articles/' . $article->id . '/' . $article->photo)))
                                <img class="bg-light rounded p-0  p-2 mx-auto "
                                    src="{{ asset('/img/articles/unknown.png') }}" style="width: 100%; height: 200px">
                            @else
                                <img class="bg-light rounded p-0  p-2 mx-auto mb-1"
                                    src="{{ asset('/img/articles/' . $article->id . '/' . $article->photo) }}"
                                    style="width: 100%; height: 200px">
                            @endif


                            <div class="testimonial-text bg-light text-center p-4">
                                <a href="{{ url('/blogs/detail?id=' . $article->id) }}">
                                    <h6 class="mb-0 truncate-text1">{{$article->name}}</h6>
                                </a>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
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
                    $('.dropdown-button').click();


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
                                .append($('<a class="showmore "><li class="expand mx-3 fw-bold text-dark">' + (
                                        isExpanded ? '  Show Less' : '  Show More') + '</li></a>')
                                    .click(function(event) {
                                        var isExpanded = $ul.hasClass('expanded');
                                        event.preventDefault();
                                        var html =
                                            '<a class="showmore "><li class="expand mx-3 fw-bold text-dark">' +
                                            (isExpanded ? '  Show Less' : '  Show More') + '</li></a>'
                                        $(this).html(isExpanded ?
                                            '<a class="showmore "><li class="expand mx-3 fw-bold text-dark">' +
                                            'Show More' + '</li></a>' :
                                            '<a class="showmore "><li class="expand mx-3 fw-bold text-dark">' +
                                            'Show Less' + '</li></a>');
                                        $ul.toggleClass('expanded');
                                        $lis.toggle();
                                    }));
                        }
                    });
                    $('.heart-icon').on('mouseleave', function() {
                        $(this).css({
                            "transition": "0.3s"
                        }, {
                            "font-size": "40px"
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

                                    url: "{{ route('addMountain') }}",
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
                                    url: "{{ route('addMountain') }}",
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
  /////////////////////////////////////
                    $('.location-search').change(function() {
                        
                            var checkedLocations = [];
                            $('.location-search:checked').each(function() {
                                checkedLocations.push($(this).val());

                            });
                            //alert(checkedLocations)
                            // Gửi mảng checkedLocations qua Ajax
                            $.ajax({
                                    type: 'GET',
                                    url: "{{ route('searchMountain') }}",
                                    data: {
                                        checkedLocations: checkedLocations
                                    },
                                    success: function(data) {
                                        $('.mountain-list').empty();
                                        
            // Duyệt qua mảng mountainList và tạo HTML tương ứng
            $.each(data.mountainList, function(index, mountain) {
                var html = '';
                html += '<div class="col-md-6 col-lg-6 wow bounceInUp" data-wow-delay="0.1s">';
                html += '    <div class="blog-item">';
                html += '        <div class="overflow-hidden rounded">';
                html += '            <img src="/img/mountains/' + mountain.id + '/' + mountain.photo_main + '" class="img-fluid w-100" alt="">';
                html += '        </div>';
                html += '        <div class="blog-content mx-4 d-flex rounded bg-light">';
                html += '            <div class="text-dark bg-primary rounded-start overflow-auto">';
                html += '                <div class="h-100 p-3 d-flex flex-column justify-content-center text-center">';
                html += '                    <i class="fa-solid fa-mountain"></i>';
                html += '                </div>';
                html += '            </div>';
                html += '            <a href="/mountains/detail?id=' + mountain.id + '" class="h5 lh-base my-auto h-100 p-3 fs-5">' + mountain.name + '</a>';
                html += '        </div>';
                var mountainLikeList=data.mountainLikeList

                if ({!! json_encode(session()->has('user')) !!}) {

                    var check=false;
                    mountainLikeList.every(element => {
                        if(element.mountain_id === mountain.id){
                            // check=true;
                            // break;
                            //alert('true');
                            html += '        <i class="fa-solid heart-icon fa-heart">  <input type="hidden" class="mountain-id" value="'+mountain.id+'">    </i>    ';
                            check=true;
                            return false;
                        }
                        return true;
                    });
                    if(check==false){
                         html += '        <i class="fa-regular heart-icon fa-heart"> <input type="hidden" class="mountain-id" value="'+mountain.id+'">    </i> ';

                     }

} else {
    html += '        <i class="fa-regular heart-icon fa-heart"> <input type="hidden" class="mountain-id" value="'+mountain.id+'">    </i> ';
}
                html += '            <input type="hidden" class="mountain-id" value="' + mountain.id + '">';
                html += '        </i>';
                html += '    </div>';
                html += '</div>';


                // Thêm HTML vào .mountain-list
                $('.mountain-list').append(html);


            });
            setTimeout(function() {
                    $('.heart-icon').on('mouseleave', function() {
                        $(this).css({
                            "transition": "0.3s"
                        }, {
                            "font-size": "40px"
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

                                    url: "{{ route('addMountain') }}",
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
                                    url: "{{ route('addMountain') }}",
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
                        }, 40);
                                                

                                            },
                                            error: function(xhr, status, error) {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Action Failed !'
                                                });
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
