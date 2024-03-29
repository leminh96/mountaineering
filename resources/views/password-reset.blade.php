{{-- <form action="{{ route('password.customUpdate') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <label for="password">New Password</label>
    <input id="password" name="password" type="password" required>

    <label for="password-confirm">Confirm Password</label>
    <input id="password-confirm" name="password_confirmation" type="password" required>

    <button type="submit">Reset Password</button>
</form> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VicTory Group - Mountaineering</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('VictoryWeb') }}/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

            $('.sign-in-button').on('click', function(event) {
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
            @if ($errors->any())
                Swal.fire({
                    icon: "error",
                    title: "Opps !",
                    text: "Something went wrong please try again !"
                });
            @endif

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
        })
    </script>
    {{-- <style>
		body,
		html {
			height: 100%;
			margin: 0;
			font-family: 'Open Sans', sans-serif;
		}

		.bg-image {
			background-image: url('/VictoryWeb/login/images/bg.jpg');
			background-size: cover;
			background-position: center;
			height: 100%;
			position: fixed;
			width: 100%;
		}

		.login-container {
			position: relative;
			z-index: 2;
			min-height: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.login-card {
			background: rgba(255, 255, 255, 0.5);
			/* Giảm giá trị alpha xuống 0.5 */
			padding: 2rem;
			border-radius: 15px;
			width: 100%;
			max-width: 400px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		.login-card:hover {
			box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
		}


		.form-input {
			background: rgba(255, 255, 255, 0.5);
			border-radius: 20px;
			margin-bottom: 20px;
		}

		.form-input:hover {
			background: rgba(255, 255, 255, 0.8);
		}

		.btn-btsprimary {
			border-radius: 20px;
			background-color: #007bff;
			color: white;
			border: none;
			padding: 10px 20px;
		}

		.btn-btsprimary:hover {
			background-color: #0056b3;
		}

		.btn-custom:hover {
			background-color: black !important;
			color: #D4A762 !important;
		}
		.clouds{
			z-index: 1;
		}
		.bg-image .clouds{
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			overflow: hidden;
		}
		.bg-image .clouds img{
			position: absolute;
			bottom: 0;
			max-width: 100%;
			animation: animate calc(8s * var(--i)) linear infinite;
		}
		@keyframes animate
		{
			0%
			{
				transform: translateX(-100%)
			}
			100%
			{
				transform: translateX(100%)
			}
		}
	</style> --}}
    <style>
        body,
        html {
            position: fixed;
            height: 100vh !important;

            width: 100vw !important;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            /* overflow: hidden; */
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
            background-image: url('/VictoryWeb/login/images/bg.jpg');
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



        .login-container {
            position: relative;
            z-index: 2;
            min-height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.5);
            /* Giảm giá trị alpha xuống 0.5 */
            padding: 2rem;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-card:hover {
            box-shadow: 0 8px 16px rgba(209, 162, 23, 0.759);
        }

        .login-card:hover .text-hover {
            color: rgba(209, 162, 23, 0.759);
        }

        .form-input {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            margin-bottom: 20px;
        }

        .form-input:hover {
            background: rgba(255, 255, 255, 0.8);
        }

        .btn-btsprimary {
            border-radius: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
        }

        .btn-btsprimary:hover {
            background-color: #0056b3;
        }

        .btn-custom:hover {
            background-color: black !important;
            color: #D4A762 !important;
        }

        .clouds {
            z-index: 1;
        }

        .bg-image .clouds {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .bg-image .clouds img {
            position: absolute;
            bottom: 0;
            max-width: 100%;
            animation: animate calc(8s * var(--i)) linear infinite;
        }

        @keyframes animate {
            0% {
                transform: translateX(-100%)
            }

            100% {
                transform: translateX(100%)
            }
        }

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
</head>

<body>

    <div class="bg-image overflow-hidden" style="height: 100vh !important">
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="clouds">
            <img src="{{ asset('VictoryWeb/login/images/cloud1.png') }}" style="--i:1;">
            <img src="{{ asset('VictoryWeb/login/images/cloud2.png') }}" style="--i:2;">
            <img src="{{ asset('VictoryWeb/login/images/cloud3.png') }}" style="--i:3;">
            <img src="{{ asset('VictoryWeb/login/images/cloud4.png') }}" style="--i:4;">
            <img src="{{ asset('VictoryWeb/login/images/cloud5.png') }}" style="--i:5;">
        </div>
        <div class="login-container d-flex flex-column justify-content-center align-items-center h-100">
            <h1 class="display-2 text-primary fw-bold m-4">Vic<span class="text-dark">Tory</span> </h1>
            <div class="login-card">
                <h3 class="display-8 mb-4 text-center text-hover">Enter your new password</h3>
                <form action="{{ route('password.customUpdate') }}" method="POST" method="POST"
                    class="forgot-password">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="form-group">
                        <input id="password" name="password" type="password" class="form-control form-input"
                            placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" name="password_confirmation" type="password"
                            class="form-control form-input" placeholder="password-confirm" required>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit"
                            class="btn-custom btn btn-primary py-2 px-4  d-xl-inline-block rounded-pill w-100">Reset
                            Password</button>
                    </div>
                    {{-- <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                        Forgot Password?
                      </button> --}}

                </form>

            </div>
        </div>
    </div>

    <!-- Add your JS scripts here -->
    <script src="{{ asset('VictoryWeb') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <!-- <script src="{{ asset('/') }}AdminLte/dist/js/adminlte.min.js"></script> -->
    <script src="{{ asset('/') }}AdminLte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
