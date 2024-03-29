@extends('VictoryWeb.main-page.layout.mainLayout')
@section('head')
    <meta charset="utf-8">
    <title>VicTory Group - Mountaineering</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="token" content="{{ csrf_token() }}">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    {{-- <link rel="stylesheet" href="{{asset('/')}}VictoryWeb/lib/fontawesome/all.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">


    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="{{ asset('VictoryWeb') }}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="{{ asset('VictoryWeb') }}/lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('VictoryWeb') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('VictoryWeb') }}/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />

    <style>
        

        .bg-image {
            background-image: url('/VictoryWeb/login/images/bg.jpg');
            background-size: cover;
            background-position: center;
            height: 100%;
        }



        /*test màu viền form đăng ký*/

        @keyframes moving-border {
            0% {
                border-color: #FF5733;
            }

            25% {
                border-color: #FFC300;
            }

            50% {
                border-color: #DAF7A6;
            }

            75% {
                border-color: #33C1FF;
            }

            100% {
                border-color: #FF5733;
            }
        }

        .animated-border {
            animation: moving-border 4s infinite linear;
            border: 7px solid;
            /* Mặc định là màu ban đầu */
        }
    </style>
@endsection
@section('content')
    <div class="bg-image">
        <div class=" container-fluid contact py-6 wow bounceInUp w-50 h-50" data-wow-delay="0.1s">
            <div class="container">
                <div class="p-5 bg-light rounded contact-form animated-border">
                    <div class="row g-4">
                        <div class="col-12 text-center">
                            <small
                                class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3 ">Register</small>
                            <h1 class="display-5 mb-0 text-center">Join our member ship</h1>
                        </div>
                        <div><!-- class="col-md-6 col-lg-7" -->
                            <p class="mb-4 text-center">It's free and only takes a minute</p>
                            <form method="post" class="addForm" action="{{ url('/proccessRegister') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="fullname" id="fullname"
                                    class="w-100 form-control p-1 mb-4 border-primary bg-light" placeholder="Full Name">

                                <div class="mb-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                            value="male" checked>
                                        <label class="form-check-label border-primary bg-light w-100"
                                            for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                            value="female">
                                        <label class="form-check-label border-primary bg-light w-100"
                                            for="inlineRadio2">Female</label>
                                    </div>
                                </div>
                                <input type="text" id="email" name="email"
                                    class="w-100 form-control p-1 mb-4 border-primary bg-light"
                                    placeholder="Enter Your Email">
                                <input type="text" id="phone" name="phone"
                                    class="w-100 form-control p-1 mb-4 border-primary bg-light" placeholder="Phone Number">
                                <input type="date" name="dob" id="dob" data-inputmask-inputformat="dd/mm/yyyy"
                                    class="w-100 form-control p-1 mb-4 border-primary bg-light "
                                    placeholder="Date of Birth">
                                <input type="text" id="username" name="username"
                                    class="w-100 form-control p-1 mb-4 border-primary bg-light" placeholder="Username">
                                <input type="password" id="password" name="password"
                                    class="w-100 form-control p-1 mb-4 border-primary bg-light" placeholder="Password">
                                <input type="password" id="cofirmPassword" name="confirmPassword"
                                    class="w-100 form-control p-1 mb-4 border-primary bg-light"
                                    placeholder="Confirm Password">

									<div class="form-group mb-5">
                                        <label for="main-photo">Avatar photo</label>
                                        <div class="input-group">
                                            <input class="form-control" type="file" id="main-photo" name="main-photo"
                                                accept="image/*">
                                        </div>
                                        <!-- Main Photo Croppie modal -->
                                        <div id="imageModel" class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Crop this avatar
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body d-flex justify-content-center">
                                                        <div id="image_demo" style="width:100%; margin-top:30px"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary crop_image">Save
                                                            changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <button
                                    class="w-100 btn btn-primary form-control p-3 border-primary bg-primary rounded-pill"
                                    name="button" value="add" type="submit">Submit Now</button>
                                <input type="hidden" name="roleid" value="1">
                                <input type="hidden" name="status" value="0">
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

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

            $('.menu').removeClass('active')
            $('.dropdown-button').on('click', function() {

                if ($('.nav-item').hasClass('menu-open')) {
                    $('.dropdown-icon').removeClass('fa-chevron-down');
                    $('.dropdown-icon').addClass('fa-angle-right');
                } else {
                    $('.dropdown-icon').removeClass('fa-angle-right');
                    $('.dropdown-icon').addClass('fa-chevron-down');
                }
            })


			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
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


            function isValidDate(dateString) {
                var regex = /^\d{1,2}\/\d{1,2}\/\d{4}$/;;
                return regex.test(dateString);
            }

            function hasSpecialCharacters(str) {
                var nonAlphanumericPattern = /[^a-zA-Z0-9]/;

                var nonEnglishAlphabeticPattern = /[^a-zA-Z]/;

                var hasSpecialASCII = nonAlphanumericPattern.test(str);

                var hasNonEnglishCharacters = nonEnglishAlphabeticPattern.test(str);

                return hasSpecialASCII && hasNonEnglishCharacters;
            }

            function isEmail(email) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
            }

            function isIntegerString(str) {
                // Biểu thức chính quy để kiểm tra chuỗi có chứa toàn bộ số và có độ dài từ 7 đến 15 ký tự
                var integerPattern = /^\d{7,15}$/;

                return integerPattern.test(str);
            }
            $('.addForm').submit(function(event) {

                var fullname = $('#fullname').val().trim();
                var email = $('#email').val().trim();
                var phone = $('#phone').val().trim();
                var dob = $('#dob').val().trim();
                var email = $('#email').val().trim();
                var username = $('#username').val().trim();
                var password = $('#password').val().trim();
                var cofirmPassword = $('#cofirmPassword').val().trim();


                if (fullname === '' || email === '' || phone === '' || dob === '' || email === '' ||
                    username === '' || password === '' || cofirmPassword === '') {
                    event.preventDefault();
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please fill in all required blanks"
                    });
                } else if (password != cofirmPassword) {
                    event.preventDefault();
                    Swal.fire({
                        icon: "warning",
                        title: "Varify passwork not match",
                        text: "Please check your passwork input again !"
                    });
                }
                var accountsList = {!! json_encode($accountsList) !!};
                var check = true;
                var error_note = '';
                accountsList.forEach(element => {
                    if (element.username === username) {
                        check = false;
                        error_note += 'Username "' + username + '" is already exist ! <br>'

                    }
                    if (element.phone === phone) {
                        check = false;
                        error_note += 'Phone number [ ' + phone + ' ] is already exist ! <br>'


                    }
                    if (element.email.toLowerCase() === email.toLowerCase()) {
                        check = false;
                        error_note += 'Email "' + email.toLowerCase() + '" is already exist ! \n'


                    }


                });
                if (isEmail(email) == false) {
                    check = false;
                    error_note += ('Inputed email "' + email + '" is invalid ! <br>')
                }
                if (hasSpecialCharacters(username)) {
                    check = false;
                    error_note += 'User name mustn\'t contain any special charatrer ("' +
                        '!\"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~' + '") is invalid ! <br>'
                }

                if (!isIntegerString(phone) && phone != '') {
                    check = false;
                    error_note += 'Phone number [ ' + phone + ' ] is invalid ! <br>'


                }
                if (check == false) {
                    event.preventDefault();
                    Swal.fire({
                        icon: "error",
                        title: 'Register failed !',
                        html: error_note

                    });
                }

                if (fullname === '') {
                    console.log('fullname empty')
                    $('#fullname').addClass('border border-2 border-danger')
                } else {
                    $('#fullname').removeClass('border border-2 border-danger')
                }
                if (email === '') {
                    console.log('email empty')
                    $('#email').addClass('border border-2 border-danger')
                } else {
                    $('#email').removeClass('border border-2 border-danger')
                }
                if (phone === '') {
                    console.log('phone empty')
                    $('#phone').addClass('border border-2 border-danger')
                } else {
                    $('#phone').removeClass('border border-2 border-danger')
                }
                if (dob === '') {
                    console.log('dob empty')
                    $('#dob').addClass('border border-2 border-danger')
                } else {
                    $('#dob').removeClass('border border-2 border-danger')
                }
                if (username === '') {
                    console.log('username empty')
                    $('#username').addClass('border border-2 border-danger')
                } else {
                    $('#username').removeClass('border border-2 border-danger')
                }
                if (password === '') {
                    console.log('password empty')
                    $('#password').addClass('border border-2 border-danger')
                } else {
                    $('#password').removeClass('border border-2 border-danger')
                }
                if (cofirmPassword === '') {
                    console.log('cofirmPassword empty')
                    $('#cofirmPassword').addClass('border border-2 border-danger')
                } else {
                    $('#cofirmPassword').removeClass('border border-2 border-danger')
                }


            })

			
            var sizeBoundary = window.innerWidth > 512 ? 512 : 256;
            var sizeViewPort = 400;
            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                mouseWheelZoom: true,
                viewport: {
                    width: 400,
                    height: 400,
                    type: 'square' //circle
                },
                boundary: {
                    width: 500,
                    height: 500
                }
            });
            //$image_crop.croppie('setZoom', 1)
            $('#main-photo').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function() {

                        //$image_crop.croppie('setZoom', 0.5)
                        //$('.cr-slider').attr({'min':0.5, 'max':3.5000,'aria-valuenow':0.2000});
                        var img = new Image();
                        img.src = reader.result;

                        var minXY = img.height < img.width ? img.height : img.width;

                        var aux = minXY <= sizeViewPort ? sizeViewPort * 2 : minXY;

                        var min = minXY <= sizeViewPort ? 0 : sizeViewPort / aux;
                        var max = minXY <= sizeViewPort ? 0 : aux / sizeViewPort;



                        var scale = minXY <= sizeViewPort ? sizeViewPort / minXY : 1;
                        var x = minXY <= sizeViewPort ? sizeViewPort - (img.width * scale / 2) :
                            (sizeViewPort - ((img.width * scale) / (sizeBoundary /
                                sizeViewPort))) / 2;
                        var y = minXY <= sizeViewPort ? sizeViewPort - (img.height * scale /
                            2) : (sizeViewPort - ((img.height * scale) / (sizeBoundary /
                            sizeViewPort))) / 2;

                        var originX = minXY <= sizeViewPort ? 0 : img.width * scale / 2;
                        var originY = minXY <= sizeViewPort ? 0 : img.height * scale / 2;

                        $('.cr-image').css("opacity", "1");
                        $('.cr-image').css("transform", "translate3d(" + x + "px, " + y +
                            "px, 0px) scale(" + scale + ")");
                        $('.cr-image').css("transform-origin", "" + originX + "px " + originY +
                            "px 0px");
                        $('.cr-slider').attr({
                            'min': min,
                            'max': max,
                            'aria-valuenow': max
                        });
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#imageModel').modal('show');

            });
            $('.crop_image').click(function(event) {
                
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response) {
                    $.ajax({
                        url: '{{ route('storeAccountImage') }}',
                        type: 'POST',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'image': response

                        },
                        success: function(data) {
                            $('#imageModel').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Cropping success !',
                                
                            });
                        }
                    })
                });
            });


        })
    </script>
    <!--Chặn nhập ngày tương lai-->
    <script>
        window.onload = function() {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("dob").setAttribute("max", today);
        };
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dobInput = document.getElementById("dob");
            var today = new Date().toISOString().split('T')[0]; // Format YYYY-MM-DD
            dobInput.setAttribute("max", today);

            dobInput.addEventListener("change", function() {
                var selectedDate = new Date(this.value);
                var now = new Date();
                if (selectedDate > now) {
                    this.value = null; // xóa giá trị user nhập
                }
            });
        });
    </script>
@endsection
