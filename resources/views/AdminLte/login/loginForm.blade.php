@extends('AdminLte.login.loginLayout')


@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VicTory Group - Admin</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/dist/css/adminlte.min.css">

    {{-- <style>
        .login-box {
            position: relative;
            z-index: 2;
            min-height: 100vh !important;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style> --}}
    <style>
        body {
            height: 100vh !important;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            /* overflow: hidden; */
            position: fixed;
        }

        .bg-image {
            position: relative;
            overflow: hidden;
            /* Đảm bảo rằng phần mở rộng của pseudo-element không làm hiện scroll bar */
            height: 100%;
        }

        .bg-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/AdminLte/dist/img/mountains.jpg');
            background-size: cover;
            background-position: center;
            z-index: -1;
            /* Đảm bảo rằng nó nằm dưới các phần tử con khác */
            animation: zoomInOut 20s infinite;
        }

        @keyframes zoomInOut {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }
        }

        .login-box {

            z-index: 2;
            min-height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.5);
            /* Giảm giá trị alpha xuống 0.5 */
            padding: 2rem;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(23, 215, 240, 0.956);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.5);
        }

        .form-control:hover {
            background: rgba(255, 255, 255, 0.8);
        }

        .fixed-block {
            position: fixed;
            right: 0;
            top: 0;

            width: 300px;
            height: 300px;
            background: url('/AdminLte/dist/img/world.jpg');
            background-size: cover;
            background-repeat: repeat-x;
            margin: 10px;
            border-radius: 50%;

            box-shadow: inset 0 0 20px rgba(0, 0, 0, 1),
                0 0 50px #4069ff;
            animation: animateEarth 1000s linear infinite;
            z-index: 100;
        }

        @keyframes animateEarth {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 299549px 0;
            }
        }

        @media (max-width: 992px) {

            /* Điều chỉnh kích thước màn hình này tùy thuộc vào layout của bạn */
            .fixed-block {
                display: none;
                /* Ẩn khối này trên các thiết bị có màn hình nhỏ hơn */
            }
        }
        /* .circle{
          transform-style: preserve-3d; 
          animation: animateText 10s linear infinite;
        }
        .circle span{
          position: absolute;
          top:0;
          right:0;
          background: #fff;
          color: darkgoldenrod;
          font-size: 3em;
          transform-origin: center;
          transform-style: preserve-3d;
          padding: 5px 11px;
          transform: rotateY(calc(var(--i)* calc(360/27))) 
          translateZ(200px);
        }
        @keyframes animateText
        {
          0%
          {
            transform: perspective(1000px) rotateY(360deg) rotateX(15deg) translateY(-30px);
          }
          100%
          {
            transform: perspective(1000px) rotateY(0deg) rotateX(15deg) translateY(-30px);
          }
        } */
        .spans {
            overflow: hidden;

            position: absolute;
            top: 50%;
            left: 50%;
            width: 4px;
            height: 4px;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1),
                0 0 0 8px rgba(255, 255, 255, 0.1),
                0 0 20px rgba(255, 255, 255, 1);
            animation: animated 3s linear infinite;
        }

        .spans::before {
            content: '';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 300px;
            height: 1px;
            background: linear-gradient(90deg, #fff, transparent);
        }

        @keyframes animated {
            0% {
                transform: rotate(315deg) translateX(0);
                visibility: visible;
            }

            70% {
                opacity: 1;
            }

            100% {
                transform: rotate(315deg) translateX(-1000px);
                visibility: hidden;
            }
        }

        .spans:nth-child(1) {
            top: 0px;
            right: 0;
            left: initial;
            animation-delay: 0;
            animation-duration: 1s;
        }

        .spans:nth-child(2) {
            top: 0px;
            right: 80px;
            left: initial;
            animation-delay: 0.2s;
            animation-duration: 3s;
        }

        .spans:nth-child(3) {
            top: 80px;
            right: 0px;
            left: initial;
            animation-delay: 0.4s;
            animation-duration: 2s;
        }

        .spans:nth-child(4) {
            top: 0px;
            right: 180px;
            left: initial;
            animation-delay: 0.6s;
            animation-duration: 1.5s;
        }

        .spans:nth-child(5) {
            top: 0px;
            right: 400px;
            left: initial;
            animation-delay: 0.8s;
            animation-duration: 2.5s;
        }

        .spans:nth-child(6) {
            top: 0px;
            right: 600px;
            left: initial;
            animation-delay: 1s;
            animation-duration: 3s;
        }

        .spans:nth-child(7) {
            top: 300px;
            right: 0px;
            left: initial;
            animation-delay: 1.2s;
            animation-duration: 1.75s;
        }

        .spans:nth-child(8) {
            top: 0px;
            right: 700px;
            left: initial;
            animation-delay: 1.4s;
            animation-duration: 1.25s;
        }

        .spans:nth-child(9) {
            top: 0px;
            right: 1000px;
            left: initial;
            animation-delay: 1..75s;
            animation-duration: 2.25s;
        }

        .spans:nth-child(10) {
            top: 0px;
            right: 450px;
            left: initial;
            animation-delay: 2.75s;
            animation-duration: 2.25s;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

            $('.sign-in-button').on('click', function() {
                var password = $('#password').val().trim();
                var username = $('#username').val().trim();



                if (password === '' || username === '') {
                    event.preventDefault();

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please fill in all required blanks"
                    });
                }
                if (password === '') {
                    console.log('password empty')
                    $('#password').addClass('border border-2 border-danger')
                } else {
                    $('#password').removeClass('border border-2 border-danger')
                }
                if (username === '') {
                    console.log('username empty')
                    $('#username').addClass('border border-2 border-danger')
                } else {
                    $('#username').removeClass('border border-2 border-danger')
                }
            })

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


            $('.forgotPasswordForm').submit(function(e) {
                e.preventDefault(); // Ngăn form submit theo cách thông thường

                var formData = $(this).serialize(); // Lấy dữ liệu từ form

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'), // Lấy URL từ thuộc tính action của form
                    data: formData,
                    success: function(response) {
                        // Hiển thị SweetAlert dựa trên response
                        Swal.fire({
                            title: 'Success! Check your email to complete the process',
                            text: response
                            .status, // Sử dụng trạng thái từ response JSON để hiển thị thông báo
                            icon: 'success',
                            confirmButtonText: 'close'
                        });
                    },
                    error: function(xhr, status, error) {
                        
                        console.log(xhr.responseText)
                        // Xử lý trường hợp có lỗi
                        Swal.fire({
                            title: 'Error!',
                            text: 'Can not send the link to reset password, please try again.',
                            icon: 'error',
                            confirmButtonText: 'close'
                        });
                    }
                });
            });
        })
    </script>
@endsection

@section('content')
    <div class="login-box" style="height: 100vh !important">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h1"><b>Victory</b>Admin</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ url('/admin/proccessLogin') }}" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        <input id="username" name='username' type="text" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class=" fa-solid fa-user-tie"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" name='password' type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">


                        <button type="submit" class="btn btn-primary btn-block sign-in-button">Sign In</button>

                    </div>
                    <div class="form-group text-right ">
                        <a href="" class="text-right " style="width:100% !important" data-toggle="modal"
                            data-target="#forgetPassword">Forgot
                            Password?</a>
                    </div>
                </form>



                {{-- <p class="mb-0 text-center">
                    <a href="{{ url('/admin/register') }}" class="text-center">Register a new membership</a>
                </p> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        




    </div>
    
@endsection

@section('script')
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}AdminLte/dist/js/adminlte.min.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
