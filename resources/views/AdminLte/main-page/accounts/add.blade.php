@extends('AdminLte.main-page.layout.mainLayout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="token" content="{{ csrf_token() }}">

    <title>VicTory Group - Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/dist/css/adminlte.min.css">
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


            $('.user_add').addClass('active')



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
                        //alert(element.username + ' - '+ username )
                        check = false;
                        error_note += 'Username "' + username+ '" is already exist ! <br>'

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
                    error_note += 'Inputed email didn\'t contain "@" ! <br>'
                }
                if (hasSpecialCharacters(username)) {
                    check = false;
                    error_note += 'User name mustn\'t contain any special charatrer ("' +
                        '!\"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~' + '") is invalid ! <br>'
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
                if (dob === '' || isValidDate(dob) == false) {
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




            });




            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                }
            });

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
@endsection

@section('content')
    <div class="content-wrapper">


        {{-- <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    Laravel 10 Crop and Resize Upload Image Ajax
                    <br>
                    {{ session()->get('main-photo') }}
                </div>
                <div class="card-body">
                    <input type="file" name="before_crop_image" id="before_crop_image" accept="image/*" />
                </div>
            </div>
        </div>

        <div id="imageModel" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Laravel 10 Crop and Resize Upload Image Ajax</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <div id="image_demo" style="width:100%; margin-top:30px"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary crop_image">Save changes</button>
                    </div>
                </div>
            </div>
        </div> --}}








        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Account Adding</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add new account</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Infomation</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="addForm" action="{{ url('/admin/accounts/proccessAdd') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="menu" value="user">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="fullname">Full Name</label>
                                        <input name='fullname' type="text" class="form-control" id="fullname"
                                            placeholder="Enter full name">
                                    </div>
                                    <div class="form-group">

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                                value="male" checked>
                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                                value="female">
                                            <label class="form-check-label" for="inlineRadio2">Female</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input name='email' type="text" class="form-control" id="email"
                                            placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone number</label>
                                        <div class="input-group">

                                            <input name="phone" type="text" class="form-control" id="phone">
                                            <div class="input-group-prepend bg-secondary">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Date of birth:</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input id="dob" name="dob" type="text" class="form-control "
                                                data-target="#reservationdate" data-inputmask-alias="datetime"
                                                data-inputmask-inputformat="dd/mm/yyyy" data-mask />
                                            <div class="input-group-append" data-target="#reservationdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label>Role</label>
                                        <select name="roleid" class="form-select w-100">
                                            @foreach ($roleList as $role)
                                            @if($role->id != 3)
                                                <option value="{{ $role->id }}"
                                                    @if ($role->id == 1) selected @endif>{{ $role->name }}
                                                </option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Account's username</label>
                                        <input id="username" name='username' type="text" class="form-control"
                                            placeholder="Enter name">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Account's password</label>
                                        <input id="password" name='password' type="password" class="form-control"
                                            placeholder="Enter password">
                                    </div>
                                    <div class="form-group">
                                        <label for="cofirmPassword">Confirm password</label>
                                        <input name='cofirmPassword' type="password" class="form-control"
                                            id="cofirmPassword" placeholder="Enter password">
                                    </div>




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


                                    <div class="form-group">
                                        <label for="dangers">Account's status</label>
                                        <input name="status" type="checkbox" checked data-bootstrap-switch
                                            data-on-text="activated" data-off-text="deactivated" data-off-color="danger"
                                            data-on-color="success" value="1">

                                    </div>





                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="button" value="add"
                                        class="btn btn-block btn-outline-info btn-sm">Confirm
                                        Add</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!------------------------------------------------------------->





                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


@section('script')
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}AdminLte/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/') }}AdminLte/dist/js/demo.js"></script>

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

            let objectDate = new Date();


            let day = objectDate.getDate();

            let month = objectDate.getMonth() + 1;

            let year = objectDate.getFullYear();

            let currenTime = (month < 10 ? '0' + month : month) + '/' + (day < 10 ? '0' + day : day) + '/' + year

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'DD/MM/YYYY',
                maxDate: currenTime

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
