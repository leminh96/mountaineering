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
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 5;
            /* Số dòng tối đa muốn hiển thị cho tin tức chính*/
            -webkit-box-orient: vertical;
        }

        .truncate-text1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 5;
            /* Số dòng tối đa muốn hiển thị cho tin tức phụ*/
            -webkit-box-orient: vertical;
        }

        .truncate-text1 img {
            display: none;
        }

        .truncate-text5 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 5;
            /* Số dòng tối đa muốn hiển thị cho tin tức còn lại*/
            -webkit-box-orient: vertical;
        }

        .truncate-text5 img {
            display: none !important;
        }

        .truncate-text5 figure {
            display: none !important;
        }

        .truncate-text5 table {
            display: none !important;
        }

        .truncate-text5 figcaption {
            display: none !important;
        }

        .truncate-text5 .hero-container {
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
            height: 100%;
            width: 100%;
            /* overflow-y: scroll; */
            overflow-x: hidden;

        }

        .news-area::-webkit-scrollbar {
            display: none;
            /* Safari and Chrome */
        }

        .heart-icon1:hover {
            font-size: 50px;
            transition: 0.3s;
        }

        .heart-icon1 {

            font-size: 40px;
            color: rgb(255, 63, 63);
            text-shadow: rgb(80, 80, 80) 0.1px 0px 0px, rgb(80, 80, 80) 0.540302px 0.841471px 0px, rgb(80, 80, 80) -0.416147px 0.909297px 0px, rgb(80, 80, 80) -0.989992px 0.14112px 0px, rgb(80, 80, 80) -0.653644px -0.756802px 0px, rgb(80, 80, 80) 0.283662px -0.958924px 0px, rgb(80, 80, 80) 0.96017px -0.279416px 0px;
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

        <div class="container-fluid blog py-5">
            <div class="container">

                <div class="  animate__animated animate__zoomInLeft rounded p-3 bg-white "
                    style="box-shadow: 0 0 60px rgba(44, 44, 44, 0.692);">
                    <small
                        class=" text-center d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Blog,
                        post: {{ \Carbon\Carbon::parse($article->created)->format('d/m/Y') }}
                    </small>

                    <h1 class="display-5 mb-4">{{ $article->name }} &nbsp;

                        @if (session()->has('user'))
                            @if ($articleLikeList->contains('article_id', $article->id) == true)
                                <i class="fa-solid heart-icon1 fa-heart">
                                    <input type="hidden" class="article-id" value="{{ $article->id }}">
                                </i>
                            @else
                                <i class="fa-regular heart-icon1 fa-heart">
                                    <input type="hidden" class="article-id" value="{{ $article->id }}">
                                </i>
                            @endif
                        @else
                            <i class="fa-regular heart-icon1 fa-heart">
                                <input type="hidden" class="article-id" value="{{ $article->id }}">
                            </i>
                        @endif

                        {{-- <i class="fa-regular heart-icon1 fa-heart"></i> --}}
                    </h1>
                    <div class="row g-4 text-dark mb-4">
                        @if (
                            $article->photo == null ||
                                $article->photo == '' ||
                                !File::exists(public_path('img/articles/' . $article->id . '/' . $article->photo)))
                            <img src="{{ asset('/img/articles/unknown.png') }}" class="img-thumnail" width="50%"
                                height="600px">
                        @else
                            <img src="{{ asset('/img/articles/' . $article->id . '/' . $article->photo) }}"
                                class="img-thumnail" width="100%" height="100%">
                        @endif

                    </div>


                    <span class="mb-4">
                        {!! html_entity_decode($article->description) !!}
                    </span>
                </div>


            </div>
        </div>






        <!-- Menu Start -->
        <div class="container-fluid menu bg-white py-2 my-2">
            <div class="container">
                <div class="card card-widget rounded p-3 bg-white "
                    >
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


                    </div>
                    <!-- /.card-footer -->
                    <div class="card-footer">
                        <div class="d-flex align-items-center">
                            <input type="hidden" id="comment-article-id" value="{{ $article->id }}">
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
                    </div>
                    <!-- /.card-footer -->
                </div>

            </div>
        </div>

        <!-- Menu End -->

        <div class="container-fluid  bg-white py-6 my-3">
            <div class="container">
                <div class="row border-top pt-5   rounded p-3 bg-white   animate__animated animate__zoomInUp">

                    <div class="  ">
                        <small
                            class=" text-center d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Blogs</small>
                        <h2 class="display-5 mb-4 fs-2">Related Blogs

                        </h2>

                    </div>
                    <div class="card-deck   animate__flipInX ">
                        <!-- các tin còn lại, skip(4) take(100)-->
                        @foreach ($articleRelatedList as $article)
                            <div class="card mb-4   overflow-hidden">
                                <div class="row blog-item">
                                    <div class="col-lg-3  overflow-hidden d-flex align-items-center">
                                        @if (
                                            $article->photo == null ||
                                                $article->photo == '' ||
                                                !File::exists(public_path('img/articles/' . $article->id . '/' . $article->photo)))
                                            <img src="{{ asset('/img/articles/unknown.png') }}" class="img-thumnail"
                                                width="100%" height="100%">
                                        @else
                                            <img src="{{ asset('/img/articles/' . $article->id . '/' . $article->photo) }}"
                                                class="img-thumnail" width="100%" height="100%">
                                        @endif
                                    </div>
                                    <div class="col-lg-9 ">
                                        <div class="card-body overflow-hidden">
                                            <h5 class="card-title truncate-text1"><a
                                                    href="{{ url('/blogs/detail?id=' . $article->id) }}">{{ $article->name }}</a>
                                            </h5>
                                            <span class="card-text truncate-text5">
                                                {!! html_entity_decode($article->description) !!}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

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
            $('.menu-blog').addClass('active')
            $('.dropdown-button').on('click', function() {

                if ($('.nav-item').hasClass('menu-open')) {
                    $('.dropdown-icon').removeClass('fa-chevron-down');
                    $('.dropdown-icon').addClass('fa-angle-right');
                } else {
                    $('.dropdown-icon').removeClass('fa-angle-right');
                    $('.dropdown-icon').addClass('fa-chevron-down');
                }
            })




            $('.heart-icon1').on('mouseleave', function() {
                $(this).css({
                    "transition": "0.3s"
                }, {
                    "font-size": "40px"
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

                            url: "{{ route('addArticle') }}",
                            data: {
                                articleID: $(this).find('.article-id').val(),
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
                                alert(JSON.stringify(error))
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
                            url: "{{ route('addArticle') }}",
                            data: {
                                articleID: $(this).find('.article-id').val(),
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
                                type: 'article',
                                comment_text: comment,
                                id: $('#comment-article-id').val()

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
