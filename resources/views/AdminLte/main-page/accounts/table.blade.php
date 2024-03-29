@extends('AdminLte.main-page.layout.mainLayout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="token" content="{{ csrf_token() }}">

    <title>VicTory Group - Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    {{-- <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/fontawesome-free/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/dist/css/adminlte.min.css">



    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
        href="{{ asset('/') }}AdminLte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/') }}AdminLte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <!-- <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/dropzone/min/dropzone.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

            $('.user_data').addClass('active')

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


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                }
            });


            // $('form').submit(function(event) {
            //     var newestAdminLoginId = null;
            //     var currentAdminLoginId = {!! json_encode(session()->get('admin')->id) !!};
            //     var allowdable = true;
            //     event.preventDefault();
            //     // $(this).submit(false);
            //     $.ajax({
            //         context: this,
            //         type: 'GET',
            //         async: 'false',
            //         dataType: 'json',
            //         contentType: 'application/json',
            //         url: "{{ url('/admin/getNewestAdminLoginId') }}",
            //         success: function(data) {
            //             alert('ngu')
            //             alert('current: ' + currentAdminLoginId)
            //             alert('new: ' + data.adminId)
            //             newestAdminLoginId = data.adminId;
            //             if (newestAdminLoginId != null && currentAdminLoginId != data.adminId) {
            //                 alert('not allow')
            //                 allowdable = false;
            //                 //$(this).submit(false);
            //                 window.location.reload();

            //             }else{
            //                 alert('allow')
            //                 form[0].submit()
            //             }
            //         }

            //     });



            // });

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
                        <h1>Accounts Managerment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">User Manager</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <button id="showBtn" onclick="show()" style="display: none">oclic</button>
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    Id
                                </th>
                                <th style="width: 5%">
                                    Avatar
                                </th>
                                <th style="width: 20%">
                                    Full Name
                                </th>
                                <th style="width: 10%">
                                    username
                                </th>

                                <th style="width: 20%">
                                    Email
                                </th>
                                <th class="text-center" style="width: 1%">
                                    Role
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th>
                                    Option
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Main Photo Croppie modal -->
                            <div id="imageModel" class="modal fade" id="exampleModal" tabindex="99999"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Crop this avatar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex justify-content-center">
                                            <div id="image_demo" style="width:100%; margin-top:30px">
                                            </div>
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


                            @foreach ($accountsList as $account)
                                <tr>
                                    <td>
                                        {{ $account->id }}
                                    </td>
                                    <td>
                                        @if (
                                            $account->photo == null ||
                                                $account->photo == '' ||
                                                !File::exists(public_path('img/accounts/' . $account->id . '/' . $account->photo)))
                                            <img alt="Avatar" class="table-avatar w-100"
                                                src="{{ asset('/img/accounts/unknown.png') }}">
                                        @else
                                            <img alt="Avatar" class="table-avatar w-100"
                                                src="{{ asset('/img/accounts/' . $account->id . '/' . $account->photo) }}">
                                            {{-- <img alt="Avatar" class="table-avatar w-100" src="{{asset('/img/accounts/5/1708792794_1697283799119_s0xloj47z0d3kk5ipwury6xfcjo0ruz7_600x600.webp')}}"> --}}
                                        @endif
                                    </td>
                                    <td>
                                        <a>
                                            {{ $account->fullname }}
                                        </a>
                                        <br />
                                        <small>
                                            {{ $account->dob }}
                                        </small>
                                    </td>
                                    <td>
                                        <a>
                                            {{ $account->username }}
                                        </a>

                                    </td>
                                    <td>
                                        <a>
                                            {{ $account->email }}
                                        </a>
                                    </td>

                                    <td class="text-center">
                                        @if ($account->role_id == 2)
                                            <span
                                                class="bg-info rounded-pill p-1 font-weight-bold">{{ $account->roleName }}</span>
                                        @elseif ($account->role_id == 1)
                                            <span
                                                class="bg-warning rounded-pill p-1 font-weight-bold">{{ $account->roleName }}</span>
                                        @else
                                            <span
                                                class="bg-purple rounded-pill p-1 font-weight-bold">{{ $account->roleName }}</span>
                                        @endif

                                    </td>
                                    <td class="project-state">
                                        @if ($account->deactivated == 0)
                                            <span class="badge badge-success">Activated</span>
                                        @else
                                            <span class="badge badge-danger">Deactivated</span>
                                        @endif
                                    </td>
                                    <td class="project-actions text-left">
                                        <a class="btn btn-primary btn-sm "
                                            href="{{ url('/admin/accounts/profile?id=' . $account->id) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
                                        <button type="button" class="btn btn-info btn-sm  update{{ $account->id }}"
                                            data-toggle="modal" data-target="#update{{ $account->id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </button>
                                        <!-- Update modal -->
                                        <div class="modal fade" id="update{{ $account->id }}">
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
                                                    <form class="updateForm"
                                                        action="{{ url('/admin/accounts/proccessUpdate') }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf

                                                        {{-- <input type="hidden" name="currentLoginId" value="user"> --}}


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
                                                                    <input name='fullname' type="text"
                                                                        class="form-control" id="fullname"
                                                                        placeholder="Enter full name"
                                                                        value="{{ $account->fullname }}">
                                                                </div>

                                                                <div class="form-group">

                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="gender" id="inlineRadio1"
                                                                            value="male"
                                                                            @if ($account->gender == 'male') checked @endif>
                                                                        <label class="form-check-label"
                                                                            for="inlineRadio1">Male</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="gender" id="inlineRadio2"
                                                                            value="female"
                                                                            @if ($account->gender == 'female') checked @endif>
                                                                        <label class="form-check-label"
                                                                            for="inlineRadio2">Female</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input name='email' type="text"
                                                                        class="form-control" id="email"
                                                                        placeholder="Enter email"
                                                                        value="{{ $account->email }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="phone">Phone number</label>
                                                                    <div class="input-group">

                                                                        <input name="phone" type="text"
                                                                            class="form-control" id="phone"
                                                                            value="{{ $account->phone }}">
                                                                        <div class="input-group-prepend bg-secondary">
                                                                            <span class="input-group-text"><i
                                                                                    class="fas fa-phone"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Date of birth:</label>
                                                                    <div class="input-group date"
                                                                        id="reservationdate{{ $account->id }}"
                                                                        data-target-input="nearest">
                                                                        <input
                                                                            value="{{ DateTime::createFromFormat('Y-m-d', $account->dob)->format('d/m/Y') }}"
                                                                            id="dob" name="dob" type="text"
                                                                            class="form-control "
                                                                            data-target="#reservationdate{{ $account->id }}"
                                                                            data-inputmask-alias="datetime"
                                                                            data-inputmask-inputformat="dd/mm/yyyy"
                                                                            data-mask />
                                                                        <div class="input-group-append"
                                                                            data-target="#reservationdate{{ $account->id }}"
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
                                                                        @foreach ($roleList as $role)
                                                                            @if ($role->id != 3)
                                                                                <option value="{{ $role->id }}"
                                                                                    @if ($role->id == $account->role_id) selected @endif>
                                                                                    {{ $role->name }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach

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

                                        @if ($account->deactivated == 0)
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deactivate{{ $account->id }}">
                                                <i class="fas fa-trash">
                                                </i>
                                                deactivate
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#activate{{ $account->id }}">
                                                <i class="fa-solid fa-circle-right"></i>
                                                activate
                                            </button>
                                        @endif
                                        <!-- Remove modal -->
                                        <form class="activateForm" action="{{ url('/admin/accounts/activate') }}"
                                            method="POST">
                                            @csrf

                                            <input type="hidden" name="menu" value="user">

                                            <input type="hidden" name="id" value="{{ $account->id }}">
                                            <input type="hidden" id="role_id" name="role_id"
                                                value="{{ $account->role_id }}">

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
                                        <!-- End Remove modal -->

                                    </td>
                                </tr>
                            @endforeach




                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection


@section('script')
    <!-- Bootstrap -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('/') }}AdminLte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}AdminLte/dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('/') }}AdminLte/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('/') }}AdminLte/plugins/chart.js/Chart.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/') }}AdminLte/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('/') }}AdminLte/dist/js/pages/dashboard2.js"></script>




    <!-- Select2 -->
    <script src="{{ asset('/') }}AdminLte/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="{{ asset('/') }}AdminLte/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/inputmask/jquery.inputmask.min.js"></script>
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
    <script src="{{ asset('/') }}AdminLte/plugins/dropzone/min/dropzone.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/dropzone"></script> -->



    <script src="{{ asset('/') }}AdminLte/plugins/summernote/summernote-bs4.min.js"></script>

    <script src="{{ asset('/') }}AdminLte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(function() {

            $('.summernote').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['fontsize', ['fontsize']],
                    ['fontname', ['fontname']],
                    ['insert', ['link']],
                    ['color', ['color']],
                    ['height', ['height']],
                    ['font', ['strikethrough', 'superscript', 'subscript']]
                ]
            });

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $('.swalDefaultSuccess').click(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
            $('.swalDefaultInfo').click(function() {
                Toast.fire({
                    icon: 'info',
                    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
            $('.swalDefaultError').click(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

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

            //Date picker

            let objectDate = new Date();
            let day = objectDate.getDate();
            let month = objectDate.getMonth() + 1;
            let year = objectDate.getFullYear();
            let currenTime = (month < 10 ? '0' + month : month) + '/' + (day < 10 ? '0' + day : day) + '/' + year

            var accountsIdList = {!! json_encode($accountsCheckList) !!};
            accountsIdList.forEach(element => {
                $('#reservationdate' + element.id).datetimepicker({
                    format: 'DD/MM/YYYY',
                });
                // var date = new Date(element.dob);
                // alert(date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear())
                // $('#picker' + element.id).val() = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date
                //     .getFullYear();
            });


            //Date and time picker
            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                        'MMMM D, YYYY'))
                }
            )

            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })

            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            })

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

        })
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
    </script>
@endsection
