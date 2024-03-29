<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Victory</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('VictoryWeb')}}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{asset('VictoryWeb')}}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="{{asset('VictoryWeb')}}/lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('VictoryWeb')}}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('VictoryWeb')}}/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar start -->
    <div class="container-fluid nav-bar">
        <div class="container">
            <nav class="navbar navbar-light navbar-expand-lg py-4">
                <a href="{{url('/home')}}" class="navbar-brand">
                    <h1 class="text-primary fw-bold mb-0">Vic<span class="text-dark">Tory</span> </h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{url('/home')}}" class="nav-item nav-link">Home</a>
                        <a href="{{url('/mountain')}}" class="nav-item nav-link">Mountains</a>
                        <a href="{{url('/organization')}}" class="nav-item nav-link">Organizations</a>
                        <a href="{{url('/article')}}" class="nav-item nav-link">Blogs</a>
                        <a href="{{url('/aboutus')}}" class="nav-item nav-link">About us</a>
                    </div>
                    <a href="{{url('/login')}}" class="btn btn-primary btn-md-square me-4 rounded-circle d-none d-lg-inline-flex"><i class="bi bi-person-circle" style="font-size: 1.5rem;"></i></a>
                    <a href="{{url('/signin')}}" class="btn btn-primary py-2 px-4 d-none d-xl-inline-block rounded-pill">Join Now</a>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid footer py-6 my-6 mb-0 bg-light wow bounceInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="footer-item">
                        <h1 class="text-primary">Vic<span class="text-dark">Tory</span></h1>
                        <p class="lh-lg mb-4">A passionate mountaineering group, united by camaraderie, pushing boundaries, and achieving peak triumphs.</p>
                        
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6">
                    <div class="footer-item">
                        <h4 class="mb-4">Contact Us</h4>
                        <div class="d-flex flex-column align-items-start">
                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i> 123 Street, Ho Chi Minh, VN</p>
                            <p><i class="fa fa-phone-alt text-primary me-2"></i> (+84) 123 456 789</p>
                            <p><i class="fas fa-envelope text-primary me-2"></i> info@example.com</p>
                            <p><i class="fa fa-clock text-primary me-2"></i> 24/7 Hours Service</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6" >
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.060360134898!2d106.70941319678954!3d10.8066891!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529ed00409f09%3A0x11f7708a5c77d777!2zQXB0ZWNoIENvbXB1dGVyIEVkdWNhdGlvbiAtIEjhu4cgVGjhu5FuZyDEkMOgbyB04bqhbyBM4bqtcCBUcsOsbmggVmnDqm4gUXXhu5FjIHThur8gQXB0ZWNo!5e0!3m2!1sen!2s!4v1709195018572!5m2!1sen!2s" width="600" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Victory
                            Group</a>, All right reserved.</span>
                </div>

            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-md-square btn-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- wow.min.js: hiệu ứng khi cuộn tương tự như aos, nhưng aos đơn giản dễ sử dụng và wow js sẽ phụ thuộc nhiều vào Animate.css , config trong main.js -->
    <script src="{{asset('VictoryWeb')}}/lib/wow/wow.min.js"></script>

    <script src="{{asset('VictoryWeb')}}/lib/easing/easing.min.js"></script>

    <!-- waypoints.min.js: hiệu ứng được cài đặt khi kéo lên xuống trong trang, tại mỗi vị trí 1 nào đó hiệu ứng được quy định sẽ được chạy , config trong main.js -->
    <script src="{{asset('VictoryWeb')}}/lib/waypoints/waypoints.min.js"></script>

    <!-- counterup.min.js: hiệu ứng số đếm tăng dần trong js, config trong main.js -->
    <script src="{{asset('VictoryWeb')}}/lib/counterup/counterup.min.js"></script>

    <!-- lightbox.min.js: hiệu ứng ui liên quan đến chỉnh và xem các image trong web , config trong main.js -->
    <script src="{{asset('VictoryWeb')}}/lib/lightbox/js/lightbox.min.js"></script>

    <!-- owl.carousel.min.js: hiệu ứng slide bar nằm ngang, config trong main.js -->
    <script src="{{asset('VictoryWeb')}}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{asset('VictoryWeb')}}/js/main.js"></script>
</body>

</html>