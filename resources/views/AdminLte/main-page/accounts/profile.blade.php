@extends('AdminLte.main-page.layout.mainLayout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="token" content="{{ csrf_token() }}">
    <title>VicTory Group - Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                }
            });
            $('.user_data').addClass('active')

            $('a').click(function(event) {
                var newestAdminLoginId = null;
                var currentAdminLoginId = {!! json_encode(session()->get('admin')->id) !!};

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: "{{ url('/admin/getNewestAdminLoginId') }}",
                    success: function(data) {
                        newestAdminLoginId = data.adminId;
                        if (newestAdminLoginId != null && currentAdminLoginId !=
                            newestAdminLoginId) {
                            event.preventDefault();
                            window.location.reload();
                        }
                    }
                });



            });

            $('button').click(function(event) {
                var newestAdminLoginId = null;
                var currentAdminLoginId = {!! json_encode(session()->get('admin')->id) !!};

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: "{{ url('/admin/getNewestAdminLoginId') }}",
                    success: function(data) {
                        newestAdminLoginId = data.adminId;
                        if (newestAdminLoginId != null && currentAdminLoginId !=
                            newestAdminLoginId) {
                            event.preventDefault();
                            window.location.reload();
                        }
                    }
                });



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

            // function isEmail(str) {
            //     var pattern = /[@]+/;
            //     return pattern.test(str);
            // }
            function isEmail(email) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
            }


            function isIntegerString(str) {
                // Biểu thức chính quy để kiểm tra chuỗi có chứa toàn bộ số và có độ dài từ 7 đến 15 ký tự
                var integerPattern = /^\d{7,15}$/;

                return integerPattern.test(str);
            }
            $('.updateForm').submit(function(event) {
                //alert($('#role').val());

                var form = $(this);

                var id = form.find('#id').val().trim();


                var fullname = form.find('#fullname').val().trim();
                var email = form.find('#email').val().trim();
                var phone = form.find('#phone').val().trim();

                var dob = form.find('#dob').val().trim();

                var email = form.find('#email').val().trim();


                var password = form.find('#password').val().trim();
                var cofirmPassword = form.find('#cofirmPassword').val().trim();

                if (fullname === '' || email === '' || phone === '' || dob === '' || email === '') {
                    event.preventDefault();
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please fill in all required blanks"
                    });
                } else if (password != '' && password != cofirmPassword) {
                    event.preventDefault();
                    Swal.fire({
                        icon: "warning",
                        title: "Varify passwork not match",
                        text: "Please check your passwork input again !"
                    });

                }
                var accountsList = {!! json_encode($accountsCheckList) !!};
                var check = true;
                var error_note = '';
                var currentUsername = form.find('#currentUsername').val().trim();
                var currentEmail = form.find('#currentEmail').val().trim();
                var currentPhone = form.find('#currentPhone').val().trim();
                accountsList.forEach(element => {


                    if (element.phone != currentPhone && element.phone === phone) {
                        check = false;
                        error_note += 'Phone number [ ' + phone + ' ] is already exist ! <br>'

                    }
                    if (element.email != currentEmail && element.email.toLowerCase() === email
                        .toLowerCase()) {
                        check = false;
                        error_note += 'Email "' + email.toLowerCase() + '" is already exist ! <br>'


                    }


                });
                if (isEmail(email) == false) {
                    check = false;
                    error_note += 'Inputed email is invalid ! <br>'
                }
                if (dob != '' && isValidDate(dob) == false) {
                    check = false;
                    error_note += 'Date of birth "' + dob + '" is invalid ! \n'
                }

                if (!isIntegerString(phone) && phone != '') {
                    check = false;
                    error_note += 'Phone number [ ' + phone + ' ] is invalid ! <br>'


                }
                if (check == false) {
                    event.preventDefault();
                    Swal.fire({
                        icon: "error",
                        title: 'Update failed !',
                        html: error_note

                    });
                }

                if (fullname === '') {
                    console.log('fullname empty')
                    form.find('#fullname').addClass('border border-2 border-danger')
                } else {
                    form.find('#fullname').removeClass('border border-2 border-danger')
                }
                if (email === '') {
                    console.log('email empty')
                    form.find('#email').addClass('border border-2 border-danger')
                } else {
                    form.find('#email').removeClass('border border-2 border-danger')
                }
                if (phone === '') {
                    console.log('phone empty')
                    form.find('#phone').addClass('border border-2 border-danger')
                } else {
                    form.find('#phone').removeClass('border border-2 border-danger')
                }
                if (dob === '' || isValidDate(dob) == false) {
                    console.log('dob empty')
                    form.find('#dob').addClass('border border-2 border-danger')
                } else {
                    form.find('#dob').removeClass('border border-2 border-danger')
                }


                if ((cofirmPassword === '' && password != '') || password != cofirmPassword) {
                    console.log('cofirmPassword empty')
                    form.find('#cofirmPassword').addClass('border border-2 border-danger')
                } else {
                    form.find('#cofirmPassword').removeClass('border border-2 border-danger')
                }



            });
            $('.updatePasswordForm').submit(function(event) {
                //alert($('#role').val());

                var form = $(this);

                var id = form.find('#id').val().trim();
                var oldPassword = form.find('#oldPassword').val().trim();
                var password = form.find('#password').val().trim();
                var cofirmPassword = form.find('#cofirmPassword').val().trim();

                if (oldPassword === '' || password === '') {
                    event.preventDefault();
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please fill in all required blanks"
                    });
                } else if (password != '' && password != cofirmPassword) {
                    event.preventDefault();
                    Swal.fire({
                        icon: "warning",
                        title: "Varify passwork not match",
                        text: "Please check your passwork input again !"
                    });

                }

                if (oldPassword === '') {
                    console.log('email empty')
                    form.find('#oldPassword').addClass('border border-2 border-danger')
                } else {
                    form.find('#oldPassword').removeClass('border border-2 border-danger')
                }
                if (password === '') {
                    console.log('email empty')
                    form.find('#password').addClass('border border-2 border-danger')
                } else {
                    form.find('#password').removeClass('border border-2 border-danger')
                }



                if ((cofirmPassword === '' && password != '') || password != cofirmPassword) {
                    console.log('cofirmPassword empty')
                    form.find('#cofirmPassword').addClass('border border-2 border-danger')
                } else {
                    form.find('#cofirmPassword').removeClass('border border-2 border-danger')
                }



            });



            $('.comment_delete').on('click', function() {
                var comment_id = $(this).attr('id');
                var comment_cart = $(this).val();
                $('#' + comment_cart).css("display", "none");
                $.ajax({
                    type: 'GET',
                    data: {
                        comment_id: comment_id
                    },
                    url: "{{ route('removeComment') }}",
                    success: function(data) {

                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            })





        })
    </script>
    <style>
        #imageModel {
            z-index: 999999 !important;
        }

        .modal {
            overflow-y: auto;
        }
    </style>
