<!DOCTYPE html>
<html lang="en">

<head>
    @yield('head')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid nav-bar fixed-top">
        <div class="container">
            <nav class="navbar navbar-light navbar-expand-lg py-0">
                <a href="{{ url('/') }}" class="navbar-brand  py-0">
                    <img src="{{ asset('/') }}VictoryWeb/img/VICTORY2.png" class="img-fluid rounded p-0"
                        width="90px" alt="">

                    {{-- <h1 class="text-primary fw-bold m-0">Vic<span class="text-dark">Tory</span> </h1> --}}
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{ url('/home') }}" class="nav-item nav-link menu menu-home">Home</a>
                        <a href="{{ url('/mountains') }}" class="nav-item nav-link menu menu-mountain">Mountains</a>
                        <a href="{{ url('/organizations') }}"
                            class="nav-item nav-link menu menu-organization">Organizations</a>
                        <a href="{{ url('/blogs') }}" class="nav-item nav-link menu menu-blog">Blogs</a>
                        <a href="{{ url('/aboutus') }}" class="nav-item nav-link menu menu-aboutus">About us</a>

                        <a href="{{ url('/contact') }}" class="nav-item nav-link menu-contact">Contact</a>
                    </div>
                    {{-- <button class="btn-search btn btn-primary btn-md-square me-4 rounded-circle  d-lg-inline-flex"
                        data-bs-toggle="modal" data-bs-target="#searchModal"><i
                            class="fa-regular fa-user fw-bold"></i></button> --}}
                    <!--mon test-->
                    <div
                        class="btn-search btn btn-primary btn-md-square me-4 rounded-circle  d-lg-inline-flex dropdown">
                        @if (!session()->has('user'))
                            <a class="btn btn-primary btn-md-square rounded-circle d-lg-inline-flex fw-bold"
                                href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-regular fa-user fw-bold"></i>
                            </a>
                        @else
                            @php
                                $account = session()->get('user');
                            @endphp
                            <a class="rounded-circle border border-3 border-primary animate__animated animate__jello animate__infinite"
                                href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false" style="width:fit-content">


                                @if (
                                    $account->photo == null ||
                                        $account->photo == '' ||
                                        !File::exists(public_path('img/accounts/' . $account->id . '/' . $account->photo)))
                                    <img src="{{ asset('/img/accounts/unknown.png') }}" class="rounded-circle "
                                        style="width:45px !important;height:45px !important" alt="User Image">
                                @else
                                    <img src="{{ asset('/img/accounts/' . $account->id . '/' . $account->photo) }}" class="rounded-circle "
                                        style="width:45px !important;height:45px !important" alt="User Image">
                                   
                                @endif


                                {{-- <img src="{{ asset('/') }}img/accounts/{{ session()->get('user')->id }}/{{ session()->get('user')->photo }}"
                                    class="rounded-circle " style="width:45px !important;height:45px !important"
                                    alt="User Image"> --}}
                            </a>
                            <ul class="dropdown-menu " aria-labelledby="dropdownMenuLink"
                                style="left: 50%;transform: translateX(-50%);">
                                <li class="text-center"><a class="dropdown-item"
                                        href="{{ url('/account/profile') }}">View Profile</a></li>
                                <li class="text-center"><a class="dropdown-item"
                                        href="{{ url('/logout?command=logout') }}" role="button">Log Out</a></li>
                            </ul>
                        @endif
                    </div>

                    @if (!session()->has('user'))
                        <a href="{{ url('/login') }}"
                            class="btn btn-light py-2 px-4 mx-1  d-xl-inline-block rounded-pill border border-2 border-primary">Log
                            in</a>
                        <a href="{{ url('/register') }}"
                            class="btn btn-primary py-2 px-4  d-xl-inline-block rounded-pill">Register</a>
                    @endif
                    <!--end mon test-->
                    <!-- <a href="" class="btn btn-light py-2 px-4 mx-1  d-xl-inline-block rounded-pill border border-2 border-primary">Log in</a>
                <a href="" class="btn btn-primary py-2 px-4  d-xl-inline-block rounded-pill">Register</a> -->
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <div class="content-footer">
        <!-- Footer Start -->
        <div class="container-fluid footer py-4 my-6 mb-0 bg-light wow bounceInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="footer-item">
                            <h1 class="text-primary">Vic<span class="text-dark">Tory</span></h1>
                            <p class="lh-lg mb-4">A passionate mountaineering group, united by camaraderie, pushing
                                boundaries, and achieving peak triumphs.</p>

                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="footer-item">
                            <h4 class="mb-4">Contact Us</h4>
                            <div class="d-flex flex-column align-items-start">
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i> 123 Street, Ho Chi Minh, VN
                                </p>
                                <p><i class="fa fa-phone-alt text-primary me-2"></i> (+84) 123 456 789</p>
                                <p><i class="fas fa-envelope text-primary me-2"></i> info@example.com</p>
                                <p><i class="fa fa-clock text-primary me-2"></i> 24/7 Hours Service</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.060360134898!2d106.70941319678954!3d10.8066891!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529ed00409f09%3A0x11f7708a5c77d777!2zQXB0ZWNoIENvbXB1dGVyIEVkdWNhdGlvbiAtIEjhu4cgVGjhu5FuZyDEkMOgbyB04bqhbyBM4bqtcCBUcsOsbmggVmnDqm4gUXXhu5FjIHThur8gQXB0ZWNo!5e0!3m2!1sen!2s!4v1709195018572!5m2!1sen!2s"
                            width="600" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="#"><i
                                    class="fas fa-copyright text-light me-2"></i>Victory
                                Group</a>, All right reserved.</span>
                    </div>

                </div>
            </div>
        </div>
        <!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-md-square btn-primary rounded-circle back-to-top"><i
                class="fa fa-arrow-up"></i></a>

    </div>

    @yield('script')


</body>

</html>
