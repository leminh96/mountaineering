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
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 5;
            /* Số dòng tối đa muốn hiển thị cho tin tức chính*/
            -webkit-box-orient: vertical;
        }

        .truncate-text img,
        .truncate-text1 img,
        .truncate-text3 img,
        .truncate-text figure,
        .truncate-text1 figure,
        .truncate-text3 figure,
        .truncate-text table,
        .truncate-text1 table,
        .truncate-text3 table,
        .truncate-text figcaption,
        .truncate-text1 figcaption,
        .truncate-text3 figcaption,
        .truncate-text .hero-container,
        .truncate-text1 .hero-container,
        .truncate-text3 .hero-container {
            display: none !important;
        }

        .truncate-text1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Số dòng tối đa muốn hiển thị cho tin tức phụ*/
            -webkit-box-orient: vertical;
        }
        .truncate-text3 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 9;
            /* Số dòng tối đa muốn hiển thị cho tin tức phụ*/
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
            height: 100%;
            width: 100%;
            /* overflow-y: scroll; */
            overflow-x: hidden;

        }

        .news-area::-webkit-scrollbar {
            display: none;
            /* Safari and Chrome */
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


        <!--News start-->
        <div class="container-fluid blog py-3 w-100 h-100 bg-light">
            <div class="text-center d-flex flex-column align-items-center wow bounceInUp" data-wow-delay="0.1s">
                <small
                    class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Blogs</small>
                <h1 class="display-5 mb-5">Featured News</h1>
                <ul class="nav w-75 d-flex justify-content-around  btn-group " data-wow-delay="0.1s">
                    @foreach ($categoryList as $category)
                        <li class="nav-item px-2 py-1 " role="group" style="width:200px"
                            aria-label="Basic checkbox toggle button group ">


                            <input type="checkbox" class="btn-check w-100 category-search" value="{{ $category->id }}"
                                id="{{ $category->id }}" autocomplete="off">
                            <label class="btn btn-outline-primary w-100"
                                for="{{ $category->id }}">{{ $category->name }}</label>

                        </li>
                    @endforeach
                </ul>
            </div>
            <div class=" news-area mt-5 ">

                <div class="row h-100 p-3 ">

                    <div class="article-list">

                    </div>






                    <div class="col-lg-9 d-flex flex-column justify-content-between h-100 border-end">
                        <!-- 1 Tin chính, lấy cái mới nhất theo id-->


                        <div class="card  wow bounceInUp w-100  d-flex align-items-center" data-wow-delay="0.2s">
                            <div class="row d-flex align-items-center">
                                <div class=" col-lg-5 d-flex align-items-center justify-content-center h-100">
                                    @if (
                                        $articleFirst->photo == null ||
                                            $articleFirst->photo == '' ||
                                            !File::exists(public_path('img/articles/' . $articleFirst->id . '/' . $articleFirst->photo)))
                                        <img src="{{ asset('/img/articles/unknown.png') }}" class="img-fluid rounded h-100"
                                            alt="">
                                    @else
                                        <img src="{{ asset('/img/articles/' . $articleFirst->id . '/' . $articleFirst->photo) }}"
                                            class="img-fluid rounded h-100" alt="">
                                    @endif

                                </div>
                                <div class=" col-lg-7 h-100">
                                    <div class="card-body h-100">
                                        <h5 class="card-title"><a
                                                href="{{ url('/blogs/detail?id=' . $articleFirst->id) }}">{{ $articleFirst->name }}</a>
                                        </h5>
                                        <span class="card-text truncate-text3 text-secondary">
                                            {!! html_entity_decode($articleFirst->description) !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card overflow-hidden wow bounceInUp w-100  d-flex flex-column justify-content-center my-4"
                            style="height:49%" data-wow-delay="0.2s">
                            <div class="row  ">
                                <span class="pt-2 w-100 text-center fw-bold">Newest News</span>
                                @foreach ($articleSecond as $article)
                                    <div class="col-lg-4 mt-2   border-end  bg-gray" style="height: 250px">
                                        <div class="card-body  h-100 overflow-hidden">

                                            <h5 class="card-title"><a
                                                    href="{{ url('/blogs/detail?id=' . $article->id) }}">{{ $article->name }}</a>
                                            </h5>
                                            <span class="card-text truncate-text text-secondary">{!! html_entity_decode($article->description) !!}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3  secondary-news   wow bounceInUp" data-wow-delay="0.3s">
                        <!-- 3 Tin phụ, controller skip (1) take(3) theo id mới nhất-->
                        <div class="mt-0">
                            <span class="pt-2 fw-bold">Guides</span>
                            @foreach ($articleGuides as $article)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h5 class="card-title truncate-text1 "><a
                                                href="{{ url('/blogs/detail?id=' . $article->id) }}">{{ $article->name }}</a>
                                        </h5>
                                        <span class="card-text truncate-text1">
                                            {!! html_entity_decode($article->description) !!}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            <span class="pt-2 fw-bold">Style</span>
                            @foreach ($articleStyle as $article)
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
                        <div class="mt-3">
                            <span class="pt-2 fw-bold">History</span>
                            @foreach ($articleHistory as $article)
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
                        <div class="mt-3">
                            <span class="pt-2 fw-bold">Sheltering</span>
                            @foreach ($articleSheltering as $article)
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
                        <div class="mt-3">
                            <span class="pt-2 fw-bold">Dangers</span>
                            @foreach ($articleDangers as $article)
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

            </div>

        </div>
        <!--News end-->



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





            $('.category-search').change(function() {

                var checkedLocations = [];
                $('.category-search:checked').each(function() {
                    checkedLocations.push($(this).val());
                    //alert($(this).val());

                });

                // Gửi mảng checkedLocations qua Ajax
                $.ajax({
                    type: 'GET',
                    url: "{{ route('searchArticle') }}",
                    data: {
                        checkedLocations: checkedLocations
                    },
                    success: function(data) {
                        $('.article-list').empty();
                        //alert(data.articleList)
                        // Duyệt qua mảng mountainList và tạo HTML tương ứng
                        $.each(data.articleList, function(index, article) {
                            //alert(article.id)

                            var imageUrl = article.photo ?
                                '{{ asset('/img/articles/') }}/' + article.id + '/' +
                                article.photo :
                                '{{ asset('/img/articles/unknown.png') }}';

                            var html = '';

                            // Construct the HTML for each article

                            html += '<div class="card mb-4 overflow-hidden">';
                            html += '    <div class="row blog-item">';
                            html +=
                                '        <div class="col-lg-3 overflow-hidden d-flex align-items-center">';
                            html += '            <img src="' + imageUrl +
                                '" class="img-thumnail" width="100%" height="100%">';
                            html += '        </div>';
                            html += '        <div class="col-lg-9">';
                            html +=
                                '            <div class="card-body overflow-hidden">';
                            html +=
                                '                <h5 class="card-title truncate-text1"><a href="{{ url('/blogs/detail?id=') }}' +
                                article.id + '">' + article.name + '</a></h5>';
                            html +=
                                '                <span class="card-text truncate-text">' +
                                article.description + '</span>';
                            html += '            </div>';
                            html += '        </div>';
                            html += '    </div>';
                            html += '</div>';

                            // Thêm HTML vào .mountain-list
                            $('.article-list').append(html);


                        });

                        // Swal.fire({
                        //     icon: 'success',
                        //     title: 'Removed from favorite list',
                        //     text: 'View your list in account detail'
                        // });



                    },
                    error: function(xhr, status, error) {

                        var err = eval("(" + xhr.responseText + ")");
                        alert(xhr.responseText)
                        Swal.fire({
                            icon: 'error',
                            title: xhr.responseText
                        });

                    }

                });
            });
        })
    </script>
@endsection