@endsection


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Account Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"> <a href="{{ url('/admin/accounts/table') }}">User
                                    Manager</a></li>
                            <li class="breadcrumb-item active"> Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="w-100">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center rounded-image">
                                @if (
                                    $account->photo == null ||
                                        $account->photo == '' ||
                                        !File::exists(public_path('img/accounts/' . $account->id . '/' . $account->photo)))
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('/img/accounts/unknown.png') }}" alt="User profile picture">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('/img/accounts/' . $account->id . '/' . $account->photo) }}"
                                        alt="User profile picture">
                                @endif
                                {{-- <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('/') }}AdminLte/dist/img/user4-128x128.jpg" alt="User profile picture"> --}}
                            </div>

                            <h3 class="profile-username text-center">{{ $account->fullname }}</h3>

                            <p class="text-muted text-center">{{ $account->roleName }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Id</b> <span class="float-right">{{ $account->id }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone number</b> <span class="float-right">{{ $account->phone }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <span class="float-right"> {{ $account->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Gender</b> <span class="float-right">{{ $account->gender }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Date of birth</b> <span
                                        class="float-right">{{ \Carbon\Carbon::parse($account->dob)->format('d/m/Y') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Created date</b> <span
                                        class="float-right">{{ \Carbon\Carbon::parse($account->created)->format('d/m/Y') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right">
                                        @if ($account->deactivated == 0)
                                            <span class="badge badge-success">Activated</span>
                                        @else
                                            <span class="badge badge-danger">Deactivated</span>
                                        @endif

                                    </a>
                                </li>
                            </ul>


                            @if ($account->id != session()->get('admin')->id)


                                @if ($account->roleName == 'user' && (session()->get('admin')->role_id == 3 || session()->get('admin')->role_id == 2))
                                    @if ($account->deactivated == 0)
                                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                            data-target="#deactivate{{ $account->id }}">
                                            <i class="fas fa-trash">
                                            </i>
                                            Deactivate
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                                            data-target="#activate{{ $account->id }}">
                                            <i class="fa-solid fa-circle-right"></i>
                                            Activate
                                        </button>
                                    @endif
                                @elseif($account->roleName == 'admin' && session()->get('admin')->role_id == 3)
                                    @if ($account->deactivated == 0)
                                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                            data-target="#deactivate{{ $account->id }}">
                                            <i class="fas fa-trash">
                                            </i>
                                            Deactivate
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                                            data-target="#activate{{ $account->id }}">
                                            <i class="fa-solid fa-circle-right"></i>
                                            Activate
                                        </button>
                                    @endif
                                @endif
                            @elseif(session()->get('admin')->role_id == 3)
                                <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                                    data-target="#update">
                                    <i class="fa-solid fa-circle-arrow-up"></i>
                                    Update your account information
                                </button>
                                <!-- Update modal -->
                                <div class="modal fade" id="update">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update form for account id:
                                                    {{ $account->id }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="updateForm" action="{{ url('/admin/accounts/proccessUpdate') }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf

                                                {{-- <input type="hidden" name="currentLoginId" value="user"> --}}
                                                <input type="hidden" name="currentUrl"
                                                    value="/admin/accounts/profile?id={{ $account->id }}">


                                                <input type="hidden" name="menu" value="user">

                                                <input type="hidden" id='id' name="id"
                                                    value="{{ $account->id }}">
                                                <input type="hidden" id="currentUsername" name="currentUsername"
                                                    value="{{ $account->username }}">
                                                <input type="hidden" id="currentEmail" name="currentEmail"
                                                    value="{{ $account->email }}">
                                                <input type="hidden" id="currentPhone" name="currentPhone"
                                                    value="{{ $account->phone }}">
                                                <div class="modal-body">

                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="fullname">Full Name</label>
                                                            <input name='fullname' type="text" class="form-control"
                                                                id="fullname" placeholder="Enter full name"
                                                                value="{{ $account->fullname }}">
                                                        </div>

                                                        <div class="form-group">

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="inlineRadio1" value="male"
                                                                    @if ($account->gender == 'male') checked @endif>
                                                                <label class="form-check-label"
                                                                    for="inlineRadio1">Male</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="inlineRadio2" value="female"
                                                                    @if ($account->gender == 'female') checked @endif>
                                                                <label class="form-check-label"
                                                                    for="inlineRadio2">Female</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input name='email' type="text" class="form-control"
                                                                id="email" placeholder="Enter email"
                                                                value="{{ $account->email }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone">Phone number</label>
                                                            <div class="input-group">

                                                                <input name="phone" type="text" class="form-control"
                                                                    id="phone" value="{{ $account->phone }}">
                                                                <div class="input-group-prepend bg-secondary">
                                                                    <span class="input-group-text"><i
                                                                            class="fas fa-phone"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Date of birth:</label>
                                                            <div class="input-group date" id="reservationdate"
                                                                data-target-input="nearest">
                                                                <input
                                                                    value="{{ DateTime::createFromFormat('Y-m-d', $account->dob)->format('d/m/Y') }}"
                                                                    id="dob" name="dob" type="text"
                                                                    class="form-control " data-target="#reservationdate"
                                                                    data-inputmask-alias="datetime"
                                                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask />
                                                                <div class="input-group-append"
                                                                    data-target="#reservationdate"
                                                                    data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i
                                                                            class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group ">
                                                            <label>Role</label>
                                                            <select name="roleid" id="role_id"
                                                                class="form-control w-100">

                                                                <option value="3" selected>
                                                                    boss
                                                                </option>


                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="username">Account's username</label>
                                                            <input id="username" name='username' type="text"
                                                                class="form-control" placeholder="Enter name"
                                                                value="{{ $account->username }}" disabled>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="password">Account's password</label>
                                                            <input id="password" name='password' type="password"
                                                                class="form-control" placeholder="Enter password"
                                                                value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cofirmPassword">Confirm password</label>
                                                            <input name='cofirmPassword' type="password"
                                                                class="form-control" id="cofirmPassword"
                                                                placeholder="Enter password">
                                                        </div>

                                                        <div class="form-group mb-5">
                                                            <label for="main-photo">Avatar photo</label>
                                                            <br>
                                                            @if (
                                                                $account->photo == null ||
                                                                    $account->photo == '' ||
                                                                    !File::exists(public_path('img/accounts/' . $account->id . '/' . $account->photo)))
                                                                <img class="rounded mx-auto d-block mb-2 img-fluid w-50"
                                                                    src="{{ asset('/img/accounts/unknown.png') }}"
                                                                    alt="">
                                                            @else
                                                                <img class="rounded mx-auto d-block mb-2 img-fluid w-50"
                                                                    src="{{ asset('/img/accounts/' . $account->id . '/' . $account->photo) }}"
                                                                    alt="">
                                                            @endif

                                                            <div class="input-group">
                                                                <input class="form-control main-photo   p-0 h-100"
                                                                    type="file" id="{{ $account->id }}"
                                                                    name="main-photo" accept="image/*">
                                                            </div>
                                                            <!-- Main Photo Croppie modal -->
                                                            <div id="imageModel" class="modal fade" id="exampleModal"
                                                                tabindex="99999" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">Crop this avatar
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div
                                                                            class="modal-body d-flex justify-content-center">
                                                                            <div id="image_demo"
                                                                                style="width:100%; margin-top:30px">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="button"
                                                                                class="btn btn-primary crop_image">Save
                                                                                changes</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <!-- /.card-body -->



                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" name="button" value="update"
                                                        class="btn btn-primary">Save
                                                        changes</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- End Update modal -->
                            @elseif(session()->get('admin')->role_id == 2)
                                <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                                    data-target="#update">
                                    <i class="fa-solid fa-circle-arrow-up"></i>
                                    Update your account password
                                </button>
                                <!-- Update modal -->
                                <div class="modal fade" id="update">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update form for account id:
                                                    {{ $account->id }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="updatePasswordForm"
                                                action="{{ url('/admin/accounts/proccessUpdateAdminPassword') }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="currentUrl"
                                                    value="/admin/accounts/profile?id={{ $account->id }}">


                                                <input type="hidden" name="menu" value="user">

                                                <input type="hidden" id='id' name="id"
                                                    value="{{ $account->id }}">

                                                <div class="modal-body">

                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <label for="username">Account's username</label>
                                                            <input id="username" name='username' type="text"
                                                                class="form-control" placeholder="Enter name"
                                                                value="{{ $account->username }}" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password">Old password</label>
                                                            <input id="oldPassword" name='oldPassword' type="password"
                                                                class="form-control" placeholder="Enter password"
                                                                value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password">New password</label>
                                                            <input id="password" name='password' type="password"
                                                                class="form-control" placeholder="Enter password"
                                                                value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cofirmPassword">Confirm password</label>
                                                            <input name='cofirmPassword' type="password"
                                                                class="form-control" id="cofirmPassword"
                                                                placeholder="Enter password">
                                                        </div>

                                                    </div>
                                                    <!-- /.card-body -->



                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" name="button" value="update"
                                                        class="btn btn-primary">Save
                                                        changes</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- End Update modal -->
                            @endif

                            <!-- Remove modal -->
                            <form action="{{ url('/admin/accounts/activate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $account->id }}">
                                <input type="hidden" name="currentUrl"
                                    value="/admin/accounts/profile?id={{ $account->id }}">
                                <div class="modal fade" id="deactivate{{ $account->id }}">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Are you sure to deactivate
                                                    "{{ $account->fullname }}"</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>This action will not remove the account from server</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="button"
                                                    value="deactivate">Confirm
                                                    deactivate</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- End Remove modal -->

                                <!-- Active modal -->

                                <div class="modal fade" id="activate{{ $account->id }}">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Are you sure to activate
                                                    "{{ $account->fullname }}"</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>This action will reactivate the account from server</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="button"
                                                    value="activate">Confirm
                                                    activate</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
                @if ($account->role_id == 1)
                    <div class="w-100">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#favorite"
                                            data-toggle="tab">Favorite
                                            item</a>
                                    </li>

                                    <li class="nav-item"><a class="nav-link" href="#comment"
                                            data-toggle="tab">Comment</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="favorite">
                                        <!-- The timeline -->
                                        <div class="timeline timeline-inverse">
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-danger">
                                                    Favorite Mountains
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            @foreach ($mountainLikeList as $mountain)
                                                <div>
                                                    <i class="fas bg-danger fa-solid  fa-mountain "></i>
                                                    <div class="timeline-item ">

                                                        <span
                                                            class="time w-50 d-flex justify-content-between align-items-center py-1 ">
                                                            <span>
                                                                Add to the list at
                                                                {{ \Carbon\Carbon::parse($mountain->created)->format('d/m/Y') }}
                                                                &nbsp;<i class="far fa-clock"></i>
                                                            </span>
                                                            <span>
                                                                <a href="{{ url('/admin/mountains/detail?id=' . $mountain->id) }}"
                                                                    class="btn btn-info btn-sm"><i
                                                                        class="fa-solid fa-circle-info"></i></a>
                                                            </span>

                                                        </span>
                                                        <h3 class="timeline-header "><a
                                                                href="{{ url('/admin/mountains/detail?id=' . $mountain->id) }}">{{ $mountain->name }}</a>
                                                            [id:{{ $mountain->id }}]</h3>
                                                    </div>
                                                </div>
                                            @endforeach




                                            <div class="pb-4">
                                                <i class="far  bg-danger fa-solid fa-circle-arrow-down"></i>
                                            </div>

                                            <div class="time-label">
                                                <span class="bg-purple">
                                                    Favorite Organizations
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->

                                            @foreach ($groupLikeList as $group)
                                                <div>
                                                    <i class="fas bg-purple fa-solid fa-people-group"></i>
                                                    <div class="timeline-item ">

                                                        <span
                                                            class="time w-50 d-flex justify-content-between align-items-center py-1 ">
                                                            <span>
                                                                Add to the list at
                                                                {{ \Carbon\Carbon::parse($group->created)->format('d/m/Y') }}
                                                                &nbsp;<i class="far fa-clock"></i>
                                                            </span>
                                                            <span>
                                                                <a href="{{ url('/admin/groups/detail?id=' . $group->id) }}"
                                                                    class="btn btn-info btn-sm"><i
                                                                        class="fa-solid fa-circle-info"></i></a>
                                                            </span>

                                                        </span>
                                                        <h3 class="timeline-header "><a
                                                                href="{{ url('/admin/groups/detail?id=' . $group->id) }}">{{ $group->name }}</a>
                                                            [id:{{ $group->id }}]</h3>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <!-- END timeline item -->
                                            <div class="pb-4">
                                                <i class="far  bg-purple fa-solid fa-circle-arrow-down"></i>
                                            </div>

                                            <div class="time-label">
                                                <span class="bg-secondary">
                                                    Favorite Articles
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            @foreach ($articleLikeList as $article)
                                                <div>
                                                    <i class="fas bg-secondary fa-solid fa-newspaper"></i>
                                                    <div class="timeline-item ">

                                                        <span
                                                            class="time w-50 d-flex justify-content-between align-items-center py-1 ">
                                                            <span>
                                                                Add to the list at
                                                                {{ \Carbon\Carbon::parse($article->created)->format('d/m/Y') }}
                                                                &nbsp;<i class="far fa-clock"></i>
                                                            </span>
                                                            <span>
                                                                <a href="{{ url('/admin/articles/detail?id=' . $article->id) }}"
                                                                    class="btn btn-info btn-sm"><i
                                                                        class="fa-solid fa-circle-info"></i></a>
                                                            </span>

                                                        </span>
                                                        <h3 class="timeline-header "><a
                                                                href="{{ url('/admin/articles/detail?id=' . $article->id) }}">{{ $article->name }}</a>
                                                            [id:{{ $article->id }}]</h3>
                                                    </div>
                                                </div>
                                            @endforeach



                                            <!-- END timeline item -->
                                            <div class="pb-4">
                                                <i class="far  bg-gray fa-solid fa-circle-arrow-down"></i>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="comment">
                                        <div class="timeline timeline-inverse">
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-danger">
                                                    Mountain Posts
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            @foreach ($mountainList as $mountain)
                                                @if ($mountainCommentList->contains('mountain_id', $mountain->id))
                                                    <div>
                                                        <i class="fas bg-danger fa-solid  fa-mountain "></i>
                                                        <div class="timeline-item ">


                                                            <h3 class="timeline-header "><a
                                                                    href="#">{{ $account->fullname }}</a>
                                                                <i class="fa-solid fa-arrow-right"></i>
                                                                <a
                                                                    href="{{ url('/admin/mountains/detail?id=' . $mountain->id) }}">{{ $mountain->name }}</a>
                                                            </h3>


                                                            <div class="timeline-body card-comments">
                                                                @foreach ($mountainCommentList as $mountainComment)
                                                                    @if ($mountainComment->mountain_id == $mountain->id)
                                                                        <div class="card-comment"
                                                                            id="mountainComment{{ $mountainComment->id }}">
                                                                            <!-- User image -->

                                                                            @if (
                                                                                $account->photo == null ||
                                                                                    $account->photo == '' ||
                                                                                    !File::exists(public_path('img/accounts/' . $account->id . '/' . $account->photo)))
                                                                                <img class="img-circle img-sm"
                                                                                    src="{{ asset('/img/accounts/unknown.png') }}"
                                                                                    alt="User Image">
                                                                            @else
                                                                                <img class="img-circle img-sm"
                                                                                    src="{{ asset('/img/accounts/' . $account->id . '/' . $account->photo) }}"
                                                                                    alt="User Image">
                                                                            @endif


                                                                            <div class="comment-text">
                                                                                <span class="username">
                                                                                    {{ $account->fullname }}
                                                                                    <span
                                                                                        class="text-muted float-right">{{ \Carbon\Carbon::parse($mountainComment->created)->format('H:i d/m/Y') }}</span>
                                                                                </span><!-- /.username -->


                                                                            </div>
                                                                            <span class="d-flex justify-content-between"
                                                                                style="width:100% !important">
                                                                                <span class="ml-4">
                                                                                    -{{ $mountainComment->comment_text }}
                                                                                </span>

                                                                                <button id="{{ $mountainComment->id }}"
                                                                                    value="mountainComment{{ $mountainComment->id }}"
                                                                                    class="comment_delete btn btn-danger btn-sm"><i
                                                                                        class="fa-solid fa-trash-can"></i></button>
                                                                            </span>
                                                                            <!-- /.comment-text -->
                                                                        </div>
                                                                    @endif
                                                                @endforeach


                                                            </div>

                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach

                                            <div class="pb-4">
                                                <i class="far  bg-danger fa-solid fa-circle-arrow-down"></i>
                                            </div>
                                            <div class="time-label">
                                                <span class="bg-purple">
                                                    Organizations Posts
                                                </span>
                                            </div>
                                            @foreach ($groupList as $group)
                                                @if ($groupCommentList->contains('group_id', $group->id))
                                                    <div>
                                                        <i class="fas bg-purple fa-solid fa-people-group"></i>
                                                        <div class="timeline-item ">


                                                            <h3 class="timeline-header "><a
                                                                    href="#">{{ $account->fullname }}</a>
                                                                <i class="fa-solid fa-arrow-right"></i>
                                                                <a
                                                                    href="{{ url('/admin/groups/detail?id=' . $group->id) }}">{{ $group->name }}</a>
                                                            </h3>


                                                            <div class="timeline-body card-comments">
                                                                @foreach ($groupCommentList as $groupComment)
                                                                    @if ($groupComment->group_id == $group->id)
                                                                        <div class="card-comment"
                                                                            id="groupComment{{ $groupComment->id }}">
                                                                            <!-- User image -->

                                                                            @if (
                                                                                $account->photo == null ||
                                                                                    $account->photo == '' ||
                                                                                    !File::exists(public_path('img/accounts/' . $account->id . '/' . $account->photo)))
                                                                                <img class="img-circle img-sm"
                                                                                    src="{{ asset('/img/accounts/unknown.png') }}"
                                                                                    alt="User Image">
                                                                            @else
                                                                                <img class="img-circle img-sm"
                                                                                    src="{{ asset('/img/accounts/' . $account->id . '/' . $account->photo) }}"
                                                                                    alt="User Image">
                                                                            @endif


                                                                            <div class="comment-text">
                                                                                <span class="username">
                                                                                    {{ $account->fullname }}
                                                                                    <span
                                                                                        class="text-muted float-right">{{ \Carbon\Carbon::parse($groupComment->created)->format('H:i d/m/Y') }}</span>
                                                                                </span><!-- /.username -->

                                                                            </div>
                                                                            <!-- /.comment-text -->
                                                                            <span class="d-flex justify-content-between"
                                                                                style="width:100% !important">
                                                                                <span class="ml-4">
                                                                                    -{{ $groupComment->comment_text }}
                                                                                </span>

                                                                                <button id="{{ $groupComment->id }}"
                                                                                    value="groupComment{{ $groupComment->id }}"
                                                                                    class="comment_delete btn btn-danger btn-sm"><i
                                                                                        class="fa-solid fa-trash-can"></i></button>
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach


                                                            </div>

                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach

                                            <div class="pb-4">
                                                <i class="far  bg-purple fa-solid fa-circle-arrow-down"></i>
                                            </div>

                                            <div class="time-label">
                                                <span class="bg-secondary">
                                                    Article Posts
                                                </span>
                                            </div>
                                            @foreach ($articleList as $article)
                                                @if ($articleCommentList->contains('article_id', $article->id))
                                                    <div>
                                                        <i class="fas bg-secondary fa-solid fa-newspaper"></i>
                                                        <div class="timeline-item ">


                                                            <h3 class="timeline-header "><a
                                                                    href="#">{{ $account->fullname }}</a>
                                                                <i class="fa-solid fa-arrow-right"></i>
                                                                <a
                                                                    href="{{ url('/admin/articles/detail?id=' . $article->id) }}">{{ $mountain->name }}</a>
                                                            </h3>


                                                            <div class="timeline-body card-comments">
                                                                @foreach ($articleCommentList as $articleComment)
                                                                    @if ($articleComment->article_id == $article->id)
                                                                        <div class="card-comment"
                                                                            id="articleComment{{ $articleComment->id }}">
                                                                            <!-- User image -->

                                                                            @if (
                                                                                $account->photo == null ||
                                                                                    $account->photo == '' ||
                                                                                    !File::exists(public_path('img/accounts/' . $account->id . '/' . $account->photo)))
                                                                                <img class="img-circle img-sm"
                                                                                    src="{{ asset('/img/accounts/unknown.png') }}"
                                                                                    alt="User Image">
                                                                            @else
                                                                                <img class="img-circle img-sm"
                                                                                    src="{{ asset('/img/accounts/' . $account->id . '/' . $account->photo) }}"
                                                                                    alt="User Image">
                                                                            @endif


                                                                            <div class="comment-text">
                                                                                <span class="username">
                                                                                    {{ $account->fullname }}
                                                                                    <span
                                                                                        class="text-muted float-right">{{ \Carbon\Carbon::parse($articleComment->created)->format('H:i d/m/Y') }}</span>
                                                                                </span><!-- /.username -->

                                                                            </div>
                                                                            <!-- /.comment-text -->
                                                                            <span class="d-flex justify-content-between"
                                                                                style="width:100% !important">
                                                                                <span class="ml-4">
                                                                                    -{{ $articleComment->comment_text }}
                                                                                </span>
                                                                                <button id="{{ $articleComment->id }}"
                                                                                    value="articleComment{{ $articleComment->id }}"
                                                                                    class="comment_delete btn btn-danger btn-sm"><i
                                                                                        class="fa-solid fa-trash-can"></i></button>
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach


                                                            </div>

                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                            <!-- END timeline item -->
                                            <div class="pb-4">
                                                <i class="far  bg-secondary fa-solid fa-circle-arrow-down"></i>
                                            </div>





                                        </div>

                                    </div>


                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                @endif
                <!-- /.col -->

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection



@section('script')
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}AdminLte/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/') }}AdminLte/dist/js/demo.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('/') }}AdminLte/plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/inputmask/jquery.inputmask.min.js"></script>






    <!-- AdminLTE App -->

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('/') }}AdminLte/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('/') }}AdminLte/plugins/chart.js/Chart.min.js"></script>






    <!-- Select2 -->
    <script src="{{ asset('/') }}AdminLte/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="{{ asset('/') }}AdminLte/plugins/moment/moment.min.js"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('/') }}AdminLte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('/') }}AdminLte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('/') }}AdminLte/plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <!-- dropzonejs -->
    <script>
        $(document).ready(function() {
            $('#reservationdate').datetimepicker({
                format: 'DD/MM/YYYY',
            });
            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {
                'placeholder': 'mm/dd/yyyy'
            })
            //Money Euro
            $('[data-mask]').inputmask()

            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()


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
            var update_modal_id = -1;
            //$image_crop.croppie('setZoom', 1)
            $('.main-photo').on('change', function() {

                update_modal_id = $(this).attr('id');



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
                //alert("Success");
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
                            //alert(update_modal_id);
                            ///$('#update' + update_modal_id).modal('hide');

                            //$('#update1').modal('hide');

                            Swal.fire({
                                icon: 'success',
                                title: 'Cropping success !',

                            });
                            //$('.update1').click()
                            //$('#update1').modal('show');
                        }
                    })
                });
            });
        })
    </script>
@endsection
